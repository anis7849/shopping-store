<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Document</title>
    <style>
        body {
            background: linear-gradient(to right, #c04848, #480048);
            min-height: 100vh
        }

        .text-gray {
            color: #aaa
        }

        img {
            height: 170px;
            width: 140px
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row text-center text-white mb-5">
            <div class="col-lg-7 mx-auto">
                <h1 class="display-4">Product List</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <select class="form-control" id="drpCategory">
                    <option value="all">All</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-8 mx-auto">
                <!-- List group-->
                <ul class="list-group shadow">
                    @foreach ($products as $product)

                    <!-- list group item-->
                    <li class="list-group-item">
                        <!-- Custom content-->
                        <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                            <div class="media-body order-2 order-lg-1">
                                <h5 class="mt-0 font-weight-bold mb-2">{{$product['name']}}</h5>
                                <p class="font-italic text-muted mb-0 small">{{$product->description}}</p>
                                <div class="d-flex align-items-center justify-content-between mt-1">
                                    <h6 class="font-weight-bold my-2">{{$product->category->name}}</h6>
                                </div>
                            </div><img src="{{$product['image']}}" alt="Generic placeholder image" width="200" class="ml-lg-5 order-1 order-lg-2">
                        </div> <!-- End -->
                    </li> <!-- End -->
                    @endforeach

                </ul> <!-- End -->
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-8 mx-auto">
                <span style="float: right">{{ $products->links() }}</span>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        $("#drpCategory").change(function() {
            $.get("/filter-product-list/" + this.value, function(data, status) {
                $('.list-group-item').remove();
                console.log(data);
                if(data.data.length > 0) {
                    for(var i=0;i<data.data.length;i++) {
                        genrateHtml(data.data[i]);
                    }
                } else {
                    alert('No record found');
                }
            });
        });

        function genrateHtml(data) {
            html = "";
            html += '<li class="list-group-item">';
            html += '<div class="media align-items-lg-center flex-column flex-lg-row p-3">';
            html += '<div class="media-body order-2 order-lg-1">';
            html += '<h5 class="mt-0 font-weight-bold mb-2">' + data['name'] + '</h5>';
            html += '<p class="font-italic text-muted mb-0 small">' + data['description'] + '</p>';
            html += '<div class="d-flex align-items-center justify-content-between mt-1">';
            html += '<h6 class="font-weight-bold my-2">' + data['category']['name'] + '</h6>';
            html += '</div>';
            html += '</div><img src="' + data['image'] + '" alt="Generic placeholder image" width="200" class="ml-lg-5 order-1 order-lg-2">';
            html += '</div>';
            html += '</li>';

            $('.list-group').append(html);
        }
    });


</script>

</html>
