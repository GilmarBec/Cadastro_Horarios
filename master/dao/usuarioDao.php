<?php
  Class UsuarioDao {
    private $con;
    
    public function UsuarioDao($conexao) {
      $this->con = $conexao->getCon();
    }
    
    //Função de inserção de novos usuarios
    function insert($usuario){
      $user = array('login'=>$usuario->getLogin(),'senha'=>$usuario->getSenha(), 'nome'=>$usuario->getNome());
      $sql = 'INSERT INTO usuario (login, senha, nome) VALUES (:login, :senha, :nome)';
      $this->con->prepare($sql)->execute($user);
      echo '<script>alert("Usuario Adicionado com sucesso!");</script>';
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
        echo 'ERROR: ' . $e->getMessage();
      }
    }
    
    function search($login){
      try{
        $stmt = $this->con->prepare('SELECT * FROM usuario WHERE login=:login');
        $stmt->execute();

        $linha = null;
        foreach($stmt as $row) {
          $linha = $row;
        }

        return $linha;
      } catch(PDOException $e){
        echo 'ERROR: ' . $e->getMessage();
      }
    }
      
    function login($login) {
      $res = $this->search($login);
      if($res != null && $res['senha'] == $usuario->getSenha()) {
        return true;
      } else {
        return false;
      }
    }

    //Ao usar o update usar o damin/Usuario.php
    function update($usuario){
      try {
        $sql = 'SELECT id FROM usuarios WHERE login=:login';
        $stmt = $this->con->prepare($sql);
        $stmt->execute($usuario);
        
        $linha = null;
        foreach($stmt as $row) {
          $linha = $row;
        }
        
        if($linha != null) {
          return false;
        }
      } catch(PDOException $e) {
        return $e->getMessage();
      }

      try {
        $array = array('id'=>$usuario->getId(), 'nome'=>$usuario->getNome(),'login'=>$usuario->getLogin(), 'senha'=>$usuario->getSenha());
        $sql = 'UPDATE usuario SET nome:nome login=:login AND senha=:senha WHERE id=:id';
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