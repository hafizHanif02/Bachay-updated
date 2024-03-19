@extends('theme-views.layouts.app')

@section('title', translate('Customer Login'))

@push('css_or_js')
    <meta property="og:image" content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo']->value }}" />
    <meta property="og:title" content="Categories of {{ $web_config['name']->value }} " />
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:description"
        content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">
    <meta property="twitter:card" content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo']->value }}" />
    <meta property="twitter:title" content="Categories of {{ $web_config['name']->value }}" />
    <meta property="twitter:url" content="{{ env('APP_URL') }}">
    <meta property="twitter:description"
        content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">
@endpush
<style>
    /* .sign-in-cardbody{
        margin: 50px 0 100px 0;
    } */
</style>
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center pb-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="title text-center text-capitalize mb-3">{{ translate('sign_in') }}</h3>
                    <form action="{{ route('customer.auth.verify-token') }}" method="get" id="customer_login_modal" autocomplete="off">
                        @csrf
                        <div class="row g-3">
                            <div class="col-sm-12">
                                <label class="form-label form--label" for="login_email">{{ translate('email') }} / {{ translate('phone') }}</label>
                                <input type="text" class="form-control" name="user_id" id="login_email" value="{{ old('user_id') }}" placeholder="{{ translate('enter_email_or_phone_number') }}" required>
                                <small>Your phone format will be 923XXXXXXXXX</small>
                            </div>
                            <div class="col-sm-12 text-small">
                                <div class="d-flex justify-content-between gap-1">
                                    <label class="form-check m-0">
                                        <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class="form-check-label">{{ translate('remember_me') }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-12 text-small">
                                <button type="submit" class="btn btn-block btn-base text-capitalize">{{ translate('sign_in') }}</button>
                                <div class="text-center">
                                    @if ($web_config['social_login_text'])
                                        <div class="mt-32px mb-3">{{ translate('or_continue_with') }}</div>
                                    @endif
                                    <div class="d-flex mb-32px justify-content-center gap-4">
                                        @foreach ($web_config['socials_login'] as $socialLoginService)
                                            @if (isset($socialLoginService) && $socialLoginService['status'] == true)
                                                <a href="{{ route('customer.auth.service-login', $socialLoginService['login_medium']) }}">
                                                    <img loading="lazy" src="{{ theme_asset('assets/img/social/' . $socialLoginService['login_medium'] . '.svg') }}" alt="{{ translate('social') }}">
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="text-capitalize">{{ translate('enjoy_new_experience') }} <a href="{{ route('customer.auth.sign-up') }}" class="text-base" >{{ translate('sign_up') }}</a></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
@endsection


