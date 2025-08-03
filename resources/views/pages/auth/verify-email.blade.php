<x-layouts.guest>
    <x-layouts.guest>
        <!-- Email Verification Section -->
        <section class="min-h-screen flex items-center py-16">
            <div class="container mx-auto px-4">
                <div class="auth-container py-10 animation-fade-in">
                    <div class="auth-card">
                        <div class="auth-header">
                            <h1 class="text-3xl font-bold mb-2">Vérification de l'adresse e-mail</h1>
                            <p class="text-gray-400">
                                Merci de vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous
                                envoyer.
                                Si vous n'avez pas reçu l'e-mail, nous pouvons vous en envoyer un nouveau.
                            </p>
                        </div>

                        <div class="p-8">
                            @if (session('status') == 'verification-link-sent')
                                <div class="text-green-500 text-sm mb-4">
                                    Un nouveau lien de vérification a été envoyé à votre adresse e-mail.
                                </div>
                            @endif

                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <button type="submit" class="btn-primary w-full">
                                    Renvoyer l'e-mail de vérification
                                    <i class="fas fa-paper-plane ml-2"></i>
                                </button>
                            </form>

                            <div class="text-center mt-6">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-blue-400 hover:underline">
                                        Se déconnecter
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x-layouts.guest>

</x-layouts.guest>
