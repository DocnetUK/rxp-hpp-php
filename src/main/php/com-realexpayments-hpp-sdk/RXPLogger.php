<?php

namespace com\realexpayments\hpp\sdk;

use Logger;

/**
 * Class RXPLogger. Wraps initialisation of the logging framework
 *
 * @package com\realexpayments\remote\sdk
 */
class RXPLogger
{
    /**
     * @var bool
     */
    private static $initialised = false;

    /* @var \Psr\Log\LoggerInterface|null
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
     * @param string $className
     *
     * @return Logger|\Psr\Log\LoggerInterface
     */
    public static function GetLogger($className)
    {
        if (self::$psrLogger !== null) {
            return self::$psrLogger;
        }

        if (!self::IsInitialised()) {
            self::Initialise();
        }

        return Logger::getLogger($className);
    }

    private static function Initialise()
    {
        if (!class_exists("\Logger")) {
            throw new \RuntimeException('Neither the Logger is set, nor is apache/log4php library installed');
        }

        $path = $_SERVER['DOCUMENT_ROOT'] . '/config.xml';
        if (file_exists($path)) {
            Logger::configure($path);
        } else {
            Logger::configure(__DIR__ . '/config.xml');
        }

        self::$initialised = true;
    }

    private static function IsInitialised()
    {
        return self::$initialised;
    }

}
