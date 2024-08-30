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
    const articleEnContent = $('#content_en_data').val();
    const articleArContent = $('#content_ar_data').val();
    snowEditor.root.innerHTML = articleEnContent;
    snowEditor1.root.innerHTML = articleArContent;

    $('#article-form').on('submit', function (e) {
        e.preventDefault();
        $('.invalid-feedback').remove();
        $('.form-control').removeClass('is-invalid');
        let titleEn = $('#title_en').val().trim();
        let titleAr = $('#title_ar').val().trim();
        let slug = $('#slug').val().trim();
        let image = $('#image').val();
        let contentEn = snowEditor.root.innerHTML.trim();
        let contentAr = snowEditor1.root.innerHTML.trim();
        let imageFile = $('#image')[0].files[0];
        let validImageFormats = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'];
        let isValidImage = imageFile ? validImageFormats.includes(imageFile.type) : true;
        let errors = {};

        if (!titleEn) errors.title_en = 'Title (English) is required.';
        if (!titleAr) errors.title_ar = 'Title (Arabic) is required.';
        if (!contentEn || contentEn === '<p><br></p>') errors.article_en = 'Article (English) content is required.';
        if (!contentAr || contentAr === '<p><br></p>') errors.article_ar = 'Article (Arabic) content is required.';
        if (!slug) errors.slug = 'Slug is required.';
        if (!isValidImage) errors.image = 'Image format must be JPEG, PNG, JPG, GIF, or SVG.';

        if (Object.keys(errors).length > 0) {
            for (let field in errors) {
                let errorMessage = errors[field];
                let inputField = $('#' + field);

                if (field === 'article_en' || field === 'article_ar') {
                    let editorContainer = field === 'article_en' ? $('#snow-editor') : $('#snow-editor1');
                    let errorDiv = $('<div>').addClass('invalid-feedback').text(errorMessage);
                    editorContainer.addClass('is-invalid').after(errorDiv);
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

        $('#content_en_data').val(contentEn);
        $('#content_ar_data').val(contentAr);

        let formData = new FormData(this);
        formData.append('title_en', titleEn);
        formData.append('title_ar', titleAr);
        formData.append('slug', slug);
        formData.append('article_en', contentEn);
        formData.append('article_ar', contentAr);
        if (imageFile) formData.append('image', imageFile);
        formData.append('_method', 'PUT'); // 
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
                        window.location.href = articlesIndexUrl;
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

    $('#article-form input, #article-form textarea').on('input change', function () {
        $(this).removeClass('is-invalid');
        $(this).next('.invalid-feedback').remove();
    });

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