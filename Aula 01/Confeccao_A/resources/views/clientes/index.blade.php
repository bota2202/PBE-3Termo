<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Lista de Clientes</h2>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Reserva</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{ $cliente->cpf }}</td>
                    <td>{{ $cliente->telefone }}</td>
                    <td>
                        {{ $cliente->reserva ? 'Sim' : 'Não' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Nenhum cliente encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>