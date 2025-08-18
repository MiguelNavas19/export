<table>
    <thead>
        <tr>
            <th>CLIENTE</th>
            <th>EXPEDIENTE</th>
            <th>CONSIGNATARIO</th>
            <th>RENUNCIA</th>
            <th>CLIENTE TIENE PODER</th>
            <th>BL</th>
            <th>CONTENEDOR</th>
            <th>CANTIDAD DE EQUIPOS</th>
            <th>TIPO</th>
            <th>DESCRIPCION</th>
            <th>PESO</th>
            <th>ETA</th>
            <th>MOTONAVE</th>
            <th>FECHA DE ARRIBO</th>
            <th>LINEA / CONSOLIDADOR</th>
            <th>PUERTO</th>
            <th>OBSERVACIONES</th>
            <th>ENVIO</th>
            <th>ESTATUS</th>
            <th>AUTORIZADO PARA IMPRIMIR BL</th>
            <th>FECHA DE PAGO EN LINEA</th>
            <th>FECHA VECONINTER</th>
            <th>FECHA DE REGISTRO</th>
            <th>DUA</th>
            <th>FECHA PAGO IMPUESTOS</th>
            <th>FUNCIONARIO</th>
            <th>COLOR</th>
            <th>FECHA DE PRESENTACION</th>
            <th>FECHA DE RECONOCIMIENTO</th>
            <th>FECHA DE VALIDACION</th>
            <th>FECHA DE DESPACHO</th>
            <th>FECHA DE DEVOLUCION</th>
            <th>FACTURA</th>
            <th>FECHA DE FACTURA</th>
            <th>DIAS LIBRES</th>
            <th>LIBERACION</th>
            <th>FECHA DE ENTREGA</th>
            <th>FECHA DE CREACION</th>

        </tr>
    </thead>

    <tbody>
        @foreach ($exportacion as $datos)
            <tr>
                <td>{{ $datos->cliente }}</td>
                <td>{{ $datos->expediente }}</td>
                <td>{{ $datos->consignatario }}</td>
                <td>{{ $datos->renuncia }}</td>
                <td>{{ $datos->poder === 2 ? 'SI' : 'NO' }}</td>
                <td>{{ $datos->bl }}</td>
                <td>{{ $datos->contenedor }}</td>
                <td>{{ $datos->cantidad_equipos }}</td>
                <td>{{ $datos->tipo }}</td>
                <td>{{ $datos->descripcion }}</td>
                <td>{{ $datos->peso }}</td>
                <td>{{ $datos->eta }}</td>
                <td>{{ $datos->motonave }}</td>
                <td>{{ $datos->fecha_arribo }}</td>
                <td>{{ $datos->linea > 0 ? $datos->tipolinea->nombre : '' }}</td>
                <td>{{ $datos->id_puerto > 0 ? $datos->tipopuerto->nombre : '' }}</td>
                <td>{{ $datos->obs }}</td>
                <td>{{ $datos->envio > 0 ? $datos->tipoenvio->nombre : '' }}</td>
                <td>{{ $datos->estatus > 0 ? $datos->tipoestatus->nombre : '' }}</td>
                <td>{{ $datos->autorizado === 2 ? 'SI' : 'NO' }}</td>
                <td>{{ $datos->fecha_pago }}</td>
                <td>{{ $datos->fecha_veconinter }}</td>
                <td>{{ $datos->fecha_registro }}</td>
                <td>{{ $datos->dua }}</td>
                <td>{{ $datos->fecha_impuesto }}</td>
                <td>{{ $datos->funcionario }}</td>
                <td>{{ $datos->color > 0 ? $datos->colors->nombre : '' }}</td>
                <td>{{ $datos->fecha_presentacion }}</td>
                <td>{{ $datos->fecha_reconocimiento }}</td>
                <td>{{ $datos->fecha_validacion }}</td>
                <td>{{ $datos->fecha_despacho }}</td>
                <td>{{ $datos->fecha_devolucion }}</td>
                <td>{{ $datos->factura }}</td>
                <td>{{ $datos->fecha_factura }}</td>
                <td>{{ $datos->dias_libres }}</td>
                <td>{{ $datos->liberacion ? 'SI' : 'NO' }}</td>
                <td>{{ $datos->fecha_entrega }}</td>
                <td>{{ $datos->created_at }}</td>

            </tr>
        @endforeach
    </tbody>

</table>
