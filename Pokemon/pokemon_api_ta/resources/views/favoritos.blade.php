<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favoritos</title>
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
        .slot {
            background: rgba(255, 255, 255, 0.58);
            border: 1px solid #dab6ed;
        }
    </style>
</head>
<body class="min-h-screen text-slate-700 p-4">
<div class="max-w-2xl mx-auto">
    <nav class="la-frame rounded-full px-3 py-2 mb-4 flex items-center justify-between gap-2">
        <a href="{{ route('pokemon.cadastroForm') }}" class="text-xs font-bold bg-white/80 text-violet-600 rounded-full px-3 py-1">Cadastrar</a>
        <a href="{{ route('aleatorio') }}" class="text-xs font-bold bg-white/80 text-violet-600 rounded-full px-3 py-1">Aleatório</a>
        <a href="{{ route('pokedex') }}" class="text-xs font-bold bg-white/80 text-violet-600 rounded-full px-3 py-1">Pokedex</a>
        <a href="{{ route('favoritos') }}" class="text-xs font-bold bg-violet-500 text-white rounded-full px-3 py-1">Favoritos</a>
    </nav>

    <div class="la-frame rounded-[1.9rem] p-3">
        <div class="bg-white/66 rounded-2xl p-3 mb-3 text-center">
            <h1 class="text-sm font-bold text-violet-700 tracking-wide">Favoritos</h1>
            <p class="text-xs text-violet-500">{{ $favoritos->count() }} pokemon(s)</p>
        </div>

        @if($favoritos->isEmpty())
            <div class="slot rounded-2xl p-6 text-center text-violet-500 text-sm">
                Nenhum pokemon favoritado ainda.
            </div>
        @else
            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-2">
                @foreach($favoritos as $fav)
                    <div class="slot rounded-xl p-2 text-center">
                        <a href="{{ route('aleatorio', ['pokemon' => $fav->pokemon_api_id]) }}" class="block">
                            <img src="{{ $fav->image }}" alt="{{ $fav->name }}" class="w-10 h-10 object-contain mx-auto mb-1">
                            <p class="text-[10px] font-bold text-violet-700 truncate capitalize">{{ $fav->name }}</p>
                            <p class="text-[9px] text-violet-500">#{{ str_pad($fav->pokemon_api_id, 4, '0', STR_PAD_LEFT) }}</p>
                        </a>
                        <form action="{{ route('pokemon.removerFavorito') }}" method="POST" class="mt-1">
                            @csrf
                            <input type="hidden" name="id" value="{{ $fav->id }}">
                            <button type="submit" class="w-full text-[9px] bg-rose-100 text-rose-600 rounded-full py-1 hover:bg-rose-200 transition">
                                Remover
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
</body>
</html>
