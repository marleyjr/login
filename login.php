<?php
session_start();
include('conexao.php');

if (empty($_POST['usuario']) || empty($_POST['senha'])) {
  $_SESSION['mensagem'] = 'Usuário ou senha inválidos';
  header('Location: index.php');
  exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "SELECT usuario, nivel FROM usuario WHERE usuario = '{$usuario}' AND senha = md5('{$senha}')";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if ($row == 1) {
  $usuario = mysqli_fetch_assoc($result);
  $_SESSION['usuario'] = $usuario['usuario'];
  $_SESSION['nivel'] = $usuario['nivel'];
  header('Location: home.php');
  exit();
} else {
  $_SESSION['mensagem'] = 'username or password is invalid';
  header('Location: index.php');
  exit();
}
?>
