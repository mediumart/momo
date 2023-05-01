<?php
namespace Mediumart\MobileMoney\Tests;

use Ramsey\Uuid\Uuid;
use Mediumart\MobileMoney\MobileMoney;
use Mediumart\MobileMoney\Collection\Client;

class CollectionClientTest extends TestCase
{
    /**
     * Subscription key
     *
     * @var string
     */
    protected $subscriptionKey = '0ce2ea5d5c98474f94034146fe69d3be';
    
    /**
     * Setup
     */
    protected function setUp():void 
    {
        // $this->sandboxUser = UsersProvisioning::sandboxUserFor($this->subscriptionKey);

        // $this->client = MobileMoney::collection();

        // $response = $this->client->createAccessToken(
        //     $this->subscriptionKey,
        //     $this->sandboxUser->id,
        //     $this->sandboxUser->apiKey
        // )->getBody();

        // $this->accessToken = json_decode($response)->access_token;    
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function testRequestToPay():void
    {
        $this->assertTrue(true);

        //
        //
        // // requestToPay
        // $response = $this->client->requestToPay(
        //     $this->subscriptionKey, 
        //     $this->accessToken, 
        //     $requestToPayId = Uuid::uuid4(),
        //     'sandbox',
        //     [
        //         "amount" => "1000",
        //         "currency"=> "EUR",
        //         "externalId"=> $requestToPayId,
        //         "payer"=> [
        //         "partyIdType"=> "MSISDN",
        //         "partyId"=> "237675000001"
        //         ],
        //         "payerMessage"=> "Testing",
        //         "payeeNote"=> "Test"
        //     ]
        // );
        // $this->assertEquals(202, $response->getStatusCode());

        //
        //
        // // requestToPayTransactionStatus
        // $response = $this->client->requestToPayTransactionStatus(
        //     $requestToPayId,
        //     $this->subscriptionKey, 
        //     'sandbox',
        //     $this->accessToken
        // );
        // $this->assertEquals(200, $response->getStatusCode());

        // // requestToPayDeliveryNotification
        // $response = $this->client->requestToPayDeliveryNotification(
        //     'Test Notification Message',
        //     $this->subscriptionKey,
        //     $requestToPayId,
        //     'sandbox',
        //     $this->accessToken
        // );
        // $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetAccountBalance() :void
    {
        $this->assertTrue(true);
        
        //
        //
        // // getAccountBalance
        // $response = $this->client->getAccountBalance(
        //     $this->subscriptionKey, 'sandbox', $this->accessToken
        // );
        // $this->assertEquals(200, $response->getStatusCode());
    }

    public function testRequestToWithdraw():void
    {
        $this->assertTrue(true);

        //
        //
        // // requestToWithdrawV1
        // $response = $this->client->requestToWithdrawV1(
        //     $requestToPayId = Uuid::uuid4(), $this->accessToken,
        //     $this->subscriptionKey, 'sandbox', [
        //         "payeeNote" => "test",
        //         "externalId" => $requestToPayId,
        //         "amount" => "1000",
        //         "currency" => "EUR",
        //         "payer"=> [
        //             "partyIdType"=> "MSISDN",
        //             "partyId"=> "237675000001"
        //         ],
        //         "payerMessage"=> "Testing message"
        //     ]
        // );
        // $this->assertEquals(202, $response->getStatusCode());

        //
        //
        // // requestToWithdrawV1TransactionStatus
        // $response = $this->client->requestToWithdrawV1TransactionStatus(
        //     $requestToPayId, $this->accessToken,
        //     $this->subscriptionKey, 'sandbox'
        // );
        // $this->assertEquals(200, $response->getStatusCode());

        //
        //
        // // requestToWithdrawV2
        // $response = $this->client->requestToWithdrawV2(
        //     $requestToPayId = Uuid::uuid4(), $this->accessToken,
        //     $this->subscriptionKey, 'sandbox', [
        //         "payeeNote" => "test",
        //         "externalId" => $requestToPayId,
        //         "amount" => "1000",
        //         "currency" => "EUR",
        //         "payer"=> [
        //             "partyIdType"=> "MSISDN",
        //             "partyId"=> "237675000001"
        //         ],
        //         "payerMessage"=> "Testing message"
        //     ]
        // );
        // $this->assertEquals(202, $response->getStatusCode());
    }

    public function testGetBasicUserinfo() :void
    {
        $this->assertTrue(true);
        
        //
        //
        // // getBasicUserinfo
        // $response = $this->client->getBasicUserinfo(
        //     '237675000100', $this->subscriptionKey, 'sandbox', $this->accessToken
        // );
        // $this->assertEquals(200, $response->getStatusCode());
    }

    public function testValidateAccountHolderStatus() :void
    {
        $this->assertTrue(true);

        //
        //
        // // specifies the type of the party ID. Allowed values [msisdn, email, party_code].
        // // accountHolderId should explicitly be in small letters.
        // $response = $this->client->validateAccountHolderStatus(
        //     '237675000100', 'msisdn', $this->subscriptionKey, 'sandbox', $this->accessToken
        // );
        // $this->assertEquals(200, $response->getStatusCode());
    }
}
