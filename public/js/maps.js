function addMap() {

	var lyon = [45.7578137, 4.8320114];
	// création de la map

	var map = L.map('map').setView(lyon, 13);

	// création du calque images
	L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
		maxZoom: 20
	}).addTo(map);

	// ajout d'un markeur
	var marker = L.marker(lyon).addTo(map);

	// ajout d'un popup
	marker.bindPopup('<h3> Lyon, FRANCE </h3>');

}



window.addEventListener('load', function() {

	// on test la présence de la map 
	var mapElement = document.getElementById('map');
	if ( mapElement ) {
		//si elle est présente, on lance l'affichage
		addMap();
	}
	
})