@extends('frontend.layout.layout')

@section('content')

    @include('frontend.inc.breadcrumb')

    <div class="site-section">
        <div class="container">

            <div class="row mb-5">
                <div class="col-md-9 order-2">

                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="float-md-left mb-4">
                                <h2 class="text-black h5">Ürünler</h2>
                            </div>
                            <div class="d-flex">
                                <div class="dropdown mr-1 ml-md-auto">

                                </div>
                                <div class="btn-group">
                                    <select class="form-control" id="orderList">
                                        <option class="dropdown-item" value="">Sıralama Seçiniz</option>
                                        <option class="dropdown-item" value="id-asc">A-Z ye Sırala</option>
                                        <option class="dropdown-item" value="id-desc">Z-A ye Sırala</option>
                                        <option class="dropdown-item" value="price-asc">Düşük Fiyata göre sırala</option>
                                        <option class="dropdown-item" value="price-desc">Yüksek Fiyata göre sırala</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            @if(session()->get("success"))
                                <div class="alert alert-success text-center">{{session()->get("success")}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-5 productContent">

                        @include("frontend.ajax.productList")

                    </div>
                    <div class="row" data-aos="fade-up">
                        <div class="col-md-12 text-center paginateButtons">
                            {{ $products->withQueryString()->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>

                <div class="col-md-3 order-1 mb-5 mb-md-0">
                    <div class="border p-4 rounded mb-4">
                        <h3 class="mb-3 h6 text-uppercase text-black d-block">Kategori</h3>
                        <ul class="list-unstyled mb-0">
                            @if (!empty($categories) && $categories->count() > 0)
                                @foreach ($categories->where('cat_ust', null) as $category)
                                    <li class="mb-1"><a href="{{ route($category->slug . '_products') }}"
                                            class="d-flex"><span>{{ $category->name }}</span>
                                            <span class="text-black ml-auto">({{ $category->getTotalProductCount() }})</span></a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>

                    <div class="border p-4 rounded mb-4">
                        <div class="mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">Fiyata Göre Sırala</h3>
                            <div id="slider-range" class="border-primary"></div>
                            <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white"
                                disabled="" />
                            <input type="text" name="text" id="priceBetween" class="form-control border-0 text-center pl-0 bg-white"
                                />
                        </div>

                        <div class="mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">Beden</h3>
                            @if (!empty($sizeList))
                                @foreach ($sizeList as $key => $size)
                                    <label for="size{{$key}}" class="d-flex">
                                        <input type="checkbox" id="size{{$key}}" value="{{$size}}" {{isset(request()->size)&& in_array($size,explode(",",request()->size)) ? "checked" : ""}} class="mr-2 mt-1 sizeList"> <span
                                            class="text-black">{{ $size }}
                                        </span>
                                    </label>
                                @endforeach
                            @endif
                        </div>

                        <div class="mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">Renk</h3>
                            @if (!empty($colors))
                                @foreach ($colors as $key => $color)
                                    <label for="color{{$key}}" class="d-flex">
                                        <input type="checkbox" value="{{$color}}" id="color{{$key}}" {{isset(request()->color) && in_array($color,explode(',',request()->color)) ? 'checked' : '' }}  class="mr-2 mt-1 colorList"> <span class="text-black">{{$color}}</span>
                                    </label>
                                @endforeach
                            @endif
                        </div>
                        <div class="mb-4">
                            <button class="btn btn-primary btn-block filterBtn">Filtrele</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="site-section site-blocks-2">
                        <div class="row justify-content-center text-center mb-5">
                            <div class="col-md-7 site-section-heading pt-4">
                                <h2>Kategoriler</h2>
                            </div>
                        </div>
                        <div class="row">
                            @if (!empty($categories))
                                @foreach ($categories->where('cat_ust', null) as $category)
                                    <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                                        <a class="block-2-item" href="{{ route($category->slug . '_products') }}">
                                            <figure class="image">
                                                <img src="{{ asset($category->image) }}" alt="" class="img-fluid">
                                            </figure>
                                            <div class="text">
                                                <span class="text-uppercase">Giyim</span>
                                                <h3>{{ $category->name }}</h3>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('customjs')
    <script>
        var maxprice = "{{ $maxprice }}";
        var defaultminprice = "{{request()->min ?? 0 }}";
        var defaultmaxprice = "{{request()->max ?? $maxprice }}";

        var url=new URL(window.location.href);

        $(document).on("click",".filterBtn",function (e){
            filtered();
        })


        $(document).on('change', '#orderList', function(e) {
            var order = $(this).val();
            if(order != '') {
                orderby = order.split('-');
                url.searchParams.set("order", orderby[0])
                url.searchParams.set("sort", orderby[1])
            }else {
                url.searchParams.delete('order');
                url.searchParams.delete('sort');
            }
            filtered();
        });


        function filtered(){
            let colorList  = $(".colorList:checked" ).map((_,chk) => chk.value).get()
            let sizeList = $(".sizeList:checked").map((_,chk) => chk.value).get()
            if (colorList.length  > 0) {
                url.searchParams.set("color",  colorList.join(","))
            }else {
                url.searchParams.delete('color');
            }

            if (sizeList.length  > 0) {
                url.searchParams.set("size", sizeList.join(","))
            }else {
                url.searchParams.delete('size');
            }

            var price = $('#priceBetween').val().split('-');
            url.searchParams.set("min", price[0])

            url.searchParams.set("max", price[1])

            newUrl = url.href;
            window.history.pushState({}, '', newUrl);
            location.reload();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"GET",
                url:newUrl,
                success: function (response) {

                    $('.productContent').html(response.data);
                    $('.paginateButtons').html(response.paginate)
                }
            });
        }

        $(document).on('submit', '#addForm', function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                url:"{{route('cart.add')}}",
                data:formData,
                success: function (response) {
                    toastr.success(response.message);
                    $('.count').text(response.sepetCount);
                }
            });

        });

    </script>
@endsection
