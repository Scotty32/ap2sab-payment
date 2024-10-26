<?php declare(strict_type=1);

namespace App\Services;

use App\Communicators\CinetpayHttpClient;
use App\Contracts\CreateTransactionContract;
use App\Contracts\InitTransactionModel;
use App\Models\Money;
use App\Models\Profile;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class TransactionService
{
    public function __construct(
        private CinetpayHttpClient $cinetpayHttpClient,
    ) { }

    public function initTransaction(
        Profile $profile,
        Money $amount,
        string $designation,
        string $returnUrl,
    ): Transaction {
        $transactionId = Uuid::uuid4();
        $notifyUrl = url(route('cinetpay.notification.handler'));
        Log::info(" notification url : {url} ", ['url' => $notifyUrl]);
        $paymentModel = $this->cinetpayHttpClient->initTransaction(
            new InitTransactionModel(
                $profile,
                $amount,
                $transactionId,
                $designation,
                $returnUrl,
                $notifyUrl
            )
        );
        return $this->_createTransaction(
            new CreateTransactionContract(
                $transactionId,
                $amount,
                $designation,
                $paymentModel->getPaymentToken(),
                $paymentModel->getPaymentUrl(),

            )
        );
    }

    public function handleTransactionStatus(string $transactionId): void
    {
        $transaction = Transaction::where('transaction_uuid', $transactionId)->first();

        if (!$transaction) {
            Log::error("la transaction {id} n'existe pas", ['id' => $transactionId]);
        }
        
        if (
            Transaction::TRANSACTION_STATUS_SUCCESS === $transaction->status
            || Transaction::TRANSACTION_STATUS_FAILED === $transaction->status
        ) {
            Log::error("la transaction {id} a deja ete traitee", ['id' => $transaction->id]);
            return;
        }

        $transactionStatusModel = $this->cinetpayHttpClient->getTransactionStatus($transactionId);

        try {
            $transaction->status = $transactionStatusModel->getPaymentStatus();
            $transaction->payment_code = $transactionStatusModel->getPaymentCode();
            $transaction->payment_date = $transactionStatusModel->getPaymentDate();

            $transaction->save();
        } catch (\Throwable $th) {
            Log::error("une erreur s\'est produite", ['error' => $th]);
            throw new Exception('une erreur s\'est produite');
        }
    }

    private function _createTransaction(CreateTransactionContract $transactionDto): Transaction {
        $data = [
            'amount' => $transactionDto
                ->getAmount(),
            'transaction_uuid' => $transactionDto->getUuid(),
            'payment_url' => $transactionDto->getPayementUrl(),
            'payment_token' => $transactionDto->getPayementToken(),
            'designation' => $transactionDto->getDesignation(),
            'status' => Transaction::TRANSACTION_STATUS_PENDING,
        ];

        $transaction = Transaction::create($data);

        return $transaction;
    }
}
