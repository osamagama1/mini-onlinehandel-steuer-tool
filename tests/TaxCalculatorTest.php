<?php

declare(strict_types=1);

namespace Tests;

use App\Domain\OrderItem;
use App\Service\TaxCalculator;
use PHPUnit\Framework\TestCase;

final class TaxCalculatorTest extends TestCase
  {
        public function testMixedTaxRatesAreSeparated(): void
    {
              $calculator = new TaxCalculator();

            $items = [
                          new OrderItem(name: 'E-Book', netPrice: 10.00, quantity: 1, reducedRate: true),
                          new OrderItem(name: 'Software-Lizenz', netPrice: 50.00, quantity: 1, reducedRate: false),
                      ];

            $result = $calculator->calculate($items);

            $this->assertEqualsWithDelta(0.70, $result['7%']['tax'], 0.001);
              $this->assertEqualsWithDelta(9.50, $result['19%']['tax'], 0.001);
    }

    public function testReverseChargeAppliesNoTax(): void
    {
              $calculator = new TaxCalculator();
              $items = [new OrderItem(name: 'B2B Service', netPrice: 100.00, quantity: 1, reducedRate: false)];

            $result = $calculator->calculate($items, reverseCharge: true);

            $this->assertSame(0.0, $result['19%']['tax']);
    }
  }
