window.addEventListener("load", function(event) {
	// PAGES PRELOADER	
	//document.querySelector('.preloader').classList.add('hide');
	document.querySelector('html').setAttribute('style', "");
	    
	// HEADER
	let burger = document.querySelector('.header__burger');
	let burgerList = document.querySelector(".header__nav");
	let burgerClose = document.querySelector('.header__close-nav');
	
	burger.addEventListener('click', function(){
	    burgerList.classList.add("active");
	    document.querySelector('html').classList.add('overflow');
	});
	
	burgerClose.addEventListener('click', function(){
	    burgerList.classList.remove('active');
	    document.querySelector('html').classList.remove('overflow');
	});
	
	// POPUPS
    let overlay = document.querySelector('.overlay');
    let htmlOverflow = document.querySelector('html');
    
    document.addEventListener('click', function(e){
        let item = e.target;
        
        if(item.closest('.js-button')) {
            let getData = item.closest('.js-button').getAttribute('data-target');
            let popupActive = document.querySelector('.popup.active, .popup2.active');
            let popup = document.querySelector('.popup[data-target = ' + getData + '], .popup2[data-target = ' + getData + ']');
            
            if(popupActive && !popupActive.classList.contains("popup-noty-cart")) {
                popupActive.classList.remove('active');
            }
            
            popup.classList.add('active');
            overlay.classList.add('active');
            htmlOverflow.classList.add('overflow');
        }
    });
    
    document.addEventListener('click', function(e){
        let elem = e.target;
        
        if(elem.closest('.js-close')){
            let popupActive = elem.closest('.popup.active');
            let popupReviews = document.querySelector(".popup-reviews.active");
            
            if(popupReviews) {
                popupReviews.querySelector('.clients-say__info__text').remove();
                popupReviews.querySelector('.clients-say__item__footer').remove();
            }
            
            if(popupActive) {
                popupActive.classList.remove('active');
            }
            
            if(popupActive && !document.querySelector(".popup-noty-cart").classList.contains("active")) {
                overlay.classList.remove('active');
                htmlOverflow.classList.remove('overflow');
            }
        }
    });

    overlay.addEventListener('click', function(){
        let popupActive = document.querySelector('.popup.active');
        let popupReviews = document.querySelector(".popup-reviews.active");
        
        if(popupReviews) {
            popupReviews.querySelector('.clients-say__info__text').remove();
            popupReviews.querySelector('.clients-say__item__footer').remove();
        }
        
        popupActive.classList.remove('active');
        overlay.classList.remove('active');
        htmlOverflow.classList.remove('overflow');
    });
    
    // SCROLL TOP
    let wrapperToTop = document.querySelector('.button-to-top');
    let buttonToTop = document.querySelector('.to-top');
    
    document.addEventListener('scroll', function(){
        if(window.pageYOffset > 1000) {
            wrapperToTop.classList.add('show');
        }else {
            wrapperToTop.classList.remove('show');
        }
    });
    
    buttonToTop.addEventListener('click', function(){
       window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });

    // Main input

    let allInput = document.querySelectorAll('.js-input');

    function checkInput(inputItems) {
        inputItems.forEach(function(item){
            let itemLenght = item.value.length;
            let inputWrapper = item.closest('.js-input-wrapper')
            if(itemLenght) {
                inputWrapper.classList.add('active-input');
            }else {
                inputWrapper.classList.remove('active-input');
            }
            item.addEventListener("keyup", function(){
                let itemLenght = item.value.length;
                if(itemLenght) {
                    inputWrapper.classList.add('active-input');
                }else {
                    inputWrapper.classList.remove('active-input');
                }
            });
        });
    }

    checkInput(allInput);

    document.addEventListener("click", function(e){
        let item = e.target;
        
        if(item.closest(".general-tabs__item")) {
            let allInput = document.querySelectorAll('.js-input');
            checkInput(allInput);
        }
    });

    // /Main input

    // Show password 

    document.addEventListener("click", function(e){
        let item = e.target;
        
        if(item.closest(".show-password")) {
            let wrapperInput = item.closest(".js-input-wrapper");
            let activeInput = wrapperInput.querySelector(".js-input");
            let getState = activeInput.getAttribute("type");
            
            if(getState == "password") {
                activeInput.setAttribute("type", "text");
            }else {
                activeInput.setAttribute("type", "password");
            }
        }
    });

    // /Show password
    
    // Drop
    let dropList = document.querySelectorAll('.js-drop-item');
    
    document.addEventListener('click', function(e){
        let element = e.target;
        
        if(element.closest('.js-drop-button')){
            let isActive = element.closest('.js-drop-item').classList.contains('active')? true: false;
            
            dropList.forEach(item => {item.classList.remove('active')});
            
            if(isActive){
                element.closest('.js-drop-item').classList.remove('active');
            }else {
                element.closest('.js-drop-item').classList.add('active');
            }
        }
        
        if(element.closest('.js-drop-contains')){
            let allInput = document.querySelectorAll('.js-input');
            checkInput(allInput);
            let dropList = element.closest('.js-drop-item');
            let dropItems = dropList.querySelectorAll('.js-drop-contains');
            
            dropItems.forEach(item => {item.classList.remove('active')});
            element.closest('.js-drop-contains').classList.add('active');
            let innerContent = element.closest('.js-drop-contains').querySelector('.text').innerHTML;
            let dropInput = dropList.querySelector('.js-drop-input');
            
            if(dropInput) {
                dropInput.value = innerContent;
            }
            
            checkInput(allInput);
            
            // close dropdown
            dropList.classList.remove('active');
        }
    });

    document.querySelector('body').addEventListener('click', function(event){
        
        let dropItem = event.target.closest('.js-drop-item');
        
        if(!dropItem) {
            document.querySelectorAll('.js-drop-item').forEach(function(item){
                item.classList.remove('active');
            });
            document.querySelector('.header__search__input').value = "";
        }
        if(dropItem) {
            if(!dropItem.classList.contains("active")) {
                document.querySelectorAll('.js-drop-item').forEach(function(item){
                    item.classList.remove('active');
                });
            }
        }
        
    });

    // //Drop
    
        // More info
        
      function showMoreInfo() {
            
        let info = document.querySelectorAll('.js-item .js-content p');
        let content = document.querySelectorAll('.js-item .js-content');
        let moreButton = document.querySelectorAll('.js-item .js-more');
        
        if(info) {
            for(var i = 0; info.length > i; i++) {
                if(info[i].offsetHeight > content[i].offsetHeight) {
                    moreButton[i].classList.add('show');
                }else {
                    moreButton[i].classList.remove('show');
                }
            }
        }
    }
        
    showMoreInfo();
    
    window.addEventListener('resize', function(){
        showMoreInfo();
    });
    

    
    document.addEventListener('click', function(e){
        let elem = e.target;
        
        if(elem.closest(".js-more")) {
            let wrapper = elem.closest(".js-more").closest('.js-item');
            let firstElem = wrapper.querySelector(".clients-say__info__text").cloneNode(true);
            let secondElem = wrapper.querySelector(".clients-say__item__footer").cloneNode(true);
            document.querySelector('.popup-reviews__wrapper').append(firstElem);
            document.querySelector('.popup-reviews__wrapper').append(secondElem);
        }
    });
    
    // /More info
    
    
   
    
    /* Reviews */
    
    document.addEventListener('click', function(e){
        let item = e.target;
        
        if(item.closest('.js-reviews-button')) {
            let wrapper = item.closest('.js-drop-item');
            
            wrapper.classList.remove('active');
        }
    });
    
    /* //Reviews */
    
    /* Check pass */
    
    let inputPass = document.querySelector('.js-password');
    let inputPassComfirm = document.querySelector('.js-password-confirm');
    let passButon = document.querySelector('.js-pass-button');
    let inputValue;
    let inputValueComfirm;
    
    inputPass.addEventListener('keyup', function(){
        inputValue = this.value;
        
        if(inputValue.length > 7) {
            document.querySelector('.js-check-pass-item[data-target = min-value]').classList.add("active");
            inputPassComfirm.closest('.input__wrapper').classList.remove('disabled');
        }else {
            document.querySelector('.js-check-pass-item[data-target = min-value]').classList.remove("active");
            inputPassComfirm.closest('.input__wrapper').classList.add('disabled');
        }
        
        if(inputValue.match(/\d/)) {
            document.querySelector('.js-check-pass-item[data-target = number]').classList.add("active");
        }else {
            document.querySelector('.js-check-pass-item[data-target = number]').classList.remove("active");
        }
        
        if(inputValue.match(/[A-Za-z]/)) {
            document.querySelector('.js-check-pass-item[data-target = letter]').classList.add("active");
        }else {
            document.querySelector('.js-check-pass-item[data-target = letter]').classList.remove("active");
        }
        
    });
    
    inputPassComfirm.addEventListener('keyup', function(){
        inputValueComfirm = this.value;
        
        if(inputValue == inputValueComfirm) {
            document.querySelector('.js-pass-button').classList.remove("disabled");
        }else {
            document.querySelector('.js-pass-button').classList.add("disabled");
        }
    });
    
    /* //Check pass */

});