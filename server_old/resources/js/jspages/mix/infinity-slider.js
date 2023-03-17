window.addEventListener("load", function(event) {
     // Infinty slider
    
    let arrowsInfinity = document.querySelectorAll('.js-arrow-infinity');
    
    function initialInfinitySlider() {
        for(var i = 0;arrowsInfinity.length > i; i++) {
            let slider = arrowsInfinity[i].closest(".slider-infinity");
            let arrowNext = arrowsInfinity[i].querySelector('.next');
            let arrowPrev = arrowsInfinity[i].querySelector('.prev');
            let sliderList = slider.querySelector('.js-infinity-slider-list');
            
            
            var checkSlider = true;
            
            arrowNext.addEventListener('click', function() {
                
                setTimeout(() => {
                    checkSlider = true;
                }, 400);
                
                if(!checkSlider) {
                    return;
                }
                
                checkSlider = false;
                
                let itemShow = slider.querySelector('.js-slider-item-infinity.show');
                let indexItemShow = itemShow.getAttribute('data-index');
                let allDots = slider.querySelectorAll('.js-dot');
                let activeDot = slider.querySelector('.js-dot.active');
                
                if(allDots.length > 1) {
                    if(indexItemShow % 3 == 0) {
                        if(activeDot.nextElementSibling == null) {
                            allDots[0].classList.add('active');
                            activeDot.classList.remove('active');
                        }else {
                            activeDot.nextElementSibling.classList.add('active');
                            activeDot.classList.remove('active');
                        }
                    }
                }
                
                
                itemShow.nextElementSibling.classList.add('show');
                itemShow.classList.remove('show');
                
                setTimeout(function(){
                    let newElem = itemShow;
                    itemShow.remove();
                    sliderList.append(newElem);
                },390);
                
            });
            
            arrowPrev.addEventListener('click', function() {
                setTimeout(() => {
                    checkSlider = true;
                }, 400);
                
                if(!checkSlider) {
                    return;
                }
                
                checkSlider = false;
                
                let itemShow = slider.querySelector('.js-slider-item-infinity.show');
                let indexItemShow = itemShow.getAttribute('data-index');
                let allDots = slider.querySelectorAll('.js-dot');
                let activeDot = slider.querySelector('.js-dot.active');
                let lastElem = sliderList.lastElementChild;
                
                if(allDots.length > 1) {
                    if(indexItemShow % 3 == 0) {
                        if(activeDot.previousElementSibling == null) {
                            allDots[allDots.length - 1].classList.add('active');
                            activeDot.classList.remove('active');
                        }else {
                            activeDot.previousElementSibling.classList.add('active');
                            activeDot.classList.remove('active');
                        }
                    }
                }

                sliderList.prepend(lastElem);
                
                setTimeout(function(){
                    itemShow.previousElementSibling.classList.add('show');
                    itemShow.classList.remove('show');
                },20);
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
    
    initialInfinitySlider();
    
    // //Infinty slider
    
});