<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; flex-direction:column; align-items:center; gap:20px;">
            <h2 style="font-size:32px; font-weight:800; color:#1f2937;">
                Clientes
            </h2>

            <a href="{{ route('clientes.create') }}"
               style="
                    background:linear-gradient(135deg,#3b82f6,#2563eb);
                    color:white;
                    padding:14px 28px;
                    border-radius:999px;
                    font-weight:700;
                    font-size:14px;
                    letter-spacing:1px;
                    text-transform:uppercase;
                    text-decoration:none;
                    box-shadow:0 10px 20px rgba(37,99,235,0.25);
                    transition:all 0.25s ease;
               "
               onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 16px 30px rgba(37,99,235,0.35)'"
               onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 10px 20px rgba(37,99,235,0.25)'"
            >
                + Novo Cliente
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
                    Total de clientes:
                    <span style="font-weight:700; color:#111827;">
                        {{ $clientes->count() }}
                    </span>
                </p>
            </div>

            @if($clientes->count() > 0)
                <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:32px; align-items:stretch;">
                    @foreach ($clientes as $cliente)
                        @php
                            $cor1 = '#10b981';
                            $cor2 = '#14b8a6';
                            $badgeBg = $cliente->reserva ? '#dcfce7' : '#fee2e2';
                            $badgeColor = $cliente->reserva ? '#15803d' : '#b91c1c';
                        @endphp

                        <div
                            style="
                                background:#ffffff;
                                border-radius:24px;
                                padding:32px 24px;
                                box-shadow:0 10px 25px rgba(0,0,0,0.08);
                                text-align:center;
                                min-height:430px;
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
                                        {{ strtoupper(substr($cliente->nome, 0, 1)) }}
                                    </div>
                                </div>

                                <h3 style="font-size:26px; font-weight:800; color:#1f2937; margin-bottom:14px;">
                                    {{ $cliente->nome }}
                                </h3>

                                <p style="font-size:16px; color:#6b7280; margin-bottom:10px;">
                                    CPF: <strong style="color:#111827;">{{ $cliente->cpf }}</strong>
                                </p>

                                <p style="font-size:16px; color:#6b7280; margin-bottom:10px;">
                                    Email: <strong style="color:#111827;">{{ $cliente->email ?? 'Não informado' }}</strong>
                                </p>

                                <p style="font-size:16px; color:#6b7280; margin-bottom:10px;">
                                    Telefone: <strong style="color:#111827;">{{ $cliente->telefone }}</strong>
                                </p>

                                <p style="font-size:16px; color:#6b7280; margin-bottom:22px;">
                                    Endereço: <strong style="color:#111827;">{{ $cliente->endereco ?? 'Não informado' }}</strong>
                                </p>

                                <div>
                                    <span
                                        style="
                                            display:inline-block;
                                            padding:10px 18px;
                                            border-radius:999px;
                                            font-size:14px;
                                            font-weight:700;
                                            background:{{ $badgeBg }};
                                            color:{{ $badgeColor }};
                                        "
                                    >
                                        {{ $cliente->reserva ? 'Reserva ativa' : 'Sem reserva' }}
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
                    <div style="font-size:52px; margin-bottom:14px;">👤</div>

                    <h3 style="font-size:28px; font-weight:800; color:#1f2937; margin-bottom:10px;">
                        Nenhum cliente cadastrado
                    </h3>

                    <p style="font-size:16px; color:#6b7280; margin-bottom:25px;">
                        Quando houver clientes, eles aparecerão aqui.
                    </p>

                    <a href="{{ route('clientes.create') }}"
                       style="
                            background:linear-gradient(135deg,#3b82f6,#2563eb);
                            color:white;
                            padding:14px 28px;
                            border-radius:999px;
                            font-weight:700;
                            text-transform:uppercase;
                            text-decoration:none;
                            box-shadow:0 10px 20px rgba(37,99,235,0.25);
                            transition:all 0.25s ease;
                       "
                    >
                        Cadastrar primeiro cliente
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>