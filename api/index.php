<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\model\Api;

$api = new Api();
try {
    $api->run();
} catch (\Exception $e) {
    echo json_encode(array('error' => $e->getMessage()));
}
