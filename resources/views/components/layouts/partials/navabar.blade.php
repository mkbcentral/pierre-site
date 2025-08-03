 @php
     $role = App\Enums\RoleType::admin(); // Example role, adjust as needed
     $isAdmin = auth()->check() && auth()->user()->role === $role;
 @endphp
 <!-- Navbar -->
 <nav class="navbar fixed w-full bg-gray-900 bg-opacity-80 shadow-lg z-50">
     <div class="container mx-auto px-4 py-3">
         <div class="flex justify-between items-center">
             <a href="/" class="nav-logo flex items-center space-x-2 group">
                 <div
                     class="bg-gradient-to-r from-blue-500 to-purple-500 p-1.5 rounded-lg transition-all duration-300 group-hover:shadow-lg group-hover:shadow-blue-500/20">
                     <i class="fas fa-chart-line text-white text-xl"></i>
                 </div>
                 <span
                     class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-purple-400">{{ config('app.name') }}</span>
             </a>

             <!-- Add search component -->
             <x-widget.search />

             <div class="hidden md:flex space-x-8">
                 <a href="{{ route('welcome') }}"
                     class="nav-link hover:text-blue-400 transition-colors {{ request()->routeIs('welcome') ? 'active' : '' }}">Accueil</a>
                 <a href="{{ route('page.training.list') }}"
                     class="nav-link hover:text-blue-400 transition-colors {{ request()->routeIs('page.training.list') ? 'active' : '' }}">Formations</a>
                 <a href="{{ route('page.post.list') }}"
                     class="nav-link hover:text-blue-400 transition-colors {{ request()->routeIs('page.post.list') ? 'active' : '' }}">Publications</a>
                 <a href="{{ route('page.contact') }}"
                     class="nav-link hover:text-blue-400 transition-colors {{ request()->routeIs('page.contact') ? 'active' : '' }}">Contact</a>
             </div>

             <div class="hidden md:flex items-center space-x-4 ml-8">
                 @auth()
                     <div class="relative group">
                         <button
                             class="flex items-center text-gray-300 hover:text-purple-400 transition-colors nav-action-btn focus:outline-none">
                             <i class="fas fa-user-circle mr-1 text-purple-400"></i>
                             {{ auth()->user()->name }}
                             <i class="fas fa-chevron-down ml-1 text-xs"></i>
                         </button>
                         <div
                             class="absolute right-0 mt-2 w-52 bg-gray-800 rounded-lg shadow-lg py-2 z-50 opacity-0 group-hover:opacity-100 group-focus-within:opacity-100 transition-opacity">
                             <a href="{{ route('admin.dashboard') }}"
                                 class="flex items-center gap-2 px-4 py-2 text-gray-200 hover:bg-gradient-to-r hover:from-blue-600 hover:to-purple-600 hover:text-white transition-colors">
                                 <i class="fas fa-cogs text-blue-400"></i>
                                 <span>Administration</span>
                             </a>
                             <form method="POST" action="{{ route('logout') }}">
                                 @csrf
                                 <button type="submit"
                                     class="flex items-center gap-2 w-full text-left px-4 py-2 text-gray-200 hover:bg-gradient-to-r hover:from-red-500 hover:to-purple-600 hover:text-white transition-colors">
                                     <i class="fas fa-sign-out-alt text-red-400"></i>
                                     <span>Se déconnecter</span>
                                 </button>
                             </form>
                         </div>
                     </div>
                 @else
                     <a href="{{ route('login') }}"
                         class="text-gray-300 hover:text-blue-400 transition-colors nav-action-btn flex items-center">
                         <i class="fas fa-sign-in-alt mr-1 text-blue-400"></i> Connexion
                     </a>
                     <a href="{{ route('register') }}"
                         class="btn-sm nav-action-btn bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600">
                         <i class="fas fa-user-plus mr-1"></i> S'inscrire
                     </a>
                 @endauth

             </div>

             <button id="mobileMenuBtn" class="md:hidden text-white focus:outline-none menu-btn">
                 <i class="fas fa-bars text-xl"></i>
             </button>
         </div>
     </div>
     <x-layouts.partials.mobile-nav />
 </nav>
