$(document).ready(function () {
    function displayError(element, message) {
        element.addClass('is-invalid');
        var errorDiv = $('<div>').addClass('invalid-feedback').text(message);
        element.after(errorDiv);
    }

    $('#addDepartmentForm').on('submit', function (e) {
        e.preventDefault(); 

        $('.invalid-feedback').remove();
        $('.is-invalid').removeClass('is-invalid');

        var isValid = true;

        if ($('#department_en').val().trim() === '') {
            displayError($('#department_en'), 'Department (English) is required.');
            isValid = false;
        }

        if ($('#department_ar').val().trim() === '') {
            displayError($('#department_ar'), 'Department (Arabic) is required.');
            isValid = false;
        }

        if ($('#slug').val().trim() === '') {
            displayError($('#slug'), 'Slug is required.');
            isValid = false;
        }

        if ($('#department_details').val().trim() === '') {
            displayError($('#department_details'), 'Department Details are required.');
            isValid = false;
        }

        var image = $('#image').val();
        if (image === '') {
            displayError($('#image'), 'Department image is required.');
            isValid = false;
        } else {
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if (!allowedExtensions.exec(image)) {
                displayError($('#image'), 'Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.');
                isValid = false;
            }
        }

        if (isValid) {
            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'), 
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status) {
                        Swal.fire({
                            title: 'Good job!',
                            text: 'Department created successfully!',
                            icon: 'success',
                            customClass: {
                                confirmButton: 'btn btn-primary waves-effect waves-light'
                            },
                            buttonsStyling: false
                        }).then(() => {
                            window.location.href = "{{ route('departments.index') }}";
                        });
                    } else {
                        console.log('Error saving department: ' + response.message);
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
                        console.log('Error saving department: ' + (xhr.responseJSON.message || 'Unknown error'));
                    }
                }
            });
        } else {
            Swal.fire({
                title: 'Error!',
                text: 'Please fill out all required fields and ensure the image file is of a supported type.',
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-primary waves-effect waves-light'
                },
                buttonsStyling: false
            });
        }
    });
});
