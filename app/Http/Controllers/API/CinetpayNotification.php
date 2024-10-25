<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CinetpayNotification extends Controller
{
    public function __construct(
        private TransactionService $transactionService) {}
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        Log::info( 'response' , $request->all());
        $transaction_id = $request->input('cpm_trans_id');
        if (!$transaction_id) {
            abort(400);
        }

        Log::info('traitement de la transaction {id} par webhook ', ['id' => $transaction_id]);
        $this->transactionService->handleTransactionStatus($transaction_id);

        return response("");
    }
}
