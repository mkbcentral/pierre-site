document.addEventListener('DOMContentLoaded', function() {
    // Mobile Menu Toggle with enhanced animation
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const menuIcon = mobileMenuBtn ? mobileMenuBtn.querySelector('i') : null;

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('show');

            // Toggle icon between bars and times
            if (menuIcon) {
                menuIcon.classList.toggle('fa-bars');
                menuIcon.classList.toggle('fa-times');
            }
        });

        // Close menu when clicking a mobile menu link
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.remove('show');
                if (menuIcon) {
                    menuIcon.classList.add('fa-bars');
                    menuIcon.classList.remove('fa-times');
                }
            });
        });
    }

    // Navbar scroll effect
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }

    // Highlight active nav link based on scroll position
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');
    const mobileLinks = document.querySelectorAll('.mobile-menu-link');

    function highlightNavOnScroll() {
        const scrollY = window.pageYOffset;

        sections.forEach(section => {
            const sectionHeight = section.offsetHeight;
            const sectionTop = section.offsetTop - 100;
            const sectionId = section.getAttribute('id');

            if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${sectionId}`) {
                        link.classList.add('active');
                    }
                });

                // Also update mobile menu links
                mobileLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${sectionId}`) {
                        link.classList.add('active');
                    }
                });
            }
        });

        // Add subtle animation to active link
        document.querySelectorAll('.nav-link.active, .mobile-menu-link.active').forEach(activeLink => {
            activeLink.style.animation = 'none';
            setTimeout(() => {
                activeLink.style.animation = 'pulse 2s infinite';
            }, 10);
        });
    }

    window.addEventListener('scroll', highlightNavOnScroll);

    // Enhanced animations for homepage elements

    // Add shine effect to gradient texts
    const gradientTexts = document.querySelectorAll('.gradient-text');
    gradientTexts.forEach(text => {
        text.addEventListener('mouseover', () => {
            text.style.animationDuration = '1.5s';
        });

        text.addEventListener('mouseout', () => {
            text.style.animationDuration = '4s';
        });
    });

    // Initialize Counter Animation
    const counters = document.querySelectorAll('.counter');

    // Stats counter enhanced animation
    function animateCountersWithBounce() {
        counters.forEach(counter => {
            const target = +counter.dataset.target;
            const count = +counter.innerText;
            const increment = target / 100;

            if (count < target) {
                counter.innerText = Math.ceil(count + increment);

                // Add bounce effect on milestone numbers
                if (count % Math.floor(target/10) < increment) {
                    counter.classList.add('counted');
                    setTimeout(() => {
                        counter.classList.remove('counted');
                    }, 600);
                }

                setTimeout(animateCountersWithBounce, 20);
            } else {
                counter.innerText = target;
                counter.classList.add('counted');
            }
        });
    }

    // Replace original counter animation with enhanced version
    if (counters.length && isInViewport(counters[0]) && counters[0].innerText === '0') {
        animateCountersWithBounce();
    }

    // Add reveal animation for sections
    const revealElements = document.querySelectorAll('section > div > *');
    revealElements.forEach(el => {
        el.classList.add('reveal-up');
    });

    function revealOnScroll() {
        revealElements.forEach(el => {
            if (isInViewport(el) && !el.classList.contains('revealed')) {
                setTimeout(() => {
                    el.classList.add('revealed');
                }, 100);
            }
        });
    }

    // Initial reveal check
    revealOnScroll();

    // Check for reveals on scroll
    window.addEventListener('scroll', revealOnScroll);

    // Testimonial Slider
    const sliderTrack = document.querySelector('.testimonial-track');
    const sliderItems = document.querySelectorAll('.testimonial-item');
    const prevBtn = document.querySelector('.testimonial-nav.prev');
    const nextBtn = document.querySelector('.testimonial-nav.next');
    const dotsContainer = document.querySelector('.testimonial-dots');

    if (sliderTrack && sliderItems.length) {
        let currentIndex = 0;
        const itemWidth = 100; // Percentage width
        const itemsPerView = window.innerWidth < 768 ? 1 : window.innerWidth < 1024 ? 2 : 3;
        const maxIndex = Math.max(0, sliderItems.length - itemsPerView);

        // Create dots
        for (let i = 0; i <= maxIndex; i++) {
            const dot = document.createElement('div');
            dot.classList.add('testimonial-dot');
            if (i === 0) dot.classList.add('active');
            dot.addEventListener('click', () => {
                goToSlide(i);
            });
            dotsContainer.appendChild(dot);
        }

        // Update dots
        function updateDots() {
            document.querySelectorAll('.testimonial-dot').forEach((dot, index) => {
                if (index === currentIndex) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }

        // Go to specific slide
        function goToSlide(index) {
            currentIndex = index;
            const offset = -index * (itemWidth / itemsPerView);
            sliderTrack.style.transform = `translateX(${offset}%)`;
            updateDots();
        }

        // Next slide
        function nextSlide() {
            if (currentIndex < maxIndex) {
                goToSlide(currentIndex + 1);
            } else {
                goToSlide(0); // Loop to start
            }
        }

        // Previous slide
        function prevSlide() {
            if (currentIndex > 0) {
                goToSlide(currentIndex - 1);
            } else {
                goToSlide(maxIndex); // Loop to end
            }
        }

        // Event listeners
        if (nextBtn) nextBtn.addEventListener('click', nextSlide);
        if (prevBtn) prevBtn.addEventListener('click', prevSlide);

        // Auto slide
        let slideInterval = setInterval(nextSlide, 5000);

        // Pause on hover
        sliderTrack.addEventListener('mouseenter', () => {
            clearInterval(slideInterval);
        });

        sliderTrack.addEventListener('mouseleave', () => {
            slideInterval = setInterval(nextSlide, 5000);
        });

        // Update slider on window resize
        window.addEventListener('resize', () => {
            const newItemsPerView = window.innerWidth < 768 ? 1 : window.innerWidth < 1024 ? 2 : 3;
            if (newItemsPerView !== itemsPerView) {
                location.reload(); // Simple solution - reload page on breakpoint change
            }
        });
    }

    // Contact Form
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Simple validation
            let valid = true;
            const requiredFields = contactForm.querySelectorAll('[required]');

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    valid = false;
                    field.classList.add('border-red-500');
                } else {
                    field.classList.remove('border-red-500');
                }
            });

            if (valid) {
                // Simulate form submission
                const submitBtn = contactForm.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Envoi en cours...';
                submitBtn.disabled = true;

                setTimeout(() => {
                    // Show success message
                    contactForm.innerHTML = `
                        <div class="bg-green-500/20 border border-green-500 rounded-lg p-6 text-center">
                            <i class="fas fa-check-circle text-green-400 text-4xl mb-4"></i>
                            <h3 class="text-xl font-bold mb-2">Message envoyé avec succès!</h3>
                            <p class="text-gray-300 mb-0">Nous vous contacterons dans les plus brefs délais.</p>
                        </div>
                    `;
                }, 1500);
            }
        });

        // Live validation
        const inputs = contactForm.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.hasAttribute('required') && !this.value.trim()) {
                    this.classList.add('border-red-500');
                } else {
                    this.classList.remove('border-red-500');
                }
            });
        });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                const navHeight = document.querySelector('nav').offsetHeight;
                const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - navHeight;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Search functionality
    function initSearch() {
        // Formation data - this could be loaded from an API in a real application
        const formations = [
            {
                title: "Fondamentaux des Cryptomonnaies",
                category: "crypto",
                description: "Maîtrisez les bases des cryptomonnaies, de la blockchain et des technologies décentralisées.",
                level: "DÉBUTANT",
                url: "formations.html#crypto-fundamentals"
            },
            {
                title: "Data Science Appliquée",
                category: "data",
                description: "Apprenez à extraire des insights à partir de données massives avec les techniques modernes d'analyse.",
                level: "INTERMÉDIAIRE",
                url: "formations.html#data-science"
            },
            {
                title: "Trading Algorithmique",
                category: "trading",
                description: "Créez vos propres stratégies de trading automatisées en combinant analyse technique et apprentissage machine.",
                level: "AVANCÉ",
                url: "formations.html#algo-trading"
            },
            {
                title: "DeFi et Finance Décentralisée",
                category: "crypto",
                description: "Explorez l'univers de la finance décentralisée et apprenez à utiliser les protocoles DeFi.",
                level: "INTERMÉDIAIRE",
                url: "formations.html#defi"
            },
            {
                title: "Intelligence Artificielle et Deep Learning",
                category: "data",
                description: "Maîtrisez les techniques avancées d'IA et apprenez à construire des modèles de deep learning.",
                level: "AVANCÉ",
                url: "formations.html#ai-deep-learning"
            },
            {
                title: "Développement Blockchain",
                category: "dev",
                description: "Apprenez à développer des applications décentralisées (dApps) et des smart contracts.",
                level: "INTERMÉDIAIRE",
                url: "formations.html#blockchain-dev"
            },
            {
                title: "Analyse Technique des Marchés Crypto",
                category: "trading",
                description: "Maîtrisez les fondamentaux de l'analyse technique pour prendre des décisions éclairées.",
                level: "DÉBUTANT",
                url: "formations.html#technical-analysis"
            },
            {
                title: "Big Data et Technologies Cloud",
                category: "data",
                description: "Apprenez à traiter et analyser de vastes ensembles de données à l'aide des plateformes cloud.",
                level: "INTERMÉDIAIRE",
                url: "formations.html#big-data"
            },
            {
                title: "Développement d'Applications Crypto",
                category: "dev",
                description: "Concevez et développez des applications mobiles et web intégrant les technologies blockchain.",
                level: "AVANCÉ",
                url: "formations.html#crypto-apps"
            }
        ];

        // Setup search inputs
        const searchInput = document.getElementById('searchInput');
        const mobileSearchInput = document.getElementById('mobileSearchInput');
        const searchResults = document.getElementById('searchResults');
        const mobileSearchResults = document.getElementById('mobileSearchResults');

        if (!searchInput || !searchResults) return;

        // Function to perform search
        function performSearch(query, resultsElement) {
            // Clear previous results
            resultsElement.innerHTML = '';

            if (query.length < 2) {
                resultsElement.classList.add('hidden');
                return;
            }

            // Filter formations based on query
            const results = formations.filter(formation => {
                const searchText = `${formation.title} ${formation.description} ${formation.category} ${formation.level}`.toLowerCase();
                return searchText.includes(query.toLowerCase());
            });

            // Show results container
            resultsElement.classList.remove('hidden');

            // Display results or no results message
            if (results.length > 0) {
                results.forEach(formation => {
                    const resultItem = document.createElement('div');
                    resultItem.className = 'search-result-item';

                    // Highlight matching text
                    const regex = new RegExp(`(${query})`, 'gi');
                    const highlightedTitle = formation.title.replace(regex, '<span class="search-highlight">$1</span>');

                    resultItem.innerHTML = `
                        <div class="font-bold">${highlightedTitle}</div>
                        <div class="text-sm text-gray-300 mt-1">${formation.description}</div>
                        <div class="flex items-center justify-between mt-2">
                            <span class="text-xs bg-opacity-20 px-2 py-1 rounded-full"
                                  style="background-color: rgba(${formation.category === 'crypto' ? '59, 130, 246' :
                                                              formation.category === 'data' ? '139, 92, 246' :
                                                              formation.category === 'trading' ? '16, 185, 129' : '99, 102, 241'}, 0.2);
                                         color: ${formation.category === 'crypto' ? '#60a5fa' :
                                                formation.category === 'data' ? '#a78bfa' :
                                                formation.category === 'trading' ? '#34d399' : '#818cf8'}">
                                ${formation.category.toUpperCase()}
                            </span>
                            <span class="text-xs text-gray-400">${formation.level}</span>
                        </div>
                    `;

                    // Add click event to navigate to formation
                    resultItem.addEventListener('click', () => {
                        window.location.href = formation.url;
                    });

                    resultsElement.appendChild(resultItem);
                });
            } else {
                const noResults = document.createElement('div');
                noResults.className = 'search-no-results';
                noResults.textContent = 'Aucune formation trouvée';
                resultsElement.appendChild(noResults);
            }
        }

        // Event listeners for desktop search
        searchInput.addEventListener('input', () => {
            performSearch(searchInput.value, searchResults);
        });

        // Close search results when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.search-container')) {
                searchResults.classList.add('hidden');
                if (mobileSearchResults) {
                    mobileSearchResults.classList.add('hidden');
                }
            }
        });

        // Mobile search if exists
        if (mobileSearchInput && mobileSearchResults) {
            mobileSearchInput.addEventListener('input', () => {
                performSearch(mobileSearchInput.value, mobileSearchResults);
            });
        }

        // Focus search input when pressing Ctrl+K or Cmd+K
        document.addEventListener('keydown', (e) => {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                searchInput.focus();
            }
        });
    }

    // Initialize search
    initSearch();

    // Enhanced hero animations
    const heroImage = document.querySelector('.hero-image-container');
    if (heroImage) {
        // Add parallax effect
        window.addEventListener('mousemove', (e) => {
            const mouseX = e.clientX / window.innerWidth - 0.5;
            const mouseY = e.clientY / window.innerHeight - 0.5;

            heroImage.style.transform = `translate(${mouseX * -20}px, ${mouseY * -20}px)`;
        });

        // Reset transform when mouse leaves
        document.querySelector('.hero-section').addEventListener('mouseleave', () => {
            heroImage.style.transform = 'translate(0, 0)';
        });
    }

    // Animate crypto symbols with random movements
    const cryptoSymbols = document.querySelectorAll('.crypto-symbols i');
    cryptoSymbols.forEach((symbol, index) => {
        symbol.style.animationDelay = `${index * 0.5}s`;

        // Random movements
        setInterval(() => {
            const randomX = Math.floor(Math.random() * 10) - 5;
            const randomY = Math.floor(Math.random() * 10) - 5;
            symbol.style.transform = `translate(${randomX}px, ${randomY}px) rotate(${randomX * 3}deg)`;
        }, 3000);
    });

    // Add hover effects to testimonial cards
    const testimonialItems = document.querySelectorAll('.testimonial-item');
    testimonialItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            item.querySelector('.bg-gray-800').style.transform = 'translateY(-10px)';
        });

        item.addEventListener('mouseleave', () => {
            item.querySelector('.bg-gray-800').style.transform = 'translateY(0)';
        });
    });

    // Add typing effect to the main heading
    const mainHeading = document.querySelector('.hero-section h1');
    if (mainHeading) {
        // Remove this typing effect as it's causing issues with the gradient span
    }

    // Enhance CTA buttons with ripple effect
    const ctaButtons = document.querySelectorAll('.btn-primary, .btn-secondary');
    ctaButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            this.appendChild(ripple);

            const x = e.clientX - e.target.getBoundingClientRect().left;
            const y = e.clientY - e.target.getBoundingClientRect().top;

            ripple.style.left = `${x}px`;
            ripple.style.top = `${y}px`;

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Check if element is in viewport
    function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.bottom >= 0
        );
    }

    // Initialize animations when scrolling
    function handleScrollAnimations() {
        // Check if counter section is visible to start counter
        if (counters.length && isInViewport(counters[0]) && counters[0].innerText === '0') {
            animateCountersWithBounce();
        }

        // Animate elements when they enter viewport
        document.querySelectorAll('.animation-fade-in, .animation-fade-in-up').forEach(item => {
            if (isInViewport(item) && !item.classList.contains('animated')) {
                let delay = item.getAttribute('data-delay') || 0;
                setTimeout(() => {
                    item.classList.add('animated');
                    item.style.animationPlayState = 'running';
                }, delay);
            }
        });
    }

    // Initial check for animations
    handleScrollAnimations();

    // Check for animations on scroll
    window.addEventListener('scroll', handleScrollAnimations);
});
