@props(['title' => '', 'subtitle' => '', 'description' => ''])
<section class="pt-24 pb-12 bg-gray-800">
    <div class="container mx-auto px-4">
        <div class="text-center animation-fade-in">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">
                {{ $title }} <span class="gradient-text">{{ $subtitle }}</span>
            </h1>
            <p class="text-gray-300 max-w-3xl mx-auto text-lg">
                {{ $description }}
            </p>
        </div>
    </div>
</section>
