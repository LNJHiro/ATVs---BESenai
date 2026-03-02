<h1>Lista de Pedidos</h1>

<a href="{{ route('pedidos.create') }}">Novo Pedido</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Número</th>
        <th>Data</th>
        <th>Status</th>
        <th>Observação</th>
    </tr>

    @foreach($pedidos as $pedido)
        <tr>
            <td>{{ $pedido->id }}</td>
            <td>{{ $pedido->numero }}</td>
            <td>{{ $pedido->data }}</td>
            <td>{{ $pedido->status }}</td>
            <td>{{ $pedido->observacao }}</td>
        </tr>
    @endforeach
</table>