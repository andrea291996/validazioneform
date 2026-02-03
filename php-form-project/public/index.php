<?php
declare(strict_types=1);

use App\App;
use App\Http\Request;

require __DIR__ . '/../vendor/autoload.php';

$app = new App();
$request = Request::fromGlobals(); 
//var_dump($request);

$response = $app->handle($request);
//var_dump($response);

$response->send();
