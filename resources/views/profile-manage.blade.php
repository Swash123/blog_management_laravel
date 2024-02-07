<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @extends('layout/master')
    @section('content')
        <section class="profile-section">
            <div class="container-fluid">
                <h1 class="my-2 mx-1"> Personal Details</h1>
                <div class="row d-flex justify-content-around align-items-center">
                    <div class="col-sm-12 col-md-6 image-portion d-flex justify-content-center">
                        <img src="{{ asset('storage/images/profile/default.jpg') }}" alt="User Image" class="user-image" />
                    </div>
                    <div class="col-sm-12 col-md-6 personal-details">
                        <p>Name: {{ $user->name }}</p>
                        <p>Email: {{ $user->email }}</p>
                        <p>phone: {{ $user->phone }}</p>
                        <p>Gender: {{ $user->gender }}</p>
                    </div>
                </div>

            </div>

            <div class="container tab-area mt-5">
                <ul class="nav nav-tabs tab-head" id="updateProfile">
                    <li class="nav-item tab-item">
                        <a class="nav-link active" id="tab1" data-bs-toggle="tab" href="#editProfile">Edit Profile</a>
                    </li>
                    <li class="nav-item tab-item">
                        <a class="nav-link" id="tab2" data-bs-toggle="tab" href="#changePassword">Change Password</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="editProfile">
                        <form action="" method="post" id="profile-form">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label update-label">Name:</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $user->name }}">
                                <div id="name_error_message" class="text-danger d-none"></div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label update-label">Email:</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    value="{{ $user->email }}">
                                <div id="email_error_message" class="text-danger d-none"></div>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label update-label">Phone:</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ $user->phone }}">
                                <div id="phone_error_message" class="text-danger d-none"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label update-label">Gender:</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male"
                                        value="Male" {{ $user->gender == 'Male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female"
                                        value="Female" {{ $user->gender == 'Female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                <div id="gender_error_message" class="text-danger d-none"></div>
                            </div>

                            <button type="submit" class="btn btn-outline-primary">Update</button>
                        </form>

                    </div>

                    <div class="tab-pane fade show" id="changePassword">
                        <form action="{{ route('password.change') }}" method="post" id="password-form">
                            @csrf
                            <div class="form-group">
                                <label for="currentPassword">Current Password <i class="text-danger">*</i></label>
                                <input type="password" name="current_password" id="currentPassword" class="form-control"
                                    maxlength="100" autocomplete="off">

                                <div id="current_password_error_message" class="text-danger d-none"></div>
                                @error('current_password')
                                    <div id="current_password_error_message" class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="newPassword">New Password <i class="text-danger">*</i></label>
                                <input type="password" name="password" id="newPassword" class="form-control"
                                    maxlength="100" autocomplete="off">

                                <div id="new_password_error_message" class="text-danger d-none"></div>
                                @error('password')
                                    <div id="new_password_error_message" class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password <i class="text-danger">*</i></label>
                                <input type="password" name="confirm_password" id="confirmPassword" class="form-control"
                                    maxlength="100" autocomplete="off">

                                <div id="confirm_password_error_message" class="text-danger d-none"></div>

                                @error('confirm_password')
                                    <div id="confirm_password_error_message" class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <input class="btn btn-outline-primary mt-3" type="submit" value="Change Password">
                        </form>
                    </div>
                </div>

            </div>



        </section>
    @endsection

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {

            function checkRegisterName() {
                if ($.trim($('#name').val()) == '') {
                    $("#name_error_message").html("The name is a required field.");
                    $("#name_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#name_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }

            function checkRegisterEmail() {
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

            function checkRegisterPhone() {
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


            function checkRegisterGender() {
                if (!($('input[name="gender"]:checked').val())) {
                    $("#gender_error_message").html("The gender is a required field.");
                    $("#gender_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#gender_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }

            function checkCurrentPassword() {
                if ($.trim($('#currentPassword').val()) == '') {
                    $("#current_password_error_message").html("The curent password is a required field.");
                    $("#current_password_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#current_password_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }

            function checkPassword() {
                if ($.trim($('#newPassword').val()) == '') {
                    $("#new_password_error_message").html("The password is a required field.");
                    $("#new_password_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#new_password_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }

            function checkConfirm() {
                if ($.trim($('#confirmPassword').val()) == '') {
                    $("#confirm_password_error_message").html("The confirm password is a required field.");
                    $("#confirm_password_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else if ($.trim($('#confirmPassword').val()) != $.trim($('#newPassword').val())) {
                    $("#confirm_password_error_message").html("The confirm password and password must match.");
                    $("#confirm_password_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#confirm_password_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }



            $('#profile-form').submit(function(event) {
                event.preventDefault();


                var checkName = checkRegisterName();
                var checkEmail = checkRegisterEmail();
                var checkPhone = checkRegisterPhone();
                var checkGender = checkRegisterGender();

                if (checkName && checkEmail && checkPhone && checkGender) {

                    var nameError = $('#register_name_error_message');
                    var emailError = $('#register_email_error_message');
                    var phoneError = $('#register_phone_error_message');
                    var genderError = $('#register_gender_error_message');


                    

                    var form = this;
                    var formData = new FormData(this);
                    formData.append('_token', '{{ csrf_token() }}');


                    $.ajax({
                        url: "{{ route('profile.update') }}",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {


                            console.log("hey");



                        },
                        error: function(xhr, status, error) {
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;

                                if (errors && errors.username) {
                                    var usernameErrors = Array.isArray(errors
                                        .username) ? errors.username : [
                                        errors.username
                                    ];
                                    console.log(usernameErrors);

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

            $('#password-form').submit(function(event) {
                event.preventDefault();




                var currentPasswordError = $("#current_password_error_message");
                var newPasswordError = $("#new_password_error_message");
                var confirmPasswordError = $("#confirm_password_error_message");

                currentPasswordError.removeClass("d-block").addClass("d-none");
                newPasswordError.removeClass("d-block").addClass("d-none");
                confirmPasswordError.removeClass("d-block").addClass("d-none");


                // console.log(checkPassword());
                // console.log(checkNewPassword());
                // console.log(checkConfirm());
                var testCurrent = checkCurrentPassword();
                var testNew = checkPassword();
                var testConfirm = checkConfirm();

                if (testCurrent && testNew && testConfirm) {
                    var form = this;
                    var formData = new FormData(this);
                    formData.append('_token', '{{ csrf_token() }}');
                    $.ajax({
                        url: "{{ route('password.change') }}",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {


                            form.reset();



                        },
                        error: function(xhr, status, error) {
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;

                                if (errors && errors.current_password) {
                                    var currentPasswordErrors = Array.isArray(errors
                                        .current_password) ? errors.current_password : [
                                        errors.current_password
                                    ];
                                    console.log(currentPasswordErrors);

                                    currentPasswordError.html(
                                        currentPasswordErrors[0]);
                                    currentPasswordError.removeClass("d-none")
                                        .addClass("d-block");
                                }

                                if (errors && errors.password) {
                                    newPasswordError.html(
                                        errors.password[0]);
                                    newPasswordError.removeClass("d-none").addClass(
                                        "d-block");
                                }

                                if (errors && errors.confirm_password) {
                                    confirmPasswordError.html(
                                        errors.confirm_password);
                                    confirmPasswordError.removeClass("d-none")
                                        .addClass("d-block");
                                } else {

                                    console.log('Error:', xhr.responseText);
                                }

                            } else {

                                console.log('Error:', xhr.responseText);
                            }
                        }


                    });
                }




            });


        });
    </script>
</body>

</html>
