<table>
    <thead>
    <tr>
        <th colspan="7"><strong></strong></th>
    </tr>
    <tr>
        <th colspan="7">
            <strong style="text-align: center">Henríquez GO!</strong>
        </th>
    </tr>
    <tr>
        <th colspan="7">
            <strong>Listado de Tarifas</strong>
        </th>
    </tr>
    <tr>
        <th colspan="7"><strong></strong></th>
    </tr>
    <tr>
        <th class="min-w-100px"><strong>CLIENTE</strong></th>
        <th class="min-w-100px"><strong>CENTRO</strong></th>
        <th class="min-w-100px"><strong>TIPO CAMIÓN</strong></th>
        <th class="min-w-100px"><strong>LOCALIDAD</strong></th>
        <th class="min-w-100px"><strong>TARÍFA</strong></th>
        <th class="min-w-100px"><strong>TARÍFA TERCERIZADA</strong></th>
        <th class="min-w-100px"><strong>DIETA</strong></th>
        <th class="min-w-100px"><strong>TIPO DE VIAJE</strong></th>
    </tr>
    </thead>
    <tbody>
        @foreach($rates as $rate)
        <tr class="odd">
            <td>{{ $rate->customer->name ?? 'N/A' }}</td>
            <td>{{ $rate->center->name ?? 'N/A' }}</td>
            <td>{{ $rate->vehicle_type_name ?? 'N/A' }}</td>
            <td>{{ $rate->location->location ?? 'N/A' }}</td>
            <td>{{ number_format($rate->rate, 2) }}</td>
            <td>{{ number_format($rate->rate_outsource, 2) ?? number_format(0) }}</td>
            <td>{{ number_format($rate->diet, 2) ?? number_format(0) }}</td>
            <td>{{ $rate->travel_type_id == 2 ? 'DOLLY / FULL' : 'SENCILLO' ?? 'SENCILLO' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
