window.addEventListener("load", function(event) {
    // Checkout 
    
    document.addEventListener('click', function(e){
        let item = e.target;
        
        if(item.closest(".checkout__item:not(.active)")) {
            if(item.closest(".checkout__item:not(.active)").previousElementSibling.classList.contains('active')) {
                item.closest(".checkout__item:not(.active)").previousElementSibling.classList.add('noty');
            }
            
            setTimeout(function(){
                document.querySelectorAll(".checkout__item.active").forEach(function(item){
                    item.classList.remove('noty');
                });
            },7000)
        }
        
        if(item.closest(".checkout__item.active")) {
            item.closest(".checkout__item.active").classList.remove('noty');
        }
        if(!item.closest(".checkout__item")) {
            if(document.querySelector(".checkout__item.active")){
                document.querySelector(".checkout__item.active").classList.remove('noty');
            }
        }
    });
    
    // Checkout 
});