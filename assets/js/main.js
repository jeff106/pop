'use strict'
/** Function**/
//traite la redirection de la requete Ajax
function onClickLink() {
    let link = $('link[name]:visited').dat;
    //determiner la requete par rapport au choix de l'administrateur
    switch(link) {
        case 'users':

            break;
        case 'news':

            break;
        case 'comment':

            break;
    }
}
//gestionnaire d'évènement declenché au click sur un lien de la nav
$(function() {
    $('.navbar').on('click', onClickLink)
})