<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./asset/style/style.css">
    <title>Liste utilisateurs</title>
</head>
<body>
    <!--Liste des utilisateurs-->
    <form action="" method="post">
    <div id="container">
        <table id="liste">
            <tr>
                <th>Nom:</th>
                <th>Prénom:</th>
                <th>Liste de rôle:</th>
                <th>Rôle:</th>
                <th>Action:</th>
            </tr>
<?php
    /*---------------------------------------------------
                    Connexion à la BDD
    ---------------------------------------------------*/

    include './utils/connectBdd.php';

    /*---------------------------------------------------
                        Fonctions
    ---------------------------------------------------*/

    //récupére tous les utilisateurs
    function showAllUser($bdd):array{
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
    //récupére l'utilisateur par son ID
    function showUsersById($bdd, $id):array{
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
    //récupére tous les rôles
    function showAllRole($bdd){
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
    //mettre à jour le role d'un utilisateur
    function updateRoleUser($bdd, $id, $id_role):void{
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

    /*---------------------------------------------------
                        Variables
    ---------------------------------------------------*/

    //récupération des tables en BDD
    $liste = showAllUser($bdd);
    $roles = showAllRole($bdd);

    /*---------------------------------------------------
                Affichage des utilisateurs
    ---------------------------------------------------*/

    //boucle affichage de la liste des utilisateurs
    foreach($liste as $value){
        echo '<tr class="select">
                    <td>'.$value['name_user'].'</td>
                    <td>'.$value['first_name_user'].'</td>
                    <td>
                <select>
            <option value="">sélectionnez un role</option>';
            //boucle affichage du menu déroulant rôle (pour chaque utilisateur)
            foreach($roles as $value2){
                echo '<option value="'.$value2['id_role'].'">
                '.$value2['name_role'].'</option>';
            }
            echo '</select>
                </td>
                <td>'.$value['name_role'].'</td>
                <td><a href="./onepage.php?id='.$value['id_user'].'"><img src="./asset/image/edit.png" class="edit"></a></td>
            </tr>';
    }
?>
    <!-- fin du tableau et import script JS en HTML -->
    </table></div></form>
    <script src="./asset/script/script.js"></script><div id="error"></div></body>
    </html>
<?php
    /*---------------------------------------------------
            Mise à jour du Rôle de l'utilisateur
    ---------------------------------------------------*/

    //test si id et id_role existe
    if(isset($_GET['id']) AND isset($_GET['id_role'])){
        //test si id_role est vide
        if($_GET['id_role']==""){
            //redirection
            header('Location: ./onepage.php?error');
        }
        //sinon
        else{
            //appel de la méthode updateRoleUser (mise à jour du rôle de l'utilisateur)
            updateRoleUser($bdd, $_GET['id'], $_GET['id_role']);
            //récupération du user mis à jour
            $name = showUsersById($bdd, $_GET['id']);
            //redirection
            header('Location: ./onepage.php?name='.$name[0]['name_user'].'&first='.$name[0]['first_name_user'].'');
        }
    } 

    /*---------------------------------------------------
                 Gestion des messages d'erreurs
    ---------------------------------------------------*/

    //test si il y à une erreur
    if(isset($_GET['error'])){
        echo "<script>let error = document.querySelector('#error');
        error.textContent = 'Veuillez sélectionner une catégorie, clic dans la liste pour confirmer la sélection'</script>";
    }
    //test si un utilisateur à été mis à jour (affiche le nom de l'utilisateur)
    if(isset($_GET['name']) AND isset($_GET['first'])){
        echo '<script>
                setTimeout(()=>{document.location.href="./onepage.php";}, 2000);
                let error = document.querySelector("#error");
                error.textContent = "Utilisateur : '.$_GET['name'].' '.$_GET['first'].' a été mis à jour";
        </script>';

    }
?>