<?php

declare(strict_types=1);

namespace App\Service;

interface ExchangeRateProvider
  {
        public function getRate(string $targetCurrency): float;
  }

final class EcbExchangeRateProvider implements ExchangeRateProvider
  {
        public function __construct(private readonly string $apiBaseUrl)
    {
    }

    public function getRate(string $targetCurrency): float
    {
              $url = sprintf('%s/latest?base=EUR&symbols=%s', $this->apiBaseUrl, $targetCurrency);
              $response = @file_get_contents($url);

            if ($response === false) {
                          throw new \RuntimeException("Exchange rate service unavailable for {$targetCurrency}");
            }

            $data = json_decode($response, true);

            return (float) ($data['rates'][$targetCurrency] ?? 1.0);
    }
  }

final class CurrencyConverter
  {
        public function __construct(private readonly ExchangeRateProvider $provider)
    {
    }

    public function convert(float $amountEur, string $targetCurrency): float
    {
              if ($targetCurrency === 'EUR') {
                            return $amountEur;
              }

            return round($amountEur * $this->provider->getRate($targetCurrency), 2);
    }
  }
