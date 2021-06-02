<?php
 require_once "models/front/API.manager.php";
 require_once "models/Model.php";

 
    class APIController {
        private $apimanager;
    
        public function __construct(){
            $this->apimanager = new APIManager();
       }
        public function getUsers(){ 
            
           $users = $this->apimanager->getBDUsers();
         Model::sendJSON($users);

        }
        public function getReleveUser($releve_user){
            $releve = $this->apimanager->getBDReleves($releve_user);
            Model::sendJSON($releve);
        }
        public function getUser($user_sonde){
            $sonde = $this->apimanager->getBDSonde($user_sonde);
            Model::sendJSON($sonde);
         
        }
        public function formatDataLigneSonde($ligneSonde){
         $tabsonde = [];
            foreach($ligneSonde as $sondes){
                if(!array_key_exists($sondes['IDSonde'],$tabsonde)){
                  $tabsonde[$sondes['IDSonde']] = [
                     "Sonde" => $sondes['IDSonde'],
                     "model" => $sondes['model'],
                     "Station" => $sondes['IDStation'],
                     "Users" => $sondes['IDUsers'],
                   //  "Model" => $sondes['Model']
                  ];
                }
            }
            return $tabsonde;
            /*   echo "------------Start----------------";
            print_r($ligneSonde);
             echo "------------End--------------";
         */

        }

        // Permet de convertir en objet JSON récupérable par une API
        // private function formatDataLignesUsers($lignes){
        //     $tab = [];
            
        //     foreach($lignes as $ligne){
        //         if(!array_key_exists($ligne['IDUsers'],$tab)){
        //             $tab[$ligne['IDUsers']] = [
        //                 "id" => $ligne['IDUsers'],
        //                 "nom" => $ligne['Nomcomplet'],
        //                 "Email" => $ligne['EmailUsers'],
        //                 "Password" => $ligne['Password']
        //             ];
        //         }
        //     }
    
        //     return $tab;
        // }



        public function getReleve(){
            $releve = $this->apimanager->getBDReleve();
            Model::sendJSON($releve);

        }

        public function getDernierReleve($user_sonde){
            $dernierReleve = $this->apimanager->getBDdernierReleve($user_sonde);
            Model::sendJSON($dernierReleve);

        }

        public function getDerniersReleves(){
            $derniersReleves = $this->apimanager->getBDderniersReleves();
            Model::sendJSON($derniersReleves);

        }

    
        public function getStation(){
            $station = $this->apimanager->getBDStation();
            Model::sendJSON($station);
            // echo "<pre>";
            // print_r($stations);
            // echo "</pre>";
           
        }
        public function getSondes(){
            $sondes = $this->apimanager->getBDSondes();
            Model::sendJSON($sondes);
        }
        
    }
