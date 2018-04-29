<?php 
Class AlterarDao {
    private $con;
    
    public function AlterarDao($conexao) {
      $this->con = $conexao->getCon();
    }

    public function setTema($tema){
      try {
        $array = array('tema'=>$tema);
        $sql = 'UPDATE alterar SET tema=:tema WHERE id=1';
        $stmt = $this->con->prepare($sql);
        $stmt->execute($array);
        
        return true;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }

    public function getTema(){
      try {
        $sql = 'SELECT tema FROM alterar WHERE id=1';
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        
        $linha = null;
        foreach($stmt as $row) {
          $linha = $row;
        }
        
        if($linha != null) {
          return $linha[0];
        }
        
        return false;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
    
    public function select(){
      try {
        $stmt = $this->con->prepare('SELECT * FROM alterar');
        $stmt->execute();
        
        $linha = null;
        foreach($stmt as $row) {
          $linha = $row;
        }
        
        if($linha != null) {
          return $linha;
        }
        
        return false;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
    
    public function update(){
      try {
        date_default_timezone_set( 'America/Sao_Paulo' );
        $alteracao = md5(date('d/m/Y H:i:s'));
        $array = array('alteracao'=>$alteracao);
        $sql = 'UPDATE alterar SET alteracao=:alteracao WHERE id=1';
        $stmt = $this->con->prepare($sql);
        $stmt->execute($array);
        
        return true;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
}