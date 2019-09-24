window.addEventListener('load', () => {
    const formUnsplash = document.getElementById('unsplash-form');
    if ( formUnsplash !== null ) {
        initForm();
    }
});

function initForm() {
    const formUnsplash = document.getElementById('unsplash-form');
    if( formUnsplash !== null ) {
        //ajout de l'event au click sur le bouton du formulaire de recherche
        formUnsplash.addEventListener('submit', (e) => {
            e.preventDefault();
            //on récupére les données du formulaire
            const inputQuery = document.getElementById('unsplash-query');
            const queryValue = inputQuery.value;
            //utilisation de l'objet UnsplashGallery avec la recherche de l'utilisateur et la page 1 par défaut à chaque recherche
            UnsplashGallery.unsplashRequest(queryValue, 1)
        })
    } 

}

/**
 * Object qui gère la requete pour récupérer les images et le nombre de pages
 * Affichage de la gallerie
 * Affichage de la pagination
 */
const UnsplashGallery = {

    currentPage: 1,
    query: '',
    deltaPagination: 5, //on affiche seulement le 5 pages dans la pagination

    unsplashRequest(query, page) {
        if ( page === undefined ) {
            page = 1;
        }
        
        //si la recherche est vide on ne fait pas de requete et on passe un tableau vide à la fonction
        if ( query  === '' ) {
            return buildGallery([]);
            //avec return, on s'arrete là
        }
        this.query = query;
        this.currentPage = parseInt(page);
        //on recupere les éléments en PHP afin de garder secret les identifiants de connexion à unsplash
        fetch('/admin/photosFromUnsplash/' + this.query + '/' + parseInt(this.currentPage))
        .then( (response) => {
            response.json().then( (response) => {
                //on construit la gallerie d'images avec le resultat de la requete 
                this.buildGallery(response.results, response.page, response.totalPages);
            })
        })
        .catch( (err) => console.log(err) );
    
    },

    //construction de la gallerie
    buildGallery(ListPhotos, page, totalPages) {

        //la page actuelle
        this.currentPage = parseInt(page);

        //l'element HTML dans lequel sera inséré la gallerie
        const galleryContainer = document.getElementById('unsplash-container');
        //construction du HTML de la gallerie
        let gallery = '<div class="row">';
        ListPhotos.forEach( (element, index) => {
            //pour chaque photo, on crée une colonne bootstrap
           gallery += `<div class="col-2 picUnsplash undiv">
                        <img class="img-fluid" src="${element.urls.regular}" />
                        <a class="btn btn-secondary unbutton" href="${element.links.html}" download target="_blank">Télécharger via unplash</a>
                       </div>`; 
        })
        //fermeture de la div gallery
        gallery += '</div>';
        //insertion dans la page
        galleryContainer.innerHTML = gallery;
        //construction de la pagination
        this.buildPagination(totalPages);
    },
    
    
    buildPagination(totalPages) {
         //l'element HTML dans lequel sera inséré la pagination
        const paginationContainer = document.getElementById('unsplash-pagination');
        let pagination = '<nav><ul class="pagination">';
        let startPage = this.currentPage;

        //si on se trouve sur une autre page que la 1, on affiche seluement la pagination de la page précédente
        // exemple si on se trouve sur la page 2, on affiche 1,2,3,4,5. Le 1 est affiché afin de pouvoir revenir en arrière
        if ( startPage > 1 ) {
            //on construit un bouton de retour en arrière
            pagination += '<li class="page-item"><a class="page-link unsplash-link" id="unsplash-link-previous" data-page="'+ (startPage - 1)  +'" href="#">'+ (startPage - 1) +'</a></li>'; 
        }

        //si il y a max 100 pages et que l'on se trouve sur la page 98,
        //il faut afficher 95, 96, 97,98, 99, 100
        //sans ce bout de code, on aurait 97, 98, 99, 100, 101. Ce qui n'est pas possible car max 100 pages.
        if (totalPages - this.currentPage < this.deltaPagination) {
            startPage = totalPages - this.deltaPagination + 1;
        }

        //On fait une boucle pour construire la pagination
        for(let i = startPage; i < startPage + this.deltaPagination; i++ ) {
            let className = startPage === i ? 'active' : '';
            //l'attribut data-page sur la a permet de récupérer le numero de page sur laquelle on souhaite aller
            //voir dans la fonction addEventOnPaginationLinks plus bas
            pagination += '<li class="page-item '+ className +'"><a href="" class="page-link unsplash-link" data-page="'+ i +'">'+ i +'</a></li>'
        }
        pagination += '</ul><nav/>';
        paginationContainer.innerHTML = pagination;

        //on ajout les events pour rendre la pagination active au click
        this.addEventOnPaginationLinks();
        
    },
    
    addEventOnPaginationLinks(){
        const links = document.getElementsByClassName('unsplash-link');
        Array.from(links).forEach( (link) => {
            //pour chage page, quand on click, 
            link.addEventListener('click', (e) => {
                //on empêche le comporement par default des liens 
                e.preventDefault();
                //on récupère le numéro de page sur laquelle on souhaite aller
                $targetPage = parseInt(e.currentTarget.dataset.page);
                if ( $targetPage === undefined || $targetPage < 1) {
                    $targetPage = 1;
                }
                //on rejoue la requete avec la même query et la nouvelle page voulue
                this.unsplashRequest(this.query, $targetPage)
            })
        })
    }
    
}