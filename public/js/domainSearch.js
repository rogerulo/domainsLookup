// app Vue instance
var app = new Vue({
  // app initial state
  data: {
    Domains: [],
    DomainRecords : [],
    newDomain: ''
  },

  // methods that implement data logic.
  // note there's no DOM manipulation here at all.
  methods: {
    addDomain: function () {
      var value = this.newDomain && this.newDomain.trim()
      if (!value) {
        return
      }
      this.Domains.push({
        domain: value
      })
      this.newDomain = ''
    },

    removeDomain: function (Domain) {
      this.Domains.splice(this.Domains.indexOf(Domain), 1)
    },

    searchDomains: function(){
        console.log("test");
        var _vue = this,
            domains = [];

        for(var i=0; i < _vue.Domains.length;i++){
            domains.push(_vue.Domains[i].domain);
        }

        axios
            ({
                method: 'POST',
                url:'/getDomainsRecords',
                data : { 'domainList' : domains},
                headers: {'X-Requested-With': 'XMLHttpRequest'}
            })
            .then(function (response) {
                if(response.data.success == true){
                    _vue.DomainRecords = response.data.DomainRecords;
                }
            })
            .catch(function (error){

                if(error.response.status == 422){
                    // _thisVue.errors.record(error.response.data);
                    alert(error);
                }else{
                }

                console.log(error.response);
            })
            .finally(function () {
                // _thisVue.loadingSendDialog = false;
            });
    }
  },
})

// mount
app.$mount('.domainapp')
