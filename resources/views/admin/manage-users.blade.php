<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
    @extends('./layout/master')
    @section('content')
        <section>
            <div class="container">

                <div class="card mb-3" style="overflow:hidden;">
                    <div class="card-header d-flex">
                        <i class="fas fa-table my-1"></i> Users Table
                        <div class="ms-auto">
                            <button type="button" id="add_user" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#form_modal">
                                <i class="fas fa-plus"></i> Add New User
                            </button>

                        </div>
                    </div>
                    <div class="card-body" style="overflow:hidden">
                        <form action="" method="GET" class="d-flex justify-content-end align-items-center">
                            <div class="form-group col-lg- col-md-10 col-sm-12 row mb-2 ">
                                <div class="col-8">
                                    <input type="search" name="search" id="search" class="form-control"value=""
                                        placeholder="Search by name">
                                </div>
                                <div class="col-4 my-auto">
                                    <input type="submit" value="Search" class="btn btn-primary w-100">
                                </div>

                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="user_table">
                                <thead class="p-3 mb-2 bg-light font-weight-bold">
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th width="15%">Number</th>
                                        <th width="10%">Gender</th>
                                        <th width="10%">Status</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->gender }}</td>
                                            <td>{{ $user->status == 0 ? 'INACTIVE' : 'ACTIVE' }}</td>
                                            <td>
                                                <div class="icons d-flex justify-content-center" style="gap:15px;">
                                                    <a data-bs-toggle="modal" data-bs-target="#form_update">
                                                        <i id="update_user"class="fas fa-edit" style="color: #18283b;"></i>
                                                    </a>
                                                    <a href="">
                                                        <i class="fa-solid fa-trash" style="color: red;"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>



                            </table>

                        </div>
                        <div class="mt-2 d-flex justify-content-end" id="pagination-links">
                            {{ $users->links() }}
                        </div>
                    </div>

                </div>

                <div class="modal fade" id="form_modal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_title">Add new user</h5>
                                <button class="close" data-bs-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="user_form" action="" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Name <i class="text-danger">*</i></label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            maxlength="100" autocomplete="off" placeholder="Enter full name">
                                        <div id="name_error_message" class="text-danger"></div>
                                        @error('name')
                                            <div id="name_error_message" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>E-mail <i class="text-danger">*</i></label>
                                        <input type="text" id="email" name="email" class="form-control"
                                            maxlength="100" autocomplete="off" placeholder="Enter E-mail">
                                        <div id="email_error_message" class="text-danger"></div>
                                        @error('email')
                                            <div id="email_error_message" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number <i class="text-danger">*</i></label>
                                        <input type="text" id="phone" name="phone" class="form-control"
                                            maxlength="100" autocomplete="off" placeholder="Enter Phone Number">
                                        <div id="phone_error_message" class="text-danger"></div>
                                        @error('phone')
                                            <div id="phone_error_message" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Gender <i class="text-danger"> *</i></label>
                                            <div style="display: flex; gap:10px">
                                                <input type="radio" id="male" name="gender" value="Male">Male
                                                <input type="radio" id="female" name="gender"
                                                    value="Female">Female
                                            </div>
                                            <div id="gender_error_message" class="text-danger"></div>
                                            @error('gender')
                                                <div id="gender_error_message" class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Username <i class="text-danger">*</i></label>
                                        <input type="text" id="username" name="username" class="form-control"
                                            maxlength="100" autocomplete="off" placeholder="Enter username">
                                        <div id="username_error_message" class="text-danger"></div>
                                        @error('username')
                                            <div id="username_error_message" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password <i class="text-danger">*</i></label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            maxlength="50" placeholder="Enter Password">

                                        <div id="password_error_message" class="text-danger"></div>
                                        @error('password')
                                            <div id="password_error_message" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                            </div>

                            <br>
                            <div class="modal-footer">
                                <button type="button" id="cancel_button" class="btn btn-light"
                                    data-dismiss="modal">Cancel</button>
                                <input type="submit" name="button_action" id="button_action" class="btn btn-primary"
                                    value="Save" />
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="form_update">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update User Information</h5>
                                <button class="close" data-bs-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <br>

                            <div class="modal-body">
                                <form id="update_profile_form">
                                    <div class="form-group">
                                        <label>Full Name <i class="text-danger">*</i></label>
                                        <input type="text" id="update_full_name" name="update_full_name"
                                            class="form-control" maxlength="100" autocomplete="off"
                                            placeholder="Enter full name">
                                        <div id="update_full_name_error_message" class="text-danger"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>E-mail <i class="text-danger">*</i></label>
                                        <input type="text" id="update_email" name="update_email" class="form-control"
                                            maxlength="100" autocomplete="off" placeholder="Enter E-mail">
                                        <div id="update_email_error_message" class="text-danger"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number <i class="text-danger">*</i></label>
                                        <input type="number" id="update_phone" name="update_phone" class="form-control"
                                            maxlength="100" autocomplete="off" placeholder="Enter Phone Number">
                                        <div id="update_phone_error_message" class="text-danger"></div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Gender <i class="text-danger"> *</i></label>
                                            <select name="update_gender" id="update_gender" class="custom-select">
                                                <option value="" hidden>Gender</option>
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                            <div id="update_gender_error_message" class="text-danger"></div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Role <i class="text-danger"> *</i></label>
                                            <select name="update_role" id="update_role" class="custom-select">
                                                <option value="" hidden>Role</option>
                                                <option>Admin</option>
                                                <option>User</option>
                                            </select>
                                            <div id="update_role_error_message" class="text-danger"></div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="update_profile_id" id="update_profile_id" />
                                        <button type="button" id="cancel_user_update_button" class="btn btn-light"
                                            data-dismiss="modal">Cancel</button>
                                        <input type="submit" name="button_update_profile" id="button_update_profile"
                                            class="btn btn-primary" value="Update" />
                                    </div>
                                </form>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </section>
    @endsection

    <script>
        $(document).ready(function() {
            $(document).on('click', '#pagination-links a', function(e) {
                e.preventDefault();


                var page = $(this).attr('href').split('page=')[1];
                var area = $('#user_table tbody');

                console.log(page);
                $.ajax({
                    url: "{{ route('users.paginate') }}",
                    method: 'POST',
                    data: {
                        page: page,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        area.empty();
                        var users = data.users.data;

                        users.forEach(function(user) {
                            var contentHtml = `
                            <tr>
                                <td>${user.id}</td>
                                <td>${user.name}</td>
                                <td>${user.email}</td>
                                <td>${user.phone}</td>
                                <td>${user.gender}</td>
                                <td>${user.status==0?"INACTIVE":"ACTIVE"}</td>
                                <td>
                                    <div class="icons d-flex justify-content-center" style="gap:15px;">
                                        <a href="">
                                        <i id="update_user"class="fas fa-edit" style="color: #18283b;"></i>
                                        </a>
                                        <a href="">
                                        <i class="fa-solid fa-trash" style="color: red;"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        `;
                            area.append(contentHtml);
                        });

                        $('#pagination-links').html(data.pagination);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>


</body>

</html>
