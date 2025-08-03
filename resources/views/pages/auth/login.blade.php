<x-layouts.guest>
    <!-- Login Section -->
    <section class="min-h-screen flex items-center py-16">
        <div class="container mx-auto px-4">
            <div class="auth-container py-10 animation-fade-in">
                <div class="auth-card">
                    <div class="auth-header">
                        <h1 class="text-3xl font-bold mb-2">Connexion</h1>
                        <p class="text-gray-400">Accédez à votre espace apprenant</p>
                    </div>

                    <div class="p-8">
                        <x-widget.sociality />
                        <!-- Divider -->
                        <div class="divider">
                            <span>ou</span>
                        </div>

                        <!-- Login Form -->
                        <form id="loginForm" class="space-y-6" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div>
                                <label for="email" class="block mb-2 text-gray-200">Email</label>
                                <input type="email" name="email" id="email" class="form-input"
                                    placeholder="votre@email.com">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block mb-2 text-gray-200">Mot de passe</label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" class="form-input pr-10"
                                        placeholder="••••••••">
                                    <span
                                        class="toggle-password absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <div class="flex justify-end mt-2">
                                    <a href="{{ route('password.request') }}"
                                        class="text-sm text-blue-400 hover:underline">Mot de passe
                                        oublié?</a>
                                </div>
                            </div>

                            <div class="flex items-center mb-4">
                                <input type="checkbox" id="remember" name="remember"
                                    class="accent-blue-400 h-4 w-4 rounded border-gray-300 focus:ring-2 focus:ring-blue-400 transition-all duration-150 mr-2">
                                <label for="remember"
                                    class="text-gray-300 text-sm select-none cursor-pointer hover:text-blue-300 transition-colors duration-150">Se
                                    souvenir de moi</label>
                            </div>

                            <button type="submit" class="btn-primary w-full">
                                Se connecter
                                <i class="fas fa-sign-in-alt ml-2"></i>
                            </button>
                        </form>

                        <div class="text-center mt-6">
                            <p class="text-gray-400">
                                Pas encore de compte?
                                <a href="{{ route('register') }}" class="text-blue-400 hover:underline">Créer un
                                    compte</a>
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
            });
        </script>
    @endpush
</x-layouts.guest>
