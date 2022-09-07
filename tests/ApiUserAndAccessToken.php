<?php
namespace Mediumart\MobileMoney\Tests;

use Mediumart\MobileMoney\Sandbox\UsersProvisioning;

trait ApiUserAndAccessToken
{
    /**
     * @var ApiUser
     */
    protected $sandboxUser;

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @var bool
     */
    protected $apiTested = true;

    /**
     * Setup
     */
    protected function setUp():void 
    {
        if (! $this->apiTested) {

            if (! $this->sandboxUser) {
                $this->sandboxUser = UsersProvisioning::sandboxUserFor($this->subscriptionKey);
            }
            
            $this->client = $this->getServiceClient();

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
