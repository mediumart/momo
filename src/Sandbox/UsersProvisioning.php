<?php
namespace Mediumart\MobileMoney\Sandbox;

use Ramsey\Uuid\Uuid;

class UsersProvisioning
{
    /**
     * Create a new sandbox user for a given product api.
     *
     * @param string $subscriptionKey
     * @return ApiUser
     */
    static public function sandboxUserFor(string $subscriptionKey):ApiUser
    {
        Factory::httpClient()->createApiUser(
            $referenceId = Uuid::uuid4(), $subscriptionKey
        );

        $response = Factory::httpClient()
                        ->createApiKey($referenceId, $subscriptionKey)
                        ->getBody();

        /** @var string[] */
        $data = json_decode($response, true);

        return new ApiUser($referenceId, $data['apiKey']);
    }
}
