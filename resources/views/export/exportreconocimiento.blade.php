<table>
    <thead>
        <tr>
            <th>N</th>
            <th>DUA</th>
            <th>TIPO</th>
            <th>CONTENEDOR</th>
            <th>ADM</th>
            <th>EXPEDIENTE</th>
            <th>CLIENTE</th>
            <th>RENUNCIA</th>
            <th>BL</th>
            <th>DESCRIPCION</th>
            <th>COLOR</th>
            <th>FUNCIONARIO</th>
            <th>ALMACEN</th>
            <th>BASE</th>
        </tr>
    </thead>

    <tbody>
        @php 
            $i = 1;
        @endphp
        @foreach ($exportacion as $datos)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $datos->dua }}</td>
                <td>{{ $datos->tipo }}</td>
                <td>{{ $datos->contenedor }}</td>
                <td>{{ $datos->cliente }}</td>
                <td>{{ $datos->expediente }}</td>
                <td>{{ $datos->consignatario }}</td>
                <td>{{ $datos->renuncia }}</td>
                <td>{{ $datos->bl }}</td>
                <td>{{ $datos->descripcion }}</td>
                <td>{{ $datos->color > 0 ? $datos->colors->nombre : '' }}</td>
                <td>{{ $datos->funcionario }}</td>
                <td>{{ $datos->almacen }}</td>
                <td>{{ $datos->base }}</td>
            </tr>
        @endforeach
    </tbody>

</table>
