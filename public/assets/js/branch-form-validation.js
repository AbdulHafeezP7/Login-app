$(document).ready(function () {
    function displayError(element, message) {
        element.addClass('is-invalid');
        var errorDiv = $('<div>').addClass('invalid-feedback').text(message);
        element.after(errorDiv);
    }

    $('#addBranchForm').on('submit', function (e) {
        e.preventDefault(); 

        // Clear previous errors
        $('.invalid-feedback').remove();
        $('.is-invalid').removeClass('is-invalid');

        var isValid = true;

        // Check if all fields are filled
        if ($('#branchname_en').val().trim() === '') {
            displayError($('#branchname_en'), 'Branch Name (English) is required.');
            isValid = false;
        }

        if ($('#branchname_ar').val().trim() === '') {
            displayError($('#branchname_ar'), 'Branch Name (Arabic) is required.');
            isValid = false;
        }

        if ($('#branchmanager_name').val().trim() === '') {
            displayError($('#branchmanager_name'), 'Branch Manager Name is required.');
            isValid = false;
        }

        // URL validation
        var urlPattern = new RegExp('^(https?:\\/\\/)?' + // protocol
            '((([a-zA-Z0-9\\-\\.]+)\\.?)+[a-zA-Z]{2,}|localhost|' + // domain name
            '\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}|[a-fA-F0-9:\\.]+)' + // OR ipv4/ipv6
            '(\\:\\d+)?(\\/[-a-zA-Z0-9@:%_\\+.~#?&//=]*)?$'); // port and path

        if ($('#branch_location').val().trim() === '') {
            displayError($('#branch_location'), 'Branch Location is required.');
            isValid = false;
        } else if (!urlPattern.test($('#branch_location').val().trim())) {
            displayError($('#branch_location'), 'Invalid URL format.');
            isValid = false;
        }

        if ($('#branch_address').val().trim() === '') {
            displayError($('#branch_address'), 'Branch Address is required.');
            isValid = false;
        }

        if ($('#branchsocial_link').val().trim() === '') {
            displayError($('#branchsocial_link'), 'Branch Social Media Link is required.');
            isValid = false;
        }

        // Check if phone numbers are valid
        var phoneRegex = /^\+?(\d{1,4}[-. ]?)?(\(?\d{1,3}\)?[-. ]?)?\d{3}[-. ]?\d{4}$/;

        if ($('#branchoffice_number').val().trim() === '') {
            displayError($('#branchoffice_number'), 'Branch Office Number is required.');
            isValid = false;
        } else if (!phoneRegex.test($('#branchoffice_number').val().trim())) {
            displayError($('#branchoffice_number'), 'Invalid phone number format.');
            isValid = false;
        }

        if ($('#branchmanager_number').val().trim() === '') {
            displayError($('#branchmanager_number'), 'Branch Manager Number is required.');
            isValid = false;
        } else if (!phoneRegex.test($('#branchmanager_number').val().trim())) {
            displayError($('#branchmanager_number'), 'Invalid phone number format.');
            isValid = false;
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
                            text: 'Branch created successfully!',
                            icon: 'success',
                            customClass: {
                                confirmButton: 'btn btn-primary waves-effect waves-light'
                            },
                            buttonsStyling: false
                        }).then(() => {
                            window.location.href = "{{ route('branchs.index') }}";
                        });
                    } else {
                        console.log('Error saving branch: ' + response.message);
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
                        console.log('Error saving branch: ' + (xhr.responseJSON.message || 'Unknown error'));
                    }
                }
            });
        } else {
            Swal.fire({
                title: 'Error!',
                text: 'Please fill out all required fields.',
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-primary waves-effect waves-light'
                },
                buttonsStyling: false
            });
        }
    });
});

