@extends('layout.app', ['hasHeader' => false, 'hasFooter' => false])

@section('content')
<div class="flex justify-center min-h-screen bg-gray-100 items-center">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="text-xl font-bold mb-4">{{ __('Reset Password') }}</div>

            <form id="resetPasswordForm" method="POST" action="{{ route('password.update.new') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div id="passwordFields">
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Password') }}</label>
                        <input id="password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div id="errorMessage" style="display: none;" class="text-red-500 mt-4">{{ __('كلمة المرور غير متشابه') }}</div>
                <div id="successMessage" style="display: none;" class="text-green-500 mt-4">{{ __('تم تغير كلمة المرور بنجاح') }}</div>

                <div class="flex items-center justify-between">
                    <button id="resetPasswordBtn" type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#resetPasswordForm').submit(function(event) {
            event.preventDefault();
            var password = $('#password').val();
            var confirmPassword = $('#password-confirm').val();

            if (password !== confirmPassword) {
                $('#errorMessage').show();
                return;
            }

            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    $('#passwordFields').remove();
                    $('#successMessage').show();
                    $('#errorMessage').hide();
                    $('#resetPasswordBtn').hide();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    var errorMessage = '';
                    if (xhr.responseJSON && xhr.responseJSON.errors && xhr.responseJSON.errors.length > 0) {
                        errorMessage = xhr.responseJSON.errors[0].message;
                    } else {
                        errorMessage = 'An error occurred while processing your request.';
                    }
                    $('#errorMessage').text(errorMessage).show();
                    $('#successMessage').hide();
                }
            });
        });
    });
</script>
@endsection
