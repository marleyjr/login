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

$query = "select usuario, nivel from usuario where usuario = '{$usuario}' and senha = md5('{$senha}')";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if ($row == 1) {
  $usuario = mysqli_fetch_assoc($result);
  $_SESSION['usuario'] = $usuario['usuario'];
  $_SESSION['nivel'] = $usuario['nivel'];
  if ($_SESSION['nivel'] == 1) {
    header('Location: home.php');
    exit();
  } elseif ($_SESSION['nivel'] == 2) {
    header('Location: home.php');
    exit();
  } elseif ($_SESSION['nivel'] == 3) {
    header('Location: home.php');
    exit();
  }
} else {
  $_SESSION['mensagem'] = 'Usuário ou senha inválidos';
  header('Location: index.php');
  exit();
}