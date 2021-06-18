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

    // Espace réservé CRUD pour l'ADMIN avec requêtes POST DELETE PUT

    // DELETE
    public function deleteBDUser($IDUser){

        // ! Axe d'amélioration : condition

        //  requete get avec id user voir si existe
        // if()l'id existe pas
        // "existe pas"

         // if id existe  
        $req = "DELETE FROM `users` WHERE IDUser =:IDUser";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindParam(':IDUser', $IDUser, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();

        return "Utilisateur supprimé" . $IDUser ;
    }
    public function deleteBDSonde($IDSonde){

        // ! Axe d'amélioration : condition

        //  requete get avec id user voir si existe
        // if()l'id existe pas
        // "existe pas"

         // if id existe  
        $req = "DELETE FROM `sonde` WHERE IDSonde =:IDSonde";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindParam(':IDSonde', $IDSonde, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();

        return "Sonde supprimé" . $IDSonde ;
    }
    public function deleteBDReleve($IDReleve){

        // ! Axe d'amélioration : condition

        //  requete get avec id user voir si existe
        // if()l'id existe pas
        // "existe pas"

         // if id existe  
        $req = "DELETE FROM `releve` WHERE IDReleve =:IDReleve";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindParam(':IDReleve', $IDReleve, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        return "Relevé supprimé" . $IDReleve ;
    }

    // CREATE
    public function createBDSonde($model, $IdStation ){
        // ! Axe d'amélioration : condition

        //  requete get avec id user voir si existe
        // if()l'id existe pas
        // "existe pas"

         // if id existe  

        //  ici station est une variable dans le cas où d'autres stations seraient créées par la suite et laisser le choix à l'administrateur

        $req = "INSERT INTO `sonde`(`model`, `IdStation`) VALUES (:model, :IdStation )";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindParam(':model', $model, PDO::PARAM_STR);
        $stmt->bindParam(':IdStation', $IdStation , PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        return "SONDE CREEE :" . $model . " DANS LA STATION NUM ". $IdStation ;

    }

    public function createBDUser($Nomcomplet){
        // ! Axe d'amélioration : condition

        //  requete get avec id user voir si existe
        // if()l'id existe pas
        // "existe pas"

         // if id existe  

        //  ici station est une variable dans le cas où d'autres stations seraient créées par la suite et laisser le choix à l'administrateur

        $req = "INSERT INTO `users`(`Nomcomplet`) VALUES (:Nomcomplet )";
        $stmt = $this->getBdd()->prepare($req); 
        $stmt->bindParam(':Nomcomplet', $Nomcomplet, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
        return "USER CREEE :" . $Nomcomplet ;

    }




}