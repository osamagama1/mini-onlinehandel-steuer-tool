<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Domain\OrderItem;
use App\Service\TaxCalculator;

$items = [
      new OrderItem(name: 'E-Book: PHP Grundlagen', netPrice: 19.99, quantity: 1, reducedRate: true),
      new OrderItem(name: 'Cloud-Software Lizenz', netPrice: 49.00, quantity: 2, reducedRate: false),
  ];

$calculator = new TaxCalculator();
$breakdown = $calculator->calculate($items);

header('Content-Type: text/plain; charset=utf-8');

foreach ($breakdown as $rate => $values) {
      printf(
                "Steuersatz %s: Netto %.2f EUR, Steuer %.2f EUR, Brutto %.2f EUR\n",
                $rate,
                $values['net'],
                $values['tax'],
                $values['gross']
            );
}

printf("\nGesamtbetrag (Brutto): %.2f EUR\n", $calculator->totalGross($breakdown));
