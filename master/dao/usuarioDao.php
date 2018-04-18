<?php
  Class UsuarioDao {
    private $con;
    
    public function UsuarioDao($conexao) {
      $this->con = $conexao->getCon();
    }
    
    //Função de inserção de novos usuarios
    function insert($usuario){
      try{
        $array = array('login'=>$usuario->getLogin(),'senha'=>$usuario->getSenha(), 'nome'=>$usuario->getNome());
        $stmt = $this->con->prepare('INSERT INTO usuario (login, senha, nome) VALUES (:login, :senha, :nome)');
        $stmt->execute($array);

        return true;
      } catch(PDOException $e){
        return false;
      }
    }

    function select(){
      try{
        $stmt = $this->con->prepare('SELECT id, nome, login  FROM usuario WHERE NOT id=1');
        $stmt->execute();

        $linha = null;
        $i = 0;
        foreach($stmt as $row) {
          $linha[$i] = $row;
          $i++;
        }

        return $linha;
      } catch(PDOException $e){
        return $e->getMessage();
      }
    }
    
    function search($login){
      try{
        $array = array('login'=>$login);
        $stmt = $this->con->prepare('SELECT * FROM usuario WHERE login=:login');
        $stmt->execute($array);

        $linha = null;
        foreach($stmt as $row) {
          $linha = $row;
        }

        return $linha;
      } catch(PDOException $e){
        echo 'ERROR: ' . $e->getMessage();
      }
    }
      
    function login($usuario) {
      $res = $this->search($usuario->getLogin());
      if($res != null && $res['senha'] == $usuario->getSenha()) {
        return true;
      } else {
        return false;
      }
    }

    //Ao usar o update usar o damin/Usuario.php
    function update($usuario){
      try {
        $array = array('login'=>$usuario->getLogin());
        $sql = 'SELECT id FROM usuario WHERE login=:login';
        $stmt = $this->con->prepare($sql);
        $stmt->execute($array);
        
        $linha = null;
        foreach($stmt as $row) {
          $linha = $row;
        }
        
        if($linha != null) if($linha['id'] != $usuario->getId()) return false;
      } catch(PDOException $e) {
        return false;
      }

      try {
        $array = null;
        if($usuario->getSenha() == "d41d8cd98f00b204e9800998ecf8427e") {
          $array = array('id'=>$usuario->getId(), 'nome'=>$usuario->getNome(),'login'=>$usuario->getLogin());
          $sql = 'UPDATE usuario SET nome=:nome, login=:login WHERE id=:id';
        } else {
          $array = array('id'=>$usuario->getId(), 'nome'=>$usuario->getNome(),'login'=>$usuario->getLogin(), 'senha'=>$usuario->getSenha());
          $sql = 'UPDATE usuario SET nome=:nome, login=:login, senha=:senha WHERE id=:id';
        }

        $stmt = $this->con->prepare($sql);
        $stmt->execute($array);
        
        return true;
      } catch(PDOException $e) {
        return false;
      }
    }

    function updateAdminPass($pass){
      try {
        $array = array('senha'=>$pass);
        $sql = 'UPDATE usuario SET senha=:senha WHERE id=1';
        $stmt = $this->con->prepare($sql);
        $stmt->execute($array);
        
        return true;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }

    public function exclude($id){
      try {
        $array = array('id'=>$id);
        $sql = 'DELETE FROM usuario WHERE id=:id';
        $stmt = $this->con->prepare($sql);
        $stmt->execute($array);
        
        return true;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
  }
?>