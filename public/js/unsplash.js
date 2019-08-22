// ES Modules syntax
import Unsplash from 'unsplash-js';

// require syntax
const Unsplash = require('unsplash-js').default;

const unsplash = new Unsplash({
    //acces key
  applicationId: "{fb329a94f8871fac69bd92222d9d5675b6eb8e3212a2a9ee079a38b592232917}",
  //app secret
  secret: "{9501f976fcf85ada0a2abcb83e1f8d8379dcd52b3cc560d6eb271a3a0ba31825}"
});


// test2

var APIKey = '9501f976fcf85ada0a2abcb83e1f8d8379dcd52b3cc560d6eb271a3a0ba31825';

$.getJSON('https://api.unsplash.com/search/photos?query=chicago&per_page=50&client_id=9501f976fcf85ada0a2abcb83e1f8d8379dcd52b3cc560d6eb271a3a0ba31825', function(data) {
  console.log(data);
  
  
  var imageList = data.results;
  
  $.each(imageList, function(i, val) {
    
    var image = val;
    var imageURL = val.urls.regular;
    var imageWidth = val.width;
    var imageHeight = val.height;
    
    if (imageWidth > imageHeight) {
      $('.grid').append('<div class="image"><img src="'+ imageURL +'"></div>');
    }   
    
  });  
});