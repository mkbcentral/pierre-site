 <!-- Navbar -->
 <nav class="bg-gray-900 border-b border-gray-800 fixed top-0 left-0 w-full z-40">
     <div class=" mx-auto px-4">
         <div class="flex justify-between items-center h-16">
             <a href="{{ url('/') }}" class="flex items-center space-x-2 hover:opacity-80 transition">
                 <i class="fas fa-chart-line text-blue-500 text-2xl"></i>
                 <span class="text-xl font-bold">{{ config('app.name') }}</span>
             </a>
             <div class="hidden md:flex items-center space-x-4">

                 <div class="flex items-center space-x-4 ml-6">
                     <button class="admin-action-btn text-gray-400 hover:text-white">
                         <i class="fas fa-bell"></i>
                     </button>

                     <a href="{{ url('/') }}" class="admin-action-btn text-gray-400 hover:text-white"
                         title="Retour au site">
                         <i class="fas fa-external-link-alt"></i>
                     </a>
                 </div>

                 <div class="relative group mr-8">
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
                             <span>Paramètres</span>
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
             </div>
             <button id="mobileMenuBtn" class="md:hidden text-white focus:outline-none">
                 <i class="fas fa-bars text-xl"></i>
             </button>
         </div>
     </div>
 </nav>
