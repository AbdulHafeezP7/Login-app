$(document).ready(function() {
    const snowEditor = new Quill('#snow-editor', {
        bounds: '#snow-editor',
        modules: {
            formula: true,
            toolbar: '#snow-toolbar'
        },
        theme: 'snow'
    });
    
    // Special case for editors
    snowEditor.on('text-change', function () {
        if (snowEditor.root.innerHTML.trim() !== '<p><br></p>') {
            $('#snow-editor').removeClass('is-invalid');
            $('#snow-editor').siblings('.invalid-feedback').remove();
        }
    });
    $('#addDepartmentForm').on('submit', function(e) {
        e.preventDefault();

        // Clear previous error messages
        $('.invalid-feedback').remove();
        $('.form-control').removeClass('is-invalid');

        let departmentEn = $('#department_en').val().trim();
        let departmentAr = $('#department_ar').val().trim();
        let departmentDetails = $('#department_details').val().trim();
        let slug = $('#slug').val().trim();
        let image = $('#image').val();

        // Image format validation
        let imageFile = $('#image')[0].files[0];
        let validImageFormats = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/svg+xml'];
        let isValidImage = imageFile ? validImageFormats.includes(imageFile.type) : true;

        let errors = {};

        if (!departmentEn) errors.department_en = 'Department (English) is required.';
        if (!departmentAr) errors.department_ar = 'Department (Arabic) is required.';
        if (!departmentDetails) errors.department_details = 'Department details are required.';
        if (!slug) errors.slug = 'Slug is required.';
        if (!image) errors.image = 'Department image is required.';
        if (!isValidImage) errors.image = 'Image format must be JPEG, JPG, PNG, GIF, or SVG.';

        // Display error messages if any
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
       
      let contentAr = snowEditor.root.innerHTML.trim();
        $('<input>').attr({
            type: 'hidden',
            name: 'content_ar',
            value: contentAr
        }).appendTo('#addDepartmentForm');
        
        // Submit the form if no errors
        let formData = new FormData(this);
        $.ajax({
            url: departmentStoreUrl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
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
                        window.location.href = departmentIndexUrl;
                    });
                }
            },
            error: function(xhr) {
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
    });

    // Clear validation on input
    $('#addDepartmentForm input, #addDepartmentForm textarea').on('input', function() {
        $(this).removeClass('is-invalid');
        $(this).next('.invalid-feedback').remove();
    });
});
