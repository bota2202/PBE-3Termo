<x-app-layout>
    <x-slot name="header">
        <h2 style="text-align:center; font-size:32px; font-weight:800;">
            Cadastrar Produto
        </h2>
    </x-slot>

    <div style="background:#f3f4f6; min-height:100vh; padding:60px 0;">
        <div style="max-width:700px; margin:0 auto; padding:0 24px;">

            <div style="background:white; border-radius:24px; padding:40px; box-shadow:0 15px 35px rgba(0,0,0,0.08);">

                @if ($errors->any())
                    <div style="background:#fee2e2; padding:15px; border-radius:12px; margin-bottom:20px;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li style="color:#991b1b;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('produtos.store') }}">
                    @csrf

                    <input type="text" name="nome" placeholder="Nome do produto"
                           value="{{ old('nome') }}"
                           style="width:100%; padding:14px; margin-bottom:15px; border-radius:12px; border:1px solid #ddd;" required>

                    <textarea name="descricao" placeholder="Descrição"
                        style="width:100%; padding:14px; margin-bottom:15px; border-radius:12px; border:1px solid #ddd; min-height:100px;">{{ old('descricao') }}</textarea>

                    <input type="number" name="preco" step="0.01"
                           placeholder="Preço"
                           value="{{ old('preco') }}"
                           style="width:100%; padding:14px; margin-bottom:15px; border-radius:12px; border:1px solid #ddd;" required>

                    <input type="text" name="categoria"
                           placeholder="Categoria"
                           value="{{ old('categoria') }}"
                           style="width:100%; padding:14px; margin-bottom:25px; border-radius:12px; border:1px solid #ddd;" required>

                    <button type="submit"
                        style="width:100%; padding:14px; border:none; border-radius:999px; background:linear-gradient(135deg,#f59e0b,#f97316); color:white; font-weight:700;">
                        Cadastrar Produto
                    </button>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>