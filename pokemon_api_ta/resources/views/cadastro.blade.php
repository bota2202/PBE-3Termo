<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Pokémon</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 min-h-screen text-white">

<!-- Navbar -->
<nav class="bg-red-700 px-6 py-3 flex items-center justify-between shadow-lg">
    <span class="text-xl font-bold tracking-widest">⚡ Pokédex</span>
    <div class="flex gap-3">
        <a href="{{ route('pokedex') }}"
           class="bg-white text-red-700 font-semibold px-4 py-1.5 rounded-full text-sm hover:bg-red-100 transition">
            ← Voltar
        </a>
    </div>
</nav>

<div class="max-w-2xl mx-auto px-4 py-10">

    <div class="bg-gray-800 rounded-2xl shadow-2xl border border-gray-700 p-8">
        <div class="flex items-center gap-3 mb-6">
            <span class="text-3xl">➕</span>
            <div>
                <h1 class="text-2xl font-bold">Cadastrar Pokémon</h1>
                <p class="text-gray-400 text-sm">Próximo ID disponível: <span class="text-yellow-400 font-bold">#{{ $proximoId }}</span></p>
            </div>
        </div>

        @if($errors->any())
        <div class="bg-red-900 border border-red-700 rounded-lg p-4 mb-6">
            <p class="font-semibold text-red-300 mb-2">Corrija os erros abaixo:</p>
            <ul class="list-disc list-inside text-sm text-red-300 space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('pokemon.cadastrar') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Nome -->
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-1">Nome *</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       placeholder="Ex: flamagon"
                       class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:outline-none focus:border-red-500 @error('name') border-red-500 @enderror">
            </div>

            <!-- Descrição -->
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-1">Descrição</label>
                <textarea name="description" rows="3"
                          placeholder="Descreva o pokémon..."
                          class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:outline-none focus:border-red-500 resize-none">{{ old('description') }}</textarea>
            </div>

            <!-- URL da Imagem -->
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-1">URL da Imagem</label>
                <input type="url" name="image" value="{{ old('image') }}"
                       placeholder="https://..."
                       class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:outline-none focus:border-red-500">
                <p class="text-xs text-gray-500 mt-1">Cole o link de uma imagem PNG/JPG do seu pokémon.</p>
                @error('image')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tipos -->
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">Tipos * <span class="text-gray-400 font-normal">(selecione até 2)</span></label>
                @php
                    $allTypes = ['normal','fire','water','grass','electric','ice','fighting','poison',
                                 'ground','flying','psychic','bug','rock','ghost','dragon','dark','steel','fairy'];
                    $oldTypes = old('types') ? explode(',', old('types')) : [];
                @endphp
                <div class="flex flex-wrap gap-2" id="type-buttons">
                    @foreach($allTypes as $type)
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
                        $color = $typeColors[$type] ?? 'bg-gray-600';
                        $selected = in_array($type, $oldTypes);
                    @endphp
                    <button type="button"
                            onclick="toggleType('{{ $type }}')"
                            id="type-btn-{{ $type }}"
                            class="type-btn px-3 py-1 {{ $color }} rounded-full text-xs font-bold uppercase transition border-2 {{ $selected ? 'border-white scale-110' : 'border-transparent opacity-60' }}"
                            data-type="{{ $type }}"
                            data-selected="{{ $selected ? 'true' : 'false' }}">
                        {{ $type }}
                    </button>
                    @endforeach
                </div>
                <input type="hidden" name="types" id="types-input" value="{{ old('types') }}">
                @error('types')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Altura e Peso -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-1">Altura * <span class="text-gray-400 font-normal">(dm)</span></label>
                    <input type="number" name="height" value="{{ old('height', 10) }}" min="1"
                           class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-red-500">
                    <p class="text-xs text-gray-500 mt-1">10 dm = 1.0m</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-1">Peso * <span class="text-gray-400 font-normal">(hg)</span></label>
                    <input type="number" name="weight" value="{{ old('weight', 100) }}" min="1"
                           class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-red-500">
                    <p class="text-xs text-gray-500 mt-1">100 hg = 10.0kg</p>
                </div>
            </div>

            <!-- Stats -->
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-3">Estatísticas * <span class="text-gray-400 font-normal">(1–255)</span></label>
                <div class="grid grid-cols-2 gap-4">
                    @foreach(['hp' => 'HP', 'attack' => 'Ataque', 'defense' => 'Defesa', 'speed' => 'Velocidade'] as $field => $label)
                    <div>
                        <label class="block text-xs text-gray-400 mb-1">{{ $label }}</label>
                        <input type="number" name="{{ $field }}" value="{{ old($field, 50) }}" min="1" max="255"
                               class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-red-500">
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Habilidades -->
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-1">Habilidades <span class="text-gray-400 font-normal">(separadas por vírgula)</span></label>
                <input type="text" name="abilities" value="{{ old('abilities') }}"
                       placeholder="Ex: blaze, solar-power"
                       class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:outline-none focus:border-red-500">
            </div>

            <!-- Botão -->
            <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl transition text-lg mt-2">
                ✅ Cadastrar Pokémon #{{ $proximoId }}
            </button>
        </form>
    </div>
</div>

<script>
    const selectedTypes = new Set(
        @if(old('types'))
            {{ json_encode(explode(',', old('types'))) }}
        @else
            []
        @endif
    );

    function toggleType(type) {
        const btn = document.getElementById('type-btn-' + type);
        if (selectedTypes.has(type)) {
            selectedTypes.delete(type);
            btn.classList.remove('border-white', 'scale-110');
            btn.classList.add('border-transparent', 'opacity-60');
        } else {
            if (selectedTypes.size >= 2) {
                alert('Selecione no máximo 2 tipos!');
                return;
            }
            selectedTypes.add(type);
            btn.classList.add('border-white', 'scale-110');
            btn.classList.remove('border-transparent', 'opacity-60');
        }
        document.getElementById('types-input').value = Array.from(selectedTypes).join(',');
    }
</script>
</body>
</html>
