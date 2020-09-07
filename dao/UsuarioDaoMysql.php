<?php
require_once 'models/Usuario.php';

class UsuarioDaoMysql implements UsuarioDAO
{
  private $pdo;

  public function __construct(PDO $driver)
  {
    $this->pdo = $driver;
  }

  public function add(Usuario $u)
  {
    $sql = $this->pdo->prepare('INSERT INTO usuarios (name, email) VALUES (:name, :email)');
    $sql->bindValue(':name', $u->getName());
    $sql->bindValue(':email', $u->getEmail());
    $sql->execute();

    $u->setId($this->pdo->lastInsertId());
    return $u;
  }

  public function findAll()
  {
    $list = [];

    $sql = $this->pdo->query('SELECT * FROM usuarios');

    if ($sql->rowCount() > 0) {
      $data = $sql->fetchAll();
      foreach ($data as $user) {
        $u = new Usuario();
        $u->setId($user['id']);
        $u->setName($user['name']);
        $u->setEmail($user['email']);
        $list[] = $u;
      }
    }

    return $list;
  }

  public function findbyEmail($email)
  {
    $sql = $this->pdo->prepare('SELECT * FROM usuarios WHERE email = :email');
    $sql->bindValue(':email', $email);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $data = $sql->fetch();
      $u = new Usuario();
      $u->setId($data['id']);
      $u->setName($data['name']);
      $u->setEmail($data['email']);
      return $u;
    }

    return false;
  }

  public function findById($id)
  {
    $sql = $this->pdo->prepare('SELECT * FROM usuarios WHERE id = :id');
    $sql->bindValue(':id', $id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $data = $sql->fetch();
      $u = new Usuario();
      $u->setId($data['id']);
      $u->setName($data['name']);
      $u->setEmail($data['email']);
      return $u;
    }

    return false;
  }

  public function update(Usuario $u)
  {
    $sql = $this->pdo->prepare('UPDATE usuarios SET name = :name, email= :email WHERE id = :id');
    $sql->bindValue(':name', $u->getName());
    $sql->bindValue(':email', $u->getEmail());
    $sql->bindValue(':id', $u->getId());
    $sql->execute();
    return true;
  }

  public function delete($id)
  {
  }
}
