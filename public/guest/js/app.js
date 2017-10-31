new Vue({
    el: 'body',
    data: {
    products: [],
    loading: false,
    error: false,
    
    
},
    methods: {
    search: function() {
        // Clear the error message.
        this.error = '';
        // Empty the products array so we can fill it with the new products.
        this.products = [];
        // Set the loading property to true, this will display the "Searching..." button.
        this.loading = true;

        // Making a get request to our API and passing the query to it.
        this.$http.get('/search?q=' + this.query).then((response) => {
            // If there was an error set the error message, if not fill the products array.
            response.body.error ? this.error = response.body.error : this.products = response.body;
            // The request is finished, change the loading to false again.
            this.loading = false;
            // Clear the query.
            this.query = '';
        });
    }
}
});






<div class="container search-area" >
                <div class="well well-sm">
                    <div class="form-group">
                        <div class="input-group input-group-md">
                            <div class="icon-addon addon-md">
                                <input type="text" placeholder="What are you looking for?" class="form-control searchBar" v-model="query">
                            </div>
                            <span class="input-group-btn">
                                <button class="btn btn-warning searchButton"  type="button" v-on:click="search()" v-if="!loading"><i class="fa fa-search"></i> Search</button>
                            <button class="btn btn-default" type="button" disabled="disabled" v-if="loading">Searching...</button>
                        </span>
                        </div>
                    </div>
        <div class="container search-dropdown">
            <div class="row">
                <button class="close pull-right hello"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="clearfix"></div>
            <div id="my-drop-down" v-if="error">
                
                    <div class="alert">
                      <p>@{{ error }}</p>  
                    </div>
                
            </div> 
            
        
            <div id="products" class="row list-group">
                    <div class="item col-xs-4 col-lg-4" v-for="product in products">
                        <div class="thumbnail">
                            <img class="group list-group-image" :src="product.image" alt="@{{ product.title }}" />
                            <div class="caption">
                                <h4 class="group inner list-group-item-heading">@{{ product.productName }}</h4>
                                <p class="group inner list-group-item-text">@{{ product.shortDescription }}</p>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <p class="lead">$@{{ product.salePrice }}</p>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <a class="btn btn-success" href="#">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
                </div>
                
                <div class="alert alert-danger" role="alert" v-if="error">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> @{{ error }}
                </div>
            </div>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
<script>
    $(document).ready(function(){ 
    $(".search-dropdown").hide();
    $(".hello").hide();
    var vm = this;
    $(".searchBar").keyup(function(event){
    if(event.keyCode == 13){
        $(".searchButton").click();
       
        $(".search-dropdown").show();
        $(".hello").fadeIn();
    }
    });
    $(".hello").click(function(){
         $(".search-dropdown").fadeOut();
    });
    });
    


    </script>
    
    
    
    
    
    
    
    
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.1/vue-resource.min.js"></script>
<script src="{{ url('guest/js/app.js') }}"></script>