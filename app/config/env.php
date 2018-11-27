<?php
define("BASE_PATH",realpath(__DIR__.'/../../'));

require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__ . '/_stripe.php';

$dotEnv = new \Dotenv\Dotenv(BASE_PATH);

$dotEnv->load();
?>