<?php
// save.php — Dínamo Torneio 2026
// Recebe o results.json via POST e guarda no servidor

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Method not allowed']);
    exit;
}

// Verificar senha (hash SHA-256 de "dinamo2026")
$ADMIN_HASH = 'd6116bc321334fb16bb556567a4f4c0cec15af5dd9654a03c63872f3a1c849f8';

$body = file_get_contents('php://input');
$data = json_decode($body, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Invalid JSON']);
    exit;
}

// Validar senha
$pw = isset($data['_pw']) ? $data['_pw'] : '';
if (hash('sha256', $pw) !== $ADMIN_HASH) {
    http_response_code(403);
    echo json_encode(['ok' => false, 'error' => 'Unauthorized']);
    exit;
}

// Remover campo de senha antes de guardar
unset($data['_pw']);

// Guardar ficheiro
$file = __DIR__ . '/results.json';
$json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

if (file_put_contents($file, $json) === false) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'Could not write file. Check permissions.']);
    exit;
}

echo json_encode(['ok' => true]);
