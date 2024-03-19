<div class="modal fade __sign-in-modal" id="SignInModal" tabindex="-1" aria-labelledby="SignInModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="logo">
                    <a href="javascript:">
                        <img loading="lazy" alt="{{ translate('logo') }}"
                            src="{{ getValidImage(path: 'storage/app/public/company/' . $web_config['web_logo']->value, type: 'logo') }}">
                    </a>
                </div>
                <h3 class="title text-capitalize">{{ translate('sign_in') }}</h3>
                <form action="{{ route('customer.auth.verify-token') }}" method="get" id="customer_login_modal"
                    autocomplete="off">
                    @csrf
                    <div class="row g-3">
                        <div class="col-sm-12">
                            <label class="form-label form--label" for="login_email">
                                {{ translate('email') }} / {{ translate('phone') }}
                            </label>
                            <input type="text" class="form-control" name="user_id" id="login_email"
                                value="{{ old('user_id') }}"
                                placeholder="{{ translate('enter_email_or_phone_number') }}" required autofocus>
                            <small>Your phone format will be 923XXXXXXXXX</small>
                        </div>
                        {{-- <div class="col-sm-12">
                        <label class="form-label form--label" for="login_password">{{ translate('password') }}</label>
                        <div class="position-relative">
                            <input type="password" class="form-control" name="password" id="login_password"
                                   placeholder="{{ translate('ex_:_7+_character')}}" required>
                            <div class="js-password-toggle"><i class="bi bi-eye-fill"></i></div>
                        </div>
                    </div> --}}
                        <div class="col-sm-12 text-small">
                            <div class="d-flex justify-content-between gap-1">
                                <label class="form-check m-0">
                                    <input type="checkbox" class="form-check-input" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <span class="form-check-label">{{ translate('remember_me') }}</span>
                                </label>
                                {{-- <a href="{{ route('customer.auth.recover-password') }}"
                                    class="text-base text-capitalize">{{ translate('forgot_password') }} ?</a> --}}
                            </div>
                        </div>

                        {{-- @if ($web_config['recaptcha']['status'] == 1)
                        <div id="recaptcha_element_customer_login" class="w-100 mt-4" data-type="image"></div>
                        <br/>
                    @else
                        <div class="row py-2 mt-4">
                            <div class="col-6 pr-2">
                                <input type="text" class="form-control border __h-40" name="default_recaptcha_id_customer_login" value=""
                                       placeholder="{{translate('enter_captcha_value')}}" autocomplete="off">
                            </div>
                            <div class="col-6 input-icons mb-2 rounded">
                                <span id="re_captcha_customer_login" class="d-flex align-items-center align-items-center">
                                    <img loading="lazy" src="{{ URL('/customer/auth/code/captcha/1?captcha_session_id=default_recaptcha_id_customer_login') }}" class="input-field rounded __h-40" id="customer_login_recaptcha_id" alt="{{ translate('captcha') }}">
                                    <i class="bi bi-arrow-repeat icon cursor-pointer p-2"></i>
                                </span>
                            </div>
                        </div>
                    @endif --}}

                        <div class="col-sm-12 text-small">
                            <button type="submit"
                                class="btn btn-block btn-base text-capitalize">{{ translate('sign_in') }}</button>
                            <div class="text-center">
                                @if ($web_config['social_login_text'])
                                    <div class="mt-32px mb-3">
                                        {{ translate('or_continue_with') }}
                                    </div>
                                @endif
                                <div class="d-flex mb-32px justify-content-center gap-4">
                                    @foreach ($web_config['socials_login'] as $socialLoginService)
                                        @if (isset($socialLoginService) && $socialLoginService['status'] == true)
                                            <a
                                                href="{{ route('customer.auth.service-login', $socialLoginService['login_medium']) }}">
                                                <img loading="lazy"
                                                    src="{{ theme_asset('assets/img/social/' . $socialLoginService['login_medium'] . '.svg') }}"
                                                    alt="{{ translate('social') }}">
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="text-capitalize">
                                    {{ translate('enjoy_new_experience') }} <a href="javascript:" class="text-base"
                                        data-bs-dismiss="modal" data-bs-target="#SignUpModal"
                                        data-bs-toggle="modal">{{ translate('sign_up') }}</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@if ($web_config['recaptcha']['status'] == 1)
    <script type="text/javascript">
        "use strict";
        var onloadCallbackCustomerLogin = function() {
            var login_id = grecaptcha.render('recaptcha_element_customer_login', {
                'sitekey': '{{ getWebConfig(name: 'recaptcha')['site_key'] }}'
            });
            $('#recaptcha_element_customer_login').attr('data-login-id', login_id);
        };
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallbackCustomerLogin&render=explicit" async defer>
    </script>
@else
    <script type="text/javascript">
        "use strict";
        $('#re_captcha_customer_login').on('click', function() {
            var re_captcha = "{{ URL('/customer/auth/code/captcha') }}";
            re_captcha = re_captcha + "/" + Math.random() +
                '?captcha_session_id=default_recaptcha_id_customer_login';
            document.getElementById('customer_login_recaptcha_id').src = re_captcha;
        })
    </script>
@endif

