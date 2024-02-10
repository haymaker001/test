<table>
    <thead>
    <tr>
        <th colspan="17"><strong></strong></th>
    </tr>
    <tr>
        <th colspan="17">
            <strong style="text-align: center">Henríquez GO!</strong>
        </th>
    </tr>
    <tr>
        <th colspan="17">
            <strong>Facturación Camiones Desde el {{ $from }} Hasta el {{ $to }} </strong>
        </th>
    </tr>
    <tr>
        <th colspan="17"><strong></strong></th>
    </tr>
    <tr>
        <th class="min-w-100px">Cliente</th>
        <th class="min-w-100px">Fecha</th>
        <th class="min-w-100px">Equipo</th>
        <th class="min-w-100px">Contenedor</th>
        <th class="min-w-100px">Rutas</th>
        <th class="min-w-100px">Chofer</th>
        <th class="min-w-100px">Ayudante</th>
        <th class="min-w-100px">Transporte</th>
        <th class="min-w-100px">Tarífa</th>
        <th class="min-w-100px">Destinos</th>
        <th class="min-w-100px">Adicionales</th>
        <th class="min-w-100px">Dieta</th>
        <th class="min-w-100px">Dolly</th>
        <th class="min-w-100px">Bultos</th>
        <th class="min-w-100px">Tipo Camión</th>
        <th class="text-end min-w-75px">Tipo Viaje</th>
        <th class="text-end min-w-100px pe-5">Nota</th>
    </tr>
    </thead>
    <tbody>
        @foreach($bookings as $booking)
        <tr class="odd">
            <td>{{ $booking->customer->name ?? 'N/A' }}</td>
            <td>{{ date('d-m-Y', strtotime($booking->pickup)) }}</td>
            <td>{{ $booking->vehicle->name ?? 'N/A' }}</td>
            <td>{{ $booking->container ?? 'N/A' }}</td>
            <td>{{ $booking->locations }}</td>
            <td>{{ $booking->driver->name ?? 'N/A'  }}</td>
            <td>{{ $booking->helper }}</td>
            <td>{{ $booking->travellers }}</td>
            <td>{{ number_format($booking->rate, 2) }}</td>
            <td>{{ $booking->destinations }}</td>
            <td>{{ number_format($booking->additionals) }}</td>
            <td>{{ number_format($booking->diet, 2) }}</td>
            <td>{{ $booking->dolly }}</td>
            <td>{{ $booking->package ?? 0 }}</td>
            <td>{{ $booking->vehicle_type_name ?? 'N/A' }}</td>
            <td>{{ $booking->travel_type->name ?? 'N/A' }}</td>
            <td>{{ $booking->note }}</td>
        </tr>
        @endforeach
    </tbody>
</table>