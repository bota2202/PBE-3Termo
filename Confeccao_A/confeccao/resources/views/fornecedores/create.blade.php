<x-app-layout>
    <x-slot name="header">
        <h2 style="text-align:center; font-size:32px; font-weight:800;">
            Cadastrar Fornecedor
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

                <form method="POST" action="{{ route('fornecedores.store') }}">
                    @csrf

                    <input type="text" name="nome" placeholder="Nome"
                           value="{{ old('nome') }}"
                           style="width:100%; padding:14px; margin-bottom:15px; border-radius:12px; border:1px solid #ddd;" required>

                    <input type="text" name="cnpj" id="cnpj"
                           placeholder="CNPJ"
                           maxlength="18"
                           value="{{ old('cnpj') }}"
                           style="width:100%; padding:14px; margin-bottom:15px; border-radius:12px; border:1px solid #ddd;" required>

                    <input type="text" name="telefone" id="telefone"
                           placeholder="Telefone"
                           maxlength="15"
                           value="{{ old('telefone') }}"
                           style="width:100%; padding:14px; margin-bottom:15px; border-radius:12px; border:1px solid #ddd;">

                    <input type="email" name="email"
                           placeholder="Email"
                           value="{{ old('email') }}"
                           style="width:100%; padding:14px; margin-bottom:15px; border-radius:12px; border:1px solid #ddd;">

                    <input type="text" name="cidade"
                           placeholder="Cidade"
                           value="{{ old('cidade') }}"
                           style="width:100%; padding:14px; margin-bottom:25px; border-radius:12px; border:1px solid #ddd;">

                    <button type="submit"
                        style="width:100%; padding:14px; border:none; border-radius:999px; background:linear-gradient(135deg,#6366f1,#4f46e5); color:white; font-weight:700;">
                        Cadastrar Fornecedor
                    </button>
                </form>
            </div>
        </div>
    </div>

<script>
document.addEventListener("DOMContentLoaded", function() {

    const cnpj = document.getElementById("cnpj");
    const telefone = document.getElementById("telefone");

    // CNPJ mask
    cnpj.addEventListener("input", function(e) {
        let v = e.target.value.replace(/\D/g,"");
        if(v.length > 14) v = v.slice(0,14);
        v = v.replace(/^(\d{2})(\d)/,"$1.$2");
        v = v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3");
        v = v.replace(/\.(\d{3})(\d)/,".$1/$2");
        v = v.replace(/(\d{4})(\d)/,"$1-$2");
        e.target.value = v;
    });

    // Telefone mask
    telefone.addEventListener("input", function(e) {
        let v = e.target.value.replace(/\D/g,"");
        if(v.length > 11) v = v.slice(0,11);

        if(v.length > 10){
            v = v.replace(/^(\d{2})(\d{5})(\d{4})$/,"($1) $2-$3");
        } else if(v.length > 5){
            v = v.replace(/^(\d{2})(\d{4})(\d+)/,"($1) $2-$3");
        } else if(v.length > 2){
            v = v.replace(/^(\d{2})(\d+)/,"($1) $2");
        }

        e.target.value = v;
    });

});
</script>

</x-app-layout>