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
                                        <tr id="user-details-{{ $user->id }}">
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->gender }}</td>
                                            <td>{{ $user->status == 0 ? 'INACTIVE' : 'ACTIVE' }}</td>
                                            <td class="action-btns" data-id="{{ $user->id }}">
                                                <div class="icons d-flex justify-content-center" style="gap:15px;">
                                                    <a class="update-btn">
                                                        <i id="update_user"class="fas fa-edit" style="color: #18283b;"></i>
                                                    </a>
                                                    <a class="delete-btn">
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
                                    <div class="form-group col-md-6">
                                        <label>Gender <i class="text-danger"> *</i></label>
                                        <div style="display: flex; gap:10px">
                                            <input type="radio" id="male" name="gender" value="Male">Male
                                            <input type="radio" id="female" name="gender" value="Female">Female
                                        </div>
                                        <div id="gender_error_message" class="text-danger"></div>
                                        @error('gender')
                                            <div id="gender_error_message" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group"
                                        style="display:flex; justify-content:start; align-items:flex-start; flex-direction:column;">
                                        <label>Role <i class="text-danger"> *</i></label>
                                        <select name="role" id="role" class="custom-select">
                                            <option value="" hidden>Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                        <div id="role_error_message" class="text-danger"></div>
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
                                    <div class="d-flex justify-content-end my-3">
                                        <button type="button" id="cancel_button" class="btn btn-light"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <input type="submit" name="button_action" id="button_action"
                                            class="btn btn-primary" value="Add" />
                                    </div>
                                </form>
                            </div>
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
                                <form id="update_form">
                                    <div class="form-group d-none">
                                        <input type="hidden" id="update-id" name="id">
                                    </div>
                                    <div class="form-group">
                                        <label>Name <i class="text-danger">*</i></label>
                                        <input type="text" id="update_name" name="name" class="form-control"
                                            maxlength="100" autocomplete="off" placeholder="Enter Name">
                                        <div id="update_name_error_message" class="text-danger"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>E-mail <i class="text-danger">*</i></label>
                                        <input type="text" id="update_email" name="email" class="form-control"
                                            maxlength="100" autocomplete="off" placeholder="Enter email">
                                        <div id="update_email_error_message" class="text-danger"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number <i class="text-danger">*</i></label>
                                        <input type="number" id="update_phone" name="phone" class="form-control"
                                            maxlength="100" autocomplete="off" placeholder="Enter Phone Number">
                                        <div id="update_phone_error_message" class="text-danger"></div>
                                    </div>
                                    <div class="form-group "
                                        style="display:flex; justify-content:start; align-items:flex-start; flex-direction:column;">
                                        <label>Gender <i class="text-danger"> *</i></label>
                                        <div id="update_gender" style="display: flex; gap:10px">
                                            <input type="radio" name="gender" value="Male">Male
                                            <input type="radio" name="gender" value="Female">Female
                                        </div>
                                        <div id="update_gender_error_message" class="text-danger"></div>
                                    </div>
                                    <div class="form-group"
                                        style="display:flex; justify-content:start; align-items:flex-start; flex-direction:column;">
                                        <label>Role <i class="text-danger"> *</i></label>
                                        <select name="role" id="update_role" class="custom-select">
                                            <option value="" hidden>Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                        <div id="update_role_error_message" class="text-danger"></div>
                                    </div>
                                    <div class="my-3 d-flex justify-content-end">
                                        <input type="hidden" name="update_profile_id" id="update_profile_id" />
                                        <button type="button" id="cancel_user_update_button" class="btn btn-light"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <input type="submit" name="button_update_profile" id="button_update_profile"
                                            class="btn btn-primary" value="Update" />
                                    </div>

                                </form>


                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="form_delete" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_title">Delete User?</h5>
                                <button class="btn btn-outline-danger close" data-bs-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h4>Are you sure you want to delete this user?</h4>
                                <form action="" method="POST" id="delete_form">
                                    @csrf
                                    <div class="form-group d-none">
                                        <input type="hidden" id="delete-id" name="id">
                                    </div>
                                    <div class="d-flex justify-content-end my-3">
                                        <input type="button" value="Cancel" class="btn btn-light"
                                            data-bs-dismiss="modal">
                                        <input type="submit" value="Delete" class="btn btn-danger">
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



            function checkNewUsername() {
                var pattern = new RegExp(/^[a-zA-Z][a-zA-Z0-9_]*$/);
                if ($.trim($('#username').val()) == '') {
                    $("#username_error_message").html("The username is a required field.");
                    $("#username_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else if (!(pattern.test($("#username").val()))) {
                    $("#username_error_message").html(
                        "Username cannot contain space and special characters");
                    $("#username_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#username_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }

            function checkNewName() {
                if ($.trim($('#name').val()) == '') {
                    $("#name_error_message").html("The name is a required field.");
                    $("#name_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#name_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }

            function checkNewEmail() {
                var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
                if ($.trim($('#email').val()) == '') {
                    $("#email_error_message").html("The email is a required field.");
                    $("#email_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else if (!(pattern.test($("#email").val()))) {
                    $("#email_error_message").html("Invalid email address");
                    $("#email_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#email_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }

            function checkNewPhone() {
                var pattern = new RegExp(/^(98[0-9]{8})$/);
                if ($.trim($('#phone').val()) == '') {
                    $("#phone_error_message").html("The phone is a required field.");
                    $("#phone_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else if (!(pattern.test($("#phone").val()))) {
                    $("#phone_error_message").html("Invalid phone number");
                    $("#phone_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#phone_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }


            function checkNewGender() {
                if (!($('input[name="gender"]:checked').val())) {
                    $("#gender_error_message").html("The gender is a required field.");
                    $("#gender_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#gender_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }

            function checkNewRole() {
                if ($('#role').val() == '') {
                    $("#role_error_message").html("The role is a required field.");
                    $("#role_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#role_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }

            function checkNewPassword() {
                if ($.trim($('#password').val()) == '') {
                    $("#password_error_message").html("The password is a required field.");
                    $("#password_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#password_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }

            function checkUpdateName() {
                if ($.trim($('#update_name').val()) == '') {
                    $("#update_name_error_message").html("The name is a required field.");
                    $("#update_name_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#update_name_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }

            function checkUpdateEmail() {
                var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
                if ($.trim($('#update_email').val()) == '') {
                    $("#update_email_error_message").html("The email is a required field.");
                    $("#update_email_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else if (!(pattern.test($("#update_email").val()))) {
                    $("#update_email_error_message").html("Invalid email address");
                    $("#update_email_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#update_email_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }

            function checkUpdatePhone() {
                var pattern = new RegExp(/^(98[0-9]{8})$/);
                if ($.trim($('#update_phone').val()) == '') {
                    $("#update_phone_error_message").html("The phone is a required field.");
                    $("#update_phone_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else if (!(pattern.test($("#update_phone").val()))) {
                    $("#update_phone_error_message").html("Invalid phone number");
                    $("#update_phone_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#update_phone_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }


            function checkUpdateGender() {
                if (!($('input[name="gender"]:checked').val())) {
                    $("#update_gender_error_message").html("The gender is a required field.");
                    $("#update_gender_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#update_gender_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }

            function checkUpdateRole() {
                if ($('#update_role').val() == '') {
                    $("#update_role_error_message").html("The role is a required field.");
                    $("#update_role_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#update_role_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }

            function checkUpdatePassword() {
                if ($.trim($('#update_password').val()) == '') {
                    $("#update_password_error_message").html("The password is a required field.");
                    $("#update_password_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#update_password_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }
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
                            <tr id="user-details-${user.id}">
                                <td>${user.id}</td>
                                <td>${user.name}</td>
                                <td>${user.email}</td>
                                <td>${user.phone}</td>
                                <td>${user.gender}</td>
                                <td>${user.status==0?"INACTIVE":"ACTIVE"}</td>
                                <td class="action-btns" data-id="${user.id }">
                                    <div class="icons d-flex justify-content-center" style="gap:15px;">
                                        <a class="update-btn">
                                            <i id="update_user"class="fas fa-edit" style="color: #18283b;"></i>
                                        </a>
                                        <a class="delete-btn">
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

            $('#add_user').click(function() {
                $('#user_form')[0].reset();
                $('#username_error_message').removeClass('d-block').addClass('d-none');
                $('#name_error_message').removeClass('d-block').addClass('d-none');
                $('#email_error_message').removeClass('d-block').addClass('d-none');
                $('#phone_error_message').removeClass('d-block').addClass('d-none');
                $('#gender_error_message').removeClass('d-block').addClass('d-none');
                $('#role_error_message').removeClass('d-block').addClass('d-none');
                $('#password_error_message').removeClass('d-block').addClass('d-none');
            });

            $('body').on('click', '.update-btn', function(e) {
                e.preventDefault();
                var id = $(this).closest('.action-btns').data(id).id;
                $('#update-id').val(id);
                $.ajax({
                    url: "{{ route('user.find') }}",
                    method: 'POST',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        var user = data.user;
                        $('#update_name').val(user.name);
                        $('#update_email').val(user.email);
                        $('#update_phone').val(user.phone);
                        $('#update_gender input[name="gender"][value="' + user.gender + '"]')
                            .prop('checked', true);
                        $('#update_role').val(user.role);
                        $('#form_update').modal('show');


                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            });
            $('body').on('click', '.delete-btn', function(e) {
                e.preventDefault();
                $('#delete_form')[0].reset();
                var id = $(this).closest('.action-btns').data(id).id;
                $('#delete-id').val(id);
                $('#form_delete').modal('show');
            });

            $('#user_form').submit(function(e) {
                e.preventDefault();

                var checkUsername = checkNewUsername();
                var checkName = checkNewName();
                var checkEmail = checkNewEmail();
                var checkPhone = checkNewPhone();
                var checkGender = checkNewGender();
                var checkRole = checkNewRole();
                var checkPassword = checkNewPassword();

                if (checkUsername && checkName && checkEmail && checkPhone && checkGender && checkRole &&
                    checkPassword) {
                    var usernameError = $('#username_error_message');
                    var nameError = $('#name_error_message');
                    var emailError = $('#email_error_message');
                    var phoneError = $('#phone_error_message');
                    var genderError = $('#gender_error_message');
                    var roleError = $('#role_error_message')
                    var passwordError = $('#password_error_message');

                    var form = this;
                    var formData = new FormData(this);
                    formData.append('_token', '{{ csrf_token() }}');
                    $.ajax({
                        url: "{{ route('user.add') }}",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            var user = data.user;
                            var contentHtml = `
                                <tr id="user-details-${user.id}">
                                    <td>${user.id}</td>
                                    <td>${user.name}</td>
                                    <td>${user.email}</td>
                                    <td>${user.phone}</td>
                                    <td>${user.gender}</td>
                                    <td>${user.status==0?"INACTIVE":"ACTIVE"}</td>
                                    <td class="action-btns" data-id="${user.id }">
                                        <div class="icons d-flex justify-content-center" style="gap:15px;">
                                            <a class="update-btn">
                                                <i id="update_user"class="fas fa-edit" style="color: #18283b;"></i>
                                            </a>
                                            <a class="delete-btn">
                                                <i class="fa-solid fa-trash" style="color: red;"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            `;
                            $('#user_table tbody').prepend(contentHtml);

                            form.reset();
                            $('#form_modal').modal('hide');
                        },
                        error: function(xhr, status, error) {
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;

                                if (errors && errors.username) {
                                    var usernameErrors = Array.isArray(errors
                                        .username) ? errors.username : [
                                        errors.username
                                    ];

                                    usernameError.html(
                                        usernameErrors[0]);
                                    usernameError.removeClass("d-none")
                                        .addClass("d-block");
                                }




                            } else {

                                console.log('Error:', xhr.responseText);
                            }
                        }
                    });
                }

            });

            $('#update_form').submit(function(e) {
                e.preventDefault();


                var checkName = checkUpdateName();
                var checkEmail = checkUpdateEmail();
                var checkPhone = checkUpdatePhone();
                var checkGender = checkUpdateGender();
                var checkRole = checkUpdateRole();


                if (checkName && checkEmail && checkPhone && checkGender && checkRole) {
                    var usernameError = $('#update_username_error_message');
                    var nameError = $('#update_name_error_message');
                    var emailError = $('#update_email_error_message');
                    var phoneError = $('#update_phone_error_message');
                    var genderError = $('#update_gender_error_message');
                    var roleError = $('#update_role_error_message')
                    var passwordError = $('#update_password_error_message');

                    var form = this;
                    var formData = new FormData(this);
                    formData.append('_token', '{{ csrf_token() }}');
                    var id = $('#update-id').val();
                    var area = $('#user-details-' + id);

                    $.ajax({
                        url: "{{ route('user.update') }}",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            var user = data.user;
                            var contentHtml = `
                                    <td>${user.id}</td>
                                    <td>${user.name}</td>
                                    <td>${user.email}</td>
                                    <td>${user.phone}</td>
                                    <td>${user.gender}</td>
                                    <td>${user.status==0?"INACTIVE":"ACTIVE"}</td>
                                    <td class="action-btns" data-id="${user.id }">
                                        <div class="icons d-flex justify-content-center" style="gap:15px;">
                                            <a class="update-btn">
                                                <i id="update_user"class="fas fa-edit" style="color: #18283b;"></i>
                                            </a>
                                            <a class="delete-btn">
                                                <i class="fa-solid fa-trash" style="color: red;"></i>
                                            </a>
                                        </div>
                                    </td>
                                
                            `;
                            area.html(contentHtml);

                            form.reset();
                            $('#form_update').modal('hide');
                        },
                        error: function(xhr, status, error) {
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;

                                // if (errors && errors.username) {
                                //     var usernameErrors = Array.isArray(errors
                                //         .username) ? errors.username : [
                                //         errors.username
                                //     ];

                                //     usernameError.html(
                                //         usernameErrors[0]);
                                //     usernameError.removeClass("d-none")
                                //         .addClass("d-block");
                                // }




                            } else {

                                console.log('Error:', xhr.responseText);
                            }
                        }
                    });
                }
            });

            $('#delete_form').submit(function(e) {
                e.preventDefault();
                var form = this;
                var formData = new FormData(this);
                formData.append('_token', '{{ csrf_token() }}');
                var id = $('#delete-id').val();
                
                $.ajax({
                    url: "{{ route('user.delete') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        
                        var area = $('#user-details-' + data).removeClass('d-block').addClass('d-none');

                        

                        form.reset();
                        $('#form_delete').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            });



        });
    </script>


</body>

</html>
