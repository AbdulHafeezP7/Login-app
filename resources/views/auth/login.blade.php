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
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap" rel="stylesheet" />
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
                                <span class="app-brand-text demo text-heading fw-bold">Real Madrid</span>
                            </a>
                        </div>
                        <h4 class="mb-1">Welcome to Real Madrid 👋</h4>
                        <p class="mb-6">Please sign-in to your account and start the adventure</p>

                        <div id="error-messages"></div>

                        <form id="formAuthentication" class="mb-4" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label for="email" class="form-label">Email or Username</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email or username" autofocus />
                            </div>
                            <div class="mb-6 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="••••••••" aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                            <!-- <div class="my-8">
                                <div class="d-flex justify-content-between">
                                    <div class="form-check mb-0 ms-2">
                                        <input class="form-check-input" type="checkbox" id="remember-me" />
                                        <label class="form-check-label" for="remember-me"> Remember Me </label>
                                    </div>
                                    <a href="auth-forgot-password-basic.html"><p class="mb-0">Forgot Password?</p></a>
                                </div>
                            </div> -->
                            <div class="mb-6">
                                <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                            </div>
                        </form>

                        <div class="divider my-6">
                            <div class="divider-text">or</div>
                        </div>
                        <p class="text-center"><span>New on our platform?</span> <a href="{{ url('register') }}"><span>Create an account</span></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#formAuthentication').on('submit', function(e) {
            e.preventDefault();

            let email = $('#email').val();
            let password = $('#password').val();
            let errors = [];

            if (email === '') {
                errors.push('Email is required.');
            } else if (!email.endsWith('@gmail.com')) {
                errors.push('Email must be a @gmail.com address.');
            }
            if (password === '') {
                errors.push('Password is required.');
            } else if (password.length < 8) {
                errors.push('Password must be at least 8 characters, at least one uppercase, at least one number,at least one special character.');
            }
            if (errors.length > 0) {
                let errorHtml = '<div class="alert alert-danger"><ul>';
                errors.forEach(function(error) {
                    errorHtml += '<li>' + error + '</li>';
                });
                errorHtml += '</ul></div>';
                $('#error-messages').html(errorHtml);
            } else {
                $.ajax({
                    url: "{{ route('login') }}",
                    method: 'POST',
                    data: {
                        email: email,
                        password: password,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            let successHtml = '<div class="alert alert-success">' + response.message + '</div>';
                            $('#error-messages').html(successHtml);
                            setTimeout(function() {
                                window.location.href = "{{ route('dashboard') }}";
                            }, 1000);
                        } else {
                            let errorHtml = '<div class="alert alert-danger"><ul>';
                            response.errors.forEach(function(error) {
                                errorHtml += '<li>' + error + '</li>';
                            });
                            errorHtml += '</ul></div>';
                            $('#error-messages').html(errorHtml);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 401) {
                            $('#error-messages').html('<div class="alert alert-danger"> Unauthorized: Invalid email or password.</div>');
                        } else {
                            $('#error-messages').html('<div class="alert alert-danger">An error occurred. Please try again later.</div>');
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>