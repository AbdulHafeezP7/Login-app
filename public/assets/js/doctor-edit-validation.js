// Doctor Edit Form Js And Validation Concept
$(document).ready(function () {
    const snowEditor = new Quill('#snow-editor', {
        bounds: '#snow-editor',
        modules: {
            formula: true,
            toolbar: '#snow-toolbar'
        },
        theme: 'snow'
    });
    // Special Case For Editors
    snowEditor.on('text-change', function () {
        if (snowEditor.root.innerHTML.trim() !== '<p><br></p>') {
            $('#snow-editor').removeClass('is-invalid');
            $('#snow-editor').siblings('.invalid-feedback').remove();
        }
    });
    const doctor_description = $('#doctor_description_old').val();
    snowEditor.root.innerHTML = doctor_description;
    $('#doctor-form').on('submit', function (e) {
        e.preventDefault();
        // Clear previous error And Validating Form
        $('.invalid-feedback').remove();
        $('.form-control').removeClass('is-invalid');
        let nameEn = $('#name_en').val().trim();
        let nameAr = $('#name_ar').val().trim();
        let department = $('#department').val();
        // Image Validation
        let imageFile = $('#image')[0].files[0];
        let validImageFormats = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'];
        let isValidImage = imageFile ? validImageFormats.includes(imageFile.type) : true;
        let errors = {};
        // Checks Validation
        if (!nameEn) errors.name_en = 'Name (English) is required.';
        if (!nameAr) errors.name_ar = 'Name (Arabic) is required.';
        if (!department) errors.department = 'Department is required.';
        if (!isValidImage) errors.image = 'Image format must be JPEG, PNG, JPG, GIF, or SVG.';
        // If There Are Validation Errors, Display Them And Prevent Form Submission
        if (Object.keys(errors).length > 0) {
            for (let field in errors) {
                let errorMessage = errors[field];
                let inputField = $('#' + field);
                if (field === 'doctor_description') {
                    let errorDiv = $('<div>').addClass('invalid-feedback').text(errorMessage);
                    $('#doctor-description-editor').addClass('is-invalid').after(errorDiv);
                } else {
                    let errorDiv = $('<div>').addClass('invalid-feedback').text(errorMessage);
                    inputField.addClass('is-invalid').after(errorDiv);
                }
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
        // Appending doctor_description
        let contentDr = snowEditor.root.innerHTML.trim();
        $('<input>').attr({
            type: 'hidden',
            name: 'doctor_description',
            value: contentDr
        }).appendTo('#doctor-form');
        // Prepare And Submmiting Form Data
        let formData = new FormData(this);
        if (imageFile) formData.append('image', imageFile);
        formData.append('_method', 'PUT');
        // Submit The Form Via AJAX And Displaying Success Message 
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Doctor updated successfully!',
                        icon: 'success',
                        customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                        },
                        buttonsStyling: false
                    }).then(() => {
                        window.location.href = doctorsIndexUrl;
                    });
                }
            },
            error: function (xhr) {
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
                    console.log('Error updating doctor: ' + (xhr.responseJSON.message || 'Unknown error'));
                }
            }
        });
    });
    // Remove Validation Error After Entering The Input Values
    $('#doctor-form input, #doctor-form textarea').on('input change', function () {
        $(this).removeClass('is-invalid');
        $(this).next('.invalid-feedback').remove();
    });
});
