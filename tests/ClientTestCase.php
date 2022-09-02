<?php
namespace Mediumart\MobileMoney\Tests;

use Mediumart\MobileMoney\Collection\Client;
use Mediumart\MobileMoney\MobileMoney;
use Mediumart\MobileMoney\Sandbox\ApiUser;
use Mediumart\MobileMoney\Sandbox\UsersProvisioning;

class ClientTestCase extends TestCase
{
    /**
     * @var ApiUser
     */
    protected $sandboxUser;

    /**
     * @var Client
     */
    protected $client;

    protected $accessToken;
    protected $subscriptionKey = '0ce2ea5d5c98474f94034146fe69d3be';
    protected $apiTested = true;

    protected function setUp():void
    {        
        if (! $this->apiTested)  {

            if (! $this->sandboxUser) {
                $this->sandboxUser = UsersProvisioning::sandboxUserFor($this->subscriptionKey);
            }
            
            $this->client = MobileMoney::sandbox()->collection();

            if (! $this->accessToken) {
                $response = $this->client->createAccessToken(
                    $this->subscriptionKey,
                    $this->sandboxUser->id,
                    $this->sandboxUser->apiKey
                )->getBody();

                $this->accessToken = json_decode($response)->access_token;    
            }
        }
    }
}