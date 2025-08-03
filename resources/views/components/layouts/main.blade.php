<html lang="fr">

<head>
    <x-utils.head />

</head>

<body class="bg-gray-900 text-white font-sans">
    <x-layouts.partials.navabar />
    {{ $slot }}
    <x-layouts.partials.footer />
    @stack('scripts')
</body>

</html>
