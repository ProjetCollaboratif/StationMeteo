<?php 
require_once "models/Model.php";

class APIManager extends Model {

    //A l'initialisation 
    public function getBDUsers(){
        $req = "SELECT * FROM users";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $user;
    }

    // Quand id User choisi:
    public function getBDSonde($user_sonde){
       // $req = "SELECT * from sonde as sd inner join station as s on s.IDStation = sd.IDStation WHERE sd.IDstation = :user_sonde
       // ";
       $req = "SELECT  sonde.IdSonde, sonde.model, users.EmailUsers
        FROM `sondeuser` 
        INNER JOIN `sonde` ON sonde.IdSonde = sondeuser.IdSonde 
        INNER JOIN `users` ON users.IDUser = sondeuser.IDUser 
        WHERE sondeuser.IDUser  = :user_sonde";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":user_sonde",$user_sonde,PDO::PARAM_INT);
        $stmt->execute();
        $lignesSonde = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lignesSonde;
    }

    // POUR LA PAGE ADMIN
    public function getBDSondes(){
        $req = "SELECT * from sonde";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $lignesondes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
      //  echo "test";
        return  $lignesondes;
    }

    // Quand selection sonde (limité a 10):
    public function getBDReleves($user_releves){
       $req = "SELECT * from releve where IDSonde = :user_releves ORDER BY IDReleve DESC LIMIT 10";
       $stmt = $this->getBdd()->prepare($req);
       $stmt->bindValue(":user_releves",$user_releves,PDO::PARAM_INT);
       $stmt->execute();
       $LigneReleve = $stmt->fetchall(PDO::FETCH_ASSOC);
       $stmt->closeCursor();
        return $LigneReleve;
    }

    // 
    public function getBDStation(){
        $req = "SELECT *  from station";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
         $releve = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $releve;
    }

    // Tous les releves POUR ADMIN
    public function getBDReleve(){
        $req = "SELECT *  from releve";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $releve = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $releve;
    }
    

    public function getBDdernierReleve($user_sonde){
        $req = "SELECT * FROM `releve` WHERE IdSonde = :user_sonde LIMIT 1";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":user_sonde",$user_sonde,PDO::PARAM_INT);
        $stmt->execute();
        $releve = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $releve;
    }

    // POUR ADMIN
    public function getBDderniersReleves(){
        $req = "SELECT * FROM `releve` LIMIT 10";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $releve = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $releve;
    }
}