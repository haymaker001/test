<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
        <style>
            body {
                font-family: verdana, sans-serif;
            }
            table {
                margin-top: 1em;
                margin-bottom: 2em;
            }

            thead {
            }

            tbody {
            }

            th,
            td {
                padding: 2pt;
            }

            table.collapse {
                border-collapse: collapse;
                width: 100% !important;
            }

            table.collapse td {
            }

            td.header {
                font-size: 10px !important;
                text-align: left !important;
            }

            td.data {
                font-size: 10px;
            }
            .align-center {
                text-align: center;
            }
            #footer {
                position: fixed;
                left: 0;
                right: 0;
                bottom: 0;
                color: #aaa;
                font-size: 0.9em;
            }
            #footer table {
                width: 100%;
                border-collapse: collapse;
                border: none;
            }
            #footer td {
                padding: 0;
                width: 50%;
            }

            .opacity {
                opacity: 0.1;
            }
            #watermark {
                position: fixed;
                bottom: 0px;
                left: 300px;
                top: 350px;
                /** The width and height may change 
                    according to the dimensions of your letterhead
                **/
                width: 21.8cm;
                height: 28cm;
                /** Your watermark should be behind every content**/
                z-index: -1000;
            }
        </style>
    </head>

    <body>
        <table class="collapse">
            <tr>
                <td colspan="3">
                    <img style="width: 40%;" src="https://henriquez.com.do/wp-content/uploads/2018/05/32247413_1653679581416159_1051820572914221056_n.jpg" />
                    <p style="margin: 0px; padding: 0px;">
                        Av Simón Bolívar #195 <br />
                        Santo Domingo, República Dominicana.
                    </p>
                </td>
                <td style="width: 50%; text-align: right; font-size:24px"><strong>FACTURA PROFORMA: </strong></td>
            </tr>
        </table>

        <table class="collapse">
            @foreach($clients as $client)
                <tr>
                    <th class="header" colspan="11" style="text-align: left;">{{ mb_strtoupper($client->name) }}</th>
                </tr>
                <tr>
                    <th class="header" style="text-align: left; font-size:12px; width: 10%">@lang('Fecha')</th>
                    <th class="header" style="text-align: left; font-size:12px; ">Equipo</th>
                    <th class="header" style="text-align: left; font-size:12px; ">@lang('Contenedor')</th>
                    <th class="header" style="text-align: left; font-size:12px; ">@lang('Rutas')</th>
                    <th class="header" style="text-align: left; font-size:12px; ">@lang('Chofer')</th>
                    <th class="header" style="text-align: left; font-size:12px; ">@lang('Transporte')</th>
                    <th class="header" style="text-align: left; font-size:12px; ">@lang('Tipo Camion')</th>
                    <th class="header" style="text-align: left; font-size:12px; ">@lang('Tipo Viaje')</th>
                    @if($show_rate == 'SI')
                    <th class="header" style="text-align: left; font-size:12px; ">@lang('Tarifa')</th>
                    @endif
                    <th class="header" style="text-align: left; font-size:12px; ">@lang('Destinos')</th>
                    <th class="header" style="text-align: left; font-size:12px; ">@lang('Adicionales')</th>
                    
                </tr>
                @foreach($bookings->where('customer_id', $client->id)->sortBy('pickup') as $row)
                <tr>
                    <td class="data" style="width: 10%">{{ date('d-m-Y',strtotime($row->pickup)) }} </td>
                    <td class="data">{{ $row->vehicle->name ?? 'N/A'  }} </td>
                    <td class="data">{{ $row->container }}</td>
                    <td class="data">{{ $row->locations }}</td>
                    <td class="data">{{ $row->driver->name  }}</td>
                    <td class="data">{{ $row->travellers }}</td>
                    <td class="data">{{ $row->vehicle_type_name }}</td>
                    <td class="data">{{ $row->travel_type_name }}</td>
                    @if($show_rate == 'SI')
                    <td class="data">{{ number_format($row->rate, 2) }} {{-- date('d/m/Y g:i A',strtotime($row->dropoff)) --}}</td>
                    @endif
                    <td class="data">{{ $row->destinations }}</td>
                    <td class="data">{{ number_format($row->additionals) }}</td>
                    
                </tr>
                @endforeach
                
                <tr>
                    <th class="header" colspan="6" style="text-align: right; font-size:12px;">SUB-TOTALES: </th>
                    <th class="data" style="text-align: right;"></th>
                    <th class="data" style="text-align: right;"></th>
                    @if($show_rate == 'SI')
                    <th class="data" style="text-align: left; border: 1px solid black; font-size:12px;">{{ number_format($bookings->where('customer_id', $client->id)->sum('rate'), 2) }}</th>
                    @endif
                    <th class="data" style="text-align: left; border: 1px solid black; font-size:12px;">{{ number_format($bookings->where('customer_id', $client->id)->sum('destinations')) }}</th>
                    <th class="data" style="text-align: left; border: 1px solid black; font-size:12px;">{{ number_format($bookings->where('customer_id', $client->id)->sum('additionals'), 2) }}</th>
                    
                </tr>
                <tr>
                    <th class="header" colspan="11" style="text-align: right;"></th>
                </tr>
            @endforeach
            <tr>
                <th class="header" colspan="11" style="text-align: right;"></th>
            </tr>
            <tr>
                <th class="header" colspan="6" style="text-align: right; font-size:12px;">GRAN TOTAL:</th>
                <th class="data" style="text-align: right;"></th>
                <th class="data" style="text-align: right;"></th>
                @if($show_rate == 'SI')
                <th class="data" style="text-align: left; border: 1px solid black; font-size:12px;">{{ number_format($bookings->sum('rate'), 2) }}</th>
                @endif
                <th class="data" style="text-align: left; border: 1px solid black; font-size:12px;">{{ number_format($bookings->sum('destinations')) }}</th>
                <th class="data" style="text-align: left; border: 1px solid black; font-size:12px;">{{ number_format($bookings->sum('additionals'), 2) }}</th>
            </tr>
            <tr>
                <th class="header" colspan="11" style="text-align: right;">&nbsp;</th>
            </tr>
            <tr>
                <th class="header" colspan="11" style="text-align: right;">&nbsp;</th>
            </tr>
            <tr>
                <th class="header" colspan="11" style="text-align: center;">
                    DEPARTAMENTO DE FACTURACIÓN <br />
                _______________________________________________________________________
                </th>
            </tr>
            
        </table>
    </body>
</html>
