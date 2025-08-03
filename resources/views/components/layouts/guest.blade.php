<!DOCTYPE html>
<html lang="fr">

<head>
    <x-utils.head />
</head>

<body class="bg-gray-900 text-white font-sans">
    {{ $slot }}
    <x-layouts.partials.footer-auth />
    @stack('scripts')
</body>

</html>
