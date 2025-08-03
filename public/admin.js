document.addEventListener('DOMContentLoaded', function() {
    const currentLanguage = localStorage.getItem('language') || 'fr';
    
    // Sidebar navigation functionality
    const navItems = document.querySelectorAll('.admin-nav-item');
    const tabContents = document.querySelectorAll('.admin-tab-content');
    const pageTitle = document.getElementById('pageTitle');
    const pageSubtitle = document.getElementById('pageSubtitle');
    
    // Page titles and subtitles
    const pageInfo = {
        dashboard: {
            title: { fr: 'Tableau de bord', en: 'Dashboard' },
            subtitle: { fr: 'Vue d\'ensemble de votre académie', en: 'Overview of your academy' }
        },
        users: {
            title: { fr: 'Utilisateurs', en: 'Users' },
            subtitle: { fr: 'Gérer les comptes utilisateurs', en: 'Manage user accounts' }
        },
        courses: {
            title: { fr: 'Formations', en: 'Courses' },
            subtitle: { fr: 'Gérer le contenu des formations', en: 'Manage course content' }
        },
        payments: {
            title: { fr: 'Paiements', en: 'Payments' },
            subtitle: { fr: 'Suivi des transactions', en: 'Track transactions' }
        },
        analytics: {
            title: { fr: 'Analytiques', en: 'Analytics' },
            subtitle: { fr: 'Statistiques et rapports', en: 'Statistics and reports' }
        },
        settings: {
            title: { fr: 'Paramètres', en: 'Settings' },
            subtitle: { fr: 'Configuration du site', en: 'Site configuration' }
        }
    };
    
    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const targetTab = this.getAttribute('data-tab');
            
            // Remove active class from all nav items
            navItems.forEach(nav => nav.classList.remove('active'));
            
            // Add active class to clicked nav item
            this.classList.add('active');
            
            // Hide all tab contents
            tabContents.forEach(content => {
                content.classList.add('hidden');
            });
            
            // Show target tab content
            const targetContent = document.getElementById(targetTab + '-tab');
            if (targetContent) {
                targetContent.classList.remove('hidden');
            }
            
            // Update page title and subtitle
            if (pageInfo[targetTab]) {
                pageTitle.innerHTML = `<span data-fr="${pageInfo[targetTab].title.fr}" data-en="${pageInfo[targetTab].title.en}">${pageInfo[targetTab].title[currentLanguage]}</span>`;
                pageSubtitle.innerHTML = `<span data-fr="${pageInfo[targetTab].subtitle.fr}" data-en="${pageInfo[targetTab].subtitle.en}">${pageInfo[targetTab].subtitle[currentLanguage]}</span>`;
                
                // Trigger animation
                pageTitle.style.animation = 'none';
                pageSubtitle.style.animation = 'none';
                
                setTimeout(() => {
                    pageTitle.style.animation = 'slideInDown 0.5s ease-out forwards';
                    pageSubtitle.style.animation = 'slideInDown 0.5s ease-out 0.1s forwards';
                }, 10);
            }
        });
    });
    
    // User search functionality
    const userSearch = document.getElementById('userSearch');
    const userFilter = document.getElementById('userFilter');
    
    if (userSearch) {
        userSearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const userRows = document.querySelectorAll('#usersTableBody tr');
            
            userRows.forEach(row => {
                const userName = row.querySelector('td:first-child').textContent.toLowerCase();
                const userEmail = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                
                if (userName.includes(searchTerm) || userEmail.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
    
    if (userFilter) {
        userFilter.addEventListener('change', function() {
            const filterValue = this.value;
            const userRows = document.querySelectorAll('#usersTableBody tr');
            
            userRows.forEach(row => {
                const status = row.querySelector('td:nth-child(4) span').textContent.toLowerCase();
                
                if (filterValue === 'all' || 
                    (filterValue === 'active' && status === 'actif') ||
                    (filterValue === 'inactive' && status === 'inactif') ||
                    (filterValue === 'premium' && status === 'premium')) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
    
    // Initialize course management
    let courses = JSON.parse(localStorage.getItem('admin_courses')) || [
        {
            id: 'crypto-fundamentals',
            title: { fr: 'Fondamentaux des Cryptomonnaies', en: 'Cryptocurrency Fundamentals' },
            description: { fr: 'Maîtrisez les bases des cryptomonnaies', en: 'Master cryptocurrency basics' },
            category: 'crypto',
            level: 'beginner',
            price: 599,
            duration: '8 semaines',
            spots: 20,
            image: 'crypto-fundamentals.png',
            chapters: [
                {
                    id: 1,
                    title: { fr: 'Introduction à la Blockchain', en: 'Introduction to Blockchain' },
                    description: { fr: 'Découvrez les concepts fondamentaux', en: 'Discover fundamental concepts' },
                    duration: '45 min',
                    videoUrl: 'https://example.com/video1.mp4'
                },
                {
                    id: 2,
                    title: { fr: 'Bitcoin et Cryptomonnaies', en: 'Bitcoin and Cryptocurrencies' },
                    description: { fr: 'Comprendre Bitcoin et les principales cryptomonnaies', en: 'Understanding Bitcoin and major cryptocurrencies' },
                    duration: '50 min',
                    videoUrl: 'https://example.com/video2.mp4'
                }
            ]
        },
        {
            id: 'data-science',
            title: { fr: 'Data Science Appliquée', en: 'Applied Data Science' },
            description: { fr: 'Apprenez à extraire des insights', en: 'Learn to extract insights' },
            category: 'data',
            level: 'intermediate',
            price: 899,
            duration: '12 semaines',
            spots: 15,
            image: 'data-science.png',
            chapters: [
                {
                    id: 1,
                    title: { fr: 'Introduction à Python', en: 'Introduction to Python' },
                    description: { fr: 'Bases de Python pour l\'analyse', en: 'Python basics for analysis' },
                    duration: '55 min',
                    videoUrl: 'https://example.com/video3.mp4'
                }
            ]
        },
        {
            id: 'algorithmic-trading',
            title: { fr: 'Trading Algorithmique', en: 'Algorithmic Trading' },
            description: { fr: 'Créez vos stratégies de trading', en: 'Create your trading strategies' },
            category: 'trading',
            level: 'advanced',
            price: 1299,
            duration: '16 semaines',
            spots: 10,
            image: 'algorithmic-trading.png',
            chapters: [
                {
                    id: 1,
                    title: { fr: 'Analyse Technique', en: 'Technical Analysis' },
                    description: { fr: 'Fondamentaux de l\'analyse technique', en: 'Technical analysis fundamentals' },
                    duration: '50 min',
                    videoUrl: 'https://example.com/video4.mp4'
                }
            ]
        }
    ];

    // Course management functions
    function saveCourses() {
        localStorage.setItem('admin_courses', JSON.stringify(courses));
    }

    function renderCourses() {
        const coursesGrid = document.getElementById('coursesGrid');
        if (!coursesGrid) return;

        coursesGrid.innerHTML = '';

        courses.forEach(course => {
            const levelColors = {
                beginner: 'bg-blue-500',
                intermediate: 'bg-yellow-500',
                advanced: 'bg-red-500'
            };

            const categoryColors = {
                crypto: 'text-blue-400',
                data: 'text-purple-400',
                trading: 'text-green-400',
                blockchain: 'text-yellow-400'
            };

            const courseCard = document.createElement('div');
            courseCard.className = 'bg-gray-700 rounded-lg p-6 hover:bg-gray-600 transition-colors';
            courseCard.innerHTML = `
                <div class="flex items-center justify-between mb-4">
                    <span class="${levelColors[course.level]}/90 text-white px-2 py-1 rounded-full text-xs">${course.level}</span>
                    <div class="flex space-x-2">
                        <button class="edit-course-btn text-blue-400 hover:text-blue-300 transition-colors" data-course-id="${course.id}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="delete-course-btn text-red-400 hover:text-red-300 transition-colors" data-course-id="${course.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="flex items-center mb-3">
                    <img src="${course.image}" alt="${course.title[currentLanguage]}" class="w-16 h-16 rounded-lg object-cover mr-4">
                    <div>
                        <h4 class="font-bold text-lg">${course.title[currentLanguage]}</h4>
                        <p class="text-gray-400 text-sm">${course.duration} • ${course.chapters.length} chapitres</p>
                    </div>
                </div>
                <p class="text-gray-300 text-sm mb-4">${course.description[currentLanguage]}</p>
                <div class="flex items-center justify-between">
                    <span class="${categoryColors[course.category]} font-bold text-xl">${course.price}€</span>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-400">
                            <i class="fas fa-users mr-1"></i>
                            ${course.spots} places
                        </span>
                        <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs">Actif</span>
                    </div>
                </div>
            `;

            coursesGrid.appendChild(courseCard);
        });

        // Add event listeners for edit and delete buttons
        document.querySelectorAll('.edit-course-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const courseId = this.getAttribute('data-course-id');
                openEditCourseModal(courseId);
            });
        });

        document.querySelectorAll('.delete-course-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const courseId = this.getAttribute('data-course-id');
                deleteCourse(courseId);
            });
        });
    }

    function generateCourseId(title) {
        return title.toLowerCase()
            .replace(/[^a-z0-9]/g, '-')
            .replace(/-+/g, '-')
            .replace(/^-|-$/g, '');
    }

    function createChapterHTML(chapter = null, container = 'chaptersContainer') {
        const chapterIndex = document.querySelectorAll(`#${container} .chapter-item`).length;
        const chapterDiv = document.createElement('div');
        chapterDiv.className = 'chapter-item bg-gray-700 rounded-lg p-4 border border-gray-600';
        
        chapterDiv.innerHTML = `
            <div class="flex justify-between items-center mb-3">
                <h4 class="font-bold text-lg">
                    <i class="fas fa-play-circle text-blue-400 mr-2"></i>
                    Chapitre ${chapterIndex + 1}
                </h4>
                <button type="button" class="remove-chapter-btn text-red-400 hover:text-red-300 transition-colors">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Titre (Français)</label>
                    <input type="text" class="form-input chapter-title-fr" value="${chapter ? chapter.title.fr : ''}" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Titre (Anglais)</label>
                    <input type="text" class="form-input chapter-title-en" value="${chapter ? chapter.title.en : ''}" required>
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Description (Français)</label>
                    <textarea class="form-input chapter-desc-fr" rows="2" required>${chapter ? chapter.description.fr : ''}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Description (Anglais)</label>
                    <textarea class="form-input chapter-desc-en" rows="2" required>${chapter ? chapter.description.en : ''}</textarea>
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Durée</label>
                    <input type="text" class="form-input chapter-duration" value="${chapter ? chapter.duration : ''}" placeholder="ex: 45 min" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">URL Vidéo</label>
                    <input type="url" class="form-input chapter-video" value="${chapter ? chapter.videoUrl : ''}" placeholder="https://example.com/video.mp4" required>
                </div>
            </div>
        `;

        // Add remove chapter functionality
        chapterDiv.querySelector('.remove-chapter-btn').addEventListener('click', function() {
            chapterDiv.remove();
            updateChapterNumbers(container);
        });

        return chapterDiv;
    }

    function updateChapterNumbers(container) {
        const chapters = document.querySelectorAll(`#${container} .chapter-item`);
        chapters.forEach((chapter, index) => {
            chapter.querySelector('h4').innerHTML = `
                <i class="fas fa-play-circle text-blue-400 mr-2"></i>
                Chapitre ${index + 1}
            `;
        });
    }

    function openEditCourseModal(courseId) {
        const course = courses.find(c => c.id === courseId);
        if (!course) return;

        const editModal = document.getElementById('editCourseModal');
        
        // Fill form with course data
        document.getElementById('editCourseId').value = course.id;
        document.getElementById('editCourseTitleFr').value = course.title.fr;
        document.getElementById('editCourseTitleEn').value = course.title.en;
        document.getElementById('editCourseDescFr').value = course.description.fr;
        document.getElementById('editCourseDescEn').value = course.description.en;
        document.getElementById('editCourseCategory').value = course.category;
        document.getElementById('editCourseLevel').value = course.level;
        document.getElementById('editCoursePrice').value = course.price;
        document.getElementById('editCourseDuration').value = course.duration;
        document.getElementById('editCourseSpots').value = course.spots;
        document.getElementById('editCourseImage').value = course.image;

        // Clear and populate chapters
        const chaptersContainer = document.getElementById('editChaptersContainer');
        chaptersContainer.innerHTML = '';

        course.chapters.forEach(chapter => {
            const chapterElement = createChapterHTML(chapter, 'editChaptersContainer');
            chaptersContainer.appendChild(chapterElement);
        });

        editModal.classList.remove('hidden');
    }

    function deleteCourse(courseId) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cette formation ?')) {
            courses = courses.filter(c => c.id !== courseId);
            saveCourses();
            renderCourses();
            showNotification('Formation supprimée avec succès', 'success');
        }
    }

    // Quick actions
    const quickActionButtons = document.querySelectorAll('.bg-blue-600, .bg-green-600, .bg-purple-600, .bg-orange-600');
    
    quickActionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const actionText = this.textContent.trim();
            showNotification(`Action "${actionText}" en cours...`, 'info');
            
            // Simulate action delay
            setTimeout(() => {
                showNotification(`Action "${actionText}" terminée!`, 'success');
            }, 2000);
        });
    });
    
    // Delete confirmations
    const deleteButtons = document.querySelectorAll('.text-red-400');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
                const row = this.closest('tr');
                if (row) {
                    row.style.opacity = '0.5';
                    setTimeout(() => {
                        row.remove();
                        showNotification('Élément supprimé avec succès', 'success');
                    }, 500);
                }
            }
        });
    });
    
    // Logout functionality
    const logoutBtn = document.getElementById('logoutBtn');
    
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function() {
            if (confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
                localStorage.removeItem('adminLoggedIn');
                window.location.href = 'index.html';
            }
        });
    }
    
    // Mobile sidebar functionality
    function initializeMobileSidebar() {
        const sidebar = document.querySelector('.admin-sidebar');
        const content = document.querySelector('.admin-content');
        const mobileToggle = document.getElementById('mobileAdminToggle');
        
        // Create backdrop
        const backdrop = document.createElement('div');
        backdrop.className = 'admin-sidebar-backdrop';
        document.body.appendChild(backdrop);
        
        // Toggle sidebar function
        function toggleSidebar() {
            const isOpen = sidebar.classList.contains('open');
            
            if (isOpen) {
                sidebar.classList.remove('open');
                backdrop.classList.remove('active');
                mobileToggle.innerHTML = '<i class="fas fa-bars text-white"></i>';
                mobileToggle.classList.remove('active');
                document.body.style.overflow = '';
            } else {
                sidebar.classList.add('open');
                backdrop.classList.add('active');
                mobileToggle.innerHTML = '<i class="fas fa-times text-white"></i>';
                mobileToggle.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        }
        
        // Close sidebar function
        function closeSidebar() {
            sidebar.classList.remove('open');
            backdrop.classList.remove('active');
            mobileToggle.innerHTML = '<i class="fas fa-bars text-white"></i>';
            mobileToggle.classList.remove('active');
            document.body.style.overflow = '';
        }
        
        // Event listeners
        if (mobileToggle) {
            mobileToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                toggleSidebar();
            });
        }
        
        backdrop.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeSidebar();
        });
        
        // Enhanced nav item click handling for mobile
        const navItems = document.querySelectorAll('.admin-nav-item');
        navItems.forEach(item => {
            // Remove existing event listeners to prevent conflicts
            item.removeEventListener('click', item.clickHandler);
            
            // Create new click handler
            item.clickHandler = function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const targetTab = this.getAttribute('data-tab');
                
                // Remove active class from all nav items
                navItems.forEach(nav => nav.classList.remove('active'));
                
                // Add active class to clicked nav item
                this.classList.add('active');
                
                // Hide all tab contents
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                });
                
                // Show target tab content
                const targetContent = document.getElementById(targetTab + '-tab');
                if (targetContent) {
                    targetContent.classList.remove('hidden');
                }
                
                // Update page title and subtitle
                if (pageInfo[targetTab]) {
                    pageTitle.innerHTML = `<span data-fr="${pageInfo[targetTab].title.fr}" data-en="${pageInfo[targetTab].title.en}">${pageInfo[targetTab].title[currentLanguage]}</span>`;
                    pageSubtitle.innerHTML = `<span data-fr="${pageInfo[targetTab].subtitle.fr}" data-en="${pageInfo[targetTab].subtitle.en}">${pageInfo[targetTab].subtitle[currentLanguage]}</span>`;
                    
                    // Trigger animation
                    pageTitle.style.animation = 'none';
                    pageSubtitle.style.animation = 'none';
                    
                    setTimeout(() => {
                        pageTitle.style.animation = 'slideInDown 0.5s ease-out forwards';
                        pageSubtitle.style.animation = 'slideInDown 0.5s ease-out 0.1s forwards';
                    }, 10);
                }
                
                // Close sidebar on mobile after selection
                if (window.innerWidth <= 1024) {
                    setTimeout(() => {
                        closeSidebar();
                    }, 200);
                }
            };
            
            // Add enhanced event listeners for mobile
            item.addEventListener('click', item.clickHandler);
            item.addEventListener('touchstart', item.clickHandler);
            
            // Add visual feedback for touch
            item.addEventListener('touchstart', function(e) {
                this.style.backgroundColor = 'rgba(59, 130, 246, 0.25)';
            });
            
            item.addEventListener('touchend', function(e) {
                setTimeout(() => {
                    this.style.backgroundColor = '';
                }, 150);
            });
        });
        
        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth > 1024) {
                closeSidebar();
            }
        });
        
        // Close sidebar on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && sidebar.classList.contains('open')) {
                closeSidebar();
            }
        });
        
        // Prevent body scroll when sidebar is open
        sidebar.addEventListener('touchmove', function(e) {
            if (sidebar.classList.contains('open')) {
                e.preventDefault();
            }
        }, { passive: false });
    }
    
    // Initialize mobile sidebar
    initializeMobileSidebar();
    
    // Responsive table functionality
    function makeTablesResponsive() {
        const tables = document.querySelectorAll('.admin-table');
        
        tables.forEach(table => {
            // Add horizontal scroll for mobile
            const container = table.closest('.overflow-x-auto');
            if (container) {
                container.style.overflowX = 'auto';
                container.style.webkitOverflowScrolling = 'touch';
            }
            
            // Add mobile-friendly row highlighting
            const rows = table.querySelectorAll('tbody tr');
            rows.forEach(row => {
                row.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        // Remove highlight from other rows
                        rows.forEach(r => r.classList.remove('bg-blue-900/20'));
                        // Add highlight to clicked row
                        this.classList.add('bg-blue-900/20');
                    }
                });
            });
        });
    }
    
    // Make tables responsive
    makeTablesResponsive();
    
    // Responsive modal handling
    function handleModalResize() {
        const modals = document.querySelectorAll('.fixed.inset-0');
        
        modals.forEach(modal => {
            const modalContent = modal.querySelector('.bg-gray-800');
            if (modalContent) {
                // Adjust modal size based on screen
                const updateModalSize = () => {
                    if (window.innerWidth <= 768) {
                        modalContent.style.maxWidth = '95vw';
                        modalContent.style.maxHeight = '95vh';
                        modalContent.style.margin = '0.5rem';
                    } else if (window.innerWidth <= 1024) {
                        modalContent.style.maxWidth = '90vw';
                        modalContent.style.maxHeight = '90vh';
                        modalContent.style.margin = '1rem';
                    } else {
                        modalContent.style.maxWidth = '';
                        modalContent.style.maxHeight = '';
                        modalContent.style.margin = '';
                    }
                };
                
                updateModalSize();
                window.addEventListener('resize', updateModalSize);
            }
        });
    }
    
    // Handle modal resize
    handleModalResize();
    
    // Responsive grid adjustments
    function adjustGridsForMobile() {
        const grids = document.querySelectorAll('.grid');
        
        grids.forEach(grid => {
            if (window.innerWidth <= 640) {
                // Force single column on very small screens
                grid.style.gridTemplateColumns = '1fr';
            } else if (window.innerWidth <= 768) {
                // Adjust columns for tablet
                if (grid.classList.contains('md:grid-cols-4')) {
                    grid.style.gridTemplateColumns = 'repeat(2, 1fr)';
                } else if (grid.classList.contains('md:grid-cols-3')) {
                    grid.style.gridTemplateColumns = 'repeat(2, 1fr)';
                } else if (grid.classList.contains('lg:grid-cols-3')) {
                    grid.style.gridTemplateColumns = '1fr';
                }
            } else {
                // Reset for larger screens
                grid.style.gridTemplateColumns = '';
            }
        });
    }
    
    // Adjust grids on load and resize
    adjustGridsForMobile();
    window.addEventListener('resize', adjustGridsForMobile);
    
    // Responsive form handling
    function optimizeFormsForMobile() {
        const forms = document.querySelectorAll('form');
        
        forms.forEach(form => {
            const inputs = form.querySelectorAll('input, textarea, select');
            
            inputs.forEach(input => {
                if (window.innerWidth <= 640) {
                    // Improve mobile input experience
                    input.style.fontSize = '16px'; // Prevent zoom on iOS
                    input.style.padding = '0.75rem';
                } else {
                    input.style.fontSize = '';
                    input.style.padding = '';
                }
            });
        });
    }
    
    // Optimize forms
    optimizeFormsForMobile();
    window.addEventListener('resize', optimizeFormsForMobile);
    
    // Touch-friendly interactions
    function addTouchFriendlyInteractions() {
        const buttons = document.querySelectorAll('button, .btn-primary, .btn-secondary');
        
        buttons.forEach(button => {
            // Add touch feedback
            button.addEventListener('touchstart', function() {
                this.style.transform = 'scale(0.95)';
            });
            
            button.addEventListener('touchend', function() {
                this.style.transform = '';
            });
        });
        
        // Add swipe gesture for closing mobile sidebar
        let startX = 0;
        let currentX = 0;
        
        const sidebar = document.querySelector('.admin-sidebar');
        
        if (sidebar) {
            sidebar.addEventListener('touchstart', function(e) {
                startX = e.touches[0].clientX;
            });
            
            sidebar.addEventListener('touchmove', function(e) {
                currentX = e.touches[0].clientX;
                const diff = startX - currentX;
                
                if (diff > 50 && window.innerWidth <= 1024) {
                    // Swipe left to close
                    sidebar.classList.remove('open');
                    document.querySelector('.admin-sidebar-backdrop').classList.remove('active');
                    document.querySelector('.mobile-admin-toggle').classList.remove('active');
                    document.querySelector('.mobile-admin-toggle').innerHTML = '<i class="fas fa-bars"></i>';
                    document.body.style.overflow = '';
                }
            });
        }
    }
    
    // Add touch interactions
    addTouchFriendlyInteractions();
    
    // Enhanced notification system for mobile
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        
        // Adjust notification position for mobile
        const isMobile = window.innerWidth <= 768;
        const baseClasses = `fixed px-4 py-3 rounded-lg shadow-lg z-50 ${
            type === 'success' ? 'bg-green-500' : 
            type === 'error' ? 'bg-red-500' : 
            type === 'warning' ? 'fa-exclamation-triangle' : 'bg-blue-500'
        } text-white`;
        
        notification.className = isMobile ? 
            `${baseClasses} top-4 left-4 right-4 text-sm` : 
            `${baseClasses} top-4 right-4 max-w-md`;
        
        notification.innerHTML = `
            <div class="flex items-center ${isMobile ? 'justify-center' : ''}">
                <i class="fas ${
                    type === 'success' ? 'fa-check' : 
                    type === 'error' ? 'fa-times' : 
                    type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info'
                } mr-2"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Auto remove after 4 seconds
        setTimeout(() => {
            notification.remove();
        }, 4000);
    }
    
    // Auto-refresh data every 30 seconds
    setInterval(function() {
        refreshDashboardData();
    }, 30000);
    
    function refreshDashboardData() {
        // Simulate data refresh
        const statsElements = document.querySelectorAll('.text-3xl.font-bold');
        
        statsElements.forEach(element => {
            const currentValue = parseInt(element.textContent.replace(/[^\d]/g, ''));
            const newValue = currentValue + Math.floor(Math.random() * 10);
            
            if (element.textContent.includes('€')) {
                element.textContent = '€' + newValue.toLocaleString();
            } else {
                element.textContent = newValue.toLocaleString();
            }
        });
    }
    
    // Initialize with dashboard active
    const dashboardNav = document.querySelector('.admin-nav-item[data-tab="dashboard"]');
    if (dashboardNav) {
        dashboardNav.classList.add('active');
    }
    
    // Show dashboard tab by default
    document.getElementById('dashboard-tab').classList.remove('hidden');
    
    // Simulate real-time updates
    setInterval(function() {
        const recentActivity = document.querySelector('#dashboard-tab .space-y-4');
        if (recentActivity) {
            // Add new activity (simulate)
            const activities = [
                { icon: 'fa-user-plus', bg: 'bg-green-500', title: 'Nouvelle inscription', desc: 'Un nouvel utilisateur s\'est inscrit', time: 'Il y a 1 min' },
                { icon: 'fa-euro-sign', bg: 'bg-blue-500', title: 'Nouveau paiement', desc: 'Paiement de 599€ reçu', time: 'Il y a 2 min' },
                { icon: 'fa-graduation-cap', bg: 'bg-purple-500', title: 'Formation terminée', desc: 'Un étudiant a terminé sa formation', time: 'Il y a 3 min' }
            ];
            
            const randomActivity = activities[Math.floor(Math.random() * activities.length)];
            
            const activityElement = document.createElement('div');
            activityElement.className = 'flex items-center p-3 bg-gray-700 rounded-lg';
            activityElement.innerHTML = `
                <div class="w-10 h-10 ${randomActivity.bg} rounded-full flex items-center justify-center mr-3">
                    <i class="fas ${randomActivity.icon} text-white"></i>
                </div>
                <div class="flex-1">
                    <p class="font-medium">${randomActivity.title}</p>
                    <p class="text-sm text-gray-400">${randomActivity.desc}</p>
                </div>
                <span class="text-xs text-gray-500">${randomActivity.time}</span>
            `;
            
            recentActivity.insertBefore(activityElement, recentActivity.firstChild);
            
            // Remove old activities (keep only 5)
            const activities_list = recentActivity.children;
            if (activities_list.length > 5) {
                recentActivity.removeChild(activities_list[activities_list.length - 1]);
            }
        }
    }, 60000); // Update every minute

    // Modal event listeners
    const addCourseBtn = document.getElementById('addCourseBtn');
    const addCourseModal = document.getElementById('addCourseModal');
    const editCourseModal = document.getElementById('editCourseModal');
    const closeCourseModal = document.getElementById('closeCourseModal');
    const closeEditModal = document.getElementById('closeEditModal');
    const cancelCourse = document.getElementById('cancelCourse');
    const cancelEditCourse = document.getElementById('cancelEditCourse');
    const addChapterBtn = document.getElementById('addChapterBtn');
    const addEditChapterBtn = document.getElementById('addEditChapterBtn');
    const courseForm = document.getElementById('courseForm');
    const editCourseForm = document.getElementById('editCourseForm');

    if (addCourseBtn) {
        addCourseBtn.addEventListener('click', function() {
            addCourseModal.classList.remove('hidden');
        });
    }

    if (closeCourseModal) {
        closeCourseModal.addEventListener('click', function() {
            addCourseModal.classList.add('hidden');
        });
    }

    if (closeEditModal) {
        closeEditModal.addEventListener('click', function() {
            editCourseModal.classList.add('hidden');
        });
    }

    if (cancelCourse) {
        cancelCourse.addEventListener('click', function() {
            addCourseModal.classList.add('hidden');
        });
    }

    if (cancelEditCourse) {
        cancelEditCourse.addEventListener('click', function() {
            editCourseModal.classList.add('hidden');
        });
    }

    if (addChapterBtn) {
        addChapterBtn.addEventListener('click', function() {
            const chaptersContainer = document.getElementById('chaptersContainer');
            const chapterElement = createChapterHTML();
            chaptersContainer.appendChild(chapterElement);
        });
    }

    if (addEditChapterBtn) {
        addEditChapterBtn.addEventListener('click', function() {
            const chaptersContainer = document.getElementById('editChaptersContainer');
            const chapterElement = createChapterHTML(null, 'editChaptersContainer');
            chaptersContainer.appendChild(chapterElement);
        });
    }

    if (courseForm) {
        courseForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(courseForm);
            const chapters = [];
            
            // Collect chapter data
            document.querySelectorAll('#chaptersContainer .chapter-item').forEach((chapterElement, index) => {
                const chapter = {
                    id: index + 1,
                    title: {
                        fr: chapterElement.querySelector('.chapter-title-fr').value,
                        en: chapterElement.querySelector('.chapter-title-en').value
                    },
                    description: {
                        fr: chapterElement.querySelector('.chapter-desc-fr').value,
                        en: chapterElement.querySelector('.chapter-desc-en').value
                    },
                    duration: chapterElement.querySelector('.chapter-duration').value,
                    videoUrl: chapterElement.querySelector('.chapter-video').value
                };
                chapters.push(chapter);
            });

            const newCourse = {
                id: generateCourseId(document.getElementById('courseTitleFr').value),
                title: {
                    fr: document.getElementById('courseTitleFr').value,
                    en: document.getElementById('courseTitleEn').value
                },
                description: {
                    fr: document.getElementById('courseDescFr').value,
                    en: document.getElementById('courseDescEn').value
                },
                category: document.getElementById('courseCategory').value,
                level: document.getElementById('courseLevel').value,
                price: parseFloat(document.getElementById('coursePrice').value),
                duration: document.getElementById('courseDuration').value,
                spots: parseInt(document.getElementById('courseSpots').value),
                image: document.getElementById('courseImage').value,
                chapters: chapters
            };

            courses.push(newCourse);
            saveCourses();
            renderCourses();
            
            addCourseModal.classList.add('hidden');
            courseForm.reset();
            document.getElementById('chaptersContainer').innerHTML = '';
            
            showNotification('Formation créée avec succès', 'success');
        });
    }

    if (editCourseForm) {
        editCourseForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const courseId = document.getElementById('editCourseId').value;
            const courseIndex = courses.findIndex(c => c.id === courseId);
            
            if (courseIndex === -1) return;
            
            const chapters = [];
            
            // Collect chapter data
            document.querySelectorAll('#editChaptersContainer .chapter-item').forEach((chapterElement, index) => {
                const chapter = {
                    id: index + 1,
                    title: {
                        fr: chapterElement.querySelector('.chapter-title-fr').value,
                        en: chapterElement.querySelector('.chapter-title-en').value
                    },
                    description: {
                        fr: chapterElement.querySelector('.chapter-desc-fr').value,
                        en: chapterElement.querySelector('.chapter-desc-en').value
                    },
                    duration: chapterElement.querySelector('.chapter-duration').value,
                    videoUrl: chapterElement.querySelector('.chapter-video').value
                };
                chapters.push(chapter);
            });

            // Update course
            courses[courseIndex] = {
                ...courses[courseIndex],
                title: {
                    fr: document.getElementById('editCourseTitleFr').value,
                    en: document.getElementById('editCourseTitleEn').value
                },
                description: {
                    fr: document.getElementById('editCourseDescFr').value,
                    en: document.getElementById('editCourseDescEn').value
                },
                category: document.getElementById('editCourseCategory').value,
                level: document.getElementById('editCourseLevel').value,
                price: parseFloat(document.getElementById('editCoursePrice').value),
                duration: document.getElementById('editCourseDuration').value,
                spots: parseInt(document.getElementById('editCourseSpots').value),
                image: document.getElementById('editCourseImage').value,
                chapters: chapters
            };

            saveCourses();
            renderCourses();
            
            editCourseModal.classList.add('hidden');
            
            showNotification('Formation modifiée avec succès', 'success');
        });
    }

    // Initialize courses when courses tab is active
    const coursesNavItem = document.querySelector('.admin-nav-item[data-tab="courses"]');
    if (coursesNavItem) {
        coursesNavItem.addEventListener('click', function() {
            setTimeout(() => {
                renderCourses();
            }, 100);
        });
    }

    // Initial render if on courses tab
    if (document.getElementById('courses-tab') && !document.getElementById('courses-tab').classList.contains('hidden')) {
        renderCourses();
    }
});