 @props(['title' => '', 'value' => 0, 'icon' => '', 'percentageChange' => 0])
 <div class="admin-card admin-stat-card p-5">
     <div class="stat-icon">
         <i class="{{ $icon }}"></i>
     </div>
     <p class="text-sm text-gray-400">{{ $title }}</p>
     <h3 class="text-3xl font-bold mt-2">{{ $value }}</h3>
     <p class="text-sm text-green-400 mt-2 flex items-center">
         <i class="fas fa-arrow-up mr-1"></i>
         {{ $percentageChange }} depuis le mois dernier
     </p>
 </div>
