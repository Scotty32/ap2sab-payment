<?php

namespace App\Communicators;

use App\Contracts\CheckTransactionResponseModel;
use App\Contracts\InitTransactionModel;
use App\Contracts\InitTransactionResponseModel;
use App\Models\Transaction;
use Exception;
use GuzzleHttp\Client;

class CinetpayHttpClient
{

    public function __construct(
        private string $apiKey,
        private string $siteId,
    ) {}

    /**
     * @todo rename to initPayment
     */
    public function initTransaction(InitTransactionModel $data): InitTransactionResponseModel
    {
        $data = [
            "apikey" => $this->apiKey,
            "site_id" => $this->siteId,
            "transaction_id" => $data->getTransactionId(),
            "amount" => $data->getAmount()->getAmount(),
            "currency" => $data->getAmount()->getCurrency(),
            "description" => $data->getDesignation(),
            "customer_name" => $data->getProfile()->last_name,
            "customer_surname" => $data->getProfile()->first_name,
            "customer_email" => $data->getProfile()->last_email,
            "customer_phone_number" => $data->getProfile()->phone_number,
            "customer_address" => "Antananarivo",
            "customer_city" => $data->getProfile()->city,
            "customer_country" => 'CI',
            "customer_state" => "CM",
            "customer_zip_code" => "00225",
            "notify_url" => $data->getNotifyUrl(),
            "return_url" => $data->getReturnUrl(),
            "channels" => "ALL",
            "lang" => "FR",
        ];

        try {
            $client = new Client();
            $response = $client->post('https://api-checkout.cinetpay.com/v2/payment', [
                'json' => $data,
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
            ]);

            $responseData = json_decode($response->getBody(), true);

            return New InitTransactionResponseModel(
                $responseData['data']['payment_url'],
                $responseData['data']['payment_token'],
            );
        } catch (Exception $e) {
            error_log('Error while initiating payment');
            error_log($e->getMessage());

            throw $e;
        }
    }

    public function getTransactionStatus(string $transactionId): CheckTransactionResponseModel
    {
        $data = [
            "apikey" => $this->apiKey,
            "site_id" => $this->siteId,
            "transaction_id" => $transactionId,
        ];

        try {
            $client = new Client();
            $response = $client->post('https://api-checkout.cinetpay.com/v2/payment/check', [
                'json' => $data,
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
            ]);

            $responseData = json_decode($response->getBody(), true);
            switch ($responseData['data']['status']) {
                case 'ACCEPTED':
                    $paymentStatus = Transaction::TRANSACTION_STATUS_SUCCESS;
                    break;
                case 'REFUSED':
                    $paymentStatus = Transaction::TRANSACTION_STATUS_FAILED;
                    break;
                default:
                $paymentStatus = Transaction::TRANSACTION_STATUS_PENDING;
                    break;
            }

            $operationId = $responseData['data']['operator_id'];
            $paymentDate = $responseData['data']['payment_date'];

            return new CheckTransactionResponseModel(
                $paymentStatus,
                $operationId,
                $paymentDate,
            );
        } catch (Exception $e) {
            error_log('Error while initiating payment');
            error_log($e->getMessage());

            throw $e;
        } 
    }
}