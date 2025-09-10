# Laravel eCas Bundle

An ECAS bundle for Laravel.

## Installation

```shell
    composer require ecphp/laravel-ecas
```

`bootstrap/providers.php`

```php
    return [
        ...
        EcPhp\LaravelEcas\Providers\LaravelEcasProvider::class,
    ];
```

`app/Providers/AppServiceProvider.php`

```php
    <?php

    declare(strict_types=1);

    use Illuminate\Contracts\Foundation\Application;
    use loophp\psr17\Psr17Interface;
    use Nyholm\Psr7\Factory\Psr17Factory;
    use loophp\psr17\Psr17;

    public function register(): void
    {

        $this->app->bind(
            Psr17Interface::class,
            function(Application $app): Psr17Interface {
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
```
