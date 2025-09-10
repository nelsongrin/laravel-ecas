<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace EcPhp\LaravelEcas\Providers;

use EcPhp\CasLib\Contract\CasInterface;
use EcPhp\CasLib\Contract\Configuration\PropertiesInterface;
use EcPhp\CasLib\Contract\Response\CasResponseBuilderInterface;
use EcPhp\Ecas\Ecas;
use EcPhp\Ecas\EcasProperties;
use EcPhp\Ecas\Service\Fingerprint\DefaultFingerprint;
use EcPhp\Ecas\Service\Fingerprint\Fingerprint;
use EcPhp\LaravelCas\Auth\CasUserProvider;
use EcPhp\LaravelEcas\Auth\EcasUserProvider;
use GuzzleHttp\Client as ClientInterface;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use loophp\psr17\Psr17;
use loophp\psr17\Psr17Interface;
use Nyholm\Psr7\Factory\Psr17Factory;

// use Psr\Http\Client\ClientInterface;

final class LaravelEcasProvider extends ServiceProvider
{
    public function boot(): void
    {
        Auth::provider(
            'laravel-cas',
            static fn (): UserProvider => new EcasUserProvider(new CasUserProvider(app('session.store')))
        );
    }

    public function register(): void
    {
        $this->app->extend(
            PropertiesInterface::class,
            static fn (PropertiesInterface $service): EcasProperties => new EcasProperties($service)
        );

        // $this->app->extend(
        //     Fingerprint::class,
        //     static fn (Fingerprint $service): DefaultFingerprint => new DefaultFingerprint($service)
        // );
        // $this->app->extend(
        //     CasInterface::class,
        //     static fn (CasInterface $service, Application $app): Ecas => new Ecas($service, $app->make(PropertiesInterface::class), $app->make(Psr17Interface::class), $app->make(CasResponseBuilderInterface::class), $app->make(ClientInterface::class), $app->make(DefaultFingerprint::class))
        // );
        $this->app->bind(
            Psr17Interface::class,
            function (Application $app): Psr17Interface
            {
                $psr17Factory = new Psr17Factory();

                //or whatever psr17 you want
                return new Psr17(
                    $psr17Factory,
                    $psr17Factory,
                    $psr17Factory,
                    $psr17Factory,
                    $psr17Factory,
                    $psr17Factory
                );
            }
        );
    }
}
