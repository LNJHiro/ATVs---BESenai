<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Lista de Clientes</h1>

<a href="{{ route('clientes.create') }}">Novo Cliente</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>CPF</th>
        <th>Telefone</th>
    </tr>

    @foreach($clientes as $cliente)
        <tr>
            <td>{{ $cliente->id }}</td>
            <td>{{ $cliente->nome }}</td>
            <td>{{ $cliente->cpf }}</td>
            <td>{{ $cliente->telefone }}</td>
        </tr>
    @endforeach
</table>
    
</body>
</html>