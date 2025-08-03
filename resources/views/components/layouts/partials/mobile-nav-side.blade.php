<div id="mobileMenu" class="md:hidden hidden bg-gray-800 pb-4">
    <div class="container mx-auto px-4 py-3">
        <div class="relative mb-4">
            <input type="text" placeholder="Rechercher..." class="admin-form-input pl-10 pr-4 py-2 w-full">
            <i class="fas fa-search absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
        </div>

        <div class="flex justify-between mb-4">
            <button class="admin-action-btn text-gray-400 hover:text-white">
                <i class="fas fa-bell"></i>
            </button>
            <button class="admin-action-btn text-gray-400 hover:text-white">
                <i class="fas fa-cog"></i>
            </button>
            <a href="index.html" class="admin-action-btn text-gray-400 hover:text-white">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </div>

        <div class="flex items-center space-x-3 mb-4">
            <div
                class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-xs font-bold">
                AD
            </div>
            <div>
                <p class="text-sm font-semibold">Admin</p>
            </div>
        </div>

        <ul class="space-y-2">
            <li>
                <a href="#" class="admin-sidebar-nav-item active" onclick="showContent('dashboard')">
                    <i class="fas fa-tachometer-alt w-6"></i>
                    <span>Tableau de bord</span>
                </a>
            </li>
            <li>
                <a href="#" class="admin-sidebar-nav-item" onclick="showContent('formations')">
                    <i class="fas fa-graduation-cap w-6"></i>
                    <span>Formations</span>
                </a>
            </li>
            <li>
                <a href="#" class="admin-sidebar-nav-item" onclick="showContent('utilisateurs')">
                    <i class="fas fa-users w-6"></i>
                    <span>Utilisateurs</span>
                </a>
            </li>
            <li>
                <a href="#" class="admin-sidebar-nav-item" onclick="showContent('categories')">
                    <i class="fas fa-tags w-6"></i>
                    <span>Catégories</span>
                </a>
            </li>
            <li>
                <a href="#" class="admin-sidebar-nav-item" onclick="showContent('lecons')">
                    <i class="fas fa-video w-6"></i>
                    <span>Leçons</span>
                </a>
            </li>
            <li class="pt-6 mt-6 border-t border-gray-700">
                <a href="#" class="admin-sidebar-nav-item" onclick="showContent('parametres')">
                    <i class="fas fa-cog w-6"></i>
                    <span>Paramètres du site</span>
                </a>
            </li>
        </ul>
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Menu Toggle
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');

            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // Sidebar Toggle
            const toggleSidebar = document.getElementById('toggleSidebar');
            const sidebar = document.querySelector('.admin-sidebar');

            if (toggleSidebar && sidebar) {
                toggleSidebar.addEventListener('click', function() {
                    sidebar.classList.toggle('admin-sidebar-collapsed');

                    // Update icon direction
                    const icon = this.querySelector('i');
                    if (sidebar.classList.contains('admin-sidebar-collapsed')) {
                        icon.classList.remove('fa-chevron-left');
                        icon.classList.add('fa-chevron-right');
                    } else {
                        icon.classList.remove('fa-chevron-right');
                        icon.classList.add('fa-chevron-left');
                    }
                });
            }

            // Content Section Navigation
            window.showContent = function(section) {
                // Hide all content sections
                const contentSections = document.querySelectorAll('.admin-content-section');
                contentSections.forEach(section => {
                    section.classList.add('hidden');
                });

                // Show selected section
                const selectedSection = document.getElementById(section + '-content');
                if (selectedSection) {
                    selectedSection.classList.remove('hidden');
                }

                // Update active nav item
                const navItems = document.querySelectorAll('.admin-sidebar-nav-item');
                navItems.forEach(item => {
                    item.classList.remove('active');
                });

                // Find the nav item that corresponds to the section and activate it
                const activeNav = document.querySelector(
                    `.admin-sidebar-nav-item[onclick="showContent('${section}')"]`);
                if (activeNav) {
                    activeNav.classList.add('active');
                }

                // Close mobile menu if open
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            };

            // New Formation Modal
            const newFormationBtn = document.getElementById('newFormationBtn');
            const newFormationModal = document.getElementById('newFormationModal');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const cancelFormationBtn = document.getElementById('cancelFormationBtn');
            const newFormationForm = document.getElementById('newFormationForm');

            if (newFormationBtn && newFormationModal) {
                newFormationBtn.addEventListener('click', function() {
                    newFormationModal.classList.remove('hidden');
                    // Add animation effect with a slight delay
                    setTimeout(() => {
                        newFormationModal.classList.add('show');
                    }, 10);
                });

                if (closeModalBtn) {
                    closeModalBtn.addEventListener('click', function() {
                        closeModal();
                    });
                }

                if (cancelFormationBtn) {
                    cancelFormationBtn.addEventListener('click', function() {
                        closeModal();
                    });
                }

                // Function to close modal with animation
                function closeModal() {
                    newFormationModal.classList.remove('show');
                    // Wait for animation to complete before hiding
                    setTimeout(() => {
                        newFormationModal.classList.add('hidden');
                    }, 300);
                }

                if (newFormationForm) {
                    newFormationForm.addEventListener('submit', function(e) {
                        e.preventDefault();

                        // Simulate form submission
                        const submitBtn = newFormationForm.querySelector('button[type="submit"]');
                        const originalText = submitBtn.innerHTML;
                        submitBtn.innerHTML =
                            '<i class="fas fa-spinner fa-spin mr-2"></i> Création en cours...';
                        submitBtn.disabled = true;

                        setTimeout(() => {
                            alert('Formation créée avec succès!');
                            closeModal();
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                            newFormationForm.reset();
                        }, 1500);
                    });
                }

                // Close modal when clicking outside
                newFormationModal.addEventListener('click', function(e) {
                    if (e.target === newFormationModal) {
                        closeModal();
                    }
                });
            }

            // Tab switching for settings
            const settingsTabs = document.querySelectorAll('.admin-tab');
            const settingsContents = document.querySelectorAll('.settings-tab');

            settingsTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    // Remove active class from all tabs
                    settingsTabs.forEach(t => t.classList.remove('active'));

                    // Add active class to clicked tab
                    tab.classList.add('active');

                    // Hide all settings content
                    settingsContents.forEach(content => content.classList.add('hidden'));

                    // Show selected settings content
                    const tabName = tab.getAttribute('data-tab');
                    const selectedContent = document.getElementById(`settings-${tabName}`);
                    if (selectedContent) {
                        selectedContent.classList.remove('hidden');
                    }
                });
            });
        });
    </script>
@endpush
