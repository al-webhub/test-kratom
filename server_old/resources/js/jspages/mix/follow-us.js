window.addEventListener("load", function(event) {

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
            }, {passive: true});
            slider.addEventListener("touchend", function(event){
                var endPointX = event.changedTouches[0].screenX;
                var endPointY = event.changedTouches[0].screenY;
                
                if(startPointX - endPointX > 40) {
                    arrowNext.click();
                } else if(endPointX - startPointX > 40) {
                    arrowPrev.click();
                }
            }, {passive: true});
        }
    }
    

    initialSlider();
    
    
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