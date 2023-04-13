<?php

use Dotenv\Dotenv;

error_reporting(E_ALL);
ini_set('log_errors', "1");
ini_set('error_log', __DIR__ . '/var/logs/error.log');

require(__DIR__.'/vendor/autoload.php');

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

if (
    isset($_ENV['APPLICATION_MODE']) &&
    strpos(strtolower($_ENV['APPLICATION_MODE']), 'dev') !== false
) {
    ini_set('display_errors', "1");
} else {
    ini_set('display_errors', "0");
}

date_default_timezone_set($_ENV['TIMEZONE']);
