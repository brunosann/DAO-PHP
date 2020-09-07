<?php
require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email');
$id = filter_input(INPUT_POST, 'id');

if ($name && $email && $id) {
  $user = new Usuario();
  $user->setId($id);
  $user->setName($name);
  $user->setEmail($email);

  $usuarioDao->update($user);

  header('Location: index.php');
  exit;
} else {
  header('Location: editar.php?id=' . $id);
  exit;
}
