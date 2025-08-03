 <!-- Footer -->
 <footer class="bg-gray-900 py-12 border-t border-gray-800">
     <div class="container mx-auto px-4">
         <div class="grid md:grid-cols-4 gap-8">
             <div>
                 <div class="flex items-center space-x-2 mb-4">
                     <i class="fas fa-chart-line text-blue-500 text-2xl"></i>
                     <span class="text-xl font-bold">{{ config('app.name') }}</span>
                 </div>
                 <p class="text-gray-400 mb-4">La référence en formation pour les métiers d'avenir dans la cryptomonnaie
                     et la data science.</p>
                 <div class="flex space-x-4">
                     <a href="https://x.com/Crypt0x0Lm" target="_blank"
                         class="text-gray-400 hover:text-blue-400 transition-colors">
                         <i class="fab fa-twitter"></i>
                     </a>
                     <a href="https://www.linkedin.com/in/pierre-musili/" target="_blank"
                         class="text-gray-400 hover:text-blue-400 transition-colors">
                         <i class="fab fa-linkedin-in"></i>
                     </a>
                     <a href="https://www.youtube.com/@pierrelmcrypto" target="_blank"
                         class="text-gray-400 hover:text-blue-400 transition-colors">
                         <i class="fab fa-youtube"></i>
                     </a>
                     <a href="https://web.facebook.com/pierrelmcrypt" target="_blank"
                         class="text-gray-400 hover:text-blue-400 transition-colors">
                         <i class="fab fa-facebook-f"></i>
                     </a>
                 </div>
             </div>

             <div>
                 <h4 class="text-lg font-bold mb-4">Liens rapides</h4>
                 <ul class="space-y-2">
                     <li><a href="/" class="text-gray-400 hover:text-blue-400 transition-colors">Accueil</a></li>
                     <li><a href="{{ route('page.training.list') }}"
                             class="text-gray-400 hover:text-blue-400 transition-colors">Formations</a></li>
                     <li><a href="{{ route('page.contact') }}"
                             class="text-gray-400 hover:text-blue-400 transition-colors">Contact</a></li>
                 </ul>
             </div>

             <div>
                 <h4 class="text-lg font-bold mb-4">Nos formations</h4>
                 <ul class="space-y-2">
                     <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Fondamentaux des
                             Cryptomonnaies</a></li>
                     <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Data Science
                             Appliquée</a></li>

                 </ul>
             </div>

             <div>
                 <h4 class="text-lg font-bold mb-4">Légal</h4>
                 <ul class="space-y-2">
                     <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Conditions
                             d'utilisation</a></li>
                     <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Politique de
                             confidentialité</a></li>
                     <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Mentions
                             légales</a></li>
                     <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Cookies</a></li>
                 </ul>
             </div>
         </div>

         <div class="border-t border-gray-800 mt-10 pt-6 text-center text-gray-500 text-sm">
             <p>&copy; 2025 {{ config('app.name') }}. Tous droits réservés.</p>
         </div>
     </div>
 </footer>
