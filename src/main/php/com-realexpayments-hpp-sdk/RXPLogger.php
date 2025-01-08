<?php

namespace com\realexpayments\hpp\sdk;

use Psr\Log\NullLogger;

/**
 * Class RXPLogger. Wraps initialisation of the logging framework
 *
 * @package com\realexpayments\remote\sdk
 */
class RXPLogger
{
    /**
     * @var \Psr\Log\LoggerInterface|null
     */
    private static $psrLogger = null;

    /**
     * @param \Psr\Log\LoggerInterface|null $logger
     * @return void
     */
    public static function SetLogger($logger)
    {
        self::$psrLogger = $logger;
    }

    /**
     * @return \Psr\Log\LoggerInterface
     */
    public static function GetLogger()
    {
        if (self::$psrLogger !== null) {
            return self::$psrLogger;
        }

        return new NullLogger();
    }

}
