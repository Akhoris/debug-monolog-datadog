<?php
require_once __DIR__ . '/vendor/autoload.php';

use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\WhatFailureGroupHandler;
use Monolog\Logger;
use Monolog\Processor\WebProcessor;
use Monolog\Processor\HostnameProcessor;


$formatter = new JsonFormatter();

$handler = new StreamHandler("logs/buyback-order-api.log", Logger::DEBUG, true);
$handler->setFormatter($formatter);

$groupHandler = new WhatFailureGroupHandler([$handler]);

$logger = new Logger("test");
$logger->pushHandler($groupHandler);

$webProcessor = new WebProcessor();
$hostnameProcessor = new HostnameProcessor();

$logger->pushProcessor($webProcessor);
$logger->pushProcessor($hostnameProcessor);


$logger->error('test error', ['test' => 'test']);
