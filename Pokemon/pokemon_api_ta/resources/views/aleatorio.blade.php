<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aleatório — {{ ucfirst($pokemon['name']) }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: radial-gradient(circle at top, #f8ecff 0%, #ead7ff 45%, #e2c8ff 100%);
            font-family: "Trebuchet MS", "Segoe UI", sans-serif;
        }
        .la-frame {
            background: #eecff9;
            border: 2px solid #d7afe8;
            box-shadow: 0 20px 38px rgba(120, 84, 176, 0.24);
        }
        .la-cell {
            background: rgba(255, 255, 255, 0.62);
            border: 1px solid #dcb7ee;
        }
    </style>
</head>
<body class="min-h-screen text-slate-700 p-4">
<div class="max-w-md mx-auto">
    <nav class="la-frame rounded-full px-3 py-2 mb-4 flex items-center justify-between gap-2">
        <a href="{{ route('pokemon.cadastroForm') }}" class="text-xs font-bold bg-white/80 text-violet-600 rounded-full px-3 py-1">Cadastrar</a>
        <a href="{{ route('aleatorio') }}" class="text-xs font-bold bg-violet-500 text-white rounded-full px-3 py-1">Aleatório</a>
        <a href="{{ route('pokedex') }}" class="text-xs font-bold bg-white/80 text-violet-600 rounded-full px-3 py-1">Pokedex</a>
        <a href="{{ route('favoritos') }}" class="text-xs font-bold bg-white/80 text-violet-600 rounded-full px-3 py-1">Favoritos</a>
    </nav>

    @if(session('sucesso'))
        <div class="bg-emerald-200 text-emerald-900 rounded-2xl px-4 py-2 mb-3 text-sm">{{ session('sucesso') }}</div>
    @endif
    @if(session('erro'))
        <div class="bg-rose-300 text-white rounded-2xl px-4 py-2 mb-3 text-sm">{{ session('erro') }}</div>
    @endif

    <div class="la-frame rounded-[1.9rem] p-3">
        <form action="{{ route('aleatorio') }}" method="GET" class="la-cell rounded-2xl p-2 mb-3 flex gap-2">
            <input type="text" name="pokemon" placeholder="Nome ou número..."
                   class="flex-1 bg-white/75 border border-violet-200 rounded-xl px-3 py-1.5 text-sm focus:outline-none focus:border-violet-400">
            <button type="submit" class="bg-violet-500 text-white rounded-xl px-3 py-1.5 text-sm font-semibold">Buscar</button>
        </form>

        <div class="la-cell rounded-2xl p-3 mb-3">
            <div class="bg-white/70 rounded-2xl border border-violet-200 p-3 text-center">
                <img src="{{ $pokemon['sprites']['other']['official-artwork']['front_default'] ?? '' }}"
                     alt="{{ $pokemon['name'] }}"
                     class="w-40 h-40 object-contain mx-auto">
            </div>
            <div class="grid grid-cols-2 gap-2 mt-2 text-xs">
                <div class="la-cell rounded-xl p-2 text-center">
                    <p class="text-violet-400">No.</p>
                    <p class="font-bold text-violet-700">#{{ str_pad($pokemon['id'], 4, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div class="la-cell rounded-xl p-2 text-center">
                    <p class="text-violet-400">Nome</p>
                    <p class="font-bold text-violet-700 capitalize truncate">{{ $pokemon['name'] }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-2 text-xs mb-3">
            <div class="la-cell rounded-xl p-2 text-center">
                <p class="text-violet-400">Altura</p>
                <p class="font-bold text-violet-700">{{ $pokemon['height'] / 10 }}m</p>
            </div>
            <div class="la-cell rounded-xl p-2 text-center">
                <p class="text-violet-400">Peso</p>
                <p class="font-bold text-violet-700">{{ $pokemon['weight'] / 10 }}kg</p>
            </div>
        </div>

        @if(!empty($pokemon['types']))
            <div class="la-cell rounded-xl p-2 mb-2">
                <p class="text-[11px] font-bold text-violet-600 mb-1">Tipos</p>
                <div class="flex flex-wrap gap-1">
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
                        <span class="px-2 py-0.5 {{ $color }} text-white text-[10px] font-bold rounded-full uppercase">
                            {{ $tipo['type']['name'] }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

        @if(!empty($pokemon['stats']))
            <div class="la-cell rounded-xl p-2 mb-2">
                <p class="text-[11px] font-bold text-violet-600 mb-1">Status</p>
                <div class="space-y-1">
                    @foreach ($pokemon['stats'] as $stat)
                        @php
                            $pct = min(($stat['base_stat'] / 255) * 100, 100);
                            $barColor = $pct > 66 ? 'bg-green-500' : ($pct > 33 ? 'bg-yellow-500' : 'bg-red-500');
                        @endphp
                        <div>
                            <div class="flex justify-between text-[10px] text-violet-500">
                                <span class="capitalize">{{ $stat['stat']['name'] }}</span>
                                <span class="font-bold text-violet-700">{{ $stat['base_stat'] }}</span>
                            </div>
                            <div class="w-full bg-violet-100 h-1.5 rounded-full overflow-hidden">
                                <div class="{{ $barColor }} h-1.5 rounded-full" style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if(!empty($pokemon['abilities']))
            <div class="la-cell rounded-xl p-2 mb-2">
                <p class="text-[11px] font-bold text-violet-600 mb-1">Habilidades</p>
                <div class="flex flex-wrap gap-1">
                    @foreach($pokemon['abilities'] as $hab)
                        <span class="bg-white/80 border border-violet-200 text-violet-700 text-[10px] px-2 py-0.5 rounded-full capitalize">
                            {{ $hab['ability']['name'] }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

        @if(!empty($pokemon['moves']) && count($pokemon['moves']) > 0)
            <div class="la-cell rounded-xl p-2 mb-3">
                <p class="text-[11px] font-bold text-violet-600 mb-1">Ataques</p>
                <div class="flex flex-wrap gap-1">
                    @foreach(array_slice($pokemon['moves'], 0, 12) as $move)
                        <span class="bg-white/80 border border-violet-200 text-violet-700 text-[10px] px-2 py-0.5 rounded-full capitalize">
                            {{ $move['move']['name'] }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="flex gap-2">
            <a href="{{ route('aleatorio') }}" class="flex-1 text-center bg-violet-500 hover:bg-violet-600 text-white font-semibold rounded-full py-2 text-sm">
                🎲 Rodar
            </a>
            @php
                $jaFavoritado = $favoritos->where('pokemon_api_id', $pokemon['id'])->isNotEmpty();
            @endphp
            @if(!$jaFavoritado)
                <form action="{{ route('pokemon.salvar') }}" method="POST" class="flex-1">
                    @csrf
                    <input type="hidden" name="pokemon_id" value="{{ $pokemon['id'] }}">
                    <input type="hidden" name="name" value="{{ $pokemon['name'] }}">
                    <input type="hidden" name="image" value="{{ $pokemon['sprites']['other']['official-artwork']['front_default'] ?? '' }}">
                    <button type="submit" class="w-full bg-amber-300 hover:bg-amber-200 text-amber-950 font-semibold rounded-full py-2 text-sm">
                        ⭐ Favoritar
                    </button>
                </form>
            @else
                <span class="flex-1 bg-amber-500 text-amber-950 font-semibold rounded-full py-2 text-sm text-center">⭐ Favoritado</span>
            @endif
        </div>
    </div>
</div>
</body>
</html>
