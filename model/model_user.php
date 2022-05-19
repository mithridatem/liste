<?php
    class User{
        /*--------------------------------------
                    Attributs               
        --------------------------------------*/
        private $id_user;
        private $name_user;
        private $first_name_user;
        private $id_role;
        /*--------------------------------------
                    Constructeur               
        --------------------------------------*/
        public function __construct(){
        }
        /*--------------------------------------
                    Getters and Setters               
        --------------------------------------*/
        public function getIdUser():int{
            return $this->id_user;
        }
        public function getNameUser():string{
            return $this->name_user;
        }
        public function getFirstNameUser():string{
            return $this->first_name_user;
        }
        public function getIdRole():int{
            return $this->id_role;
        }
        public function setIdUser($id){
            $this->id_user = $id;
        }
        public function setNameUser($name){
            $this->name_user = $name;
        }
        public function setFirstNameUser($first){
            $this->first_name_user = $first;
        }
        public function setIRole($id){
            $this->id_role = $id;
        }
        /*--------------------------------------
                    Méthodes               
        --------------------------------------*/
        //afficher tous les utilisateurs
        public function showAllUser($bdd):array{
            try{
                $req = $bdd->prepare('SELECT * FROM user INNER JOIN role 
                WHERE user.id_role = role.id_role');
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
        public function showUsersById($bdd, $id):array{
            try{
                $req = $bdd->prepare('SELECT * FROM user WHERE id_user = :id_user');
                $req->execute(array(
                    'id_user' => $id,
                ));
                $data = $req->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }
            catch(Exception $e)
            {
                //affichage d'une exception en cas d’erreur
                die('Erreur : '.$e->getMessage());
            }
        }
        //mettre à jour le role d'un utilisateur
        public function updateRoleUser($bdd, $id, $id_role):void{
            try{
                $req = $bdd->prepare('UPDATE user set id_role 
                = :id_role WHERE id_user = :id_user');
                $req->execute(array(
                    'id_user' => $id,
                    'id_role' => $id_role,
                ));
            }
            catch(Exception $e)
            {
                //affichage d'une exception en cas d’erreur
                die('Erreur : '.$e->getMessage());
            }
        }
    }

?>