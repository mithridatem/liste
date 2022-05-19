<?php
    //imports
    include './utils/connectBdd.php';
    include './model/model_user.php';
    include './model/model_role.php';
    include './view/view_show_all_user.php';
    //instance des objets
    $user = new User();
    $role = new Role();
    //récupération des tables BDD
    $liste = $user->showAllUser($bdd);
    $roles = $role->showAllRole($bdd);
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
    echo '</table></div></form>
    <script src="./asset/script/script.js"></script><div id="error"></div></body>
    </html>';

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