<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex — {{ ucfirst($pokemon['name']) }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 min-h-screen text-white">

<!-- Navbar -->
<nav class="bg-red-700 px-6 py-3 flex items-center justify-between shadow-lg">
    <span class="text-xl font-bold tracking-widest">⚡ Pokédex</span>
    <div class="flex gap-3">
        <a href="{{ route('pokedex') }}"
           class="bg-white text-red-700 font-semibold px-4 py-1.5 rounded-full text-sm hover:bg-red-100 transition">
            🎲 Aleatório
        </a>
        <a href="{{ route('pokemon.cadastroForm') }}"
           class="bg-yellow-400 text-gray-900 font-semibold px-4 py-1.5 rounded-full text-sm hover:bg-yellow-300 transition">
            ➕ Cadastrar
        </a>
    </div>
</nav>

<div class="max-w-5xl mx-auto px-4 py-8">

    <!-- Flash messages -->
    @if(session('sucesso'))
    <div class="bg-green-600 text-white px-4 py-3 rounded-lg mb-4 flex justify-between items-center">
        <span>{{ session('sucesso') }}</span>
        <button onclick="this.parentElement.remove()" class="ml-4 font-bold">✕</button>
    </div>
    @endif
    @if(session('erro'))
    <div class="bg-red-600 text-white px-4 py-3 rounded-lg mb-4">{{ session('erro') }}</div>
    @endif

    <!-- Busca -->
    <form action="{{ route('pokedex') }}" method="GET" class="mb-6 flex gap-2">
        <input type="text" name="pokemon" placeholder="Nome ou número do pokémon..."
               class="flex-1 bg-gray-800 border border-gray-600 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:border-red-500"/>
        <button type="submit"
                class="bg-red-600 hover:bg-red-700 px-5 py-2 rounded-lg font-semibold transition">
            Buscar
        </button>
    </form>

    <!-- Card principal -->
    <div class="bg-gray-800 rounded-2xl shadow-2xl overflow-hidden mb-10 border border-gray-700">
        <div class="md:flex">
            <!-- Imagem -->
            <div class="bg-gray-700 md:w-72 flex items-center justify-center p-8">
                <img src="{{ $pokemon['sprites']['other']['official-artwork']['front_default'] ?? '' }}"
                     alt="{{ $pokemon['name'] }}"
                     class="w-56 h-56 object-contain drop-shadow-2xl">
            </div>

            <!-- Infos -->
            <div class="flex-1 p-6">
                <div class="flex justify-between items-start mb-2">
                    <h1 class="text-3xl font-bold capitalize">{{ $pokemon['name'] }}</h1>
                    <div class="text-right">
                        <span class="text-gray-400 text-lg font-mono">#{{ str_pad($pokemon['id'], 4, '0', STR_PAD_LEFT) }}</span>
                        @if(!empty($pokemon['is_custom']))
                            <span class="ml-2 bg-yellow-500 text-gray-900 text-xs font-bold px-2 py-0.5 rounded-full">CUSTOM</span>
                        @endif
                    </div>
                </div>

                <!-- Descrição -->
                @if(!empty($pokemon['description']))
                <p class="text-gray-300 text-sm mb-4 italic">"{{ $pokemon['description'] }}"</p>
                @endif

                <!-- Tipos -->
                <div class="flex gap-2 mb-4 flex-wrap">
                    @foreach ($pokemon['types'] as $tipo)
                    @php
                        $typeColors = [
                            'fire'=>'bg-orange-500','water'=>'bg-blue-500','grass'=>'bg-green-500',
                            'electric'=>'bg-yellow-400 text-gray-900','psychic'=>'bg-pink-500',
                            'ice'=>'bg-cyan-400 text-gray-900','dragon'=>'bg-indigo-600',
                            'dark'=>'bg-gray-700','fairy'=>'bg-pink-300 text-gray-900',
                            'normal'=>'bg-gray-500','fighting'=>'bg-red-700','flying'=>'bg-sky-400 text-gray-900',
                            'poison'=>'bg-purple-600','ground'=>'bg-yellow-700','rock'=>'bg-stone-500',
                            'bug'=>'bg-lime-600','ghost'=>'bg-purple-900','steel'=>'bg-slate-400 text-gray-900',
                        ];
                        $color = $typeColors[$tipo['type']['name']] ?? 'bg-gray-600';
                    @endphp
                    <span class="px-3 py-1 {{ $color }} text-white text-xs font-bold rounded-full uppercase tracking-wider">
                        {{ $tipo['type']['name'] }}
                    </span>
                    @endforeach
                </div>

                <!-- Altura e Peso -->
                <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
                    <div class="bg-gray-700 rounded-lg px-4 py-2 text-center">
                        <p class="text-gray-400 text-xs">Altura</p>
                        <p class="font-bold text-lg">{{ $pokemon['height'] / 10 }}m</p>
                    </div>
                    <div class="bg-gray-700 rounded-lg px-4 py-2 text-center">
                        <p class="text-gray-400 text-xs">Peso</p>
                        <p class="font-bold text-lg">{{ $pokemon['weight'] / 10 }}kg</p>
                    </div>
                </div>

                <!-- Habilidades -->
                @if(!empty($pokemon['abilities']))
                <div class="mb-4">
                    <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Habilidades</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($pokemon['abilities'] as $hab)
                        <span class="bg-gray-700 text-gray-200 text-xs px-2 py-1 rounded capitalize">
                            {{ $hab['ability']['name'] }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Botões de ação -->
                <div class="flex gap-3 mt-4 flex-wrap">
                    <a href="{{ route('pokedex') }}"
                       class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-lg transition text-sm">
                        🎲 Próximo aleatório
                    </a>

                    @php
                        $jaFavoritado = $favoritos->where('pokemon_api_id', $pokemon['id'])->isNotEmpty();
                    @endphp

                    @if(!$jaFavoritado)
                    <form action="{{ route('pokemon.salvar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="pokemon_id" value="{{ $pokemon['id'] }}">
                        <input type="hidden" name="name" value="{{ $pokemon['name'] }}">
                        <input type="hidden" name="image" value="{{ $pokemon['sprites']['other']['official-artwork']['front_default'] ?? '' }}">
                        <button type="submit"
                                class="bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-semibold px-4 py-2 rounded-lg transition text-sm">
                            ⭐ Favoritar
                        </button>
                    </form>
                    @else
                    <span class="bg-yellow-700 text-yellow-200 font-semibold px-4 py-2 rounded-lg text-sm">
                        ⭐ Favoritado
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="border-t border-gray-700 p-6">
            <h2 class="text-white font-semibold text-sm uppercase tracking-wider mb-4">Estatísticas</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                @foreach ($pokemon['stats'] as $stat)
                @php
                    $pct = min(($stat['base_stat'] / 255) * 100, 100);
                    $barColor = $pct > 66 ? 'bg-green-500' : ($pct > 33 ? 'bg-yellow-500' : 'bg-red-500');
                @endphp
                <div>
                    <div class="flex justify-between text-xs text-gray-400 mb-1">
                        <span class="capitalize">{{ $stat['stat']['name'] }}</span>
                        <span class="font-bold text-white">{{ $stat['base_stat'] }}</span>
                    </div>
                    <div class="w-full bg-gray-700 h-2 rounded-full overflow-hidden">
                        <div class="{{ $barColor }} h-2 rounded-full transition-all duration-500"
                             style="width: {{ $pct }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Moves -->
        @if(!empty($pokemon['moves']) && count($pokemon['moves']) > 0)
        <div class="border-t border-gray-700 p-6">
            <h2 class="text-white font-semibold text-sm uppercase tracking-wider mb-3">Golpes</h2>
            <div class="flex flex-wrap gap-2">
                @foreach(array_slice($pokemon['moves'], 0, 12) as $move)
                <span class="bg-gray-700 text-gray-300 text-xs px-2 py-1 rounded capitalize">
                    {{ $move['move']['name'] }}
                </span>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Seção de Favoritos -->
    @if(!$favoritos->isEmpty())
    <div class="mb-10">
        <h2 class="text-white text-lg font-bold mb-4 flex items-center gap-2">
            ⭐ Favoritos <span class="text-gray-400 text-sm font-normal">({{ $favoritos->count() }})</span>
        </h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
            @foreach($favoritos as $fav)
            <div class="bg-gray-800 rounded-xl border border-gray-700 hover:border-yellow-500 transition group overflow-hidden">
                <a href="{{ route('pokedex', ['favorito_id' => $fav->id]) }}" class="block p-3 text-center">
                    <img src="{{ $fav->image }}" alt="{{ $fav->name }}"
                         class="w-16 h-16 object-contain mx-auto mb-2 group-hover:scale-110 transition-transform">
                    <p class="text-xs font-semibold capitalize text-gray-200 truncate">{{ $fav->name }}</p>
                    <p class="text-xs text-gray-500">#{{ str_pad($fav->pokemon_api_id, 4, '0', STR_PAD_LEFT) }}</p>
                </a>
                <form action="{{ route('pokemon.removerFavorito') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $fav->id }}">
                    <button type="submit"
                            class="w-full text-xs text-red-400 hover:bg-red-900 hover:text-red-200 py-1 transition">
                        Remover ✕
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>
</body>
</html>
