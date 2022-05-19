<?php
    //imports
    include './utils/connectBdd.php';
    include './model/model_user.php';
    //test si id et id_role existe
    if(isset($_GET['id']) AND isset($_GET['id_role'])){
        //test si id_role est vide
        if($_GET['id_role']==""){
            //redirection
            header('Location: ./index.php?error');
        }
        //sinon
        else{
            //instance d'un objet user
            $user = new User();
            //appel de la méthode update
            $user->updateRoleUser($bdd, $_GET['id'], $_GET['id_role']);
            //récupération du user update
            $name = $user->showUsersById($bdd, $_GET['id']);
            //redirection
            header('Location: ./index.php?name='.$name[0]['name_user'].'&first='.$name[0]['first_name_user'].'');
        }
    } 
    else{
        //redirection
        header('Location: ./index.php?error');
    }
?>