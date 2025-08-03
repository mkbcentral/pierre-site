     <!-- Footer -->
     <footer class="bg-gray-900 py-8 border-t border-gray-800">
         <div class="container mx-auto px-4">
             <div class="flex flex-col md:flex-row justify-between items-center">
                 <div class="flex items-center space-x-2 mb-4 md:mb-0">
                     <i class="fas fa-chart-line text-blue-500 text-xl"></i>
                     <span class="text-lg font-bold">{{ config('app.name') }}</span>
                 </div>

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

                 <div class="mt-4 md:mt-0 text-gray-500 text-sm text-center md:text-right">
                     <p>&copy; 2025 {{ config('app.name') }}. Tous droits réservés.</p>
                     <p>Developed by <a href="https://mkbcentral.com" target="_blank"
                             class="text-blue-400 hover:underline">{{ env('DEV_NAME') }}</a></p>
                 </div>
             </div>
     </footer>