{{-- <script>
    "use strict";
    $("#customer_login_modal").submit(function(e) {
        e.preventDefault();
        var customer_recaptcha = true;

        @if ($web_config['recaptcha']['status'] == 1)
            var response_customer_login = grecaptcha.getResponse($('#recaptcha_element_customer_login').attr(
                'data-login-id'));

            if (response_customer_login.length === 0) {
                e.preventDefault();
                toastr.error("{{ translate('please_check_the_recaptcha') }}");
                customer_recaptcha = false;
            }
        @endif

        if (customer_recaptcha === true) {
            let form = $(this);
            $.ajax({
                type: 'get',
                url: `{{ route('customer.auth.verify-token') }}`,
                data: form.serialize(),
                success: function(data) {
                    if (data.status === 'success') {
                        toastr.success(`{{ translate('login_successful') }}`);
                        data.redirect_url !== '' ? window.location.href = data.redirect_url :
                            location.reload();
                    } else if (data.status === 'error') {
                        data.redirect_url !== '' ? window.location.href = data.redirect_url : toastr
                            .error(data.message);
                    }
                }
            });
        }
    });
</script> --}}

<script>
    document.getElementById('login_email').addEventListener('input', function() {
        let inputValue = this.value.trim();
        let atIndex = inputValue.indexOf('@');
        let inputValueLength = inputValue.length;
        let suggestion = 'gmail.com'; // Change suggestion to gmail.com

        // Requirement 1: Add suggestion when '@' is typed and input doesn't end with "gmail.com"
        if (atIndex !== -1 && atIndex === inputValueLength - 1 && !inputValue.endsWith(suggestion) && !inputValue.includes('@gmail.com')) {
            this.value += suggestion; // Add suggestion only if not already present
        }

        // Auto-Detection (Requirement 1)
        let isEmail = false;
        let isNumber = false;
        if (atIndex !== -1 && atIndex !== 0 && atIndex !== inputValueLength - 1 && !inputValue.endsWith(suggestion)) {
            // Check if input contains '@' symbol and not at the beginning or end
            isEmail = true;
        } else if (/^\d+$/.test(inputValue)) {
            // Check if input contains only digits
            isNumber = true;
        }

        // Error Handling (Requirement 2)
        let errorMessage = '';
        if (!isEmail && !isNumber) {
            errorMessage = 'Invalid input. Please enter a valid email or a number.';
        } else if (isEmail && atIndex === -1) {
            errorMessage = 'Invalid email format. Please include "@" symbol.';
        } else if (isEmail && inputValue.endsWith(suggestion)) {
            errorMessage = 'Invalid email format. Please remove the suggested domain.';
        }

        // Display error message if any
        if (errorMessage !== '') {
            // You can display this message to the user, for example, in an error box or below the input field.
            console.log(errorMessage);
            return;
        }

        // Smart Validation (Requirement 3)
        if (isEmail) {
            // Validate email format
            if (!isValidEmail(inputValue)) {
                console.log('Invalid email format. Please enter a valid email.');
                return;
            }
        }

        // Processing based on type (email/number)
        if (isEmail) {
            // Process email input
            console.log('Email input:', inputValue);
        } else if (isNumber) {
            // Process number input
            // Replace '0' with '92' if it's the first character
            if (inputValue.charAt(0) === '0') {
                inputValue = '92' + inputValue.substring(1);
            }
            // Add '92' automatically if number starts with '3' and has 10 digits
            else if (inputValue.startsWith('3') && inputValue.length === 10) {
                inputValue = '92' + inputValue;
            }
            // If '+' occurs at the beginning and input is numeric, remove '+' when numeric part reaches length 10
            else if (inputValue.startsWith('+') && /^\d{10}$/.test(inputValue.substring(1))) {
                inputValue = inputValue.substring(1); // Remove the '+' prefix
            }
            console.log('Number input:', inputValue);
        }

        // Requirement 2: Validate input start
        let startsWithValid = false;
        let firstChar = inputValue.charAt(0);
        let validStartsWith = ['+92', '92', '03', '3']; // Include '92' here

        if (/^[a-zA-Z0-9]+$/.test(firstChar) || validStartsWith.includes(inputValue.substring(0, 2))) {
            // Check if the first character is an alphabet, number, or if it starts with one of the valid prefixes
            startsWithValid = true;
        }

        // If not starting with a valid prefix or alphabet, clear input
        if (!startsWithValid || !/^[a-zA-Z0-9@.]+$/.test(inputValue)) {
            // Added regex check for alphanumeric characters
            this.value = '';
            return;
        }

        // Requirement 3, 4, 5, 6: Validate remaining input based on start
        let remainingLength;
        switch (inputValue.substring(0, 2)) {
            case '+9':
                remainingLength = 12;
                break;
            case '92':
                remainingLength = 12;
                break;
            case '03':
                remainingLength = 13;
                break;
            case '3':
                remainingLength = 8;
                break;
            default:
                remainingLength = undefined;
                break;
        }

        // If input starts with a number, limit length to 12 characters
        if (/^\d+$/.test(inputValue.substring(0, 1))) {
            remainingLength = 12;
        }

        // Truncate input if length exceeds the allowed limit
        if (remainingLength && inputValueLength > 2 && inputValueLength !== remainingLength) {
            this.value = inputValue.substring(0, remainingLength);
        }
    });

    // Email validation function
    function isValidEmail(email) {
        // Your email validation logic here
        // Example: You can use a regular expression to validate email format
        // Adapt this regex as needed for your specific requirements
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Event listener to check for backspace/delete
    document.getElementById('login_email').addEventListener('keydown', function(event) {
        let inputValue = this.value;
        let atIndex = inputValue.indexOf('@');
        let suggestion = 'gmail.com';

        // If backspace is pressed and input ends with "gmail.com", remove it directly
        if (event.key === 'Backspace' && inputValue.endsWith(suggestion)) {
            this.value = inputValue.slice(0, -suggestion.length);
            event.preventDefault(); // Prevent default behavior of removing individual characters
        }
    });
</script>
