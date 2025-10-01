@php
    $trainings = App\Models\Training::query()
        ->with(['categoryTraining', 'chapters'])
        ->where('status', App\Enums\TrainingStatusType::PUBLISHED)
        ->orderBy('created_at', 'desc')
        ->get();
    $categories = App\Models\CategoryTraining::all();
@endphp
<x-layouts.main>
    <!-- Hero Section -->
    <x-content.training-hero title="Nos" subtitle="Formations"
        description="Découvrez notre catalogue complet de formations conçues pour vous propulser vers l'excellence dans les domaines de la cryptomonnaie et de la data science." />
    <!-- Catégories Section -->
    <section class="py-12 bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <button class="category-btn active" data-category="all">
                    Toutes les formations
                </button>
                @foreach ($categories as $category)
                    <button class="category-btn" data-category="{{ Str::slug($category->name) }}">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            <!-- Formations Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 formation-grid">
                @foreach ($trainings as $training)
                    <!-- Formation {{ $loop->iteration }} -->
                    <div class="formation-card bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-blue-900/30 transition-all hover:-translate-y-2 animation-fade-in-up"
                        data-category="{{ Str::slug($training->categoryTraining->name ?? 'autre') }}" <div
                        class="bg-gradient-to-r from-blue-600 to-blue-400 h-3"></div>
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
        <div></div>
        </div>
    </section>

    <x-content.cta />

    @push('styles')
        <style>
            .category-btn {
                @apply px-6 py-3 rounded-full text-gray-300 border border-gray-600 hover:border-blue-400 hover:text-blue-400 transition-all duration-300 cursor-pointer;
                background: rgba(31, 41, 55, 0.5);
            }

            .category-btn.active {
                @apply bg-blue-500 text-white border-blue-500;
                box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            }

            .formation-card {
                transition: all 0.3s ease-in-out;
            }

            .formation-grid {
                transition: opacity 0.3s ease-in-out;
            }
        </style>
    @endpush

    @push('scripts')
        <script type="module">
            document.addEventListener('DOMContentLoaded', function() {
                // Category filtering
                const categoryButtons = document.querySelectorAll('.category-btn');
                const formationCards = document.querySelectorAll('.formation-card');
                const formationGrid = document.querySelector('.formation-grid');

                categoryButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        // Remove active class from all buttons
                        categoryButtons.forEach(btn => btn.classList.remove('active'));

                        // Add active class to clicked button
                        button.classList.add('active');

                        // Get category to filter by
                        const category = button.getAttribute('data-category');

                        console.log('Filtering by category:', category);

                        // Add loading animation
                        formationGrid.style.opacity = '0.5';

                        // Filter cards with animation
                        setTimeout(() => {
                            let visibleCount = 0;
                            formationCards.forEach(card => {
                                const cardCategory = card.getAttribute('data-category');
                                if (category === 'all' || cardCategory === category) {
                                    card.style.display = 'block';
                                    card.style.opacity = '0';
                                    setTimeout(() => {
                                        card.style.opacity = '1';
                                    }, visibleCount * 50);
                                    visibleCount++;
                                } else {
                                    card.style.display = 'none';
                                }
                            });

                            // Show message if no cards found
                            if (visibleCount === 0 && category !== 'all') {
                                if (!document.querySelector('.no-results-message')) {
                                    const noResultsMsg = document.createElement('div');
                                    noResultsMsg.className =
                                        'no-results-message col-span-full text-center py-12';
                                    noResultsMsg.innerHTML = `
                                        <div class="text-gray-400">
                                            <i class="fas fa-search text-4xl mb-4"></i>
                                            <p class="text-xl mb-2">Aucune formation trouvée</p>
                                            <p>Il n'y a pas de formation dans cette catégorie pour le moment.</p>
                                        </div>
                                    `;
                                    formationGrid.appendChild(noResultsMsg);
                                }
                            } else {
                                // Remove no results message if it exists
                                const noResultsMsg = document.querySelector(
                                    '.no-results-message');
                                if (noResultsMsg) {
                                    noResultsMsg.remove();
                                }
                            }

                            formationGrid.style.opacity = '1';
                        }, 100);
                    });
                });
            });
        </script>
    @endpush
</x-layouts.main>
