window.addEventListener('load', () => {

    initForm();

});

function initForm() {
    const formUnsplash = document.getElementById('unsplash-form');
    if( formUnsplash !== null ) {
        formUnsplash.addEventListener('submit', (e) => {
            e.preventDefault();
            const inputQuery = document.getElementById('unsplash-query');
            const queryValue = inputQuery.value;
            unsplashRequest(queryValue)
        })
    } 

}

function unsplashRequest(query) {
    //si la recherche est vide on ne fait pas de requete et on passe un tableau vide à la fonction
    if ( query  === '') {
        return buildGallery([]);
        //avec return, on s'arrete là
    }
    //on recupere les éléments en PHP afin de garder secret les identifiants de connexion à unsplash
    fetch('/admin/photosFromUnsplash/' + query)
    .then( (response) => {
        response.json().then( (response) => {
            buildGallery(response);
        })
    })
    .catch( (err) => console.log(err) );

}

function buildGallery(ListPhotos) {
    //TODO : ajouter une pagination
    console.log(ListPhotos);
    const galleryContainer = document.getElementById('unsplash-container');
    let gallery = '<div class="row">';
    ListPhotos.forEach( (element, index) => {
       gallery += `<div class="col-2">
                    <img class="img-fluid" src="${element.urls.regular}" />
                    <a href="${element.links.html}" download target="_blank">Télécharger via unplash</a>
                   </div>`; 
    })
    gallery += '</div>';
    galleryContainer.innerHTML = gallery;
}