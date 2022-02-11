<?php

namespace AVASTechnology\LaravelEnvironment;

use ValueError;

/**
 * Class AbstractEnum
 *
 * @package App\Extensions\Illuminate
 */
abstract class AbstractEnum implements Enumeration
{
    /**
     * @var string|int $value
     */
    protected string|int $value;

    /**
     * @var array ENUMERATIONS
     */
    protected const ENUMERATIONS = [];

    /**
     * AbstractEnum constructor.
     * @param  string|int  $value
     */
    public function __construct(string|int $value)
    {
        if (!isset(static::ENUMERATIONS[$value])) {
            throw new \ValueError(
                sprintf(
                    'Invalid %s value "%s"',
                    class_basename(static::class),
                    $value
                )
            );
        }

        $this->value = $value;
    }

    /**
     * @return int|string
     */
    abstract public static function default(): int|string;

    /**
     * @param  int|string  $value
     * @return static
     * @throws ValueError
     */
    public static function from(int|string $value): static
    {
        return new static($value);
    }

    /**
     * @param  int|string  $value
     * @return static|null
     */
    public static function tryFrom(int|string $value): ?static
    {
        try {
            return static::from($value);
        } catch (ValueError $error) {
            return null;
        }
    }

    /**
     * @return array
     */
    public static function cases(): array
    {
        return static::ENUMERATIONS;
    }

    /**
     * @param  string|int  $value
     * @return bool
     */
    public function validate(string|int $value): bool
    {
        return isset(static::ENUMERATIONS[$value]);
    }

    /**
     * @param  array  $mappers
     * @return string
     */
    public function display(array $mappers = []): string
    {
        return __(static::ENUMERATIONS[$this->value], $mappers);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return strval($this->value);
    }
}
