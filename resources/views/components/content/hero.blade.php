<!-- Hero Section -->
<section id="accueil" class="hero-section min-h-screen flex items-center">
    <div class="floating-elements">
        <div class="floating-element" style="top: 10%; left: 5%; font-size: 2rem;">
            <i class="fas fa-bitcoin text-yellow-500"></i>
        </div>
        <div class="floating-element" style="top: 30%; left: 70%; font-size: 3rem; animation-delay: 2s;">
            <i class="fas fa-chart-line text-blue-500"></i>
        </div>
        <div class="floating-element" style="top: 70%; left: 20%; font-size: 2.5rem; animation-delay: 5s;">
            <i class="fas fa-database text-green-500"></i>
        </div>
        <div class="floating-element" style="top: 80%; left: 80%; font-size: 2rem; animation-delay: 8s;">
            <i class="fas fa-brain text-purple-500"></i>
        </div>
        <div class="floating-element" style="top: 40%; left: 40%; font-size: 3rem; animation-delay: 10s;">
            <i class="fab fa-ethereum text-purple-400"></i>
        </div>
    </div>
    <div class="container mx-auto px-4 py-20">
        <div class="grid md:grid-cols-2 gap-10 items-center">
            <div class="order-2 md:order-1 animation-fade-in-up">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                    <span class="gradient-text">Maîtrisez</span> la Crypto et la Data Science
                </h1>
                <p class="text-gray-300 text-lg mb-8 leading-relaxed">Acquérez des compétences de pointe dans les
                    domaines les plus demandés du marché. Nos formations combinent l'expertise en cryptomonnaies et en
                    analyse de données pour vous propulser vers l'avenir numérique.</p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('page.training.list') }}"
                        class="btn-primary transform hover:scale-105 transition-transform duration-300">
                        Découvrir nos formations
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                    <a href="{{ route('page.contact') }}"
                        class="btn-secondary transform hover:scale-105 transition-transform duration-300">
                        Nous contacter
                        <i class="fas fa-envelope ml-2"></i>
                    </a>
                </div>
            </div>
            <div
                class="order-1 md:order-2 text-center animation-fade-in flex items-center justify-center h-full w-full">
                <div class="hero-image-container relative w-full h-full flex items-center justify-center">
                    <!-- Decorative geometric shape (SVG) behind the image -->
                    <svg class="absolute -top-6 -left-6 w-full h-full z-0 max-w-xs md:max-w-md lg:max-w-lg"
                        viewBox="0 0 400 400" fill="none">
                        <defs>
                            <linearGradient id="grad1" x1="0" y1="0" x2="400" y2="400"
                                gradientUnits="userSpaceOnUse">
                                <stop stop-color="#6366F1" />
                                <stop offset="1" stop-color="#06B6D4" />
                            </linearGradient>
                        </defs>
                        <polygon points="200,20 380,120 320,380 80,380 20,120" fill="url(#grad1)" opacity="0.25" />
                    </svg>
                    <div x-data="{
                        images: [
                            '{{ asset('images/img-1.jpg') }}',
                            '{{ asset('images/img-2.jpg') }}',
                            '{{ asset('images/img-3.jpg') }}'
                        ],
                        current: 0
                    }" x-init="setInterval(() => { current = (current + 1) % images.length }, 3500)"
                        class="relative w-full mx-auto aspect-[3/2] max-w-xs sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl">
                        <template x-for="(img, idx) in images" :key="idx">
                            <img :src="img" alt="Hero Slide"
                                class="object-cover w-full h-full rounded-3xl shadow-2xl mx-auto absolute inset-0 transition-opacity duration-1000 ease-in-out"
                                :class="{
                                    'opacity-0 z-0': current !== idx,
                                    'opacity-90 z-10': current === idx
                                }"
                                x-show="current === idx" x-transition:enter="transition-opacity duration-1000"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-90"
                                x-transition:leave="transition-opacity duration-1000"
                                x-transition:leave-start="opacity-90" x-transition:leave-end="opacity-0"
                                style="will-change: opacity;" />
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
