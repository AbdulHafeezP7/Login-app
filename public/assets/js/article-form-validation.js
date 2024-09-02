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

    $('#addArticleForm').on('submit', function (e) {
        e.preventDefault();

        // Clear previous error messages
        $('.invalid-feedback').remove();
        $('.form-control').removeClass('is-invalid');

        let titleEn = $('#title_en').val().trim();
        let titleAr = $('#title_ar').val().trim();
        let image = $('#image').val();
        let contentEn = snowEditor.root.innerHTML.trim();
        let contentAr = snowEditor1.root.innerHTML.trim();
        let slug = $('#slug').val().trim();

        // Image format validation
        let imageFile = $('#image')[0].files[0];
        let validImageFormats = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/svg+xml'];
        let isValidImage = imageFile ? validImageFormats.includes(imageFile.type) : true;

        let errors = {};

        if (!titleEn) errors.title_en = 'Title (English) is required.';
        if (!titleAr) errors.title_ar = 'Title (Arabic) is required.';
        if (!contentEn || contentEn === '<p><br></p>') errors.content_en = 'Article (English) content is required.';
        if (!contentAr || contentAr === '<p><br></p>') errors.content_ar = 'Article (Arabic) content is required.';
        if (!slug) errors.slug = 'Slug is required.';
        if (!image) errors.image = 'Thumbnail image is required.';
        if (!isValidImage) errors.image = 'Image format must be JPEG, JPG, PNG, GIF, or SVG.';

        if (Object.keys(errors).length > 0) {
            // Display error messages under input fields
            for (let field in errors) {
                let errorMessage = errors[field];
                let inputField = $('#' + field);

                let errorDiv = $('<div>').addClass('invalid-feedback').text(errorMessage);

                inputField.addClass('is-invalid').after(errorDiv);
            }

            // Consolidate error messages for Swal
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

        // Append hidden inputs for content
        $('<input>').attr({
            type: 'hidden',
            name: 'content_en',
            value: contentEn
        }).appendTo('#addArticleForm');

        $('<input>').attr({
            type: 'hidden',
            name: 'content_ar',
            value: contentAr
        }).appendTo('#addArticleForm');

        var formData = new FormData(this);
        $.ajax({
            url: articleStoreUrl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status) {
                    Swal.fire({
                        title: 'Good job!',
                        text: 'Article created successfully!',
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
                    $('.invalid-feedback').remove();
                    $('.form-control').removeClass('is-invalid');

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
                    console.log('Error saving article: ' + (xhr.responseJSON.message || 'Unknown error'));
                }
            }
        });
    });

    // Event listeners to clear validation on input
    $('#addArticleForm input, #addArticleForm textarea').on('input change', function () {
        $(this).removeClass('is-invalid');
        $(this).next('.invalid-feedback').remove();
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
});
