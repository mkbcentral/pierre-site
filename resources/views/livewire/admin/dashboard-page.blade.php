 <!-- Dashboard Section -->
 <div id="dashboard-content" class="admin-content-section">
     <div class="flex justify-between items-center mb-6">
         <h1 class="text-2xl font-bold">Tableau de bord</h1>
         <div>
             <button class="btn-secondary">
                 <i class="fas fa-download mr-2"></i>
                 Exporter les données
             </button>
         </div>
     </div>

     <!-- Stats Cards -->
     <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
         <x-widget.dashboard-card title="Formations" value="{{ $trainingCount }}" icon="fas fa-chalkboard-teacher"
             percentageChange="5%" />
         <x-widget.dashboard-card title="Etudiants" value="{{ $userCount }}" icon="fas fa-users"
             percentageChange="10%" />
         <x-widget.dashboard-card title="Ventes" value="{{ $revenueAmount }}" icon="fas fa-dollar-sign"
             percentageChange="15%" />
         <x-widget.dashboard-card title="Publications" value="{{ $postCount }}" icon="fas fa-newspaper"
             percentageChange="20%" />
     </div>
 </div>
