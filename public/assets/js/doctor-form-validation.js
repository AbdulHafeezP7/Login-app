$(document).ready(function () {
    $('#addDoctorForm').on('submit', function (e) {
        e.preventDefault(); 
        
        $('.invalid-feedback').remove();
        $('.is-invalid').removeClass('is-invalid');

        // Check if all fields are filled
        var isValid = true;
        var errorMessage = '';

        // Function to display error message
        function displayError(element, message) {
            element.addClass('is-invalid');
            var errorDiv = $('<div>').addClass('invalid-feedback').text(message);
            element.after(errorDiv);
        }

        if ($('#name_en').val().trim() === '') {
            displayError($('#name_en'), 'Name (English) is required.');
            isValid = false;
        }

        if ($('#name_ar').val().trim() === '') {
            displayError($('#name_ar'), 'Name (Arabic) is required.');
            isValid = false;
        }

        if ($('#department').val() === '') {
            displayError($('#department'), 'Department selection is required.');
            isValid = false;
        }

        var image = $('#image').val();
        if (image === '') {
            displayError($('#image'), 'Doctor image is required.');
            isValid = false;
        } else {
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if (!allowedExtensions.exec(image)) {
                displayError($('#image'), 'Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.');
                isValid = false;
            }
        }

        // If the form is valid, proceed with AJAX submission
        if (isValid) {

            var nameEnFull = $('#basic-addon11').text() + ' ' + $('#name_en').val();
            var nameArFull = $('#basic-addon11').text() + ' ' + $('#name_ar').val();

            // Update the input values before submitting
            $('#name_en').val(nameEnFull);
            $('#name_ar').val(nameArFull);

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
                            text: 'Doctor created successfully!',
                            icon: 'success',
                            customClass: {
                                confirmButton: 'btn btn-primary waves-effect waves-light'
                            },
                            buttonsStyling: false
                        }).then(() => {
                            window.location.href = "{{route('doctors.index')}}";
                        });
                    } else {
                        console.log('Error saving doctor: ' + response.message);
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
                        console.log('Error saving doctor: ' + (xhr.responseJSON.message || 'Unknown error'));
                    }
                }
            });
        } else {
            
            if (!errorMessage) {
                errorMessage = 'Please fill out all required fields correctly and ensure the image file is of a supported type.';
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
        }
    });
});
