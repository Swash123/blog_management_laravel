<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div id="container" class="container_main">
        <!-- FORM SECTION -->
        <div class="row">
            <!-- SIGN UP -->

            <div class="col align-items-center flex-col sign-up">
                <div class="form-wrapper align-items-center">
                    <form action="" method="POST" id="form_signup">
                        @csrf
                        <div class="form sign-up">
                            <div class="form-group">
                                <i class='bx bxs-user'></i>
                                <input type="text" id="register_username" name="username" placeholder="Username">
                                <div id="register_username_error_message" class="text-danger d-none"></div>
                            </div>
                            <div class="form-group">
                                <i class='bx bxs-lock-alt'></i>
                                <input type="text" id="register_name" name="name" placeholder="Name">
                                <div id="register_name_error_message" class="text-danger d-none"></div>
                            </div>
                            <div class="form-group">
                                <i class='bx bx-mail-send'></i>
                                <input type="email" id="register_email" name="email" placeholder="Email">
                                <div id="register_email_error_message" class="text-danger d-none"></div>
                            </div>
                            <div class="form-group">
                                <i class='bx bxs-lock-alt'></i>
                                <input type="text" id="register_phone" name="phone" placeholder="Phone">
                                <div id="register_phone_error_message" class="text-danger d-none"></div>
                            </div>

                            <div class="form-group"
                                style="display:flex; justify-content:start; align-items:flex-start; flex-direction:column;">
                                Gender:
                                <div style="display: flex; gap:10px">
                                    <input type="radio" name="gender" value="Male">Male
                                    <input type="radio" name="gender" value="Female">Female
                                </div>
                                <div id="register_gender_error_message" class="text-danger d-none"></div>
                            </div>



                            <div class="form-group">
                                <i class='bx bxs-lock-alt'></i>
                                <input type="password" id="register_password" name="password" placeholder="Password">
                                <div id="register_password_error_message" class="text-danger d-none"></div>
                            </div>



                            <input type="submit" class="btn btn-outline-primary" value="Sign up">

                            <p>
                                <span>
                                    Already have an account?
                                </span>
                                <b onclick="toggle()" class="pointer">
                                    Sign in here
                                </b>
                            </p>
                        </div>
                    </form>
                </div>

            </div>

            <!-- END SIGN UP -->
            <!-- SIGN IN -->

            <div class="col align-items-center flex-col sign-in">
                <div class="form-wrapper align-items-center">
                    <form action="{{ route('auth') }}" method="POST">
                        @csrf
                        <div class="form sign-in">
                            <div class="form-group">
                                <i class='bx bxs-user'></i>
                                <input type="text" name="username" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <i class='bx bxs-lock-alt'></i>
                                <input type="password" name="password" placeholder="Password">
                            </div>
                            @error('login')
                                <div id="full_name_error_message" class="text-danger">{{ $message }}
                                </div>
                            @enderror
                            <input type="submit" class="btn btn-outline-primary" value="Sign in">


                            <p>
                                <b>
                                    Forgot password?
                                </b>
                            </p>
                            <p>
                                <span>
                                    Don't have an account?
                                </span>
                                <b onclick="toggle()" class="pointer">
                                    Sign up here
                                </b>
                            </p>
                        </div>
                    </form>
                </div>
                <div class="form-wrapper">

                </div>
            </div>
            <!-- END SIGN IN -->
        </div>
        <!-- END FORM SECTION -->
        <!-- CONTENT SECTION -->
        <div class="row content-row">
            <!-- SIGN IN CONTENT -->
            <div class="col align-items-center flex-col">
                <div class="text sign-in">
                    <h2>
                        Welcome
                    </h2>

                </div>
                <div class="img sign-in">

                </div>
            </div>
            <!-- END SIGN IN CONTENT -->
            <!-- SIGN UP CONTENT -->
            <div class="col align-items-center flex-col">
                <div class="img sign-up">

                </div>
                <div class="text sign-up">
                    <h2>
                        Join with us
                    </h2>

                </div>
            </div>
            <!-- END SIGN UP CONTENT -->
        </div>
        <!-- END CONTENT SECTION -->
    </div>
    <script src="js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {

            function checkRegisterUsername() {
                var pattern = new RegExp(/^[a-zA-Z][a-zA-Z0-9_]*$/);
                if ($.trim($('#register_username').val()) == '') {
                    $("#register_username_error_message").html("The username is a required field.");
                    $("#register_username_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else if (!(pattern.test($("#register_username").val()))) {
                    $("#register_username_error_message").html(
                        "Username cannot contain space and special characters");
                    $("#register_username_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#register_username_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }

            function checkRegisterName() {
                if ($.trim($('#register_name').val()) == '') {
                    $("#register_name_error_message").html("The name is a required field.");
                    $("#register_name_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#register_name_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }

            function checkRegisterEmail() {
                var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
                if ($.trim($('#register_email').val()) == '') {
                    $("#register_email_error_message").html("The email is a required field.");
                    $("#register_email_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else if (!(pattern.test($("#register_email").val()))) {
                    $("#register_email_error_message").html("Invalid email address");
                    $("#register_email_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#register_email_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }

            function checkRegisterPhone() {
                var pattern = new RegExp(/^(98[0-9]{8})$/);
                if ($.trim($('#register_phone').val()) == '') {
                    $("#register_phone_error_message").html("The phone is a required field.");
                    $("#register_phone_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else if (!(pattern.test($("#register_phone").val()))) {
                    $("#register_phone_error_message").html("Invalid phone number");
                    $("#register_phone_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#register_phone_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }


            function checkRegisterGender() {
                if (!($('input[name="gender"]:checked').val())) {
                    $("#register_gender_error_message").html("The gender is a required field.");
                    $("#register_gender_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#register_gender_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }

            function checkRegisterPassword() {
                if ($.trim($('#register_password').val()) == '') {
                    $("#register_password_error_message").html("The password is a required field.");
                    $("#register_password_error_message").removeClass("d-none").addClass("d-block");
                    return false;
                } else {
                    $("#register_password_error_message").removeClass("d-block").addClass("d-none");
                    return true;
                }
            }




            $('#form_signup').submit(function(event) {
                event.preventDefault();


                var checkUsername = checkRegisterUsername();
                var checkName = checkRegisterName();
                var checkEmail = checkRegisterEmail();
                var checkPhone = checkRegisterPhone();
                var checkGender = checkRegisterGender();
                var checkPassword = checkRegisterPassword();

                if (checkUsername && checkName && checkEmail && checkPhone && checkGender &&
                    checkPassword) {
						var usernameError=$('#register_username_error_message');
						var nameError=$('#register_name_error_message');
						var emailError=$('#register_email_error_message');
						var phoneError=$('#register_phone_error_message');
						var genderError=$('#register_gender_error_message');
						var passwordError=$('#register_password_error_message');
						

                    var form = this;
                    var formData = new FormData(this);
                    formData.append('_token', '{{ csrf_token() }}');


                    $.ajax({
                        url: "{{ route('register') }}",
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

        });
    </script>
</body>

</html>
