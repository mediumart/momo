<?php
namespace Mediumart\MobileMoney\Tests;

use Ramsey\Uuid\Uuid;
use Mediumart\MobileMoney\MobileMoney;
use Mediumart\MobileMoney\Disbursement\Client;

class DisbursementClientTest extends TestCase
{
    /**
     * Subscription key
     *
     * @var string
     */
    protected $subscriptionKey = '0f0433705bbe4985800bd0a3f70553c5';
    
    /**
     * Setup
     */
    protected function setUp():void 
    {
        // $this->sandboxUser = UsersProvisioning::sandboxUserFor($this->subscriptionKey);

        // $this->client = MobileMoney::disbursement();

        // $response = $this->client->createAccessToken(
        //     $this->subscriptionKey,
        //     $this->sandboxUser->id,
        //     $this->sandboxUser->apiKey
        // )->getBody();

        // $this->accessToken = json_decode($response)->access_token;    
    }


    public function testDepositV1AndV2():void
    {
        $this->assertTrue(true);

        //
        //
        // // depositV1
        // $response = $this->client->depositV1(
        //     $this->subscriptionKey, 
        //     $requestId = Uuid::uuid4(),
        //     $this->accessToken, 
        //     'sandbox',
        //     [
        //         "amount" => "1000",
        //         "currency"=> "EUR",
        //         "externalId"=> $requestId,
        //         "payee"=> [
        //             "partyIdType"=> "MSISDN",
        //             "partyId"=> "237675000001"
        //         ],
        //         "payerMessage"=> "Testing",
        //         "payeeNote"=> "Test"
        //     ]
        // );
        // $this->assertEquals(202, $response->getStatusCode());
        
        //
        //
        // // getDepositStatus
        // $response = $this->client->getDepositStatus(
        //     $this->subscriptionKey, 
        //     $requestId,
        //     $this->accessToken, 
        //     'sandbox'
        // );
        // $this->assertEquals(200, $response->getStatusCode());

        //
        //
        // // depositV2
        // $response = $this->client->depositV2(
        //     $this->subscriptionKey, 
        //     $requestId = Uuid::uuid4(),
        //     $this->accessToken, 
        //     'sandbox',
        //     [
        //         "amount" => "1000",
        //         "currency"=> "EUR",
        //         "externalId"=> $requestId,
        //         "payee"=> [
        //             "partyIdType"=> "MSISDN",
        //             "partyId"=> "237675000001"
        //         ],
        //         "payerMessage"=> "Testing",
        //         "payeeNote"=> "Test"
        //     ]
        // );
        // $this->assertEquals(202, $response->getStatusCode());
    }


    public function testRefundV1AndV2():void
    {
        $this->assertTrue(true);

        //
        //
        // // refundV1
        // $response = $this->client->refundV1(
        //     $this->subscriptionKey, 
        //     $requestId = Uuid::uuid4(),
        //     $this->accessToken, 
        //     'sandbox',
        //     [
        //         "amount" => "1000",
        //         "currency" => "EUR",
        //         "externalId" => $requestId,
        //         "payerMessage" => "Testing",
        //         "payeeNote" => "Test",
        //         "referenceIdToRefund" => $requestId
        //     ]
        // );
        // $this->assertEquals(202, $response->getStatusCode());
        
        //
        //
        // // getRefundStatus
        // $response = $this->client->getRefundStatus(
        //     $this->subscriptionKey, 
        //     $requestId,
        //     $this->accessToken, 
        //     'sandbox'
        // );
        // $this->assertEquals(200, $response->getStatusCode());

        //
        //
        // // refundV2
        // $response = $this->client->refundV2(
        //     $this->subscriptionKey, 
        //     $requestId = Uuid::uuid4(),
        //     $this->accessToken, 
        //     'sandbox',
        //     [
        //         "amount" => "1000",
        //         "currency" => "EUR",
        //         "externalId" => $requestId,
        //         "payerMessage" => "Testing",
        //         "payeeNote" => "Test",
        //         "referenceIdToRefund" => $requestId
        //     ]
        // );
        // $this->assertEquals(202, $response->getStatusCode());
    }
}
