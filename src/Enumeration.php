<?php

namespace AVASTechnology\LaravelEnvironment;

use ValueError;

/**
 *
 */
interface Enumeration
{
    /**
     * @param  int|string  $value
     * @return static
     * @throws ValueError
     */
    public static function from(int|string $value): static;

    /**
     * @param  int|string  $value
     * @return static|null
     */
    public static function tryFrom(int|string $value): ?static;

    /**
     * @return array
     */
    public static function cases(): array;
}
