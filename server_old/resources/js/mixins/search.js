var search = {
  data: function () {
    return {
      search_list: [],
      search_filter: null,
    }
  },
  methods: {
    requestSearchList: function(){
      let component = this;
      let search_value =  this.search_filter? this.search_filter : null;
      
      axios.post('/catalog/requestSearchList/name/' + search_value).then(response => (
        component.search_list = response.data
      ));
    }
  },
  watch: {
    search_filter: function(){
      this.requestSearchList();
    },
  }
}

export default search;