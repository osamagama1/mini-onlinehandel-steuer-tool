<?php

declare(strict_types=1);

namespace App\Domain;

final class OrderItem
  {
        public function __construct(
                  private readonly string $name,
                  private readonly float $netPrice,
                  private readonly int $quantity,
                  private readonly bool $reducedRate = false,
              ) {
        }

    public function getName(): string
    {
              return $this->name;
    }

    public function getNetPrice(): float
    {
              return $this->netPrice;
    }

    public function getQuantity(): int
    {
              return $this->quantity;
    }

    public function isReducedRate(): bool
    {
              return $this->reducedRate;
    }
  }
