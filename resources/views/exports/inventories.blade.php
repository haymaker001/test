<table>
    <thead>
    <tr>
        <th colspan="6"><strong></strong></th>
    </tr>
    <tr>
        <th colspan="6">
            <strong style="text-align: center">Henríquez GO!</strong>
        </th>
    </tr>
    <tr>
        <th colspan="6">
            <strong>Listado de Productos de Inventario</strong>
        </th>
    </tr>
    <tr>
        <th colspan="6"><strong></strong></th>
    </tr>
    <tr>
        <th class="min-w-100px"><strong>PRODUCTO</strong></th>
        <th class="min-w-100px"><strong>ALMACEN</strong></th>
        <th class="min-w-100px"><strong>TRAMO</strong></th>
        <th class="min-w-100px"><strong>UBICACIÓN</strong></th>
        <th class="min-w-100px"><strong>ULTIMA FECHA ENTRADA</strong></th>
        <th class="min-w-100px"><strong>ENTRADA</strong></th>
        <th class="min-w-100px"><strong>SALIDA</strong></th>
        <th class="min-w-100px"><strong>STOCK FINAL</strong></th>
        <th class="min-w-100px"><strong>COSTO UNITARIO</strong></th>
    </tr>
    </thead>
    <tbody>
        @foreach($inventories as $inventory)
        <tr class="odd">
            <td>{{ $inventory->item_definition->name ?? 'N/A' }} - {{ $inventory->item_definition->reference ?? '' }}</td>
            <td>{{ $inventory->warehouse->name ?? 'N/A' }}</td>
            <td>{{ $inventory->warehouse_location->name ?? 'N/A' }}</td>
            <td>{{ $inventory->section->name ?? 'N/A' }}</td>
            <td>{{ $inventory->latest_entrance }}</td>
            <td>{{ number_format($inventory->in_stock) }}</td>
            <td>{{ number_format($inventory->out_stock) }}</td>
            <td>{{ number_format($inventory->final_stock) }}</td>
            <td>{{ number_format($inventory->latest_price, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr class="odd">
            <td colspan="8"><strong>PRODUCTOS DE INVENTARIO: {{ number_format($inventories->count(), 2) }}, TOTAL DE PIEZAS: {{ number_format($inventories->sum('pieces'), 2) }} </strong></td>
        </tr>
    </tfoot>
</table>
