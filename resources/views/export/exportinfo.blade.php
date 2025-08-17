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
                <th>FECHA DE PAGO</th>
                <th>FECHA DE ENTREGA</th>
                <th>FECHA DE CREACION</th>
                <th>FECHA VECONINTER</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($exportacion as $datos)
            <tr>
                <td>{{ $datos->cliente }}</td>
                <td>{{ $datos->expediente }}</td>
                <td>{{ $datos->consignatario }}</td>
                <td>{{ $datos->renuncia }}</td>
                <td>{{ $datos->bl }}</td>
                <td>{{ $datos->contenedor }}</td>
                <td>{{ $datos->tipo }}</td>
                <td>{{ $datos->eta }}</td>
                <td>{{ $datos->motonave }}</td>
                <td>{{ $datos->linea > 0 ? $datos->tipolinea->nombre : '' }}</td>
                <td>{{ $datos->id_puerto > 0 ? $datos->tipopuerto->nombre : '' }}</td>
                <td>{{ $datos->obs }}</td>
                <td>{{ $datos->envio > 0 ? $datos->tipoenvio->nombre : '' }}</td>
                <td>{{ $datos->estatus > 0 ? $datos->tipoestatus->nombre : '' }}</td>
                <td>{{ $datos->liberacion ? 'SI' : 'NO' }}</td>
                <td>{{ $datos->fecha_pago }}</td>
                <td>{{ $datos->fecha_entrega }}</td>
                <td>{{ $datos->created_at }}</td>
                 <td>{{ $datos->fecha_veconinter }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>

