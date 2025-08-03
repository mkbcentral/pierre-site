 @if (session('success') || session('error'))
     <div x-data="{ show: true }" x-show="show" x-transition
         class="mb-4 p-3 rounded flex items-center justify-between
                {{ session('success') ? 'bg-green-500/20 text-green-700 border border-green-400' : 'bg-red-500/20 text-red-700 border border-red-400' }}">
         <span>
             {{ session('success') ?? session('error') }}
         </span>
         <button @click="show = false" class="ml-4 text-xl leading-none focus:outline-none hover:text-gray-900 transition"
             aria-label="Fermer">
             &times;
         </button>
     </div>
 @endif
