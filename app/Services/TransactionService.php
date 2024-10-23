<?php declare(strict_type=1);

namespace App\Services;

use App\Contracts\CreateParticipantContract;
use App\Contracts\CreateTransactionContract;
use App\Models\Transaction;
use CinetPay\CinetPay;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionService
{
    public function __construct(
        private ParticipantService $participantService,
    ) { }

    public function addTransaction(string $transactionId): Transaction {
        /**
         * @var CinetPay $cinetpay
        */
        $cinetpay = App::make(CinetPay::class);
        $cinetpay->setTransId($transactionId);
        if (!$cinetpay->getPayStatus($transactionId, Config('cinetpay.site_id'))) {
            throw new Exception("la transaction n existe pas");
        }

        $amount = $cinetpay->_cpm_amount;
        $currency = $cinetpay->_cpm_currency;
        $metadata = base64_decode($cinetpay->_cpm_custom);
        $message = $cinetpay->_cpm_error_message;
        $payment_date = $cinetpay->_cpm_payment_date;

        $metadata = json_decode($metadata, true);

        if (null === $metadata) {
            throw new Exception("une erreur s'est produite");
        }

        $validator = Validator::make($metadata, [
            'nom' => 'required|string',
            'prenoms' => 'required|string',
            'email' => 'required|string',
            'telephone' => 'required|string',
            'profession' => 'string',
            'promotion' => 'required|string',
            'ville' => 'required|string',
            'pays' => 'required|string',
        ]);

        if ('SUCCES' !== $message) {
            throw new Exception('la transaction est en attente vous serez notifié lorsqu\'elle sera validé');
        }

        if ($validator->fails()) {
            throw new Exception("le payment a été effectué mais nous n'avons pas pu valider votre inscription veuillez contacter le support");
        }
            
        $validatedMetadata = $validator->validated();
        $code = $cinetpay->_cpm_payid;

        if (Transaction::where('payment_code', $cinetpay->_cpm_payid)->exists()) {
            throw new Exception('la transaction a deja été enregistrée');
        }

        $transactionDto = new CreateTransactionContract(
            $transactionId,
            $code,
            (float)$amount,
            $currency,
            $payment_date
        );
        try {
            DB::beginTransaction();

            $transaction = $this->_addTransaction($transactionDto);

            $participantDto = new CreateParticipantContract(
                $validatedMetadata['nom'],
                $validatedMetadata['prenoms'],
                $validatedMetadata['email'],
                $validatedMetadata['telephone'],
                $validatedMetadata['promotion'],
                $validatedMetadata['profession'],
                $validatedMetadata['pays'],
                $validatedMetadata['ville'],          
            );
    
            $this->participantService->addParticipant($participantDto, $transaction);
            DB::commit();
            return $transaction;
    
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    private function _addTransaction(CreateTransactionContract $transactionDto): Transaction {
        $data = [
            'amount' => $transactionDto
                ->getAmount(),
            'transaction_uuid' => $transactionDto->getUuid(),
            'payment_code' => $transactionDto->getPaymentCode(),
            'payment_date' => $transactionDto->getPaymentDate(),
        ];

        $transaction = Transaction::create($data);

        return $transaction;
    }
}
