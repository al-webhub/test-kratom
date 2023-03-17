/*
window.addEventListener("load", function(event) {
	//MAIN SLIDER
	let mainArrows = document.querySelectorAll(".main-js-arrows");
	var sliderAutoStart;
	function initialSliderMain() {
	    for(var i = 0;mainArrows.length > i; i++) {
	        let slider = mainArrows[i].closest(".main-slider");
	        let arrowNext = mainArrows[i].querySelector('.next');
	        let arrowPrev = mainArrows[i].querySelector('.prev');
	        let allItems = slider.querySelectorAll('.js-slider-item').length;
	        let sliderItems = slider.querySelectorAll('.js-slider-item');
	        
	        if(allItems < 2) {
	            arrowNext.classList.add("disabled");
	        }
	        
	        function autoPlay() {
	            let itemShow = slider.querySelector('.js-slider-item.show');
	            let dotActive = slider.querySelector('.js-dot.active');
	            let allDots = slider.querySelectorAll('.js-dot');
	            
	            
	            
	            if(slider.querySelector('.js-slider-item.show').nextElementSibling == null) {
	                slider.querySelector('.js-slider-item.show').classList.remove('show');
	                sliderItems[0].classList.add('show');
	                arrowNext.classList.remove('disabled');
	                arrowPrev.classList.add('disabled');
	            }else {
	                itemShow.nextElementSibling.classList.add('show');
	                itemShow.classList.remove('show');
	                arrowPrev.classList.remove('disabled');
	            }
	            if(dotActive) {
	                if(dotActive.nextElementSibling) {
	                    dotActive.nextElementSibling.classList.add('active');
	                    dotActive.classList.remove('active');
	                }else {
	                    dotActive.classList.remove("active");
	                    allDots[0].classList.add('active');
	                }
	            }
	            
	            
	            if(slider.querySelector('.js-slider-item.show').nextElementSibling == null) {
	                arrowNext.classList.add('disabled');
	            }
	        }
	        
	        
	        if(window.innerWidth > 1160){
	            slider.addEventListener('mouseover', function(){
	                clearInterval(sliderAutoStart);
	            });
	            
	                
	            slider.addEventListener('mouseleave', function(){
	                sliderAutoStart = setInterval(autoPlay, 10000);
	            });
	            
	            sliderAutoStart = setInterval(autoPlay, 10000);
	        }
	        
	        arrowNext.addEventListener('click', function() {
	            let itemShow = slider.querySelector('.js-slider-item.show');
	            let dotActive = slider.querySelector('.js-dot.active');
	
	            if(slider.querySelector('.js-slider-item.show').nextElementSibling == null) {
	                return;
	            }
	            
	            if(dotActive) {
	                dotActive.nextElementSibling.classList.add('active');
	                dotActive.classList.remove('active');
	            }
	            
	            arrowPrev.classList.remove('disabled');
	            
	            itemShow.nextElementSibling.classList.add('show');
	            itemShow.classList.remove('show');
	            
	            if(slider.querySelector('.js-slider-item.show').nextElementSibling == null) {
	                arrowNext.classList.add('disabled');
	            }
	        });
	        
	        arrowPrev.addEventListener('click', function() {
	            let itemShow = slider.querySelector('.js-slider-item.show');
	            let dotActive = slider.querySelector('.js-dot.active');
	            
	            if(slider.querySelector('.js-slider-item.show').previousElementSibling == null) {
	                return;
	            }
	             
	            if(dotActive) {
	                dotActive.previousElementSibling.classList.add('active');
	                dotActive.classList.remove('active');
	            }
	            arrowNext.classList.remove('disabled');
	            
	            itemShow.previousElementSibling.classList.add('show');
	            itemShow.classList.remove('show');
	            
	            if(slider.querySelector('.js-slider-item.show').previousElementSibling == null) {
	                arrowPrev.classList.add('disabled');
	            }
	        });
	
	        var startPointX;
	        var startPointY;
	        slider.addEventListener("touchstart", function(event) {
	            startPointX = event.changedTouches[0].screenX;
	            startPointY = event.changedTouches[0].screenY;
	        }, false);
	        slider.addEventListener("touchend", function(event){
	            var endPointX = event.changedTouches[0].screenX;
	            var endPointY = event.changedTouches[0].screenY;
	            
	            if(startPointX - endPointX > 40) {
	                arrowNext.click();
	            } else if(endPointX - startPointX > 40) {
	                arrowPrev.click();
	            }
	        }, false);
	    }
	}
	
	
	initialSliderMain();
	
	
	document.addEventListener('click', function(e){
	    let elem = e.target;
	    
	    if(elem.closest('.js-dot')) {
	        document.querySelectorAll('.js-dot').forEach(function(item){
	            item.classList.remove('active');
	        });
	        
	        let mainItem = document.querySelectorAll('.main-slider__item')
	        mainItem.forEach(function(item){
	            item.classList.remove('show');
	        });
	        
	        let buttonPrev = document.querySelector('.main-banner__arrows .slider-button .prev');
	        let buttonNext = document.querySelector('.main-banner__arrows .slider-button .next');
	        
	        buttonPrev.classList.remove('disabled');
	        let index = elem.getAttribute('data-index');
	        
	        if(index == 1) {
	            buttonPrev.classList.add('disabled');
	            buttonNext.classList.remove('disabled');
	        }
	        
	        if(index == mainItem.length) {
	            buttonNext.classList.add('disabled');
	            buttonPrev.classList.remove('disabled');
	        }
	        
	        document.querySelector('.main-slider__item[data-index= "'+ index + '"]').classList.add('show');
	        elem.classList.add('active');
	    }
	});
	//MAIN SLIDER
	
	
	
	
	// mainSLider
    
    let arrows = document.querySelectorAll(".js-arrows");
    
     function initialSlider() {
        for(var i = 0;arrows.length > i; i++) {
            let slider = arrows[i].closest(".slider");
            let arrowNext = arrows[i].querySelector('.next');
            let arrowPrev = arrows[i].querySelector('.prev');
            let allItems = slider.querySelectorAll('.js-slider-item').length;
            
            if(allItems < 2) {
                arrowNext.classList.add("disabled");
            }
            
            arrowNext.addEventListener('click', function() {
                let itemShow = slider.querySelector('.js-slider-item.show');
                let itemElseShow = slider.querySelector('.js-slider-item-else.show');
                let dotActive = slider.querySelector('.js-dot.active');
                
                if(slider.querySelector('.js-slider-item.show').nextElementSibling == null) {
                    return;
                }
                
                if(dotActive) {
                    dotActive.nextElementSibling.classList.add('active');
                    dotActive.classList.remove('active');
                }
                
                arrowPrev.classList.remove('disabled');
                
                if(itemElseShow) {
                    itemElseShow.nextElementSibling.classList.add('show');
                    itemElseShow.classList.remove('show');
                }
                
                itemShow.nextElementSibling.classList.add('show');
                itemShow.classList.remove('show');
                
                if(slider.querySelector('.js-slider-item.show').nextElementSibling == null) {
                    arrowNext.classList.add('disabled');
                }
            });
            
            arrowPrev.addEventListener('click', function() {
                let itemShow = slider.querySelector('.js-slider-item.show');
                let itemElseShow = slider.querySelector('.js-slider-item-else.show');
                let dotActive = slider.querySelector('.js-dot.active');
                
                if(slider.querySelector('.js-slider-item.show').previousElementSibling == null) {
                    return;
                }
                 
                if(dotActive) {
                    dotActive.previousElementSibling.classList.add('active');
                    dotActive.classList.remove('active');
                }
                
                arrowNext.classList.remove('disabled');
                
                if(itemElseShow) {
                    itemElseShow.previousElementSibling.classList.add('show');
                    itemElseShow.classList.remove('show');
                }
                
                itemShow.previousElementSibling.classList.add('show');
                itemShow.classList.remove('show');
                
                if(slider.querySelector('.js-slider-item.show').previousElementSibling == null) {
                    arrowPrev.classList.add('disabled');
                }
            });

            var startPointX;
            var startPointY;
            slider.addEventListener("touchstart", function(event) {
                startPointX = event.changedTouches[0].screenX;
                startPointY = event.changedTouches[0].screenY;
            }, false);
            slider.addEventListener("touchend", function(event){
                var endPointX = event.changedTouches[0].screenX;
                var endPointY = event.changedTouches[0].screenY;
                
                if(startPointX - endPointX > 40) {
                    arrowNext.click();
                } else if(endPointX - startPointX > 40) {
                    arrowPrev.click();
                }
            }, false);
        }
    }
    

    initialSlider();
    
    
    document.addEventListener('click', function(e){
        let elem = e.target;
        
        if(elem.closest('.main-banner__nav__button')) {
            document.querySelectorAll('.main-banner__nav__button').forEach(function(item){
                item.classList.remove('active');
            });
            
            let mainItem = document.querySelectorAll('.main-banner__item')
            mainItem.forEach(function(item){
                item.classList.remove('show');
            });
            
            let buttonPrev = document.querySelector('.main-banner__arrows .prev');
            let buttonNext = document.querySelector('.main-banner__arrows .next');
            
            buttonPrev.classList.remove('disabled');
            let index = elem.getAttribute('data-index');
            
            if(index == 1) {
                buttonPrev.classList.add('disabled');
                buttonNext.classList.remove('disabled');
            }
            
            if(index == mainItem.length) {
                buttonNext.classList.add('disabled');
                buttonPrev.classList.remove('disabled');
            }
            
            document.querySelector('.main-banner__item[data-index= "'+ index + '"]').classList.add('show');
            elem.classList.add('active');
        }
    });
    
    
    let socialItems = document.querySelectorAll('.js-socila-item');
    
    socialItems.forEach((item) => {
        item.addEventListener('mouseover', function() {
            attribute = item.getAttribute("data-target");
            document.querySelectorAll('.follow-us__arrows .dots__item').forEach(function(item){
                item.classList.remove('active');
            });
            
            let mainItem = document.querySelectorAll('.follow-us__item')
            mainItem.forEach(function(item){
                item.classList.remove('show');
            });
            
            let buttonPrev = document.querySelector('.follow-us__arrows .prev');
            let buttonNext = document.querySelector('.follow-us__arrows .next');
            
            buttonPrev.classList.remove('disabled');
            let index = item.getAttribute('data-index');
            
            if(index == 1) {
                buttonPrev.classList.add('disabled');
                buttonNext.classList.remove('disabled');
            }
            
            if(index == mainItem.length / 2) {
                buttonNext.classList.add('disabled');
                buttonPrev.classList.remove('disabled');
            }
            
            document.querySelector('.follow-us__phone .follow-us__item[data-index= "'+ index + '"]').classList.add('show');
            document.querySelector('.follow-us__tablet .follow-us__item[data-index= "'+ index + '"]').classList.add('show');
            document.querySelector('.follow-us__arrows .dots__item[data-index= "'+ index + '"]').classList.add('active');
        });
    });
    // /Main SLider
});
*/