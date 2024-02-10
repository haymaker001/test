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
            <strong>Listado de Vehículos</strong>
        </th>
    </tr>
    <tr>
        <th colspan="7"><strong></strong></th>
    </tr>
    <tr>
        <th class="min-w-100px"><strong>NOMBRE</strong></th>
        <th class="min-w-100px"><strong>MODELO</strong></th>
        <th class="min-w-100px"><strong>TIPO</strong></th>
        <th class="min-w-100px"><strong>MARCA</strong></th>
        <th class="min-w-100px"><strong>PLACA</strong></th>
        <th class="min-w-100px"><strong>AÑO</strong></th>
        <th class="min-w-100px"><strong>HP</strong></th>
        <th class="min-w-100px"><strong>VIN</strong></th>
    </tr>
    </thead>
    <tbody>
        @foreach($vehicles as $vehicle)
        <tr class="odd">
            <td>{{ $vehicle->name ?? 'N/A' }}</td>
            <td>{{ $vehicle->model ?? 'N/A' }}</td>
            <td>{{ $vehicle->vehicle_type->name ?? 'N/A' }}</td>
            <td>{{ $vehicle->color }}</td>
            <td>{{ $vehicle->license_plate }}</td>
            <td>{{ $vehicle->year }}</td>
            <td>{{ $vehicle->horse_power }}</td>
            <td>{{ $vehicle->vin }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
