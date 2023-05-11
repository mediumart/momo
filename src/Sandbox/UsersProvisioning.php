<?php
namespace Mediumart\MobileMoney\Sandbox;

use Ramsey\Uuid\Uuid;

class UsersProvisioning
{
    /**
     * Create a new sandbox user for a given product api.
     *
     * @param string $subscriptionKey
     * @return SandboxUser
     */
    static public function sandboxUserFor(string $subscriptionKey): SandboxUser
    {
        Factory::httpClient()->createApiUser(
            $referenceId = Uuid::uuid4(), $subscriptionKey
        );

        $response = Factory::httpClient()
                        ->createApiKey($referenceId, $subscriptionKey)
                        ->getBody();

        /** @var string[] */
        $data = json_decode($response, true);

        return new SandboxUser($referenceId, $data['apiKey']);
    }
}
