<x-app-layout>
    <x-slot name="header">
        <h2 style="text-align:center; font-size:32px; font-weight:800; color:#1f2937;">
            Cadastrar Item no Estoque
        </h2>
    </x-slot>

    <div style="background:#f3f4f6; min-height:100vh; padding:60px 0;">
        <div style="max-width:700px; margin:0 auto; padding:0 24px;">

            <div
                style="
                    background:white;
                    border-radius:24px;
                    padding:40px 36px;
                    box-shadow:0 15px 35px rgba(0,0,0,0.08);
                    border:1px solid #e5e7eb;
                "
            >

                @if ($errors->any())
                    <div style="
                        background:#fee2e2;
                        color:#991b1b;
                        padding:16px;
                        border-radius:12px;
                        margin-bottom:24px;
                        font-weight:600;
                    ">
                        <ul style="margin:0; padding-left:18px;">
                            @foreach ($errors->all() as $error)
                                <li style="margin-bottom:6px;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('estoque.store') }}">
                    @csrf

                    <div style="margin-bottom:22px;">
                        <label style="font-weight:700; display:block; margin-bottom:8px; color:#374151;">
                            Nome do item
                        </label>
                        <input
                            type="text"
                            name="nome"
                            value="{{ old('nome') }}"
                            required
                            style="
                                width:100%;
                                padding:14px 16px;
                                border-radius:12px;
                                border:1px solid #d1d5db;
                                font-size:15px;
                                outline:none;
                                transition:all 0.2s;
                            "
                            onfocus="this.style.borderColor='#10b981';this.style.boxShadow='0 0 0 3px rgba(16,185,129,0.18)'"
                            onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'"
                        >
                    </div>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px; margin-bottom:22px;">
                        <div>
                            <label style="font-weight:700; display:block; margin-bottom:8px; color:#374151;">
                                Quantidade
                            </label>
                            <input
                                type="number"
                                name="quantidade"
                                min="0"
                                step="1"
                                value="{{ old('quantidade') }}"
                                required
                                style="
                                    width:100%;
                                    padding:14px 16px;
                                    border-radius:12px;
                                    border:1px solid #d1d5db;
                                    font-size:15px;
                                    outline:none;
                                    transition:all 0.2s;
                                "
                                onfocus="this.style.borderColor='#10b981';this.style.boxShadow='0 0 0 3px rgba(16,185,129,0.18)'"
                                onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'"
                            >
                        </div>

                        <div>
                            <label style="font-weight:700; display:block; margin-bottom:8px; color:#374151;">
                                Reservado
                            </label>
                            <input
                                type="number"
                                name="reservado"
                                min="0"
                                step="1"
                                value="{{ old('reservado', 0) }}"
                                required
                                style="
                                    width:100%;
                                    padding:14px 16px;
                                    border-radius:12px;
                                    border:1px solid #d1d5db;
                                    font-size:15px;
                                    outline:none;
                                    transition:all 0.2s;
                                "
                                onfocus="this.style.borderColor='#10b981';this.style.boxShadow='0 0 0 3px rgba(16,185,129,0.18)'"
                                onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'"
                            >
                        </div>
                    </div>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px; margin-bottom:30px;">
                        <div>
                            <label style="font-weight:700; display:block; margin-bottom:8px; color:#374151;">
                                Preço
                            </label>
                            <input
                                type="number"
                                name="preco"
                                min="0"
                                step="0.01"
                                value="{{ old('preco') }}"
                                style="
                                    width:100%;
                                    padding:14px 16px;
                                    border-radius:12px;
                                    border:1px solid #d1d5db;
                                    font-size:15px;
                                    outline:none;
                                    transition:all 0.2s;
                                "
                                onfocus="this.style.borderColor='#10b981';this.style.boxShadow='0 0 0 3px rgba(16,185,129,0.18)'"
                                onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'"
                            >
                        </div>

                        <div>
                            <label style="font-weight:700; display:block; margin-bottom:8px; color:#374151;">
                                Data de entrada
                            </label>
                            <input
                                type="date"
                                name="data_entrada"
                                value="{{ old('data_entrada') }}"
                                max="{{ date('Y-m-d') }}"
                                style="
                                    width:100%;
                                    padding:14px 16px;
                                    border-radius:12px;
                                    border:1px solid #d1d5db;
                                    font-size:15px;
                                    outline:none;
                                    transition:all 0.2s;
                                "
                                onfocus="this.style.borderColor='#10b981';this.style.boxShadow='0 0 0 3px rgba(16,185,129,0.18)'"
                                onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'"
                            >
                        </div>
                    </div>

                    <div style="text-align:center;">
                        <button
                            type="submit"
                            style="
                                background:linear-gradient(135deg,#10b981,#14b8a6);
                                color:white;
                                padding:14px 40px;
                                border:none;
                                border-radius:999px;
                                font-size:16px;
                                font-weight:700;
                                cursor:pointer;
                                box-shadow:0 10px 20px rgba(0,0,0,0.1);
                                transition:all 0.25s ease;
                            "
                            onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 15px 30px rgba(0,0,0,0.18)'"
                            onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 10px 20px rgba(0,0,0,0.1)'"
                        >
                            Cadastrar Item
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>