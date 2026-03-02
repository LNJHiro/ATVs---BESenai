<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Lista de Fornecedores</h1>

<a href="{{ route('fornecedores.create') }}">Novo Fornecedor</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>CNPJ</th>
        <th>Telefone</th>
    </tr>

    @foreach($fornecedores as $fornecedor)
        <tr>
            <td>{{ $fornecedor->id }}</td>
            <td>{{ $fornecedor->nome }}</td>
            <td>{{ $fornecedor->cnpj }}</td>
            <td>{{ $fornecedor->telefone }}</td>
        </tr>
    @endforeach
</table>
</body>
</html>