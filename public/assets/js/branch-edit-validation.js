$(document).ready(function() {
    $('#branch-form').on('submit', function(e) {
        e.preventDefault();
        // Form validation
        $('.invalid-feedback').remove();
        $('.form-control').removeClass('is-invalid');

        let branchNameEn = $('#branchname_en').val().trim();
        let branchNameAr = $('#branchname_ar').val().trim();
        let branchManagerName = $('#branchmanager_name').val().trim();
        let branchLocation = $('#branch_location').val().trim();
        let branchAddress = $('#branch_address').val().trim();
        let branchSocialLink = $('#branchsocial_link').val().trim();
        let branchOfficeNumber = $('#branchoffice_number').val().trim();
        let branchManagerNumber = $('#branchmanager_number').val().trim();
        let errors = {};

        // Validation checks
        if (!branchNameEn) errors.branchname_en = 'Branch Name (English) is required.';
        if (!branchNameAr) errors.branchname_ar = 'Branch Name (Arabic) is required.';
        if (!branchManagerName) errors.branchmanager_name = 'Branch Manager Name is required.';
        if (!branchLocation) errors.branch_location = 'Branch Location is required.';
        if (!branchAddress) errors.branch_address = 'Branch Address is required.';
        if (!branchSocialLink) errors.branchsocial_link = 'Branch Social Media Link is required.';
        if (!branchOfficeNumber) errors.branchoffice_number = 'Branch Office Number is required.';
        if (!branchManagerNumber) errors.branchmanager_number = 'Branch Manager Number is required.';

        // If there are validation errors, display them and prevent form submission
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

        // Prepare form data
        let formData = new FormData(this);
        formData.append('_method', 'PUT');

        // Submit the form via AJAX
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status) {
                    Swal.fire({
                        title: 'Good job!',
                        text: 'Branch updated successfully!',
                        icon: 'success',
                        customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                        },
                        buttonsStyling: false
                    }).then(() => {
                        window.location.href = branchIndexUrl;
                    });
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = '';

                    for (let field in errors) {
                        let errorMessage = errors[field][0];
                        let inputField = $('#' + field);

                        let errorDiv = $('<div>').addClass('invalid-feedback').text(errorMessage);
                        inputField.addClass('is-invalid').after(errorDiv);
                        errorMessages += errorMessage + '\n';
                    }

                    Swal.fire({
                        title: 'Error!',
                        text: errorMessages.trim(),
                        icon: 'error',
                        customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                        },
                        buttonsStyling: false
                    });
                } else {
                    console.log('Error updating branch: ' + (xhr.responseJSON.message || 'Unknown error'));
                }
            }
        });
    });

    // Remove validation error when input enters
    $('#branch-form input, #branch-form textarea').on('input change', function() {
        $(this).removeClass('is-invalid');
        $(this).next('.invalid-feedback').remove();
    });
});
