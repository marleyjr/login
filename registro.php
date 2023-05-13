<?php
session_start();
include('conexao.php');

if (isset($_POST['adicionar'])) {
  $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
  $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
  
  // Verifica se o usuário já existe na base de dados
  $query_verificacao = "SELECT usuario FROM usuario WHERE usuario = '{$usuario}'";
  $resultado_verificacao = mysqli_query($conexao, $query_verificacao);

  if (mysqli_num_rows($resultado_verificacao) > 0) {
    $_SESSION['mensagem'] = "A user with that name already exists";
    header('Location: index.php');
    exit();
  }

  // Insere o novo usuário apenas se não houver duplicidade
  $query_insercao = "INSERT INTO usuario (usuario, senha, nivel) VALUES ('{$usuario}', md5('{$senha}'), 1)";
  mysqli_query($conexao, $query_insercao);

  $_SESSION['mensagem'] = "Successful registration";
  header('Location: index.php');
  exit();
}
?>
