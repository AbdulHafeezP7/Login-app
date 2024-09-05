$(document).ready(function () {
    var quillDescription = new Quill('#doctor-description-editor', {
        modules: {
            toolbar: '#doctor-description-toolbar'
        },
        theme: 'snow'
    });

    $('#addDoctorForm').on('submit', function (e) {
        e.preventDefault();

        // Clear previous error messages
        $('.invalid-feedback').remove();
        $('.form-control').removeClass('is-invalid');

        // Get prefix value from the span
        var prefix = $('#basic-addon11').text().trim();

        // Validate the actual input fields
        var nameEn = $('#name_en').val().trim();
        var nameAr = $('#name_ar').val().trim();
        var department = $('#department').val();
        var doctorDescriptionContent = quillDescription.root.innerHTML.trim();
        var image = $('#image').val();

        // Remove prefix from name_en and name_ar for validation
        var rawNameEn = nameEn.startsWith(prefix) ? nameEn.slice(prefix.length).trim() : nameEn;
        var rawNameAr = nameAr.startsWith(prefix) ? nameAr.slice(prefix.length).trim() : nameAr;

        // Image format validation
        let imageFile = $('#image')[0].files[0];
        let validImageFormats = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/svg+xml'];
        let isValidImage = imageFile ? validImageFormats.includes(imageFile.type) : true;

        let errors = {};

        if (!rawNameEn) errors.name_en = 'Name (English) is required.';
        if (!rawNameAr) errors.name_ar = 'Name (Arabic) is required.';
        if (!doctorDescriptionContent || doctorDescriptionContent === '<p><br></p>') errors.doctor_description = 'Doctor description is required.';
        if (!department) errors.department = 'Please select a department.';
        if (!image) errors.image = 'Doctor image is required.';
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

        // Append hidden input for doctor description
        $('#doctor_description').val(doctorDescriptionContent);

        // Append the prefix to names for storage
        nameEn = prefix + ' ' + rawNameEn;
        nameAr = prefix + ' ' + rawNameAr;

        var formData = new FormData(this);
        formData.set('name_en', nameEn);
        formData.set('name_ar', nameAr);
        formData.set('doctor_description', doctorDescriptionContent);
        $.ajax({
            url: doctorStoreUrl,
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
                        window.location.href = doctorIndexUrl;
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
                    console.log('Error saving doctor: ' + (xhr.responseJSON.message || 'Unknown error'));
                }
            }
        });
    });

    // Event listener to clear validation on input
    $('#addDoctorForm input, #addDoctorForm select').on('input change', function () {
        $(this).removeClass('is-invalid');
        $(this).next('.invalid-feedback').remove();
    });

    quillDescription.on('text-change', function () {
        if (quillDescription.root.innerHTML.trim() !== '<p><br></p>') {
            $('#doctor-description-editor').removeClass('is-invalid');
            $('#doctor-description-editor').siblings('.invalid-feedback').remove();
        }
    });
});
