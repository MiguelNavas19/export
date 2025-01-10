<table>
    <thead>
        <tr>
            <th>CLIENTE</th>
            <th>EXPEDIENTE</th>
            <th>CONSIGNATARIO</th>
            <th>RENUNCIA</th>
            <th>BL</th>
            <th>CONTENEDOR</th>
            <th>TIPO</th>
            <th>ETA</th>
            <th>MOTONAVE</th>
            <th>LINEA / CONSOLIDADOR</th>
            <th>PUERTO</th>
            <th>OBSERVACIONES</th>
            <th>ENVIO</th>
            <th>ESTATUS</th>
            <th>LIBERACION</th>

        </tr>
    </thead>

    <tbody>
        @foreach ($exportacion as $datos)
            <tr>
                <td> {{ $datos->cliente }}</td>
                <td> {{ $datos->expediente }}</td>
                <td> {{ $datos->consignatario }}</td>
                <td> {{ $datos->renuncia }}</td>
                <td> {{ $datos->bl }}</td>
                <td> {{ $datos->contenedor }}</td>
                <td> {{ $datos->tipo }}</td>
                <td> {{ $datos->eta }}</td>
                <td> {{ $datos->motonave }}</td>
                @if ($datos->linea > 0)
                    <td> {{ $datos->tipolinea->nombre }}</td>
                @else
                    <td> </td>
                @endif
                @if ($datos->id_puerto > 0)
                    <td> {{ $datos->tipopuerto->nombre }}</td>
                @else
                    <td> </td>
                @endif

                <td> {{ $datos->obs }}</td>
                @if ($datos->envio > 0)
                    <td> {{ $datos->tipoenvio->nombre }}</td>
                @else
                    <td> </td>
                @endif

                @if ($datos->estatus > 0)
                    <td> {{ $datos->tipoestatus->nombre }}</td>
                @else
                    <td> </td>
                @endif

                @if ($datos->liberacion == true)
                    <td>SI</td>
                @else
                    <td>NO</td>
                @endif

            </tr>
        @endforeach
    </tbody>

</table>
