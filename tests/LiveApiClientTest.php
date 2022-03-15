<?php
namespace Mediumart\Momo\Tests;

use Ramsey\Uuid\Uuid;
use Mediumart\Momo\Http\SandboxUserClient;
use Mediumart\Momo\Http\CollectionClient;

class LiveApiClientTest extends TestCase
{
    public function testLiveApiClients():void
    {
        $subscriptionKey = 'e6249204ad6e4294911b1e60e9bb5f73';
        $body = '{"providerCallbackHost": "isaacesso.com"}';
        $httpClient = new \GuzzleHttp\Client();
        
        // sandboxUserClient (can create api user end api key)
        $sandboxUserClient = new sandboxUserClient($httpClient, $subscriptionKey);
        $userReferenceId = Uuid::uuid4();

        $response = $sandboxUserClient->createApiUser($userReferenceId, $body);
        $this->assertEquals(201, $response->getStatusCode());

        $response = $sandboxUserClient->getApiUser($userReferenceId);
        $this->assertEquals(200, $response->getStatusCode());

        $user = json_decode($response->getBody(), True);
        $this->assertIsArray($user);
        $this->assertNotEmpty($user);

        $response = $sandboxUserClient->createApiKey($userReferenceId);
        $this->assertEquals(201, $response->getStatusCode());
        
        $apiKey = json_decode($response->getBody())->apiKey;
        $this->assertNotNull($apiKey);
        $this->assertNotEmpty($apiKey);

        ////
        ////
        ////

        // collectionClient
        $collectionClient = new CollectionClient($httpClient, $subscriptionKey);
        
        $response = $collectionClient->createToken($userReferenceId, $apiKey);
        $this->assertEquals(200, $response->getStatusCode());

        $tokenData = json_decode($response->getBody(), True);
        $this->assertIsArray($tokenData);
        $this->assertNotEmpty($tokenData);

        $requestToPayReferenceId = Uuid::uuid4();

        $response = $collectionClient->requestToPay(
            $tokenData['access_token'], 
            $requestToPayReferenceId,
            [
                "amount" => "2000",
                "currency"=> "EUR",
                "externalId"=> "123456789",
                "payer"=> [
                    "partyIdType"=> "MSISDN",
                    "partyId"=> "237675005678"
                ],
                "payerMessage"=> "Payment is pending ",
                "payeeNote"=> "product payment"
            ]
        );
        $this->assertEquals(202, $response->getStatusCode());
    } 
}