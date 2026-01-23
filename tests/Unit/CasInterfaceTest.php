<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace EcPhp\LaravelEcas\Tests\Unit;

use EcPhp\CasLib\Contract\CasInterface;
use EcPhp\Ecas\Ecas;
use EcPhp\LaravelEcas\Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class CasInterfaceTest extends TestCase
{
    public function testIfEcas(): void
    {
        $casInterface = app()->make(CasInterface::class);
        self::assertInstanceOf(Ecas::class, $casInterface);
    }
}
