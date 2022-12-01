<!doctype html>
<html lang="en">

<head>
    <title>Laravel 8 Demo</title>
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
                <h3>Laravel 8 Demo</h3>
                <a href="#" data-toggle="modal" data-target="#addDemoModal" class="float-lg-right btn btn-success"> <i class="fa fa-plus"></i> Add</a>
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
                                <th>Email</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1
                            @endphp
                            @foreach ($demo as $row)
                                
                           
                           <tr>
                           <td>{{$i++}}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>
                                <a href="#" data-value="{{$row->id}}" class="btn btn-warning btn-sm editBtn">Edit</a>
                                <a href="#" value="{{$row->id}}" class="btn btn-danger btn-sm deleteBtn">Delete</a>
                            </td>
                           </tr>
                           @endforeach

                        </tbody>
                    </table>
                </table>
            </div>
        </div>
    </div>


    <!-- Add Model Form Start -->
    <div class="modal fade" id="addDemoModal" tabindex="-1" role="dialog" aria-labelledby="addDemoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Form Demo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="" id="addDemoForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control name" name="name" id="name">
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="email" class="form-control email" name="email" id="email">
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="password" class="form-control password" name="password" id="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                        <button type="submit" class="btn btn-primary" id="addDemo">Submit</button>
                    </div>

                </form>


            </div>
        </div>
    </div>

    <!-- Add Model Form End-->

    <!-- Edit Model form -->
    <div class="modal fade" id="editDemoModal" tabindex="-1" role="dialog" aria-labelledby="editDemoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Form Demo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="" id="editDemoForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control name" name="name" id="editname">
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="email" class="form-control email" name="email" id="editemail">
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="password" class="form-control password" name="password" id="editpassword">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                        <button type="submit" class="btn btn-primary" id="updateDemo">Submit</button>
                    </div>

                </form>


            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

          $(document).on('click', '#addDemo', function (e) {
                e.preventDefault();   
                let btn = $(this);
                let name = $('#name').val();
                let email = $('#email').val();
                let password = $('#password').val();

                $.ajax({
                    type: "post",
                    url: "/add-demo",
                    data: {
                        'name' :name,
                        'email' :email,
                        'password' :password,
                    },
                    beforeSend: function(){
                        btn.removeClass('btn-primary')
                        btn.addClass('btn-warning')
                        btn.html('Sending.....')

                    },
                    success: function (response) {
                        $('#addDemoModal').modal('hide');
                        alert('Data Saved');
                        location.reload(true);
                        console.log(response)
                    },
                    error: function (error){
                        console.log(error)
                        alert('Data Not Saved');

                    }
                });

            });

            // Update View
            $('.editBtn').on('click',function(){
                let demo_id = $(this).data('value');
                
                $.ajax({
                    type: "get",
                    url: "/edit-demo/"+demo_id,
                    success: function (response) {
                        console.log(response.demo.name)
                        $('#editDemoModal').modal('show');
                        $('#editname').val(response.demo.name);
                        $('#editemail').val(response.demo.email);
                        $('#editpassword').val(response.demo.password);
                    }
                });
            });

            
        });
    </script>

</body>

</html>