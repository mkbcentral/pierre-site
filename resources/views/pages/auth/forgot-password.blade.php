<x-layouts.guest>
    <x-layouts.guest>
        <!-- Login Section -->
        <section class="min-h-screen flex items-center py-16">
            <div class="container mx-auto px-4">
                <div class="auth-container py-10 animation-fade-in">
                    <div class="auth-card">
                        <div class="auth-header">
                            <h1 class="text-3xl font-bold mb-2">Réinitialiser le mot de passe</h1>
                            <p class="text-gray-400">Entrez votre adresse e-mail pour recevoir un lien de
                                réinitialisation.</p>
                        </div>

                        <div class="p-8">
                            <!-- Forgot Password Form -->
                            <form id="forgotPasswordForm" class="space-y-6" action="{{ route('password.email') }}"
                                method="POST">
                                @csrf
                                <div>
                                    <label for="email" class="block mb-2 text-gray-200">Adresse e-mail</label>
                                    <input type="email" id="email" name="email" class="form-input"
                                        placeholder="Votre adresse e-mail" required autofocus>
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                @if (session('status'))
                                    <div class="text-green-500 text-sm mb-4">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <button type="submit" class="btn-primary w-full">
                                    Envoyer le lien de réinitialisation
                                    <i class="fas fa-paper-plane ml-2"></i>
                                </button>
                            </form>

                            <div class="text-center mt-6">
                                <p class="text-gray-400">
                                    Retour à la connexion
                                    <a href="{{ route('login') }}" class="text-blue-400 hover:underline">Se
                                        connecter</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x-layouts.guest>

</x-layouts.guest>
