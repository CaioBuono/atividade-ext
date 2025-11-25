<?php

include __DIR__ . '/../../../includes.php';

$validacao = (
  isset($_POST['field']) and strlen($_POST['field']) and
  isset($_POST['value']) and strlen($_POST['value']) and
  isset($_POST['allowHtml'])
);

if(!$validacao){
  echo json_encode([
    'sucesso'  => false,
    'mensagem' => 'Não foi possível salvar o novo texto enviado'
  ]);
  exit;
}

extract($_POST);

$alteracoesSessao = explode('.', $field);
$arquivoPagesJson = JsonManipulator::getArquivoPagesJson();

foreach($arquivoPagesJson as $key => &$sessaoPage){
  //PERCORRE O ARRAY E FAZ ALTERAÇÃO POR REFERENCIA
  $sessaoPage[$alteracoesSessao[0]][$alteracoesSessao[1]] = $value;
}

$arquivoPagesJson = json_encode($arquivoPagesJson, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
if(!$arquivoPagesJson){
  echo json_encode([
    'sucesso'  => false,
    'mensagem' => 'Erro ao gerar novo JSON: ' . json_last_error_msg()
  ]);
  exit;
}

$pathArquivo = CAMINHO_JSON . 'pages.json';
if(!is_writable(dirname($pathArquivo))){
  echo json_encode([
    'sucesso'  => false,
    'mensagem' => 'Não é possível gravar nesse diretório: ' . dirname($pathArquivo)
  ]);
  exit;
}

$tempFile = $pathArquivo . '.tmp';
$save     = file_put_contents($tempFile, $arquivoPagesJson, LOCK_EX);
if(!$save){
  echo json_encode([
    'sucesso'  => false,
    'mensagem' => 'Falha ao salvar o arquivo temporário'
  ]);
  exit;
}

if(!rename($tempFile, $pathArquivo)){
  @unlink($tempFile);
  echo json_encode([
    'sucesso'  => false,
    'mensagem' => 'Falha ao mover arquivo temporário para destino'
  ]);
  exit;
}

echo json_encode([
  'sucesso'  => true,
  'mensagem' => 'Sessão selecionada atualizada com sucesso!'
]);