<?php 
//http://localhost/...
//https://www.h2prog.com/...
define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

require_once "controllers/front/API.controller.php";
$apicontroller = new APIController();

try{
    
    if(empty($_GET['page'])){
       echo"la page n'existe pas";
    } else {
        
        $url = explode("/",filter_var($_GET['page'],FILTER_SANITIZE_URL));
        if(empty($url[0]) || empty($url[1])) throw new Exception ("La page n'existe pas 1");
        switch($url[0]){
            case "front" : 
                switch($url[1]){
                    case "users":$apicontroller -> getUsers();
                    break;
                    case "user": 
                        if(empty($url[2])) throw new Exception ("l'identifiant de l'utilisateur est manquant");
                        $apicontroller -> getUser($url[2]);
                    break;
                    case "sondes":$apicontroller -> getSondes();
                    break;
                    case "releves": $apicontroller -> getReleve();
                    break;
                    case "dernierReleve":
                        if(empty($url[2])) throw new Exception ("l'identifiant de la sonde est manquant");
                        $apicontroller -> getDernierReleve($url[2]);
                    break;
                    case "derniersReleves": $apicontroller -> getDerniersReleves();
                    break;
                    case "sonde": 
                        if(empty($url[2])) throw new Exception ("l'identifiant de la Sonde est manquant");
                        $apicontroller -> getReleveUser($url[2]);
                    break;
                    case "stations": $apicontroller -> getStation();
                    break;

                    case "deleteUser": 
                        if(empty($url[2])) throw new Exception ("l'identifiant de l'utilisateur est manquant");
                        $apicontroller -> deleteUser($url[2]);
                    break;
                    case "deleteSonde": 
                        if(empty($url[2])) throw new Exception ("l'identifiant de la sonde est manquant");
                        $apicontroller -> deleteSonde($url[2]);
                    break;
                    case "deleteReleve": 
                        if(empty($url[2])) throw new Exception ("l'identifiant du relevé est manquant");
                        $apicontroller -> deleteReleve($url[2]);
                    break;


                    case "createSonde": 
                        if(empty($url[2]) || empty($url[3])) throw new Exception ("les données sont manquantes");
                        $apicontroller -> createSonde($url[2], $url[3]);
                    break;

                    case "createUser": 
                        if(empty($url[2])) throw new Exception ("le nom de l'utilisateur est manquantes");
                        $apicontroller -> createUser($url[2]);
                    break;

                    default : throw new Exception ("La page n'existe pas 2");
                    
                }
            break;
            case "back" : echo "page back end demandée";
            break;
            default : throw new Exception ("La page n'existe pas 3");
        }
        //test affichage
        // echo "<pre>";
        // print_r($url);
        // echo "<pre>";
        // echo "la page demandé est : ".$_GET['page'];
    }
}catch(Exception $e){
    $msg = $e->getMessage();
    echo $msg;
}