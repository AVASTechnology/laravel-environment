<?php

namespace AVASTechnology\LaravelEnvironment;

/**
 * Class Environment
 *
 * @package App\Console\Automation
 */
class Environment extends AbstractEnum
{
    /**
     * @var string CASE_PRODUCTION Production environment used by customers
     */
    public const CASE_PRODUCTION = 'production';

    /**
     * @var string CASE_LOCAL Local development environment
     */
    public const CASE_LOCAL = 'local';

    /**
     * @var string CASE_TESTING Mock environment used for automated testing
     */
    public const CASE_TESTING = 'testing';

    /**
     * @var string CASE_DEVELOPMENT Centralized development environment for testing
     */
    public const CASE_DEVELOPMENT = 'dev';

    /**
     * @var string CASE_STAGING Pre-production environment used for final testing before deployment to production
     */
    public const CASE_STAGING = 'staging';

    /**
     * @var array ENUMERATIONS
     */
    protected const ENUMERATIONS = [
        self::CASE_PRODUCTION   => 'Production',
        self::CASE_LOCAL        => 'Local',
        self::CASE_TESTING      => 'Testing',
        self::CASE_DEVELOPMENT  => 'Dev',
        self::CASE_STAGING      => 'Staging',
    ];

    /**
     * @return string
     */
    public static function default(): string
    {
        return static::CASE_PRODUCTION;
    }
}
