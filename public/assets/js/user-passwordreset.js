$(document).ready(function () {
    $('#user-form').on('submit', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $('.invalid-feedback').remove();
        $('.form-control').removeClass('is-invalid');

        // Validation checks
        let newPassword = $('#password').val().trim();
        let confirmPassword = $('#password_confirmation').val().trim();
        let errors = {};

        if (!newPassword) {
            errors.new_password = 'New Password is required.';
        } else if (newPassword.length < 8) {
            errors.new_password = 'Password must be at least 8 characters, at least one uppercase, at least one number,at least one special character.';
        }

        if (!confirmPassword) {
            errors.new_password_confirmation = 'Confirm Password is required.';
        } else if (confirmPassword !== newPassword) {
            errors.new_password_confirmation = 'Passwords do not match.';
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
                Swal.fire({
                    title: 'Success!',
                    text: 'User Password Reset successfully!',
                    icon: 'success',
                    customClass: {
                        confirmButton: 'btn btn-primary waves-effect waves-light'
                    },
                    buttonsStyling: false
                }).then(() => {
                    window.location.href = userIndexUrl;
                });
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '';

                    if (errors.new_password) {
                        errorMessage += errors.new_password[0] + '\n';
                    }
                    if (errors.new_password_confirmation) {
                        errorMessage += errors.new_password_confirmation[0];
                    }

                    Swal.fire({
                        title: 'Error!',
                        text: errorMessage,
                        icon: 'error',
                        customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                        },
                        buttonsStyling: false
                    });
                } else {
                    console.log('Error resetting password: ' + (xhr.responseJSON.message || 'Unknown error'));
                }
            }
        });
    });

    // Remove validation error when input changes
    $('#password-reset-form input').on('input change', function () {
        $(this).removeClass('is-invalid');
        $(this).next('.invalid-feedback').remove();
    });
});
