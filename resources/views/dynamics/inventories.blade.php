<!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_customers_table .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="min-w-125px">Producto</th>
                                <th class="min-w-125px">Almacen</th>
                                <th class="min-w-125px">Tramo</th>
                                <th class="min-w-125px">Ubicacion</th>
                                <!--<th class="min-w-125px">Stock Inicial</th>-->
                                <th class="min-w-125px">Fecha Ultima Entrada</th>
                                <th class="min-w-125px">Entrada</th>
                                <th class="min-w-125px">Salida</th>
                                <th class="min-w-125px">Stock Final</th>
                                <th class="min-w-125px">Costo Unitario</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600">
                            @foreach($inventories as $center)
                            <tr id="{{ $center->id }}" >
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>{{ $center->item_definition->name ?? 'N/A' }} - {{ $center->item_definition->reference ?? '' }}</td>
                                <td>{{ $center->warehouse->name ?? 'N/A' }}</td>
                                <td>{{ $center->warehouse_location->name ?? 'N/A' }}</td>
                                <td>{{ $center->section->name ?? 'N/A' }}</td>
                                <!--<td>{{ number_format($center->item_definition->initial_stock) }}</td>-->
                                <td>{{ $center->latest_entrance }}</td>
                                <td>{{ number_format($center->in_stock) }}</td>
                                <td>{{ number_format($center->out_stock) }}</td>
                                <td>{{ number_format($center->final_stock) }}</td>
                                <td>{{ number_format($center->latest_price, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="odd">
                                <td colspan="8"><strong>PRODUCTOS DE INVENTARIO: {{ number_format($inventories->count(), 2) }}, TOTAL DE PIEZAS: {{ number_format($inventories->sum('pieces'), 2) }} </strong></td>
                            </tr>
                        </tfoot>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->