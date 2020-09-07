<?php
require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if ($name && $email) {
  if ($usuarioDao->findbyEmail($email)) return header('Location: adicionar.php');

  $newUser = new Usuario();
  $newUser->setName($name);
  $newUser->setEmail($email);

  $usuarioDao->add($newUser);

  header('Location: index.php');
  exit;
} else {
  header('Location: adicionar.php');
  exit;
}
