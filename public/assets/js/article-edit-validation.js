
$(document).ready(function () {
    const snowEditor = new Quill('#snow-editor', {
        bounds: '#snow-editor',
        modules: {
            formula: true,
            toolbar: '#snow-toolbar'
        },
        theme: 'snow'
    });
    const snowEditor1 = new Quill('#snow-editor1', {
        bounds: '#snow-editor1',
        modules: {
            formula: true,
            toolbar: '#snow-toolbar1'
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
    snowEditor1.on('text-change', function () {
        if (snowEditor1.root.innerHTML.trim() !== '<p><br></p>') {
            $('#snow-editor1').removeClass('is-invalid');
            $('#snow-editor1').siblings('.invalid-feedback').remove();
        }
    });
    const content_en = $('#content_en_old').val();
    snowEditor.root.innerHTML = content_en;
    const content_ar = $('#content_ar_old').val();
    snowEditor1.root.innerHTML = content_ar;

    $('#article-form').on('submit', function (e) {
        e.preventDefault();
        // Form validation
        $('.invalid-feedback').remove();
        $('.form-control').removeClass('is-invalid');
        let titleEn = $('#title_en').val().trim();
        let titleAr = $('#title_ar').val().trim();
        let slug = $('#slug').val().trim();
        let imageFile = $('#image')[0].files[0];
        let validImageFormats = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'];
        let isValidImage = imageFile ? validImageFormats.includes(imageFile.type) : true;
        let errors = {};

        // Validation checks
        if (!titleEn) errors.title_en = 'Title (English) is required.';
        if (!titleAr) errors.title_ar = 'Title (Arabic) is required.';
        if (!slug) errors.slug = 'Slug is required.';
        if (!isValidImage) errors.image = 'Image format must be JPEG, PNG, JPG, GIF, or SVG.';

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

        let contentEn = snowEditor.root.innerHTML.trim();
        $('<input>').attr({
            type: 'hidden',
            name: 'content_en',
            value: contentEn
        }).appendTo('#article-form');
        let contentAr = snowEditor1.root.innerHTML.trim();
        $('<input>').attr({
            type: 'hidden',
            name: 'content_ar',
            value: contentAr
        }).appendTo('#article-form');

        // Prepare form data
        let formData = new FormData(this);
        if (imageFile) formData.append('image', imageFile);
        formData.append('_method', 'PUT');

        // Submit the form via AJAX
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
                        text: 'Article updated successfully!',
                        icon: 'success',
                        customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                        },
                        buttonsStyling: false
                    }).then(() => {
                        window.location.href = articleIndexUrl;
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
                    console.log('Error updating article: ' + (xhr.responseJSON.message || 'Unknown error'));
                }
            }
        });
    });
     // Remove validation error when input enters
   $('#article-form input, #article-form textarea').on('input change', function() {
    $(this).removeClass('is-invalid');
    $(this).next('.invalid-feedback').remove();
});
});
