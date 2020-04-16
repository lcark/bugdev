<?php

require __dir__.'/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$DB = new PDO(
    'mysql:host=127.0.0.1;dbname=test;charset=utf8',
    'lcark',
    'test'
);

$LOGGER = new Logger('auth');
$LOGGER->pushHandler(new StreamHandler("../log/log.log"), Logger::WARNING);

$LOADER = new FilesystemLoader(__DIR__ . '/template');
$TWIG = new Environment($LOADER);

session_start();

?>