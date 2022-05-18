const ligne = document.querySelectorAll('.select');
//console.log(ligne);
//boucle sur toutes lignes
ligne.forEach(e=>{
    //ajout d'un écouteur d'événement sur la liste déroulante
    e.children[2].children[0].addEventListener('click', ()=>{
        //récupération de la valeur sélectionnée dans la liste déroulante
        let valeur = e.children[2].children[0].value;
        //récupération de l'url du lien
        let url = e.children[4].children[0].href;
        //construction et remplacement de l'url 
        //exemple : update_user.php?id=1&id_role=3
        e.children[4].children[0].innerHTML = "<a href="+url+"&id_role="+valeur+"><img src='./asset/image/edit.png' class='edit'></a>";
    })
})