// User Edit Form Js And Validation Concept
$(document).ready(function () {
    $('#user-form').on('submit', function (e) {
        e.preventDefault();
        // Prepare And Submmiting Form Data
        let formData = new FormData(this);
        // Clear previous error And Validating Form
        $('.invalid-feedback').remove();
        $('.form-control').removeClass('is-invalid');
        let name = $('#name').val().trim();
        let email = $('#email').val().trim();
        let errors = {};
        // Checks Validation
        if (!name) errors.name = 'Full Name is required.';
        if (!email) {
            errors.email = 'Email is required.';
        } else if (!email.endsWith('@gmail.com')) {
            errors.email = 'Email must be a @gmail.com address.';
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
        // Submit The Form Via AJAX And Displaying Success Message
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'User updated successfully!',
                        icon: 'success',
                        customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                        },
                        buttonsStyling: false
                    }).then(() => {
                        window.location.href = userIndexUrl;
                    });
                } else {
                    console.log('Error updating user: ' + response.message);
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    Swal.fire({
                        title: 'Error!',
                        text: xhr.responseJSON.message,
                        icon: 'error',
                        customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                        },
                        buttonsStyling: false
                    });
                } else {
                    console.log('Error updating user: ' + (xhr.responseJSON.message || 'Unknown error'));
                }
            }
        });
    });
    // Remove Validation Error After Entering The Input Values
    $('#user-form input').on('input change', function () {
        $(this).removeClass('is-invalid');
        $(this).next('.invalid-feedback').remove();
    });
});
