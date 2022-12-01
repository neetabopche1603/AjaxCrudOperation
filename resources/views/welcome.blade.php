<!doctype html>
<html lang="en">

<head>
    <title>Laravel 8</title>
    <!-- Required meta tags -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
</head>

<body>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Laravel 8</h3>
                <a href="#" data-toggle="modal" data-target="#addProductModal" class="float-lg-right btn btn-success"> <i class="fa fa-plus"></i> Add</a>
            </div>

            <div class="card-body">
                @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <table class="responsive">
                    <table id="product" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>SN.</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($products as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->product_name}}</td>
                                <td>{{$row->desc}}</td>

                                <td>
                                    <button href="#" value="{{$row->id}}" class="btn btn-warning btn-sm editbtn">Edit</button>
                                    <button href="#" value="{{$row->id}}" class="btn btn-danger btn-sm deletebtn">Delete</button>

                                </td>

                            </tr>
                            @empty
                            <h4 class="text-center"> Data Not Found </h4>
                            @endforelse

                        </tbody>
                    </table>
                </table>
            </div>
        </div>
    </div>


    <!-- Add Model Form Start -->
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{url('add-product')}}" id="addProductForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="product" class="col-form-label">Product:</label>
                            <input type="text" class="form-control product" name="product" id="product">
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-form-label">Description:</label>
                            <textarea class="form-control description" name="description" id="description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>


            </div>
        </div>
    </div>

    <!-- Add Model Form End-->

    <!-- Edit Model form -->
    <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <input type="hidden" class="form-control product" name="product_id" id="product_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="product" class="col-form-label">Product:</label>
                        <input type="text" class="form-control product" name="product" id="product_name">
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-form-label">Description:</label>
                        <textarea class="form-control description" name="description" id="pro_description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    <button type="button" class="btn btn-primary" id="updateBtn">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script> -->
    <script>
        // $(document).ready(function() {
        //     $('#product').DataTable();
        // });

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.add_product', function(e) {
                e.preventDefault();
                // $(this).text('Sending..');
                var data = {
                    'product': $('.product').val(),
                    'description': $('.description').val(),

                }
                // console.log(data)
                $.ajax({
                    type: "POST",
                    url: "/add-product",
                    data: "data",
                    dataType: "json",
                    success: function(response) {
                        console.log(response)

                    }
                });



            });

            // $('#addProductForm').on('submit', function(e) {
            //     e.preventDefault();

            //     $.ajax({
            //         type: "post",
            //         url: "/add-product",
            //         data: $('#addProductForm').serialize(),
            //         // dataType: "dataType",
            //         success: function(response) {
            //             // console.log(response);
            //             $('#addProductModal').modal('hide')
            //             alert("Data Saved");
            //             location.reload(true);

            //         },
            //         error: function(error) {
            //             // console.log(error);
            //             alert("Data Not Saved");
            //         }

            //     });
            // });

            // Update function
            $(document).on('click', '.editbtn', function(e) {
                e.preventDefault();
                var product_id = $(this).val();
                // alert(product_id);
                // console.log(product_id);
                $.ajax({
                    type: "get",
                    url: "/edit-product/" + product_id,
                    success: function(response) {
                        $('#editProductModal').modal('show');
                        $('#product_id').val(response.product.id)
                        $('#product_name').val(response.product.product_name)
                        $('#pro_description').val(response.product.desc)
                    }
                });

            });


            // Update Data without using form
            $(document).on('click', '#updateBtn', function(e) {
                e.preventDefault();
                let btn = $(this)
                let product_id = $('#product_id').val();
                let product_name = $('#product_name').val();
                let product_desc = $('#pro_description').val();

                $.ajax({
                    type: "post",
                    url: "{{route('update')}}",
                    data: {
                        'id': product_id,
                        'name': product_name,
                        'desc': product_desc
                    },
                    beforeSend: function() {
                        btn.removeClass('btn-primary')
                        btn.addClass('btn-warning')
                        btn.html('Proccessing...')
                    },
                    success: function(response) {
                        alert(response.status);
                        setTimeout(function() {
                            location.reload();
                        }, 1000)
                        // console.log(response);
                    }
                });
            })


            // Delete function
            $(document).on('click', '.deletebtn', function(e) {
                e.preventDefault();
                var product_id = $(this).val();
                $.ajax({
                    type: "post",
                    url: "{{route('delete')}}",
                    data: {'id':product_id},
                    success: function(response) {
                        alert(response.status);
                        setTimeout(function() {
                            location.reload();
                        }, 1000)
                    }
                });

            });

        });
    </script>


</body>

</html>