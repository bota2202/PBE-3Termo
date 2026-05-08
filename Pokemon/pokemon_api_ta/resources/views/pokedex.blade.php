<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex</title>
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
        .slot-locked {
            background: rgba(255, 255, 255, 0.44);
        }
    </style>
</head>
<body class="min-h-screen text-slate-700 p-4">
<div class="max-w-4xl mx-auto">
    <nav class="la-frame rounded-full px-3 py-2 mb-4 flex items-center justify-between gap-2">
        <a href="{{ route('pokemon.cadastroForm') }}" class="text-xs font-bold bg-white/80 text-violet-600 rounded-full px-3 py-1">Cadastrar</a>
        <a href="{{ route('aleatorio') }}" class="text-xs font-bold bg-white/80 text-violet-600 rounded-full px-3 py-1">Aleatório</a>
        <a href="{{ route('pokedex') }}" class="text-xs font-bold bg-violet-500 text-white rounded-full px-3 py-1">Pokedex</a>
        <a href="{{ route('favoritos') }}" class="text-xs font-bold bg-white/80 text-violet-600 rounded-full px-3 py-1">Favoritos</a>
    </nav>

    <div class="la-frame rounded-[1.9rem] p-3">
        <div class="bg-white/66 rounded-2xl p-3 mb-3 text-center">
            <h1 class="text-sm font-bold text-violet-700 tracking-wide">Hisui Pokédex</h1>
            <p class="text-xs text-violet-500">
                Desbloqueados: {{ collect($slots)->where('unlocked', true)->count() }} / {{ count($slots) }}
            </p>
        </div>

        <div class="grid grid-cols-12 gap-1.5">
            @foreach($slots as $slot)
                @if($slot['unlocked'])
                    <a href="{{ route('aleatorio', ['pokemon' => $slot['id']]) }}" class="slot rounded-xl p-1.5 block text-center hover:border-violet-400 transition">
                        <img src="{{ $slot['image'] }}" alt="{{ $slot['name'] }}" class="w-8 h-8 object-contain mx-auto mb-1">
                        <p class="text-[9px] font-bold text-violet-700 leading-none">#{{ str_pad($slot['id'], 4, '0', STR_PAD_LEFT) }}</p>
                    </a>
                @else
                    <div class="slot slot-locked rounded-xl p-1.5 text-center">
                        <div class="w-8 h-8 mx-auto mb-1 rounded-lg border border-dashed border-violet-300 bg-white/30 flex items-center justify-center">
                            <span class="text-violet-400 text-base font-bold">?</span>
                        </div>
                        <p class="text-[9px] font-bold text-violet-400 leading-none">#{{ str_pad($slot['id'], 4, '0', STR_PAD_LEFT) }}</p>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
</body>
</html>
