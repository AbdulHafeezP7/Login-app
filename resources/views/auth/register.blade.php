<!doctype html>
<html
    lang="en"
    class="light-style layout-wide customizer-hide"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../../assets/"
    data-template="vertical-menu-template"
    data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Register</title>
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
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
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
                        <!-- /Logo -->
                        <h4 class="mb-1">Create an Account 🚀</h4>
                        <p class="mb-6">Fill the form below to create a new account</p>
                        <form id="formAuthentication" class="mb-4" action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" />
                            </div>
                            <div class="mb-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" />
                            </div>
                            <div class="mb-6 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="mb-6 form-password-toggle">
                                <label class="form-label" for="password_confirmation">Confirm Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password_confirmation" />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="mb-6">
                                <button class="btn btn-primary d-grid w-100" type="submit">Register</button>
                            </div>
                        </form>
                        <div class="divider my-6">
                            <div class="divider-text">or</div>
                        </div>

                        <p class="text-center">
                            <span>Already have an account?</span>
                            <a href="{{ url('login') }}">
                                <span>Login instead</span>
                            </a>
                        </p>

                        <div class="d-flex justify-content-center">
                            <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-facebook me-1_5">
                                <i class="tf-icons ti ti-brand-facebook-filled"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-twitter me-1_5">
                                <i class="tf-icons ti ti-brand-twitter-filled"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-github me-1_5">
                                <i class="tf-icons ti ti-brand-github-filled"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-google-plus">
                                <i class="tf-icons ti ti-brand-google-filled"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#formAuthentication').on('submit', function(e) {
                e.preventDefault();
                $('.alert-danger').remove();
                let name = $('#name').val();
                let email = $('#email').val();
                let password = $('#password').val();
                let password_confirmation = $('#password_confirmation').val();

                let errors = [];
                if (name === '') {
                    errors.push('Full Name is required.');
                }
                if (email === '') {
                    errors.push('Email is required.');
                } else if (!email.endsWith('@gmail.com')) {
                    errors.push('Email must be a @gmail.com address.');
                }
                if (password === '') {
                    errors.push('Password is required.');
                } else if (password.length < 8) {
                    errors.push('Password must be at least 8 characters.');
                } else if (!/[A-Z]/.test(password)) {
                    errors.push('Password must contain at least one uppercase character.');
                } else if (!/[0-9]/.test(password)) {
                    errors.push('Password must contain at least one number.');
                } else if (!/[@$!%*?&]/.test(password)) {
                    errors.push('Password must contain at least one special character.');
                }
                if (password_confirmation !== password) {
                    errors.push('Password confirmation does not match.');
                }
                if (errors.length > 0) {
                    let errorHtml = '<div class="alert alert-danger"><ul>';
                    errors.forEach(function(error) {
                        errorHtml += '<li>' + error + '</li>';
                    });
                    errorHtml += '</ul></div>';
                    $('form').before(errorHtml);
                } else {
                    // Send Ajax request
                    $.ajax({
                        url: "{{ route('register') }}",
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            if (response.success) {
                                let successHtml = '<div class="alert alert-success">' + response.message + '</div>';
                                $('form').before(successHtml);
                                setTimeout(function() {
                                    window.location.href = "{{ route('register') }}";
                                }, 3000);
                            } else {
                                let errorHtml = '<div class="alert alert-danger"><ul>';
                                response.errors.forEach(function(error) {
                                    errorHtml += '<li>' + error + '</li>';
                                });
                                errorHtml += '</ul></div>';
                                $('form').before(errorHtml);
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>