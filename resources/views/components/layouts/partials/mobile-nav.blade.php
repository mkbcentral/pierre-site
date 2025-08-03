 <!-- Mobile Menu -->
 <div id="mobileMenu" class="md:hidden mobile-menu bg-gray-800/95 backdrop-blur-lg ">
     <!-- Add mobile search -->
     <div class="px-4 py-3">
         <div class="relative search-container">
             <input type="text" id="mobileSearchInput" placeholder="Rechercher une formation..."
                 class="form-input pr-10 pl-4 py-2 w-full bg-gray-700/50 border-gray-600">
             <i class="fas fa-search absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
         </div>
         <div id="mobileSearchResults" class="bg-gray-700 rounded-lg shadow-xl mt-2 max-h-60 overflow-y-auto hidden">
         </div>
     </div>

     <div class="container mx-auto px-4 flex flex-col space-y-3 pb-4 min-h-screen">
         <a href="/" class="mobile-menu-link py-2 hover:text-blue-400 transition-colors flex items-center"
             style="--index: 1;">
             <i class="fas fa-home mr-3 text-blue-400"></i> Accueil
         </a>
         <a href="{{ route('page.training.list') }}"
             class="mobile-menu-link py-2 hover:text-blue-400 transition-colors flex items-center" style="--index: 2;">
             <i class="fas fa-graduation-cap mr-3 text-purple-400"></i> Formations
         </a>
          <a href="{{ route('page.post.list') }}"
             class="mobile-menu-link py-2 hover:text-blue-400 transition-colors flex items-center" style="--index: 2;">
             <i class="fas fa-graduation-cap mr-3 text-purple-400"></i> Publications
         </a>

         <a href="#contact" class="mobile-menu-link py-2 hover:text-blue-400 transition-colors flex items-center"
             style="--index: 5;">
             <i class="fas fa-envelope mr-3 text-red-400"></i> Contact
         </a>

         <div class="border-t border-gray-700 my-2 pt-2">
             @auth
                 <!-- Mobile Dropdown for Authenticated User -->
                 <div x-data="{ open: false }" class="relative">
                     <button @click="open = !open"
                         class="mobile-menu-link py-2 flex items-center hover:text-blue-400 transition-colors w-full"
                         style="--index: 8;">
                         <i class="fas fa-user-circle mr-3 text-green-400"></i>
                         {{ Auth::user()->name }}
                         <i class="fas fa-chevron-down ml-auto"></i>
                     </button>
                     <div x-show="open" @click.away="open = false"
                         class="absolute left-0 w-full bg-gray-700 rounded-lg shadow-xl mt-2 z-20">
                         <a href="{{ route('admin.dashboard') }}"
                             class="block px-4 py-2 hover:bg-gray-600 transition-colors items-center">
                             <i class="fas fa-user-shield mr-3 text-green-400"></i> Admin
                         </a>

                         <form method="POST" action="{{ route('logout') }}">
                             @csrf
                             <button type="submit"
                                 class="w-full text-left px-4 py-2 hover:bg-gray-600 transition-colors flex items-center">
                                 <i class="fas fa-sign-out-alt mr-3 text-red-400"></i> Déconnexion
                             </button>
                         </form>
                     </div>
                 </div>
             @else
                 <a href="{{ route('login') }}"
                     class="mobile-menu-link py-2 flex items-center hover:text-blue-400 transition-colors"
                     style="--index: 6;">
                     <i class="fas fa-sign-in-alt mr-3 text-blue-400"></i> Connexion
                 </a>
                 <a href="{{ route('register') }}"
                     class="mobile-menu-link py-2 flex items-center hover:text-blue-400 transition-colors"
                     style="--index: 7;">
                     <i class="fas fa-user-plus mr-3 text-purple-400"></i> S'inscrire
                 </a>
             @endauth
         </div>
     </div>
 </div>
