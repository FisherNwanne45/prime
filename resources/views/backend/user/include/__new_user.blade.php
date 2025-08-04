<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content site-table-modal">
            <div class="modal-header">
                <h4 class="modal-title" id="userModalLabel">{{ __('Add New User') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.user.store') }}" method="POST">
                    @csrf
                    <div class="modal-form">
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <div class="single-field">
                                    <label class="box-label" for="first_name">{{ __('First Name') }}<span
                                            class="required-field">*</span></label>
                                    <input type="text" class="box-input" name="first_name" required>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="single-field">
                                    <label class="box-label" for="last_name">{{ __('Last Name') }}<span
                                            class="required-field">*</span></label>
                                    <input type="text" class="box-input" name="last_name" required>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="single-field">
                                    <label class="box-label" for="email">{{ __('Email') }}<span
                                            class="required-field">*</span></label>
                                    <input type="email" class="box-input" name="email" required>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="single-field">
                                    <label class="box-label" for="username">{{ __('Username') }}<span
                                            class="required-field">*</span></label>
                                    <input type="text" class="box-input" name="username" required>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="single-field">
                                    <label class="box-label" for="country">{{ __('Country') }}</label>
                                    <select name="country" class="box-input">
                                        @foreach(getCountries() as $country)
                                        <option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="single-field">
                                    <label class="box-label" for="phone">{{ __('Phone') }}</label>
                                    <input type="text" class="box-input" name="phone">
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="single-field">
                                    <label class="box-label" for="password">{{ __('Password') }}<span
                                            class="required-field">*</span></label>
                                    <input type="password" class="box-input" name="password" id="password" required>
                                    <small id="password-strength-text" style="display: block; margin-top: 5px;"></small>
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-6">
                                <div class="single-field">
                                    <label class="box-label"
                                        for="password_confirmation">{{ __('Confirm Password') }}<span
                                            class="required-field">*</span></label>
                                    <input type="password" class="box-input" name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="single-field">
                                    <label class="box-label" for="status">{{ __('Status') }}</label>
                                    <select name="status" class="box-input">
                                        <option value="1">{{ __('Active') }}</option>
                                        <option value="0">{{ __('Inactive') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="single-field">
                                    <label class="box-label" for="email_verified">{{ __('Email Verification') }}</label>
                                    <select name="email_verified" class="box-input">
                                        <option value="1">{{ __('Verified') }}</option>
                                        <option value="0">{{ __('Unverified') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="site-btn-sm primary-btn me-2">
                            <i icon-name="plus-circle"></i> {{ __('Create User') }}
                        </button>
                        <button type="button" class="site-btn-sm red-btn"
                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const strengthText = document.getElementById('password-strength-text');
        const form = document.querySelector('#userModal form');

        function getStrength(password) {
            let score = 0;
            if (password.length >= 8) score++;
            if (/[A-Z]/.test(password)) score++;
            if (/[a-z]/.test(password)) score++;
            if (/\d/.test(password)) score++;
            if (/[\W_]/.test(password)) score++;
            return score;
        }

        function updateStrengthIndicator(score) {
            const messages = ['Very Weak (User cannot be created)', 'Weak (User cannot be created)',
                'Fair (Manageable, try better combinations)', 'Strong', 'Very Strong'
            ];
            const colors = ['#d9534f', '#f0ad4e', '#5bc0de', '#5cb85c', '#4cae4c'];

            const level = Math.min(score - 1, messages.length - 1);
            strengthText.textContent = messages[level] || '';
            strengthText.style.color = colors[level] || '#000';
        }

        passwordInput.addEventListener('input', function() {
            const score = getStrength(passwordInput.value);
            updateStrengthIndicator(score);
        });

        form.addEventListener('submit', function(e) {
            const score = getStrength(passwordInput.value);
            if (score < 4) {
                e.preventDefault();
                alert(
                    'Please enter a stronger password (at least 8 characters, upper and lowercase, number, and symbol).'
                );
                passwordInput.focus();
            }
        });
    });
</script>