<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista de Estoque</title>
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

    <h2>Lista de Estoque</h2>

    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Categoria</th>
                <th>Ativo</th>
            </tr>
        </thead>
        <tbody>
            @forelse($estoques as $estoque)
                <tr>
                    <td>{{ $estoque->produto }}</td>
                    <td>{{ $estoque->quantidade }}</td>
                    <td>R$ {{ number_format($estoque->preco, 2, ',', '.') }}</td>
                    <td>{{ $estoque->categoria ?? '-' }}</td>
                    <td>{{ $estoque->ativo ? 'Sim' : 'Não' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Nenhum item no estoque.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>