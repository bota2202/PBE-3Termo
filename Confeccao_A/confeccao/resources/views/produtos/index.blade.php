<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; flex-direction:column; align-items:center; gap:20px;">
            <h2 style="font-size:32px; font-weight:800; color:#1f2937;">
                Produtos
            </h2>

            <a href="{{ route('produtos.create') }}"
               style="
                    background:linear-gradient(135deg,#f59e0b,#f97316);
                    color:white;
                    padding:14px 28px;
                    border-radius:999px;
                    font-weight:700;
                    font-size:14px;
                    letter-spacing:1px;
                    text-transform:uppercase;
                    text-decoration:none;
                    box-shadow:0 10px 20px rgba(249,115,22,0.25);
                    transition:all 0.25s ease;
               "
               onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 16px 30px rgba(249,115,22,0.35)'"
               onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 10px 20px rgba(249,115,22,0.25)'"
            >
                + Novo Produto
            </a>
        </div>
    </x-slot>

    <div style="background:#f3f4f6; min-height:100vh; padding:40px 0;">
        <div style="max-width:1200px; margin:0 auto; padding:0 24px;">

            @if(session('success'))
                <div style="
                    max-width:700px;
                    margin:0 auto 30px auto;
                    background:#dcfce7;
                    color:#166534;
                    padding:16px 20px;
                    border-radius:16px;
                    font-weight:700;
                    text-align:center;
                    border:1px solid #bbf7d0;
                    box-shadow:0 8px 20px rgba(0,0,0,0.05);
                ">
                    {{ session('success') }}
                </div>
            @endif

            <div style="text-align:center; margin-bottom:30px;">
                <p style="font-size:20px; color:#4b5563;">
                    Total de produtos:
                    <span style="font-weight:700; color:#111827;">
                        {{ $produtos->count() }}
                    </span>
                </p>
            </div>

            @if($produtos->count() > 0)

                <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:32px; align-items:stretch;">
                    @foreach ($produtos as $produto)

                        @php
                            $cor1 = '#f59e0b';
                            $cor2 = '#f97316';
                        @endphp

                        <div
                            style="
                                background:#ffffff;
                                border-radius:24px;
                                padding:32px 24px;
                                box-shadow:0 10px 25px rgba(0,0,0,0.08);
                                text-align:center;
                                min-height:420px;
                                display:flex;
                                flex-direction:column;
                                justify-content:space-between;
                                border:1px solid #e5e7eb;
                                transition:all 0.25s ease;
                            "
                            onmouseover="this.style.transform='translateY(-8px)';this.style.boxShadow='0 18px 35px rgba(0,0,0,0.14)'"
                            onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 10px 25px rgba(0,0,0,0.08)'"
                        >
                            <div>

                                <!-- Avatar -->
                                <div style="display:flex; justify-content:center; margin-bottom:22px;">
                                    <div
                                        style="
                                            width:82px;
                                            height:82px;
                                            border-radius:999px;
                                            display:flex;
                                            align-items:center;
                                            justify-content:center;
                                            color:white;
                                            font-size:30px;
                                            font-weight:800;
                                            background:linear-gradient(135deg, {{ $cor1 }}, {{ $cor2 }});
                                            box-shadow:0 10px 20px rgba(0,0,0,0.12);
                                        "
                                    >
                                        {{ strtoupper(substr($produto->nome, 0, 1)) }}
                                    </div>
                                </div>

                                <!-- Nome -->
                                <h3 style="font-size:24px; font-weight:800; color:#1f2937; margin-bottom:14px;">
                                    {{ $produto->nome }}
                                </h3>

                                <!-- Descrição -->
                                <p style="font-size:15px; color:#6b7280; margin-bottom:14px;">
                                    <strong style="color:#111827;">Descrição:</strong>
                                    {{ $produto->descricao ?? 'Sem descrição' }}
                                </p>

                                <!-- Categoria -->
                                <p style="font-size:15px; color:#6b7280; margin-bottom:20px;">
                                    Categoria:
                                    <strong style="color:#111827;">
                                        {{ $produto->categoria ?? 'Não informada' }}
                                    </strong>
                                </p>

                                <!-- Preço -->
                                <div style="margin-bottom:22px;">
                                    <span style="font-size:30px; font-weight:900; color:#111827;">
                                        R$ {{ number_format($produto->preco, 2, ',', '.') }}
                                    </span>
                                </div>

                                <!-- Badge -->
                                <div>
                                    <span
                                        style="
                                            display:inline-block;
                                            padding:10px 18px;
                                            border-radius:999px;
                                            font-size:14px;
                                            font-weight:700;
                                            background:#ffedd5;
                                            color:#c2410c;
                                        "
                                    >
                                        Produto disponível
                                    </span>
                                </div>

                            </div>
                        </div>

                    @endforeach
                </div>

            @else

                <div style="
                    max-width:700px;
                    margin:0 auto;
                    background:white;
                    border-radius:24px;
                    padding:48px 32px;
                    text-align:center;
                    box-shadow:0 10px 25px rgba(0,0,0,0.08);
                    border:1px solid #e5e7eb;
                ">
                    <div style="font-size:52px; margin-bottom:14px;">📦</div>

                    <h3 style="font-size:28px; font-weight:800; color:#1f2937; margin-bottom:10px;">
                        Nenhum produto cadastrado
                    </h3>

                    <p style="font-size:16px; color:#6b7280; margin-bottom:25px;">
                        Quando houver produtos, eles aparecerão aqui organizados em cards.
                    </p>

                    <a href="{{ route('produtos.create') }}"
                       style="
                            background:linear-gradient(135deg,#f59e0b,#f97316);
                            color:white;
                            padding:14px 28px;
                            border-radius:999px;
                            font-weight:700;
                            text-transform:uppercase;
                            text-decoration:none;
                            box-shadow:0 10px 20px rgba(249,115,22,0.25);
                            transition:all 0.25s ease;
                       "
                    >
                        Cadastrar primeiro produto
                    </a>
                </div>

            @endif

        </div>
    </div>
</x-app-layout>