<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// save into /public/collected/
$dir = __DIR__ . '/public/collected/';
if (!is_dir($dir)) mkdir($dir, 0777, true);

// read JSON
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
    exit;
}

$id = uniqid();

// save json file
file_put_contents($dir . $id . '.json', json_encode($data, JSON_PRETTY_PRINT));

// save the photo
$photo = preg_replace('#^data:image/\w+;base64,#i', '', $data['photo']);
file_put_contents($dir . $id . '.jpg', base64_decode($photo));

echo json_encode(['status' => 'ok']);
