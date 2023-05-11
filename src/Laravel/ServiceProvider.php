<?php

namespace Mediumart\MobileMoney\Laravel;

use Illuminate\Support\Facades\Cache;
use Mediumart\MobileMoney\MobileMoney;
use Mediumart\MobileMoney\Sandbox\UsersProvisioning;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Hooks prefix.
     *
     * @var string
     */
    protected $prefix = 'sandbox_user_for_';

    /**
     * Services names.
     *
     * @var string[]
     */
    protected $services = [
        'collection',
        'disbursement',
        'remittance',
    ];

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/momo.php' => config_path('momo.php'),
        ]);

        MobileMoney::setCurrentEnvironment(
            config('momo.env')
        );
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->registerSandboxUsersHooks();
    }

    /**
     * Register sandbox users hooks.
     *
     * @return void
     */
    protected function registerSandboxUsersHooks(): void
    {
        foreach ($this->services as $service) {
            $this->app->singleton($this->prefix.$service, function ($app) use ($service) {

                $subscriptionKey = config('momo.sandbox.subscriptionsKeys.'.$service);

                if (empty($subscriptionKey)) {
                    throw new \Exception( 'Subscription key for ['.$service.'] is not set');
                }

                $this->cacheSubscriptionKey($service, $subscriptionKey);

                return $this->sandboxUserFor($service, $subscriptionKey);
            });
        }
    }

    /**
     * Cache subcription key of a service
     *
     * @param string $service
     * @param string $subscriptionKey
     * @return void
     */
    protected function cacheSubscriptionKey($service, $subscriptionKey)
    {
        $key = 'momo.sandbox.'.$service;

        if (Cache::has($key)) {
            $this->cleanupBeforeCaching($key, $subscriptionKey);
        }

        Cache::forever($key, $subscriptionKey);
    }

    /**
     * Cleanup before caching subscription key
     *
     * @param string $key
     * @param string $subscriptionKey
     * @return void
     */
    protected function cleanupBeforeCaching($key, $subscriptionKey)
    {
        $service = str_replace('momo.sandbox.', '', $key);

        $oldSubscriptionKey = Cache::get($key);

        if ($oldSubscriptionKey != $subscriptionKey) {
            Cache::forget($key);
            Cache::forget($service.':'.$oldSubscriptionKey);
        }
    }

    /**
     * Get a sandbox user for a service
     *
     * @param [type] $service
     * @param [type] $subscriptionKey
     * @return void
     */
    protected function sandboxUserFor($service, $subscriptionKey)
    {
        return Cache::rememberForever($service.':'.$subscriptionKey, function () use ($subscriptionKey) {
            return UsersProvisioning::sandboxUserFor($subscriptionKey);
        });
    }
}
