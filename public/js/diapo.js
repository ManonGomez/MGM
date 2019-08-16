const carousel = {
    slideIndex: 1,

    setIntervalId: null,

    showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");

        if (n > slides.length) {
            this.slideIndex = 1
        }
        if (n < 1) {
            this.slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";

        }
        slides[this.slideIndex - 1].style.display = "block";
    },


    plusSlides(n) {
        this.showSlides(this.slideIndex += n);
    },
    currentSlide(n) {
        this.showSlides(this.slideIndex = n);
    },

    automatic() {
        this.slideIndex += 1;
        this.showSlides(this.slideIndex);

    },


    buttonpause() {
        var buttonpause
        clearInterval(this.setIntervalId)
    },

    buttonplay() {
        this.setIntervalId = setInterval(() => {
            this.automatic()
        }, 5000)
    },

    init() {
        //permet d'afficher tout de suite la 1ere slide
        this.showSlides(this.slideIndex);
        
        var prev = document.getElementById("prev");
        prev.addEventListener("click", (e) => {
            this.plusSlides(-1)
        })
        var next = document.getElementById("next");
        next.addEventListener("click", (e) => {
            this.plusSlides(1)
        })
        var buttonpause = document.getElementById("buttonpause");
        buttonpause.addEventListener("click", (e) => {
            this.buttonpause()
        })

        var buttonplay = document.getElementById("buttonplay");
        buttonplay.addEventListener("click", (e) => {
            this.buttonplay()
        })

        document.addEventListener("keyup", (e) => {
            // console.log("Evènement clavier : " + e.type + ", touche : " + e.keyCode);
            if (e.keyCode == 37) {
                this.plusSlides(-1)
            }
            if (e.keyCode == 39) {
                this.plusSlides(1)
            }
        })
        //change image every 5 seconds
        this.setIntervalId = setInterval(() => {
            this.automatic();
        }, 5000)
    },

}

document.addEventListener('load', function(){
    
    var carouselElement = document.getElementById('mySlide');
    if ( carouselElement ) {
        carousel.init()
    }

})
