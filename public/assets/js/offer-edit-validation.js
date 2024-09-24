// Offer Edit Form Js And Validation Concept
$(document).ready(function () {
    $('#offer-form').on('submit', function (e) {
        e.preventDefault();
        // Prepare And Submmiting Form Data
        let formData = new FormData(this);
        // Clear previous error And Validating Form
        $('.invalid-feedback').remove();
        $('.form-control').removeClass('is-invalid');
        let offerEn = $('#offer_en').val().trim();
        let offerAr = $('#offer_ar').val().trim();
        let actualPrice = $('#actual_price').val().trim();
        let offerPrice = $('#offer_price').val().trim();
        let offerImage = $('#image').val();
        // Image Validation
        let imageFile = $('#image')[0].files[0];
        let validImageFormats = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/svg+xml'];
        let isValidImage = imageFile ? validImageFormats.includes(imageFile.type) : true;
        let errors = {};
        // Checks Validation
        if (!offerEn) errors.offer_en = 'Offer Name (English) is required.';
        if (!offerAr) errors.offer_ar = 'Offer Name (Arabic) is required.';
        if (!actualPrice) errors.actual_price = 'Actual Price is required.';
        if (!offerPrice) errors.offer_price = 'Offer Price is required.';
        if (!offerImage) errors.image = 'Insurance Image is required.';
        if (!isValidImage) errors.image = 'Image format must be JPEG, JPG, PNG, GIF, or SVG.';
        // If There Are Validation Errors, Display Them And Prevent Form Submission
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
        // Submit The Form Via AJAX And Displaying Success Message 
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Offer updated successfully!',
                        icon: 'success',
                        customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                        },
                        buttonsStyling: false
                    }).then(() => {
                        window.location.href = offerIndexUrl;
                    });
                } else {
                    console.log('Error updating offer: ' + response.message);
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    Swal.fire({
                        title: 'Error!',
                        text: xhr.responseJSON.message,
                        icon: 'error',
                        customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                        },
                        buttonsStyling: false
                    });
                } else {
                    console.log('Error updating offer: ' + (xhr.responseJSON.message || 'Unknown error'));
                }
            }
        });
    });
    // Remove Validation Error After Entering The Input Values
    $('#offer-form input').on('input change', function () {
        $(this).removeClass('is-invalid');
        $(this).next('.invalid-feedback').remove();
    });
});
