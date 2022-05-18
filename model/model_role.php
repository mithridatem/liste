<?php
    class Role{
        /*--------------------------------------
                    Attributs               
        --------------------------------------*/
        private $id_role;
        private $name_role;       
        /*--------------------------------------
                    Constructeur               
        --------------------------------------*/
        public function __construct(){
        }
        /*--------------------------------------
                    Getters and Setters               
        --------------------------------------*/
        public function getIdRole():int{
            return $this->id_role;
        }
        public function getNameRole():string{
            return $this->name_role;
        }
        public function setIRole($id){
            $this->id_role = $id;
        }
        public function setNameRole($name){
            $this->name_role = $name;
        }
        /*--------------------------------------
                    Méthodes               
        --------------------------------------*/
        public function showAllRole($bdd){
            try{
                $req = $bdd->prepare('SELECT * FROM role');
                $req->execute();
                $data = $req->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }
            catch(Exception $e)
            {
                //affichage d'une exception en cas d’erreur
                die('Erreur : '.$e->getMessage());
            }
        }
    }

?>