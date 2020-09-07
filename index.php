<?php
require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);
$list = $usuarioDao->findAll();
?>

<a href="adicionar.php">Adicionar</a>

<table border="1" width="100%" style="text-align: center;">
  <tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Email</th>
    <th>Ações</th>
  </tr>
  <?php foreach ($list as $user) : ?>
    <tr>
      <td><?= $user->getId() ?></td>
      <td><?= $user->getName() ?></td>
      <td><?= $user->getEmail() ?></td>
      <td>
        <a href="editar.php?id=<?= $user->getId() ?>">[Editar]</a>
        <a href="deletar.php?id=<?= $user->getId() ?>" onclick="return confirm('Tem certeza que deseja excluir?')">[Deletar]</a>
      </td>
    </tr>
  <?php endforeach ?>
</table>