<style>
    .price-range .well {
    width: 200px; 
    margin: 0 auto; 
}
.price-range input.span2 {
    width: 100%; 
}

</style>
<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian">
            <?php
            $categories = \App\Models\Category::all();
            foreach ($categories as $category) {
            ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordian" href="#{{ strtolower($category->name) }}">
                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                {{ $category->name }}
                            </a>
                        </h4>
                    </div>
                    <div id="{{ strtolower($category->name) }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <!-- Các thông tin của category -->
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="brands_products">
            <h2>Brands</h2>
            <div class="panel-group category-products" id="accordian">
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    <?php
                    $brands = \App\Models\Brand::all();
                    foreach ($brands as $brand) {
                    ?>
                        <li><a href="#"> <span class="pull-right">({{ rand(1, 100) }})</span>{{ $brand->name }}</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
      <div id="slider-range"></div>

        <div class="price-range" >
            <h2>Price Range</h2>
            <div class="well text-center">
                 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[0,600]" id="sl2" ><br />
                 <b class="pull-left" id="minPrice">$ 0</b> 
                 <b class="pull-right" id="maxPrice">$ 600</b>
            </div>       
         </div>

           
        <div class="shipping">
            <img src="{{asset("Frontend/images/home/shipping.jpg")}}" alt="" />
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var slider = new Slider('#sl2', {
            formatter: function(value) {
                return 'Current value: ' + value;
            }
        });

        slider.on('slideStop', function(value) {
            $.ajax({
                url: '{{ route("products.filter") }}',
                method: 'POST',
                data: {
                    min_price: value[0],
                    max_price: value[1],
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    var productHtml = '';
                    response.forEach(function(product) {
                        var images = JSON.parse(product.hinhanh);
                        var imageSrc = images.length > 0 ? '{{ asset("upload/product/") }}/' + images[0] : '';
                        
                        productHtml += '<div class="col-sm-4">' +
                                        '<div class="product-image-wrapper">' +
                                            '<div class="single-products">' +
                                                '<div class="productinfo text-center">';
                        
                        if (imageSrc !== '') {
                            productHtml += '<img src="' + imageSrc + '" alt="" />';
                        }
                        
                        productHtml += '<h2>' + product.price + '</h2>' +
                                        '<p>' + product.name + '</p>' +
                                        '<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>' +
                                    '</div>' +
                                    '<div class="product-overlay">' +
                                        '<div class="overlay-content">' +
                                            '<h2>' + product.price + '</h2>' +
                                            '<p>' + product.name + '</p>' +
                                            '<a href="{{ route('product.show', '') }}/' + product.id + '" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="choose">' +
                                    '<ul class="nav nav-pills nav-justified">' +
                                        '<li><a href="{{ route('product.show', '') }}/' + product.id + '"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>' +
                                        '<li><a href="{{ route('product.show', '') }}/' + product.id + '"><i class="fa fa-plus-square"></i>Add to compare</a></li>' +
                                    '</ul>' +
                                '</div>' +
                            '</div>' +
                        '</div>';
                    });
                    $('#product-list').html(productHtml); 
                },
                error: function(xhr) {
                    console.log("Error:", xhr.responseText);
                }
            });
        });
    });
</script>


