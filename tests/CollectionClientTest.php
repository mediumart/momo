<?php
namespace Mediumart\MobileMoney\Tests;

use Ramsey\Uuid\Uuid;
use Mediumart\MobileMoney\MobileMoney;
use Mediumart\MobileMoney\Collection\Client;

class CollectionClientTest extends TestCase
{
    use ApiUserAndAccessToken;

    /**
     * @var Client
     */
    protected $client;

    protected $subscriptionKey = '0ce2ea5d5c98474f94034146fe69d3be';
    
    protected function getServiceClient():mixed
    {
        return MobileMoney::collection();
    }

    public function testRequestToPay():void
    {
        if (! $this->apiTested) {
            // requestToPay
            $response = $this->client->requestToPay(
                $this->subscriptionKey, 
                $this->accessToken, 
                $requestToPayId = Uuid::uuid4(),
                'sandbox',
                [
                    "amount" => "1000",
                    "currency"=> "EUR",
                    "externalId"=> $requestToPayId,
                    "payer"=> [
                    "partyIdType"=> "MSISDN",
                    "partyId"=> "237675000001"
                    ],
                    "payerMessage"=> "Testing",
                    "payeeNote"=> "Test"
                ]
            );
            $this->assertEquals(202, $response->getStatusCode());

            //requestToPayTransactionStatus
            $response = $this->client->requestToPayTransactionStatus(
                $requestToPayId,
                $this->subscriptionKey, 
                'sandbox',
                $this->accessToken
            );
            $this->assertEquals(200, $response->getStatusCode());

            // requestToPayDeliveryNotification
            $response = $this->client->requestToPayDeliveryNotification(
                'Test Notification Message',
                $this->subscriptionKey,
                $requestToPayId,
                'sandbox',
                $this->accessToken
            );
            $this->assertEquals(200, $response->getStatusCode());
        } else {
            $this->assertTrue(true);
        }
    }

    public function testGetAccountBalance() :void
    {
        if (! $this->apiTested) {
            $response = $this->client->getAccountBalance(
                $this->subscriptionKey, 'sandbox', $this->accessToken
            );
            $this->assertEquals(200, $response->getStatusCode());
        } else {
            $this->assertTrue(true);
        }
    }

    public function testRequestToWithdraw():void
    {
        if (! $this->apiTested) {
            $response = $this->client->requestToWithdrawV1(
                $requestToPayId = Uuid::uuid4(), $this->accessToken,
                $this->subscriptionKey, 'sandbox', [
                    "payeeNote" => "test",
                    "externalId" => $requestToPayId,
                    "amount" => "1000",
                    "currency" => "EUR",
                    "payer"=> [
                        "partyIdType"=> "MSISDN",
                        "partyId"=> "237675000001"
                    ],
                    "payerMessage"=> "Testing message"
                ]
            );
            $this->assertEquals(202, $response->getStatusCode());

            $response = $this->client->requestToWithdrawV1TransactionStatus(
                $requestToPayId, $this->accessToken,
                $this->subscriptionKey, 'sandbox'
            );
            $this->assertEquals(200, $response->getStatusCode());

            $response = $this->client->requestToWithdrawV2(
                $requestToPayId = Uuid::uuid4(), $this->accessToken,
                $this->subscriptionKey, 'sandbox', [
                    "payeeNote" => "test",
                    "externalId" => $requestToPayId,
                    "amount" => "1000",
                    "currency" => "EUR",
                    "payer"=> [
                        "partyIdType"=> "MSISDN",
                        "partyId"=> "237675000001"
                    ],
                    "payerMessage"=> "Testing message"
                ]
            );
            $this->assertEquals(202, $response->getStatusCode());
        } else {
            $this->assertTrue(true);
        }
    }

    public function testGetBasicUserinfo() :void
    {
        if (! $this->apiTested) {
            $response = $this->client->getBasicUserinfo(
                '237675000100', $this->subscriptionKey, 'sandbox', $this->accessToken
            );
            $this->assertEquals(200, $response->getStatusCode());
        } else {
            $this->assertTrue(true);
        }
    }

    public function testValidateAccountHolderStatus() :void
    {
        if (! $this->apiTested) {
            // specifies the type of the party ID. Allowed values [msisdn, email, party_code].
            // accountHolderId should explicitly be in small letters.
            $response = $this->client->validateAccountHolderStatus(
                '237675000100', 'msisdn', $this->subscriptionKey, 'sandbox', $this->accessToken
            );
            $this->assertEquals(200, $response->getStatusCode());
        } else {
            $this->assertTrue(true);
        }
    }
}
