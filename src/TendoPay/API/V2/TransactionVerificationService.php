<?php

namespace TendoPay\API\V2;

use Exception;
use InvalidArgumentException;
use TendoPay\Logger;
use TendoPay\SDK\Exception\TendoPayConnectionException;
use TendoPay\SDK\Models\VerifyTransactionRequest;
use TendoPay\SDK\Models\VerifyTransactionResponse;
use TendoPay\SDK\V2\TendoPayClient;
use UnexpectedValueException;

class TransactionVerificationService
{
    private $apiClient;
    private $logger;

    public function __construct(TendoPayClient $apiClient = null)
    {
        if (empty($apiClient)) {
            $apiClientFactory = new TendoPayApiClientFactory();
            $this->apiClient = $apiClientFactory->createClient();
        } else {
            $this->apiClient = $apiClient;
        }

        $this->logger = new Logger();
    }

    /**
     * @param $requestParams
     *
     * @return VerifyTransactionResponse
     *
     * @throws InvalidArgumentException
     * @throws UnexpectedValueException
     */
    public function getVerifiedTransaction($requestParams)
    {
        if ($this->apiClient::isCallbackRequest($requestParams)) {
            $transaction = $this->apiClient->verifyTransaction(new VerifyTransactionRequest($requestParams));

            if ( ! $transaction->isVerified()) {
                throw new UnexpectedValueException('Invalid signature for the verification');
            }

            return $transaction;
        } else {
            throw new InvalidArgumentException("This is not a valid payment request callback!");
        }
    }
}