<?php
namespace Mediumart\MobileMoney\Sandbox;

use Ramsey\Uuid\Uuid;
use Mediumart\MobileMoney\User;

class UsersProvisioning
{
    /**
     * Create a new sandbox user for a given product api.
     *
     * @param string $subscriptionkey
     * @return User
     */
    static public function sandboxUserFor(string $subscriptionkey): User
    {
        Factory::httpClient()->createApiUser(
            $referenceId = Uuid::uuid4(), $subscriptionkey
        );

        $response = Factory::httpClient()
                        ->createApiKey($referenceId, $subscriptionkey)
                        ->getBody();

        /** @var string[] */
        $data = json_decode($response, true);

        return new User($referenceId, $data['apiKey'], $subscriptionkey);
    }
}
