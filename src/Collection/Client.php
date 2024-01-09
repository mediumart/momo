<?php
namespace Mediumart\MobileMoney\Collection;

use Mediumart\MobileMoney\BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    /**
     * This operation is used to delete an invoice. The invoiceId is associated with the invoice to be cancelled
     *
     * @param string $invoiceId
     * @param string $token
     * @param string $targetEnv
     * @param string|null $callbackUrl
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function cancelInvoice(string $invoiceId, string $token, string $targetEnv, string $callbackUrl = null)
    {
        $headers = [
            'Authorization' => 'Bearer '.$token,
            'X-Target-Environment' => $targetEnv
        ];

        if (! empty($callbackUrl)) {
            $headers['X-Callback-Url'] = $callbackUrl;
        }

        return $this->client->request('DELETE',
            $this->baseurl.'/v2_0/invoice/'.$invoiceId, [
                'headers' => $headers
            ]
        );
    }

    /**
     * A merchant may use this in order to create an invoice that can be paid by an intended payer via any channel at a later stage.
     *
     * @param string $invoiceId
     * @param string $token
     * @param string $targetEnv
     * @param mixed[] $payload
     * @param string|null $callbackUrl
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createInvoice(
        string $invoiceId,
        string $token,
        string $targetEnv,
        array $payload,
        string $callbackUrl = null
    )
    {
        $headers = [
            'Authorization' => 'Bearer '.$token,
            'X-Target-Environment' => $targetEnv,
            'X-Reference-Id' => $invoiceId
        ];

        if (! empty($callbackUrl)) {
            $headers['X-Callback-Url'] = $callbackUrl;
        }

        return $this->client->request('POST',
            $this->baseurl.'/v2_0/invoice', [
                'headers' => $headers,
                'body' => json_encode($payload)
            ]
        );
    }

    /**
     * Making it possible to perform payments via the partner gateway.
     * This may be used to pay for external bills or to perform air-time top-ups.
     *
     * @param string $paymentId
     * @param string $token
     * @param string $targetEnv
     * @param string|null $callbackUrl
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createPayments(
        string $paymentId,
        string $token,
        string $targetEnv,
        string $callbackUrl = null
    )
    {
        $headers =  [
            'Authorization' => 'Bearer '.$token,
            'X-Target-Environment' => $targetEnv,
            'X-Reference-Id' => $paymentId
        ];

        if (! empty($callbackUrl)) {
            $headers['X-Callback-Url'] = $callbackUrl;
        }

        return $this->client->request('POST', $this->baseurl.'/v2_0/payment', [
            'headers' => $headers
        ]);
    }
    /**
     * This operation is used to get the status of an invoice.
     * invoice-Id that was passed in the post is used as reference to the request
     *
     * @param string $invoiceId
     * @param string $token
     * @param string $targetEnv
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getInvoiceStatus(string $invoiceId, string $token, string $targetEnv)
    {
        return $this->client->request('GET', $this->baseurl.'/v2_0/invoice/'.$invoiceId, [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                'X-Target-Environment' => $targetEnv,
            ]
        ]);
    }

    /**
     * This operation is used to get the status of a Payment.
     * payment-Id that was passed in the post is used as reference to the request
     *
     * @param string $paymentId
     * @param string $token
     * @param string $targetEnv
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getPaymentStatus(string $paymentId, string $token, string $targetEnv)
    {
        return $this->client->request('GET', $this->baseurl.'/v2_0/payment/'.$paymentId, [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                'X-Target-Environment' => $targetEnv,
            ]
        ]);
    }

    /**
     * Preapproval operation is used to create a pre-approval.
     *
     * @param string $preApprovalId
     * @param string $token
     * @param string $targetEnv
     * @param mixed[] $payload
     * @param string|null $callbackUrl
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function preApproval(
        string $preApprovalId,
        string $token,
        string $targetEnv,
        array $payload,
        string $callbackUrl =null
    )
    {
        $headers = $headers =  [
            'Authorization' => 'Bearer '.$token,
            'X-Target-Environment' => $targetEnv,
            'X-Reference-Id' => $preApprovalId
        ];

        if (! empty($callbackUrl)) {
            $headers['X-Callback-Url'] = $callbackUrl;
        };

        return $this->client->request('POST', $this->baseurl.'/v2_0/preapproval', [
            'headers' => $headers,
            'body' => json_encode($payload)
        ]);
    }

    /**
     * This operation is used to get the status of a pre-approval.
     * preapproval-Id that was passed in the post is used as reference to the request.
     *
     * @param string $preApprovalId
     * @param string $token
     * @param string $targetEnv
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getPreApprovalStatus(string $preApprovalId, string $token, string $targetEnv)
    {
        return $this->client->request('GET', $this->baseurl.'/v2_0/preapproval/'.$preApprovalId, [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                'X-Target-Environment' => $targetEnv,
            ]
        ]);
    }

    /**
     * Request a payment from a consumer (Payer).
     *
     * @param string $subscriptionKey
     * @param string $token
     * @param string $requestId
     * @param string $targetEnv
     * @param mixed[] $payload
     * @param string $callbackUrl
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function requestToPay(
        string $subscriptionKey,
        string $token,
        string $requestId,
        string $targetEnv,
        array $payload,
        string $callbackUrl=null
    ):ResponseInterface
    {
        $headers = [
            'Authorization' => 'Bearer '.$token,
            'X-Reference-Id' => $requestId,
            'X-Target-Environment' => $targetEnv,
            'Content-Type' => 'application/json',
            'Ocp-Apim-Subscription-Key' => $subscriptionKey
        ];

        if (! empty($callbackUrl))
            $headers['X-Callback-Url'] = $callbackUrl;

        return $this->client->request('POST',
            $this->baseurl.'/v1_0/requesttopay',[
                'headers' => $headers,
                'body' => json_encode($payload)
            ]
        );
    }

    /**
     * This operation is used to get the status of a request to pay.
     * X-Reference-Id that was passed in the post is used as reference to the request..
     *
     * @param string $requestId
     * @param string $subscriptionKey
     * @param string $targetEnv
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function requestToPayTransactionStatus(
        string $requestId,
        string $subscriptionKey,
        string $targetEnv,
        string $token
    ):ResponseInterface
    {
        return $this->client->request('GET',
            $this->baseurl.'/v1_0/requesttopay/'.$requestId,[
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'X-Target-Environment' => $targetEnv,
                    'Ocp-Apim-Subscription-Key' => $subscriptionKey
                ]
            ]
        );
    }

    /**
     * This operation is used to request a withdrawal (cash-out) from a consumer (Payer).
     * The payer will be asked to authorize the withdrawal.
     * The transaction will be executed once the payer has authorized the withdrawal
     *
     * @param string $requestId
     * @param string $token
     * @param string $subscriptionKey
     * @param string $targetEnv
     * @param mixed[] $payload
     * @param string $callbackUrl
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function requestToWithdrawV1(
        string $requestId,
        string $token,
        string $subscriptionKey,
        string $targetEnv,
        array $payload,
        string $callbackUrl=null
    ):ResponseInterface
    {
        $headers = [
            'Authorization' => 'Bearer '.$token,
            'X-Reference-Id' => $requestId,
            'X-Target-Environment' => $targetEnv,
            'Ocp-Apim-Subscription-Key' => $subscriptionKey
        ];

        if (! empty($callbackUrl))
            $headers['X-Callback-Url'] = $callbackUrl;

        return $this->client->request('POST',
            $this->baseurl.'/v1_0/requesttowithdraw',[
                'headers' => $headers,
                'body' =>json_encode($payload)
            ]
        );
    }

    /**
     * This operation is used to request a withdrawal (cash-out) from a consumer (Payer).
     * The payer will be asked to authorize the withdrawal.
     * The transaction will be executed once the payer has authorized the withdrawal
     *
     * @param string $requestId
     * @param string $token
     * @param string $subscriptionKey
     * @param string $targetEnv
     * @param mixed[] $payload
     * @param string $callbackUrl
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function requestToWithdrawV2(
        string $requestId,
        string $token,
        string $subscriptionKey,
        string $targetEnv,
        array $payload,
        string $callbackUrl=null
    ):ResponseInterface
    {
        $headers = [
            'Authorization' => 'Bearer '.$token,
            'X-Reference-Id' => $requestId,
            'X-Target-Environment' => $targetEnv,
            'Ocp-Apim-Subscription-Key' => $subscriptionKey
        ];

        if (! empty($callbackUrl))
            $headers['X-Callback-Url'] = $callbackUrl;

        return $this->client->request('POST',
            $this->baseurl.'/v2_0/requesttowithdraw',[
                'headers' => $headers,
                'body' =>json_encode($payload)
            ]
        );
    }

    /**
     * This operation is used to get the status of a request to withdraw.
     * X-Reference-Id that was passed in the post is used as reference to the request.
     *
     * @param string $requestId
     * @param string $token
     * @param string $subscriptionKey
     * @param string $targetEnv
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function requestToWithdrawV1TransactionStatus(
        string $requestId,
        string $token,
        string $subscriptionKey,
        string $targetEnv
    ):ResponseInterface
    {
        return $this->client->request('GET',
            $this->baseurl.'/v1_0/requesttowithdraw/'.$requestId,[
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'X-Target-Environment' => $targetEnv,
                    'Ocp-Apim-Subscription-Key' => $subscriptionKey
                ]
            ]
        );
    }
}
