var reviews = {
	data: function(){
    	return {
	      comment:{
		  	text: ''  
	      },
	      productId: this.dataProductId,
        reviews: this.dataReviews,
        user: this.dataUser,
        likes: JSON.parse(localStorage.getItem('likes'))
      }
    },
    props: ['dataReviews', 'dataUser', 'dataProductId'],
    computed: {
	  	photo: function(){
		  	let noAvatar = '/img/photo-log-in.png';
		  	
		  	if(this.user)
		  		return this.user.usermeta.photo? this.user.usermeta.photo: noAvatar;
		  	else
		  		return noAvatar;
	  	}  
    },
    methods: {
	    add: function(productId = null, isIncognito = false){
		    var component = this;
		    
		    let params = {
			    product_id: productId,
			    text: this.comment.text,
			    name: isIncognito? 'Incognito': this.user.usermeta.fullname,
			    likes: 0,
			    dislikes: 0
		    };
		    			    
		    axios.post('/reviews/review/add', params).then(function(response) {
			    
			    console.log(response.data);
			   component.comment.text = '';
			   noty('success', response.data.message);
		    });			    
	    },
	    reply: function(parentId, baseIndex){
		    var component = this;
		    
		    let params = {
			    parent_id: parentId,
			    product_id: this.productId,
			    text: this.comment.text,
			    name: this.user.usermeta.fullname,
			    likes: 0,
			    dislikes: 0,
			    photo: this.photo
		    };
		    
		    this.reviews.data[baseIndex].children.push(params);
		    
		    axios.post('/reviews/reply/create', params).then(function(response) {
			    console.log(response);
			   component.comment.text = '';
		    });
	    },
	    loadMore: function(){
		    let component = this;
		    
		    let params = {
			    product_id: this.productId,
			    page: this.reviews.current_page + 1
		    };
		    
		    axios.post('/reviews/loadmore', params).then(function(response) {
			    console.log(response);
				component.reviews.current_page = response.data.current_page;
				component.reviews.next_page_url = response.data.next_page_url;
				
				response.data.data.forEach(function(review){
					component.reviews.data.push(review);
				});
		    });
	    },
	    cancel: function(){
		    this.comment.text = '';
	    },
	    like: function(id, baseIndex, subIndex, type){
		    var component = this;
		    var params = {};
		    var reverseType = type == 'like'? 'dislike': 'like';
		    
		    if(this.check(id, type))
		    {
			    params[type] = -1;
			    
			    if(subIndex !== null)
			    	this.reviews.data[baseIndex].children[subIndex][type+'s']--;
			    else
		    		this.reviews.data[baseIndex][type+'s']--;
		    	
		    	component.toStorage(id, null);
				axios.post('/reviews/like/' + id, params);
		    }else if(this.check(id, reverseType)){
			    params[type] = 1;
			    params[reverseType] = -1;
			    
			    if(subIndex  !== null){
			    	this.reviews.data[baseIndex].children[subIndex][type+'s']++;
			    	this.reviews.data[baseIndex].children[subIndex][reverseType+'s']--;
			    }else{
		    		this.reviews.data[baseIndex][type+'s']++;
		    		this.reviews.data[baseIndex][reverseType+'s']--;
		    	}
		    		
			    component.toStorage(id, type);
			    axios.post('/reviews/like/' + id, params);
		    }else {
			    params[type] = 1;
			    
			    if(subIndex  !== null)
			    	this.reviews.data[baseIndex].children[subIndex][type+'s']++;
			    else
		    		this.reviews.data[baseIndex][type+'s']++;
		    	
		    	
		    	component.toStorage(id, type);
				axios.post('/reviews/like/' + id, params);
		    }
		    
	    },
	    dislike: function(id, baseIndex, subIndex){
		    var component = this;
		    
		    if(subIndex  !== null){
			    this.reviews.data[baseIndex].children[subIndex].dislikes++;
		    }else{
			    this.reviews.data[baseIndex].dislikes++;
		    }	    
	    },
	    toStorage: function(id, type){
		    if(!this.likes) {
			    this.likes = {};
		    }
		    
		    if(!this.likes[this.productId])
		    	this.likes[this.productId] = {};
		    	
		    this.likes[this.productId][id] = type;
		    
		    localStorage.likes = JSON.stringify(this.likes);
	    },
	    check: function(id, type){
		    if(this.likes && this.likes[this.productId] && this.likes[this.productId][id] && this.likes[this.productId][id] == type)
		    	return true;
		    else
		    	return false;
	    }
    }
}

export default reviews;