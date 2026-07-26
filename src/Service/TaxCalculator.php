<?php

declare(strict_types=1);

namespace App\Service;

use App\Domain\OrderItem;

final class TaxCalculator
  {
        private const STANDARD_RATE = 0.19;
        private const REDUCED_RATE = 0.07;

    public function calculate(array $items, bool $reverseCharge = false): array
    {
              $breakdown = [];

            foreach ($items as $item) {
                          $rate = $item->isReducedRate() ? self::REDUCED_RATE : self::STANDARD_RATE;
                          $key = (string) ($rate * 100) . '%';

                  $net = $item->getNetPrice() * $item->getQuantity();
                          $tax = $reverseCharge ? 0.0 : round($net * $rate, 2);
                          $gross = $net + $tax;

                  if (!isset($breakdown[$key])) {
                                    $breakdown[$key] = ['net' => 0.0, 'tax' => 0.0, 'gross' => 0.0];
                  }

                  $breakdown[$key]['net'] += $net;
                          $breakdown[$key]['tax'] += $tax;
                          $breakdown[$key]['gross'] += $gross;
            }

            return $breakdown;
    }

    public function totalGross(array $breakdown): float
    {
              return array_sum(array_column($breakdown, 'gross'));
    }
  }
