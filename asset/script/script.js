//Récupération de toutes les lignes du tableau HTML
const ligne = document.querySelectorAll('.select');
//boucle sur toutes lignes
ligne.forEach(e=>{
    //ajout d'un écouteur d'événement sur la liste déroulante de chaque ligne
    //e.children[2].children[0] c'est la liste déroulante (à la 3 colonne du tableau)
    e.children[2].children[0].addEventListener('click', ()=>{
        console.log(e.children[2].children[0].value);
        //récupération de la valeur sélectionnée dans la liste déroulante de chaque ligne
        let valeur = e.children[2].children[0].value;
        //récupération de l'url du lien
        //e.children[4].children[0] c'est la colonne 5 du tableau (href c'est l'url en HTML)
        let url = e.children[4].children[0].href;
        //construction et remplacement de l'url 
        //exemple : update_user.php?id=1&id_role=3
        e.children[4].children[0].innerHTML = "<a href="+url+"&id_role="+valeur+"><img src='./asset/image/edit.png' class='edit'></a>";
    })
});
