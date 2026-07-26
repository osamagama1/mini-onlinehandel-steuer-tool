<?php

declare(strict_types=1);

namespace Tests;

use App\Service\CurrencyConverter;
use App\Service\ExchangeRateProvider;
use PHPUnit\Framework\TestCase;

final class CurrencyConverterTest extends TestCase
  {
        public function testEurAmountsAreUnchanged(): void
    {
              $provider = $this->createMock(ExchangeRateProvider::class);
              $provider->expects($this->never())->method('getRate');

            $converter = new CurrencyConverter($provider);

            $this->assertSame(42.0, $converter->convert(42.0, 'EUR'));
    }

    public function testForeignCurrencyUsesProviderRate(): void
    {
              $provider = $this->createMock(ExchangeRateProvider::class);
              $provider->method('getRate')->with('USD')->willReturn(1.10);

            $converter = new CurrencyConverter($provider);

            $this->assertEqualsWithDelta(110.0, $converter->convert(100.0, 'USD'), 0.001);
    }
  }
