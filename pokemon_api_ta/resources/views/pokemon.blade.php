<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 flex items-center justify-center min-h-screen">

    <div class="bg-gray-800 p-6 rounded-xl shadow-xl w-96 border border-gray-700">

        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-white uppercase tracking-wide">
                {{ $pokemon['name'] }}
            </h1>
            <span class="text-gray-400 text-sm">
                #{{ $pokemon['id'] }}
            </span>
        </div>

        <!-- Imagem -->
        <div class="bg-gray-700 rounded-lg p-4 mb-4">
            <img
                src="{{ $pokemon['sprites']['other']['official-artwork']['front_default'] }}"
                alt="{{ $pokemon['name'] }}"
                class="w-full h-48 object-contain">
        </div>

        <!-- Tipos -->
        <div class="flex gap-2 mb-4">
            @foreach ($pokemon['types'] as $tipo)
            <span class="px-2 py-1 bg-gray-600 text-gray-200 text-xs font-semibold rounded">
                {{ $tipo['type']['name'] }}
            </span>
            @endforeach
        </div>

        <!-- Infos básicas -->
        <div class="text-gray-400 text-sm mb-4 flex justify-between">
            <span>Altura: {{ $pokemon['height'] / 10 }}m</span>
            <span>Peso: {{ $pokemon['weight'] / 10 }}kg</span>
        </div>

        <!-- Stats -->
        <div class="mb-4">
            <h2 class="text-white text-sm font-semibold mb-2">Stats</h2>

            @foreach ($pokemon['stats'] as $stat)
            <div class="mb-2">
                <div class="flex justify-between text-xs text-gray-400 mb-1">
                    <span>{{ $stat['stat']['name'] }}</span>
                    <span>{{ $stat['base_stat'] }}</span>
                </div>
                <div class="w-full bg-gray-700 h-2 rounded overflow-hidden">
                    <div
                        class="bg-red-500 h-2 rounded transition-all duration-300"
                        style="width: {{ min(($stat['base_stat'] / 150) * 100, 100) }}%"></div>
                </div>
                @endforeach
            </div>

            <!-- Moves -->
            <div class="mb-4">
                <h2 class="text-white text-sm font-semibold mb-2">Moves</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach (array_slice($pokemon['moves'], 0, 6) as $move)
                    <span class="px-2 py-1 bg-gray-700 text-gray-300 text-xs rounded">
                        {{ $move['move']['name'] }}
                    </span>
                    @endforeach
                </div>
            </div>

            <!-- Botão -->
            <button
                onclick="window.location.reload()"
                class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 rounded-md transition">
                Buscar próximo
            </button>

        </div>

</body>

</html>