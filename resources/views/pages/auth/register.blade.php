<x-layouts.guest>
    <!-- Signup Section -->
    <section class="min-h-screen flex items-center py-16">
        <div class="container mx-auto px-4">
            <div class="auth-container py-10 animation-fade-in">
                <div class="auth-card">
                    <div class="auth-header">
                        <h1 class="text-3xl font-bold mb-2">Créer un compte</h1>
                        <p class="text-gray-400">Rejoignez la communauté {{ config('app.name') }}</p>
                    </div>
                    <div class="p-8">
                        <x-widget.sociality />
                        <!-- Divider -->
                        <div class="divider">
                            <span>ou</span>
                        </div>

                        <!-- Signup Form -->
                        <form id="signupForm" class="space-y-6" action="{{ route('register') }}" method="POST">
                            @csrf
                            <div>
                                <label for="fullName" class="block mb-2 text-gray-200">Votre nom complet</label>
                                <input type="text" id="fullName" name="name" class="form-input"
                                    placeholder="Votre nom complet" value="{{ old('name') }}">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="phone" class="block mb-2 text-gray-200">Votre numéro de téléphone</label>
                                <input type="text" id="phone" name="phone" class="form-input"
                                    placeholder="Votre numéro de téléphone" value="{{ old('phone') }}">
                                @error('phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block mb-2 text-gray-200">Email</label>
                                <input type="email" id="email" name="email" class="form-input"
                                    placeholder="votre@email.com" value="{{ old('email') }}">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block mb-2 text-gray-200">Mot de passe</label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" class="form-input pr-10"
                                        placeholder="Minimum 8 caractères">
                                    <span
                                        class="toggle-password absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <div class="mt-2">
                                    <div
                                        class="password-strength w-full h-1.5 bg-gray-700 rounded-full overflow-hidden">
                                        <div
                                            class="password-strength-bar h-full bg-red-500 w-0 transition-all duration-300">
                                        </div>
                                    </div>
                                    <p class="password-strength-text text-xs text-gray-400 mt-1">Force du mot de passe
                                    </p>
                                </div>
                            </div>

                            <div>
                                <label for="confirmPassword" class="block mb-2 text-gray-200">Confirmer le mot de
                                    passe</label>
                                <div class="relative">
                                    <input type="password" id="confirmPassword" name="password_confirmation"
                                        class="form-input pr-10" placeholder="Confirmer votre mot de passe">
                                    <span
                                        class="toggle-confirm-password absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                                @error('password_confirmation')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn-primary w-full">
                                Créer mon compte
                                <i class="fas fa-user-plus ml-2"></i>
                            </button>
                        </form>

                        <div class="text-center mt-6">
                            <p class="text-gray-400">
                                Déjà inscrit?
                                <a href="{{ route('login') }}" class="text-blue-400 hover:underline">Se connecter</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Toggle password visibility
                const togglePassword = document.querySelector('.toggle-password');
                const passwordInput = document.getElementById('password');

                if (togglePassword && passwordInput) {
                    togglePassword.addEventListener('click', function() {
                        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                        passwordInput.setAttribute('type', type);

                        // Toggle icon
                        this.querySelector('i').classList.toggle('fa-eye');
                        this.querySelector('i').classList.toggle('fa-eye-slash');
                    });
                }

                // Toggle confirm password visibility
                const toggleConfirmPassword = document.querySelector('.toggle-confirm-password');
                const confirmPasswordInput = document.getElementById('confirmPassword');

                if (toggleConfirmPassword && confirmPasswordInput) {
                    toggleConfirmPassword.addEventListener('click', function() {
                        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' :
                            'password';
                        confirmPasswordInput.setAttribute('type', type);

                        // Toggle icon
                        this.querySelector('i').classList.toggle('fa-eye');
                        this.querySelector('i').classList.toggle('fa-eye-slash');
                    });
                }

                // Password strength meter
                if (passwordInput) {
                    const strengthBar = document.querySelector('.password-strength-bar');
                    const strengthText = document.querySelector('.password-strength-text');

                    passwordInput.addEventListener('input', function() {
                        const password = this.value;
                        let strength = 0;

                        if (password.length >= 8) strength += 1;
                        if (password.match(/[A-Z]/)) strength += 1;
                        if (password.match(/[0-9]/)) strength += 1;
                        if (password.match(/[^A-Za-z0-9]/)) strength += 1;

                        // Update strength bar
                        switch (strength) {
                            case 0:
                                strengthBar.style.width = '0%';
                                strengthBar.className = 'password-strength-bar h-full bg-red-500';
                                strengthText.textContent = 'Force du mot de passe';
                                break;
                            case 1:
                                strengthBar.style.width = '25%';
                                strengthBar.className = 'password-strength-bar h-full bg-red-500';
                                strengthText.textContent = 'Faible';
                                break;
                            case 2:
                                strengthBar.style.width = '50%';
                                strengthBar.className = 'password-strength-bar h-full bg-yellow-500';
                                strengthText.textContent = 'Moyen';
                                break;
                            case 3:
                                strengthBar.style.width = '75%';
                                strengthBar.className = 'password-strength-bar h-full bg-blue-500';
                                strengthText.textContent = 'Bon';
                                break;
                            case 4:
                                strengthBar.style.width = '100%';
                                strengthBar.className = 'password-strength-bar h-full bg-green-500';
                                strengthText.textContent = 'Excellent';
                                break;
                        }
                    });
                }
            });
        </script>
    @endpush
</x-layouts.guest>
