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

        let titleEn = $('#title_en').val().trim();
        let titleAr = $('#title_ar').val().trim();
        let image = $('#image').val();
        let contentEn = snowEditor.root.innerHTML.trim();
        let contentAr = snowEditor1.root.innerHTML.trim();
        let slug = $('#slug').val().trim();

        // Image format validation
        let imageFile = $('#image')[0].files[0];
        let validImageFormats = ['image/jpeg', 'image/png', 'image/gif'];
        let isValidImage = imageFile ? validImageFormats.includes(imageFile.type) : true;

        if (!titleEn || !titleAr || !contentEn || !contentAr || !slug || !image || !isValidImage) {
            let errorMessage = '';

            if (!titleEn) errorMessage += 'Title (English) is required.\n';
            if (!titleAr) errorMessage += 'Title (Arabic) is required.\n';
            if (!contentEn || contentEn === '<p><br></p>') errorMessage += 'Article (English) content is required.\n';
            if (!contentAr || contentAr === '<p><br></p>') errorMessage += 'Article (Arabic) content is required.\n';
            if (!slug) errorMessage += 'Slug is required.\n';
            if (!image) errorMessage += 'Thumbnail image is required.\n';
            if (!isValidImage) errorMessage += 'Image format must be JPEG, PNG, or GIF.\n';

            Swal.fire({
                title: 'Error!',
                text: errorMessage.trim(),
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-primary waves-effect waves-light'
                },
                buttonsStyling: false
            });
            return;
        }

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

                    let errors = xhr.responseJSON.errors;

                    for (let field in errors) {
                        let errorMessage = errors[field][0];
                        let inputField = $('#' + field);

                        let errorDiv = $('<div>').addClass('invalid-feedback').text(errorMessage);

                        inputField.after(errorDiv);
                        inputField.addClass('is-invalid');
                    }
                } else {
                    console.log('Error saving article: ' + (xhr.responseJSON.message || 'Unknown error'));
                }
            }
        });
    });
});
