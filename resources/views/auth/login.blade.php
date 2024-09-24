<!doctype html>
<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/core.css') }}">
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flag-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/node-waves.css') }}">
    <link rel="stylesheet" href="{{ asset('css/page-auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/theme-default.css') }}">
    <link rel="stylesheet" href="{{ asset('css/typeahead.css') }}">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
</head>

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-6">
                <div class="card">
                    <div class="card-body">
                        <div class="app-brand justify-content-center mb-6">
                            <a href="{{ url('/') }}" class="app-brand-link">
                                <span class="app-brand-logo demo">
                                    <!-- SVG Logo -->
                                    <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z" fill="#7367F0" />
                                        <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
                                        <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="#7367F0" />
                                    </svg>
                                </span>
                                <span class="app-brand-text demo text-heading fw-bold">Login</span>
                            </a>
                        </div>
                        <h4 class="mb-1">Welcome to Login Page 👋</h4>
                        <p class="mb-6">Please sign-in to your account and start the adventure</p>

                        <div id="error-messages"></div>

                        <form id="formAuthentication" class="mb-4" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label for="email" class="form-label">Email or Username</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email or username" autofocus />
                            </div>
                            <!-- <div class="mb-6 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="••••••••" aria-describedby="password" />
                                </div>
                            </div> -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                            </div>
                            <div class="mb-6">
                                <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#formAuthentication').on('submit', function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                $('.invalid-feedback').remove();
                $('.form-control').removeClass('is-invalid');

                // Validation checks
                let email = $('#email').val().trim();
                let password = $('#password').val().trim();

                let errors = {};

                if (!email) {
                    errors.email = 'Email is required.';
                } else if (!email.endsWith('@gmail.com')) {
                    errors.email = 'Email must be a @gmail.com address.';
                }
                if (!password) {
                    errors.password = 'Password is required.';
                } else if (password.length < 8) {
                    errors.password = 'Password must be at least 8 characters, including at least one uppercase letter, one number, and one special character.';
                }

                // If there are validation errors
                if (Object.keys(errors).length > 0) {
                    for (let field in errors) {
                        let errorMessage = errors[field];
                        let inputField = $('#' + field);

                        let errorDiv = $('<div>').addClass('invalid-feedback').text(errorMessage);
                        inputField.addClass('is-invalid').after(errorDiv);
                    }

                    let errorMessages = Object.values(errors).join('\n');
                    Swal.fire({
                        title: 'Error!',
                        text: errorMessages,
                        icon: 'error',
                        customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                        },
                        buttonsStyling: false
                    });
                    return;
                }

                // Submit the form via AJAX
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'User Login successfull!',
                                icon: 'success',
                                customClass: {
                                    confirmButton: 'btn btn-primary waves-effect waves-light'
                                },
                                buttonsStyling: false
                            }).then(() => {
                                window.location.href = "{{ route('dashboard') }}";
                            });
                        } else {
                            let errorMessages = response.errors.join('\n');
                            Swal.fire({
                                title: 'Error!',
                                text: errorMessages,
                                icon: 'error',
                                customClass: {
                                    confirmButton: 'btn btn-primary waves-effect waves-light'
                                },
                                buttonsStyling: false
                            });
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 401) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Unauthorized: Invalid email or password.',
                                icon: 'error',
                                customClass: {
                                    confirmButton: 'btn btn-primary waves-effect waves-light'
                                },
                                buttonsStyling: false
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'An error occurred. Please try again later.',
                                icon: 'error',
                                customClass: {
                                    confirmButton: 'btn btn-primary waves-effect waves-light'
                                },
                                buttonsStyling: false
                            });
                        }
                    }
                });
            });

            // Remove validation error when input changes
            $('#formAuthentication input').on('input change', function () {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            });
        });
    </script>
</body>

</html>
