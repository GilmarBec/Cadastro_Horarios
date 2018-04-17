<?php
  Class RegistroDao {
    private $con;
    
    public function RegistroDao($conexao) {
      $this->con = $conexao->getCon();
    }
    
    public function insert($idHorario, $dates){
      try {
        foreach($dates as $date) {
          $array = array("idHorario"=>$idHorario, "data"=>$date);
          $stmt = $this->con->prepare('SELECT id FROM registro WHERE idHorario=:idHorario AND data=:data');
          $stmt->execute($array);
          
          $linha = null;
          foreach($stmt as $row) {
            $linha = $row;
          }
          
          if($linha != null) {
            return false;
          } else {
            $array = array('idHorario'=>$idHorario,'data'=>$date);
            $stmt = $this->con->prepare('INSERT INTO registro (idHorario, data) VALUES (:idHorario, :data)');
            $stmt->execute($array);
            $final = true;
          }
        }
        return $final;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
    
    public function select(){
      try {
        $stmt = $this->con->prepare('SELECT * FROM registro');
        $stmt->execute();
        
        $i = 0;
        $linha = null;
        foreach($stmt as $row) {
          $linha[$i] = $row;
          $i++;
        }
        
        if($linha != null) {
          return $linha;
        }
        
        return false;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
    
    public function search($data){
      try {
        $array = array("data"=>$data);
        $stmt = $this->con->prepare('SELECT idHorario FROM registro WHERE data=:data');
        $stmt->execute($array);
        
        $i = 0;
        $linha = null;
        foreach($stmt as $row) {
          $linha[$i] = $row;
          $i++;
        }
        
        if($linha != null) {
          return $linha;
        }
        
        return false;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
    
    public function searchById($id){
      try {
        $array = array("idHorario"=>$id);
        $stmt = $this->con->prepare('SELECT * FROM registro WHERE idHorario=:idHorario');
        $stmt->execute($array);
        
        $i = 0;
        $linha = null;
        foreach($stmt as $row) {
          $linha[$i] = $row;
          $i++;
        }
        
        if($linha != null) {
          return $linha;
        }
        
        return false;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
    
    public function update($idHorario, $dates) {
      try {
        $final = $this->exclude($idHorario);
        $final = $this->insert($idHorario, $dates);
        return $final;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
    
    public function exclude($id){
      try {
        $array = array('id'=>$id);
        $sql = 'DELETE FROM registro WHERE idHorario=:id';
        $stmt = $this->con->prepare($sql);
        $stmt->execute($array);
        
        return true;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }

    public function clear(){
      try {
        $stmt = $this->con->prepare('DROP TABLE registro');
        $stmt->execute();

        //Create Table Registro And Your Foreign Key
        $sql = "
          CREATE TABLE `registro` (
            `id` bigint(20) AUTO_INCREMENT,
            `idHorario` int(11) NOT NULL,
            `data` date NOT NULL,
            PRIMARY KEY (`id`)
          );
          ALTER TABLE `registro`
            ADD KEY `FK_horarioRegistro` (`idHorario`), AUTO_INCREMENT=1;
        ";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        
        return true;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
  }
?>