<?php

namespace App\Http\Controllers;

use App\Services\ParticipantService;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class NotifyPayment extends Controller
{
    public function __construct(
        private TransactionService $transactionService) {}
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $transaction_id = $request->input('cpm_trans_id');
        $this->transactionService->addTransaction($transaction_id);

        return view('welcome');
    }
}
