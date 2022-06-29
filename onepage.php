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
    <form action="./test.php" method="post">
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
    /*---------------------------------------------------
                        Variables
    ---------------------------------------------------*/
    //récupération des tables en BDD
    $liste = showAllUser($bdd);
    $roles = showAllRole($bdd);
    /*---------------------------------------------------
                        Logique
    ---------------------------------------------------*/
    //boucle affichage de la liste des utilisateurs
    foreach($liste as $value){
        echo '<tr class="select">
                    <td>'.$value['name_user'].'</td>
                    <td>'.$value['first_name_user'].'</td>
                    <td>
                <select>
            <option value="">sélectionnez un role</option>';
            //boucle affichage du menu déroulant role
            foreach($roles as $value2){
                echo '<option value="'.$value2['id_role'].'">
                '.$value2['name_role'].'</option>';
            }
            echo '</select>
                </td>
                <td>'.$value['name_role'].'</td>
                <td><a href="./update_user.php?id='.$value['id_user'].'"><img src="./asset/image/edit.png" class="edit"></a></td>
            </tr>';
    }
    //fin du tableau et import script JS
    echo '</table></div></form>
    <script src="./asset/script/script.js"></script><div id="error"></div></body>
    </html>';
    /*---------------------------------------------------
                        Gestion des erreurs
    ---------------------------------------------------*/
    //gestion des erreurs
    //test si il y à une erreur
    if(isset($_GET['error'])){
        echo "<script>let error = document.querySelector('#error');
        error.innerHTML = 'Veuillez sélectionner une catégorie, clic dans la liste pour confirmer la sélection'</script>";
    }
    //test si un utilisateur à été mis à jours
    if(isset($_GET['name']) AND isset($_GET['first'])){
        echo '<script>let error = document.querySelector("#error")
        error.innerHTML = "Utilisateur : '.$_GET['name'].' '.$_GET['first'].' a été mis à jour"</script>';
    }
?>