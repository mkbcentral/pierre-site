 <x-layouts.guest>
     <!-- Login Section -->
     <section class="min-h-screen flex items-center py-16">
         <div class="container mx-auto px-4">
             <div class="auth-container py-10 animation-fade-in">
                 <div class="auth-card">
                     <div class="auth-header">
                         <h1 class="text-3xl font-bold mb-2">Réinitialiser le mot de passe</h1>
                         <p class="text-gray-400">Entrez votre adresse e-mail pour recevoir un lien de
                             réinitialisation.</p>
                     </div>

                     <div class="p-8">
                         <!-- Reset Password Form -->
                         <form id="resetPasswordForm" class="space-y-6" action="{{ route('password.update') }}"
                             method="POST">
                             @csrf
                             <input type="hidden" name="token" value="{{ request()->route('token') }}">
                             <div>
                                 <label for="email" class="block mb-2 text-gray-200">Adresse e-mail</label>
                                 <input type="email" id="email" name="email" class="form-input"
                                     placeholder="Votre adresse e-mail" value="{{ old('email', request('email')) }}"
                                     required autofocus>
                                 @error('email')
                                     <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                 @enderror
                             </div>
                             <div>
                                 <label for="password" class="block mb-2 text-gray-200">Nouveau mot de passe</label>
                                 <div class="relative">
                                     <input type="password" id="password" name="password" class="form-input pr-10"
                                         placeholder="••••••••" required>
                                     <span
                                         class="toggle-password absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                         <i class="fas fa-eye"></i>
                                     </span>
                                 </div>
                                 @error('password')
                                     <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                 @enderror
                                 <div class="mt-2">
                                     <div
                                         class="password-strength w-full h-1.5 bg-gray-700 rounded-full overflow-hidden">
                                         <div
                                             class="password-strength-bar h-full bg-red-500 w-0 transition-all duration-300">
                                         </div>
                                     </div>
                                     <p class="password-strength-text text-xs text-gray-400 mt-1">Force du mot de passe
                                     </p>
                                 </div>
                             </div>
                             <div>
                                 <label for="password_confirmation" class="block mb-2 text-gray-200">Confirmer le mot
                                     de passe</label>
                                 <div class="relative">
                                     <input type="password" id="password_confirmation" name="password_confirmation"
                                         class="form-input pr-10" placeholder="••••••••" required>
                                     <span
                                         class="toggle-password absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                         <i class="fas fa-eye"></i>
                                     </span>
                                 </div>
                                 @error('password_confirmation')
                                     <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                 @enderror
                             </div>

                             @if (session('status'))
                                 <div class="text-green-500 text-sm mb-4">
                                     {{ session('status') }}
                                 </div>
                             @endif

                             <button type="submit" class="btn-primary w-full">
                                 Réinitialiser le mot de passe
                                 <i class="fas fa-sync-alt ml-2"></i>
                             </button>
                         </form>

                         <div class="text-center mt-6">
                             <p class="text-gray-400">
                                 Retour à la connexion
                                 <a href="{{ route('login') }}" class="text-blue-400 hover:underline">Se
                                     connecter</a>
                             </p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     @push('scripts')
         <script>
             document.addEventListener('DOMContentLoaded', function() {
                 // Toggle password visibility
                 const togglePassword = document.querySelector('.toggle-password');
                 const passwordInput = document.getElementById('password');

                 if (togglePassword && passwordInput) {
                     togglePassword.addEventListener('click', function() {
                         const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                         passwordInput.setAttribute('type', type);

                         // Toggle icon
                         this.querySelector('i').classList.toggle('fa-eye');
                         this.querySelector('i').classList.toggle('fa-eye-slash');
                     });
                 }

                 // Toggle confirm password visibility
                 const toggleConfirmPassword = document.querySelector('.toggle-confirm-password');
                 const confirmPasswordInput = document.getElementById('confirmPassword');

                 if (toggleConfirmPassword && confirmPasswordInput) {
                     toggleConfirmPassword.addEventListener('click', function() {
                         const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' :
                             'password';
                         confirmPasswordInput.setAttribute('type', type);

                         // Toggle icon
                         this.querySelector('i').classList.toggle('fa-eye');
                         this.querySelector('i').classList.toggle('fa-eye-slash');
                     });
                 }

                 // Password strength meter
                 if (passwordInput) {
                     const strengthBar = document.querySelector('.password-strength-bar');
                     const strengthText = document.querySelector('.password-strength-text');

                     passwordInput.addEventListener('input', function() {
                         const password = this.value;
                         let strength = 0;

                         if (password.length >= 8) strength += 1;
                         if (password.match(/[A-Z]/)) strength += 1;
                         if (password.match(/[0-9]/)) strength += 1;
                         if (password.match(/[^A-Za-z0-9]/)) strength += 1;

                         // Update strength bar
                         switch (strength) {
                             case 0:
                                 strengthBar.style.width = '0%';
                                 strengthBar.className = 'password-strength-bar h-full bg-red-500';
                                 strengthText.textContent = 'Force du mot de passe';
                                 break;
                             case 1:
                                 strengthBar.style.width = '25%';
                                 strengthBar.className = 'password-strength-bar h-full bg-red-500';
                                 strengthText.textContent = 'Faible';
                                 break;
                             case 2:
                                 strengthBar.style.width = '50%';
                                 strengthBar.className = 'password-strength-bar h-full bg-yellow-500';
                                 strengthText.textContent = 'Moyen';
                                 break;
                             case 3:
                                 strengthBar.style.width = '75%';
                                 strengthBar.className = 'password-strength-bar h-full bg-blue-500';
                                 strengthText.textContent = 'Bon';
                                 break;
                             case 4:
                                 strengthBar.style.width = '100%';
                                 strengthBar.className = 'password-strength-bar h-full bg-green-500';
                                 strengthText.textContent = 'Excellent';
                                 break;
                         }
                     });
                 }
             });
         </script>
     @endpush
 </x-layouts.guest>
