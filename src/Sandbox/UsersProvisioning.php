<?php
namespace Mediumart\Momo\Sandbox;

use Ramsey\Uuid\Uuid;

class UsersProvisioning
{
    /**
     * Create a new sandbox user for a given product api.
     *  
     * @param string $api
     * @return ApiUser
     */
    static public function sandboxUserFor(string $api)
    {
        $keys = require __DIR__.'/SubscriptionsKeys.php';

        if (! array_key_exists($api, $keys) || empty($keys[$api])) {
            return;
        }

        Factory::httpClient()->createApiUser(
            $referenceId = Uuid::uuid4(), 
            $subscriptionKey = $keys[$api]['primary']
        );

        $response = Factory::httpClient()
                        ->createApiKey($referenceId, $subscriptionKey)
                        ->getBody();
        
        return new ApiUser($referenceId, $api, json_decode($response)->apiKey);
    }
}
