@php
    $posts = App\Models\Post::query()
        ->where('status', App\Enums\StatusType::PUBLISHED)
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();
@endphp
<!-- Post section -->
<section class="py-12 bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16 animation-fade-in">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Nos recentes publications</h2>
            <p class="text-gray-300 max-w-3xl mx-auto">
                Découvrez nos dernières publications, sélectionnées pour vous tenir informé des nouveautés et tendances
                du secteur.
            </p>
        </div>
        <!-- Post Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 formation-grid">
            @foreach ($posts as $post)
                    <!-- Post infos -->
                    <div
                        class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
                        <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}"
                            class="w-full h-48 object-cover">
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-xl font-semibold mb-2 text-gray-900">{{ $post->title }}</h3>
                            <p class="text-gray-700 mb-4 flex-1">{{ Str::limit($post->excerpt ?? $post->content, 100) }}</p>
                            <a href="#" class="btn-primary mt-auto inline-block">Lire
                                la publication</a>
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
