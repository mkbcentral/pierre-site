@php
    $trainings = App\Models\Training::query()
        ->where('status', App\Enums\TrainingStatusType::PUBLISHED)
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();
@endphp
<!-- Catégories Section -->
<section class="py-12 bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16 animation-fade-in">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Nos recentes Formations</h2>
            <p class="text-gray-300 max-w-3xl mx-auto">Choisissez parmi nos programmes spécialisés conçus pour vous
                donner les compétences recherchées par les entreprises innovantes.</p>
        </div>

        <!-- Formations Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 formation-grid">
            @foreach ($trainings as $training)
                <!-- Formation 1 -->
                <div class="formation-card bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-blue-900/30 transition-all hover:-translate-y-2 animation-fade-in-up"
                    data-category="crypto">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-400 h-3"></div>
                    <div class="formation-image h-48 overflow-hidden">
                        <img src="{{ asset('storage/' . $training->cover_image) }}" alt="{{ $training->title }}"
                            class="w-full h-full object-cover object-center">
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div class="rounded-full bg-blue-500/20 w-14 h-14 flex items-center justify-center">
                                <i class="fas fa-coins text-blue-400 text-2xl"></i>
                            </div>
                            <span
                                class="bg-blue-500/20 text-blue-400 text-xs uppercase font-bold px-3 py-1 rounded-full">
                                {{ $training->level }}
                            </span>
                        </div>
                        <h3 class="text-xl font-bold mb-3">{{ $training->title }}</h3>
                        <p class="text-gray-300 mb-4">{{ $training->description }}</p>
                        <ul class="mb-6 space-y-2 text-gray-300">
                            @foreach ($training->chapters as $chapter)
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-400 mr-2"></i>
                                    {{ $chapter->title }}
                                </li>
                            @endforeach
                        </ul>
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="text-center">
                                <span class="text-3xl font-extrabold text-blue-400 block mb-1">
                                    {{ number_format($training->price, 0, ',', ' ') }} USD
                                </span>
                                <span class="text-gray-400 text-sm">8 semaines · 3 heures/semaine</span>
                            </div>
                            <a href="{{ route('page.training.create.subscription', $training) }}"
                                class="btn-sm w-full sm:w-auto text-center">
                                Commencer
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex justify-center my-12">
            <a href="{{ route('page.training.list') }}  " class="btn-secondary inline-flex items-center">
                Voir plus
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>
