<?php

use Composer\Autoload\ClassLoader;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use Doctrine\ODM\MongoDB\Types\Type;
use Mvc\Infrastructure\Doctrine\DonationTypeType;

/** @var ClassLoader $loader */
$loader = require __DIR__ . '/../vendor/autoload.php';
AnnotationDriver::registerAnnotationClasses();
Type::addType(DonationTypeType::NAME, DonationTypeType::class);

$_SERVER += $_ENV;
$_SERVER['APP_ENV'] = isset($_ENV['APP_ENV']) ? (string)$_ENV['APP_ENV'] : 'prod';
$_SERVER['APP_DEBUG'] = isset($_ENV['APP_DEBUG']) ? (int)$_ENV['APP_DEBUG'] : 0;

return $loader;
