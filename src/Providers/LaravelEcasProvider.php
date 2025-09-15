<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace EcPhp\LaravelEcas\Providers;

use EcPhp\CasLib\Contract\Configuration\PropertiesInterface;
use EcPhp\Ecas\EcasProperties;
use EcPhp\LaravelCas\Auth\CasUserProvider;
use EcPhp\LaravelEcas\Auth\EcasUserProvider;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

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
    }
}
