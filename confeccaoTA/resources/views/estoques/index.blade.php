<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Estoque</h1>

<a href="{{ route('estoques.create') }}">Novo Produto</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Produto</th>
        <th>Código</th>
        <th>Quantidade</th>
        <th>Preço</th>
    </tr>

    @foreach($estoques as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->produto }}</td>
            <td>{{ $item->codigo }}</td>
            <td>{{ $item->quantidade }}</td>
            <td>{{ $item->preco }}</td>
        </tr>
    @endforeach
</table>
</body>
</html>