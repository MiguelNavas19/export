<table>
    <thead>
        <tr>
            <th>EXPEDIENTE</th>
            <th>CONSIGNATARIO</th>
            <th>BL</th>
            <th>TIPO</th>
            <th>CONTENEDOR</th>
            <th>ETA</th>
            <th>OBSERVACIONES</th>
            <th>MOTONAVE</th>
            <th>CLIENTE</th>
            <th>LINEA/ CONSOLIDADOR</th>
            <th>ENVIO</th>
            <th>ESTATUS</th>

        </tr>
    </thead>

    <tbody>
        @foreach ($exportacion as $datos)
            <tr>
                <td> {{ $datos->expediente }}</td>
                <td> {{ $datos->consignatario}}</td>
                <td> {{ $datos->bl }}</td>
                <td> {{ $datos->tipo }}</td>
                <td> {{ $datos->contenedor }}</td>
                <td> {{ $datos->eta }}</td>
                <td> {{ $datos->obs }}</td>
                <td> {{ $datos->motonave }}</td>
                <td> {{ $datos->cliente }}</td>
                <td> {{ $datos->linea }}</td>
                @if($datos->envio > 0)
                <td> {{ $datos->tipoenvio->nombre }}</td>
                @else
                <td> </td>
                @endif

                @if($datos->estatus > 0)
                <td> {{ $datos->tipoestatus->nombre  }}</td>
                @else
                <td> </td>
                @endif

            </tr>
        @endforeach
    </tbody>

</table>
