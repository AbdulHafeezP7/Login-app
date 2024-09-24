// User Form Js And Validation Concept
$(document).ready(function () {
    $('#addUserForm').on('submit', function (e) {
        e.preventDefault();
        // Clear previous error And Validating Form
        $('.invalid-feedback').remove();
        $('.form-control').removeClass('is-invalid');
        let Name = $('#name').val().trim();
        let Email = $('#email').val().trim();
        let Password = $('#password').val().trim();
        let Password_confirmation = $('#password_confirmation').val().trim();
        let errors = {};
        // Checks Validation
        if (!Name) errors.name = 'Full Name is required.';
        if (!Email) {
            errors.email = 'Email is required.';
        } else if (!Email.endsWith('@gmail.com')) {
            errors.email = 'Email must be a @gmail.com address.';
        }
        if (!Password) {
            errors.password = 'Password is required.';
        } else {
            if (Password.length < 8) errors.password = 'Password must be at least 8 characters.';
            if (!/[A-Z]/.test(Password)) errors.password = 'Password must contain at least one uppercase character.';
            if (!/[0-9]/.test(Password)) errors.password = 'Password must contain at least one number.';
            if (!/[@$!%*?&]/.test(Password)) errors.password = 'Password must contain at least one special character.';
        }
        if (Password_confirmation !== Password) {
            errors.password_confirmation = 'Password confirmation does not match.';
        }
        // If There Are Validation Errors, Display Them And Prevent Form Submission
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
        // Prepare And Submmiting Form Data
        let formData = new FormData(this);
        // Submit The Form Via AJAX And Displaying Success Message
        $.ajax({
            url: userStoreUrl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'User created successfully!',
                        icon: 'success',
                        customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                        },
                        buttonsStyling: false
                    }).then(() => {
                        window.location.href = userIndexUrl;
                    });
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    $('.invalid-feedback').remove();
                    let errors = xhr.responseJSON.errors;
                    for (let field in errors) {
                        let errorMessage = errors[field][0];
                        let inputField = $('#' + field);
                        let errorDiv = $('<div>').addClass('invalid-feedback').text(errorMessage);
                        inputField.after(errorDiv);
                        inputField.addClass('is-invalid');
                    }
                } else {
                    console.log('Error saving user: ' + (xhr.responseJSON.message || 'Unknown error'));
                }
            }
        });
    });
    // Remove Validation Error After Entering The Input Values
    $('#addUserForm input').on('input', function () {
        $(this).removeClass('is-invalid');
        $(this).next('.invalid-feedback').remove();
    });
});
