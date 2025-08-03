<!-- Sidebar -->
<div class="hidden md:block admin-sidebar bg-gray-800 fixed top-0 left-0 h-full z-30" style="width: 260px;">
    <div class="p-4 pt-20">
        <div class="pb-4 mb-4 border-b border-gray-700">
            <button id="toggleSidebar"
                class="p-2 rounded-lg bg-gray-700 hover:bg-gray-600 w-full flex items-center justify-between">
                <span>Navigation</span>
                <i class="fas fa-chevron-left"></i>
            </button>
        </div>

        <ul class="space-y-2">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="admin-sidebar-nav-item flex items-center px-3 py-2 rounded-lg transition-all duration-200
                        {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white font-semibold text-base shadow ring-1 ring-indigo-300 scale-100' : 'hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-tachometer-alt w-6"></i>
                    <span class="ml-2">Tableau de bord</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.trainings') }}"
                    class="admin-sidebar-nav-item flex items-center px-3 py-2 rounded-lg transition-all duration-200
                        {{ request()->routeIs('admin.trainings') ? 'bg-indigo-600 text-white font-semibold text-base shadow ring-1 ring-indigo-300 scale-100' : 'hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-chalkboard-teacher w-6"></i>
                    <span class="ml-2">Formations</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.posts') }}"
                    class="admin-sidebar-nav-item flex items-center px-3 py-2 rounded-lg transition-all duration-200
                        {{ request()->routeIs('admin.posts') ? 'bg-indigo-600 text-white font-semibold text-base shadow ring-1 ring-indigo-300 scale-100' : 'hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-newspaper w-6"></i>
                    <span class="ml-2">Publication</span>
                </a>
            </li>
        </ul>
    </div>
</div>
