<!DOCTYPE html>
<html lang="fr">

<head>
    <x-utils.head />
</head>

<body class="bg-gray-900 text-white font-sans">
    <x-layouts.partials.nav-side />
    <x-layouts.partials.mobile-nav-side />

    <!-- Main Content -->
    <div class="flex pt-16">
        @include('components.layouts.partials.sidebar')
        <!-- Content Area -->
        <div class="flex-1 admin-content overflow-hidden md:ml-[260px]">
            <div class="p-6">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
