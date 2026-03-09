<x-app-layout>
    <x-slot name="header">
        <h2 style="text-align:center; font-size:32px; font-weight:800; color:#1f2937;">
            Cadastrar Cliente
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

                <form method="POST" action="{{ route('clientes.store') }}">
                    @csrf

                    <div style="margin-bottom:22px;">
                        <label style="font-weight:700; display:block; margin-bottom:8px; color:#374151;">
                            Nome
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
                            onfocus="this.style.borderColor='#6366f1';this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.2)'"
                            onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'"
                        >
                    </div>

                    <div style="margin-bottom:22px;">
                        <label style="font-weight:700; display:block; margin-bottom:8px; color:#374151;">
                            CPF
                        </label>
                        <input
                            type="text"
                            name="cpf"
                            id="cpf"
                            value="{{ old('cpf') }}"
                            maxlength="14"
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
                            onfocus="this.style.borderColor='#6366f1';this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.2)'"
                            onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'"
                        >
                    </div>

                    <div style="margin-bottom:22px;">
                        <label style="font-weight:700; display:block; margin-bottom:8px; color:#374151;">
                            Email
                        </label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
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
                            onfocus="this.style.borderColor='#6366f1';this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.2)'"
                            onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'"
                        >
                    </div>

                    <div style="margin-bottom:22px;">
                        <label style="font-weight:700; display:block; margin-bottom:8px; color:#374151;">
                            Telefone
                        </label>
                        <input
                            type="text"
                            name="telefone"
                            id="telefone"
                            value="{{ old('telefone') }}"
                            maxlength="15"
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
                            onfocus="this.style.borderColor='#6366f1';this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.2)'"
                            onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'"
                        >
                    </div>

                    <div style="margin-bottom:30px;">
                        <label style="font-weight:700; display:block; margin-bottom:8px; color:#374151;">
                            Endereço
                        </label>
                        <input
                            type="text"
                            name="endereco"
                            value="{{ old('endereco') }}"
                            style="
                                width:100%;
                                padding:14px 16px;
                                border-radius:12px;
                                border:1px solid #d1d5db;
                                font-size:15px;
                                outline:none;
                                transition:all 0.2s;
                            "
                            onfocus="this.style.borderColor='#6366f1';this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.2)'"
                            onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'"
                        >
                    </div>

                    <div style="text-align:center;">
                        <button
                            type="submit"
                            style="
                                background:linear-gradient(135deg,#6366f1,#8b5cf6);
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
                            Cadastrar Cliente
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const cpfInput = document.getElementById("cpf");
            const telefoneInput = document.getElementById("telefone");

            cpfInput.addEventListener("input", function (e) {
                let value = e.target.value.replace(/\D/g, "");

                if (value.length > 11) value = value.slice(0, 11);

                value = value
                    .replace(/^(\d{3})(\d)/, "$1.$2")
                    .replace(/^(\d{3})\.(\d{3})(\d)/, "$1.$2.$3")
                    .replace(/\.(\d{3})(\d)/, ".$1-$2");

                e.target.value = value;
            });

            telefoneInput.addEventListener("input", function (e) {
                let value = e.target.value.replace(/\D/g, "");

                if (value.length > 11) value = value.slice(0, 11);

                if (value.length > 10) {
                    value = value.replace(/^(\d{2})(\d{5})(\d{4})$/, "($1) $2-$3");
                } else if (value.length > 6) {
                    value = value.replace(/^(\d{2})(\d{4})(\d+)/, "($1) $2-$3");
                } else if (value.length > 2) {
                    value = value.replace(/^(\d{2})(\d+)/, "($1) $2");
                } else if (value.length > 0) {
                    value = value.replace(/^(\d+)/, "($1");
                }

                e.target.value = value;
            });
        });
    </script>
</x-app-layout>