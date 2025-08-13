@php
    $tools = App\Models\Tool::all();
@endphp
<section class="py-12 px-4 bg-gradient-to-br from-[#3b82f6]/10 to-[#8b5cf6]/10">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-center mb-10 text-gray-300">🧰 Mes outils de formation</h2>

        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($tools as $tool)
                <!-- Carte outil -->
                <div
                    class="group bg-gray-300
                            rounded-2xl border
                            border-transparent
                            hover:border-blue-300
                            shadow transition transform
                            hover:-translate-y-2
                            hover:shadow-xl p-6
                            flex flex-col items-center
                            text-center duration-300">
                    <div class="text-5xl mb-4 transition-transform group-hover:scale-110">📝</div>
                    <p class="text-gray-500 text-sm mt-2 mb-4">Conférences vidéo en direct pour les cours.</p>
                    <h3 class="text-xl font-semibold text-gray-700">{{ $tool->name }}</h3>
                    <a href="/paiement/zoom"
                        class="mt-auto inline-block bg-gradient-to-r from-[#3b82f6] to-[#8b5cf6] text-white px-4 py-2 rounded-lg hover:opacity-90 transition">
                        Payer maintenant
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
