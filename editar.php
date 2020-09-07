<?php
require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);

$user = false;
$id = filter_input(INPUT_GET, 'id');

if ($id) {
  $user = $usuarioDao->findById($id);
}
if (!$user) return header('Location: index.php');
?>

<h1>Editar Usuario</h1>
<form action="editar_action.php" method="post">
  <input type="hidden" name="id" value="<?= $user->getId() ?>">
  <label>
    Nome: <br>
    <input type="text" name="name" id="" value="<?= $user->getName() ?>">
  </label>
  <br>
  <label>
    Email: <br>
    <input type="text" name="email" id="" value="<?= $user->getEmail() ?>">
  </label>
  <br> <br>
  <button type="submit">Salvar</button>
</form>