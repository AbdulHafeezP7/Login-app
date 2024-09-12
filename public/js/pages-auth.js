import FormValidation from './path/to/form-validation.min.js';
import Popper from './path/to/popper.min.js'; // Correct relative path

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formAuthentication');
    
    if (form) {
        FormValidation.formValidation(form, {
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'The full name is required'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email is required'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required'
                        }
                    }
                },
                password_confirmation: {
                    validators: {
                        notEmpty: {
                            message: 'The password confirmation is required'
                        },
                        identical: {
                            compare: function () {
                                return document.getElementById('password').value;
                            },
                            message: 'The password and its confirmation are not the same'
                        }
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: '.mb-6',
                    eleInvalidClass: '',
                    eleValidClass: ''
                })
            }
        });
    }
});
