<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex — {{ ucfirst($pokemon['name']) }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: radial-gradient(circle at top, #f8ecff 0%, #ead7ff 45%, #e2c8ff 100%);
            font-family: "Trebuchet MS", "Segoe UI", sans-serif;
        }
        .la-panel {
            background: rgba(255, 255, 255, 0.72);
            border: 1px solid rgba(190, 150, 230, 0.55);
            box-shadow: 0 18px 40px rgba(135, 93, 184, 0.22);
            backdrop-filter: blur(4px);
        }
    </style>
</head>
<body class="min-h-screen text-slate-700">

<!-- Navbar -->
<nav class="max-w-5xl mx-auto mt-5 px-4">
    <div class="la-panel rounded-full px-5 py-3 flex items-center justify-between">
    <span class="text-base md:text-lg font-bold tracking-wide text-violet-700">✨ Hisui Pokédex</span>
    <div class="flex gap-2 md:gap-3">
        <a href="{{ route('pokedex') }}"
           class="bg-violet-500 text-white font-semibold px-4 py-1.5 rounded-full text-sm hover:bg-violet-600 transition">
            🎲 Aleatório
        </a>
        <a href="{{ route('pokemon.cadastroForm') }}"
           class="bg-emerald-400 text-emerald-950 font-semibold px-4 py-1.5 rounded-full text-sm hover:bg-emerald-300 transition">
            ➕ Cadastrar
        </a>
    </div>
    </div>
</nav>

<div class="max-w-5xl mx-auto px-4 py-6">

    <!-- Flash messages -->
    @if(session('sucesso'))
    <div class="bg-emerald-500 text-emerald-950 px-4 py-3 rounded-2xl mb-4 flex justify-between items-center shadow">
        <span>{{ session('sucesso') }}</span>
        <button onclick="this.parentElement.remove()" class="ml-4 font-bold">✕</button>
    </div>
    @endif
    @if(session('erro'))
    <div class="bg-rose-500 text-white px-4 py-3 rounded-2xl mb-4 shadow">{{ session('erro') }}</div>
    @endif

    <!-- Busca -->
    <form action="{{ route('pokedex') }}" method="GET" class="la-panel rounded-3xl p-3 mb-6 flex gap-2">
        <input type="text" name="pokemon" placeholder="Nome ou número do pokémon..."
               class="flex-1 bg-white/75 border border-violet-200 rounded-2xl px-4 py-2 text-slate-700 placeholder-violet-300 focus:outline-none focus:border-violet-400"/>
        <button type="submit"
                class="bg-violet-500 hover:bg-violet-600 text-white px-5 py-2 rounded-2xl font-semibold transition">
            Buscar
        </button>
    </form>

    <!-- Card principal -->
    <div class="la-panel rounded-[2rem] overflow-hidden mb-8">
        <div class="md:flex">
            <!-- Imagem -->
            <div class="bg-violet-100/70 md:w-72 flex items-center justify-center p-8 border-b md:border-b-0 md:border-r border-violet-200">
                <img src="{{ $pokemon['sprites']['other']['official-artwork']['front_default'] ?? '' }}"
                     alt="{{ $pokemon['name'] }}"
                     class="w-56 h-56 object-contain drop-shadow-[0_10px_20px_rgba(132,78,178,.35)]">
            </div>

            <!-- Infos -->
            <div class="flex-1 p-6">
                <div class="flex justify-between items-start mb-2">
                    <h1 class="text-3xl font-bold capitalize text-violet-700">{{ $pokemon['name'] }}</h1>
                    <div class="text-right">
                        <span class="text-violet-400 text-lg font-mono">#{{ str_pad($pokemon['id'], 4, '0', STR_PAD_LEFT) }}</span>
                        @if(!empty($pokemon['is_custom']))
                            <span class="ml-2 bg-amber-300 text-amber-900 text-xs font-bold px-2 py-0.5 rounded-full">CUSTOM</span>
                        @endif
                    </div>
                </div>

                <!-- Descrição -->
                @if(!empty($pokemon['description']))
                <p class="text-violet-600 text-sm mb-4 italic">"{{ $pokemon['description'] }}"</p>
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
                    <div class="bg-white/65 border border-violet-200 rounded-2xl px-4 py-2 text-center">
                        <p class="text-violet-400 text-xs">Altura</p>
                        <p class="font-bold text-lg text-violet-700">{{ $pokemon['height'] / 10 }}m</p>
                    </div>
                    <div class="bg-white/65 border border-violet-200 rounded-2xl px-4 py-2 text-center">
                        <p class="text-violet-400 text-xs">Peso</p>
                        <p class="font-bold text-lg text-violet-700">{{ $pokemon['weight'] / 10 }}kg</p>
                    </div>
                </div>

                <!-- Habilidades -->
                @if(!empty($pokemon['abilities']))
                <div class="mb-4">
                    <p class="text-violet-400 text-xs uppercase tracking-wider mb-1">Habilidades</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($pokemon['abilities'] as $hab)
                        <span class="bg-white/70 border border-violet-200 text-violet-700 text-xs px-2 py-1 rounded-full capitalize">
                            {{ $hab['ability']['name'] }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Botões de ação -->
                <div class="flex gap-3 mt-4 flex-wrap">
                    <a href="{{ route('pokedex') }}"
                       class="bg-violet-500 hover:bg-violet-600 text-white font-semibold px-4 py-2 rounded-full transition text-sm">
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
                                class="bg-amber-300 hover:bg-amber-200 text-amber-950 font-semibold px-4 py-2 rounded-full transition text-sm">
                            ⭐ Favoritar
                        </button>
                    </form>
                    @else
                    <span class="bg-amber-500 text-amber-950 font-semibold px-4 py-2 rounded-full text-sm">
                        ⭐ Favoritado
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="border-t border-violet-200 p-6">
            <h2 class="text-violet-700 font-semibold text-sm uppercase tracking-wider mb-4">Estatísticas</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                @foreach ($pokemon['stats'] as $stat)
                @php
                    $pct = min(($stat['base_stat'] / 255) * 100, 100);
                    $barColor = $pct > 66 ? 'bg-green-500' : ($pct > 33 ? 'bg-yellow-500' : 'bg-red-500');
                @endphp
                <div>
                    <div class="flex justify-between text-xs text-violet-500 mb-1">
                        <span class="capitalize">{{ $stat['stat']['name'] }}</span>
                        <span class="font-bold text-violet-700">{{ $stat['base_stat'] }}</span>
                    </div>
                    <div class="w-full bg-violet-100 h-2 rounded-full overflow-hidden">
                        <div class="{{ $barColor }} h-2 rounded-full transition-all duration-500"
                             style="width: {{ $pct }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Moves -->
        @if(!empty($pokemon['moves']) && count($pokemon['moves']) > 0)
        <div class="border-t border-violet-200 p-6">
            <h2 class="text-violet-700 font-semibold text-sm uppercase tracking-wider mb-3">Golpes</h2>
            <div class="flex flex-wrap gap-2">
                @foreach(array_slice($pokemon['moves'], 0, 12) as $move)
                <span class="bg-white/70 border border-violet-200 text-violet-700 text-xs px-2 py-1 rounded-full capitalize">
                    {{ $move['move']['name'] }}
                </span>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Seção de Favoritos -->
    @if(!$favoritos->isEmpty())
    <div class="la-panel rounded-[2rem] p-5">
        <h2 class="text-violet-700 text-lg font-bold mb-4 flex items-center gap-2">
            ⭐ Meus Favoritos <span class="text-violet-400 text-sm font-normal">({{ $favoritos->count() }})</span>
        </h2>
        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-2">
            @foreach($favoritos as $fav)
            <div class="bg-white/70 rounded-2xl border border-violet-200 hover:border-violet-400 transition group overflow-hidden">
                <a href="{{ route('pokedex', ['favorito_id' => $fav->id]) }}" class="block p-2 text-center">
                    <img src="{{ $fav->image }}" alt="{{ $fav->name }}"
                         class="w-12 h-12 object-contain mx-auto mb-1 group-hover:scale-110 transition-transform">
                    <p class="text-[11px] font-semibold capitalize text-violet-700 truncate">{{ $fav->name }}</p>
                    <p class="text-[10px] text-violet-400">#{{ str_pad($fav->pokemon_api_id, 4, '0', STR_PAD_LEFT) }}</p>
                </a>
                <form action="{{ route('pokemon.removerFavorito') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $fav->id }}">
                    <button type="submit"
                            class="w-full text-[10px] text-rose-500 hover:bg-rose-100 py-1 transition">
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
