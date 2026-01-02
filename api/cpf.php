<?php
header("Content-Type: application/json; charset=UTF-8");

$cpf = $_GET['cpf'] ?? '';

if (!$cpf) {
  echo json_encode(["error" => "CPF não informado"]);
  exit;
}

// URL da API REAL (a que funciona)
$url = "https://consultainfinity.infinityfreeapp.com/proxy.php?cpf=" . urlencode($cpf);

$response = @file_get_contents($url);

if ($response === false) {
  echo json_encode([
    "error" => "Falha ao consultar API externa"
  ]);
  exit;
}

// Se não for JSON, bloqueia
json_decode($response);
if (json_last_error() !== JSON_ERROR_NONE) {
  echo json_encode([
    "error" => "Resposta inválida da API",
    "raw" => substr($response, 0, 200)
  ]);
  exit;
}

echo $response;
exit;
