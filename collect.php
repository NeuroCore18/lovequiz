<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
$dir = 'collected/';
if (!is_dir($dir)) mkdir($dir, 0777, true);
$data = json_decode(file_get_contents('php://input'), true);
$id = uniqid();
file_put_contents($dir . $id . '.json', json_encode($data, JSON_PRETTY_PRINT));
$photo = preg_replace('#^data:image/\w+;base64,#i', '', $data['photo']);
file_put_contents($dir . $id . '.jpg', base64_decode($photo));
echo json_encode(['status' => 'ok']);
?>