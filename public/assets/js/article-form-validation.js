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
    
    function displayError(element, message) {
        element.addClass('is-invalid');
        var errorDiv = $('<div>').addClass('invalid-feedback').text(message);
        element.after(errorDiv);
    }

   
    $('#addArticleForm').on('submit', function (e) {
        e.preventDefault();

        $('.invalid-feedback').remove();
        $('.is-invalid').removeClass('is-invalid');

        var isValid = true;

        if ($('#title_en').val().trim() === '') {
            displayError($('#title_en'), 'Title (English) is required.');
            isValid = false;
        }

        if ($('#title_ar').val().trim() === '') {
            displayError($('#title_ar'), 'Title (Arabic) is required.');
            isValid = false;
        }

        if ($('#content_en').val().trim() === '') {
            displayError($('#content_en'), 'Article (English) is required.');
            isValid = false;
        }

        if ($('#content_ar').val().trim() === '') {
            displayError($('#content_ar'), 'Article (Arabic) is required.');
            isValid = false;
        }

        if ($('#slug').val().trim() === '') {
            displayError($('#slug'), 'Slug is required.');
            isValid = false;
        }

        var image = $('#image').val();
        if (image === '') {
            displayError($('#image'), 'Thumbnail image is required.');
            isValid = false;
        } else {
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if (!allowedExtensions.exec(image)) {
                displayError($('#image'), 'Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.');
                isValid = false;
            }
        }

        if (isValid) {

            let contentEn = snowEditor.root.innerHTML;
            let contentAr = snowEditor1.root.innerHTML;

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
                url: "{{ route('articles.store') }}",
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
                            window.location.href = "{{ route('articles.index') }}";
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
        } else {
            Swal.fire({
                title: 'Error!',
                text: 'Please fill out all required fields and ensure the image file is of a supported type.',
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-primary waves-effect waves-light'
                },
                buttonsStyling: false
            });
        }
    });
});
