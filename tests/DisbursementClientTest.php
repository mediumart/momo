<?php
namespace Mediumart\MobileMoney\Tests;

use Ramsey\Uuid\Uuid;
use Mediumart\MobileMoney\MobileMoney;
use Mediumart\MobileMoney\Disbursement\Client;

class DisbursementClientTest extends TestCase
{
    use ApiUserAndAccessToken;
    
    /**
     * @var Client
     */
    protected $client;

    protected $subscriptionKey = '0f0433705bbe4985800bd0a3f70553c5';
    
    protected function getServiceClient():mixed
    {
        return MobileMoney::sandbox()->disbursement();
    }

    public function testDepositV1AndV2():void
    {
        if (! $this->apiTested) {
            $response = $this->client->depositV1(
                $this->subscriptionKey, 
                $requestId = Uuid::uuid4(),
                $this->accessToken, 
                'sandbox',
                [
                    "amount" => "1000",
                    "currency"=> "EUR",
                    "externalId"=> $requestId,
                    "payee"=> [
                        "partyIdType"=> "MSISDN",
                        "partyId"=> "237675000001"
                    ],
                    "payerMessage"=> "Testing",
                    "payeeNote"=> "Test"
                ]
            );
            $this->assertEquals(202, $response->getStatusCode());

            $response = $this->client->getDepositStatus(
                $this->subscriptionKey, 
                $requestId,
                $this->accessToken, 
                'sandbox'
            );
            $this->assertEquals(200, $response->getStatusCode());

            $response = $this->client->depositV2(
                $this->subscriptionKey, 
                $requestId = Uuid::uuid4(),
                $this->accessToken, 
                'sandbox',
                [
                    "amount" => "1000",
                    "currency"=> "EUR",
                    "externalId"=> $requestId,
                    "payee"=> [
                        "partyIdType"=> "MSISDN",
                        "partyId"=> "237675000001"
                    ],
                    "payerMessage"=> "Testing",
                    "payeeNote"=> "Test"
                ]
            );
            $this->assertEquals(202, $response->getStatusCode());
        } else {
            $this->assertTrue(true);
        }
    }


    public function testRefundV1AndV2():void
    {
        if (! $this->apiTested) {
            $response = $this->client->refundV1(
                $this->subscriptionKey, 
                $requestId = Uuid::uuid4(),
                $this->accessToken, 
                'sandbox',
                [
                    "amount" => "1000",
                    "currency" => "EUR",
                    "externalId" => $requestId,
                    "payerMessage" => "Testing",
                    "payeeNote" => "Test",
                    "referenceIdToRefund" => $requestId
                ]
            );
            $this->assertEquals(202, $response->getStatusCode());

            $response = $this->client->getRefundStatus(
                $this->subscriptionKey, 
                $requestId,
                $this->accessToken, 
                'sandbox'
            );
            $this->assertEquals(200, $response->getStatusCode());

            $response = $this->client->refundV2(
                $this->subscriptionKey, 
                $requestId = Uuid::uuid4(),
                $this->accessToken, 
                'sandbox',
                [
                    "amount" => "1000",
                    "currency" => "EUR",
                    "externalId" => $requestId,
                    "payerMessage" => "Testing",
                    "payeeNote" => "Test",
                    "referenceIdToRefund" => $requestId
                ]
            );
            $this->assertEquals(202, $response->getStatusCode());
        } else {
            $this->assertTrue(true);
        }
    }
}
