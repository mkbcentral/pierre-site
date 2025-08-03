<x-layouts.main>
    <!-- Hero Section -->
    <x-content.training-hero title="" subtitle="Finaliser votre paiement"
        description="Choisissez votre mode de paiement et validez votre inscription." />
    <!-- Catégories Section -->
    <section class="py-12 bg-gray-900">
        <div class="container mx-auto px-4 flex justify-center">
            <!-- Payment Card -->
            <div class="w-full max-w-md">
                <div class="bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
                    <!-- Card Header -->
                    <div class="px-8 pt-8 pb-4 border-b border-gray-700 text-center">
                        <h2 class="text-2xl font-bold flex items-center gap-3 justify-center mb-2">
                            <i class="fas fa-credit-card text-blue-400"></i>
                            <span data-fr="Informations de paiement" data-en="Payment information">Informations de
                                paiement</span>
                        </h2>
                        <x-widget.flash-message />
                    </div>
                    <!-- Card Body -->
                    <div class="px-8 py-6">
                        <!-- Formation Information -->
                        <div class="mb-8">
                            <img src="{{ asset('storage/' . $training->cover_image) }}" alt="Formation"
                                class="w-full h-32 rounded-lg object-cover mb-4">
                            <h4 class="font-bold text-xl mb-1" id="courseTitle">{{ $training->title }}</h4>
                            <div class="flex flex-wrap gap-4 text-sm text-gray-400 mb-2">
                                <span data-fr="Accès à vie" data-en="Lifetime access">Accès à vie</span>
                                <span data-fr="Support" data-en="Support">Support</span>
                            </div>
                            <div class="text-lg font-bold text-green-400" id="coursePrice">
                                {{ $training->price }} USD
                            </div>
                        </div>
                        <!-- Payment Buttons -->
                        <div class="flex flex-col gap-4">
                            <form method="POST" action="{{ route('page.training.subscription.apply', $training) }}">
                                @csrf
                                <button type="submit"
                                    class="w-full px-6 py-3 bg-blue-500 text-white rounded-lg font-bold hover:bg-blue-600 transition">
                                    Payer
                                </button>
                            </form>
                            <a href="/"
                                class="w-full px-6 py-3 bg-gray-600 text-white rounded-lg font-bold hover:bg-gray-700 transition text-center">
                                Annuler
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.main>
