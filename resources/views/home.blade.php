@extends('layouts.app')

@section('content')
<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-8">
            <div class="content flex-row-fluid p-0 smm-0" id="kt_content">
                <!--begin::Row-->
                <div class="row gy-0 gx-10">
                    <!--begin::Col-->
                    <div class="col-xl-12">
                        <!--begin::General Widget 1-->
                        <div>
                            <input type="hidden" name="chart_data_url" id="chart_data_url" value="{{ route('charts', ':id') }}">
                            <!--begin::Tabs-->
                            <ul class="nav row mb-10">
                                <li class="nav-item col-12 col-lg mb-5 mb-lg-0">
                                    <a
                                        class="nav-link btn btn-flex btn-color-muted btn-outline btn-outline-default btn-active-danger d-flex flex-grow-1 flex-column flex-center py-5 h-1250px h-lg-175px active"
                                        data-bs-toggle="tab"
                                        href="#kt_general_widget_1_3"
                                    >
                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/ecommerce/ecm006.svg-->
                                        <span class="svg-icon svg-icon-4x mb-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z" fill="black" />
                                                <path
                                                    opacity="0.3"
                                                    d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z"
                                                    fill="black"
                                                />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <span class="fs-4 fw-bold">
                                            <div data-kt-countup="true" data-kt-countup-value="{{ $viajes }}" data-kt-countup-prefix="">0</div>
                                            <br />
                                            Viajes
                                        </span>
                                    </a>
                                </li>

                                <li class="nav-item col-12 col-lg mb-5 mb-lg-0">
                                    <a
                                        class="nav-link btn btn-flex btn-color-muted btn-outline btn-outline-default btn-active-danger d-flex flex-grow-1 flex-column flex-center py-5 h-1250px h-lg-175px"
                                        data-bs-toggle="tab"
                                        href="#kt_general_widget_1_1"
                                    >
                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen043.svg-->
                                        <span class="svg-icon svg-icon-4x mb-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
                                                <path
                                                    d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                    fill="black"
                                                />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <span class="fs-4 fw-bold">
                                            <div data-kt-countup="true" data-kt-countup-value="{{ $destinos }}" data-kt-countup-prefix="">0</div>
                                            <br />
                                            Entregas
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item col-12 col-lg mb-5 mb-lg-0">
                                    <a
                                        class="nav-link btn btn-flex btn-color-muted btn-outline btn-outline-default btn-active-danger d-flex flex-grow-1 flex-column flex-center py-5 h-1250px h-lg-175px"
                                        data-bs-toggle="tab"
                                        href="#kt_general_widget_1_2"
                                    >
                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/finance/fin010.svg-->
                                        <span class="svg-icon svg-icon-4x mb-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M12.5 22C11.9 22 11.5 21.6 11.5 21V3C11.5 2.4 11.9 2 12.5 2C13.1 2 13.5 2.4 13.5 3V21C13.5 21.6 13.1 22 12.5 22Z" fill="black" />
                                                <path
                                                    d="M17.8 14.7C17.8 15.5 17.6 16.3 17.2 16.9C16.8 17.6 16.2 18.1 15.3 18.4C14.5 18.8 13.5 19 12.4 19C11.1 19 10 18.7 9.10001 18.2C8.50001 17.8 8.00001 17.4 7.60001 16.7C7.20001 16.1 7 15.5 7 14.9C7 14.6 7.09999 14.3 7.29999 14C7.49999 13.8 7.80001 13.6 8.20001 13.6C8.50001 13.6 8.69999 13.7 8.89999 13.9C9.09999 14.1 9.29999 14.4 9.39999 14.7C9.59999 15.1 9.8 15.5 10 15.8C10.2 16.1 10.5 16.3 10.8 16.5C11.2 16.7 11.6 16.8 12.2 16.8C13 16.8 13.7 16.6 14.2 16.2C14.7 15.8 15 15.3 15 14.8C15 14.4 14.9 14 14.6 13.7C14.3 13.4 14 13.2 13.5 13.1C13.1 13 12.5 12.8 11.8 12.6C10.8 12.4 9.99999 12.1 9.39999 11.8C8.69999 11.5 8.19999 11.1 7.79999 10.6C7.39999 10.1 7.20001 9.39998 7.20001 8.59998C7.20001 7.89998 7.39999 7.19998 7.79999 6.59998C8.19999 5.99998 8.80001 5.60005 9.60001 5.30005C10.4 5.00005 11.3 4.80005 12.3 4.80005C13.1 4.80005 13.8 4.89998 14.5 5.09998C15.1 5.29998 15.6 5.60002 16 5.90002C16.4 6.20002 16.7 6.6 16.9 7C17.1 7.4 17.2 7.69998 17.2 8.09998C17.2 8.39998 17.1 8.7 16.9 9C16.7 9.3 16.4 9.40002 16 9.40002C15.7 9.40002 15.4 9.29995 15.3 9.19995C15.2 9.09995 15 8.80002 14.8 8.40002C14.6 7.90002 14.3 7.49995 13.9 7.19995C13.5 6.89995 13 6.80005 12.2 6.80005C11.5 6.80005 10.9 7.00005 10.5 7.30005C10.1 7.60005 9.79999 8.00002 9.79999 8.40002C9.79999 8.70002 9.9 8.89998 10 9.09998C10.1 9.29998 10.4 9.49998 10.6 9.59998C10.8 9.69998 11.1 9.90002 11.4 9.90002C11.7 10 12.1 10.1 12.7 10.3C13.5 10.5 14.2 10.7 14.8 10.9C15.4 11.1 15.9 11.4 16.4 11.7C16.8 12 17.2 12.4 17.4 12.9C17.6 13.4 17.8 14 17.8 14.7Z"
                                                    fill="black"
                                                />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <span class="fs-4 fw-bold">
                                            <div data-kt-countup="true" data-kt-countup-value="{{ $facturacion }}" data-kt-countup-prefix="$ ">0</div>
                                            <br />
                                            Facturación
                                        </span>
                                    </a>
                                </li>

                                <li class="nav-item col-12 col-lg mb-5 mb-lg-0">
                                    <a
                                        class="nav-link btn btn-flex btn-color-muted btn-outline btn-outline-default btn-active-danger d-flex flex-grow-1 flex-column flex-center py-5 h-1250px h-lg-175px"
                                        data-bs-toggle="tab"
                                        href="#kt_general_widget_1_4"
                                    >
                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/graphs/gra004.svg-->
                                        <span class="svg-icon svg-icon-4x mb-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M11 11H13C13.6 11 14 11.4 14 12V21H10V12C10 11.4 10.4 11 11 11ZM16 3V21H20V3C20 2.4 19.6 2 19 2H17C16.4 2 16 2.4 16 3Z" fill="black" />
                                                <path d="M21 20H8V16C8 15.4 7.6 15 7 15H5C4.4 15 4 15.4 4 16V20H3C2.4 20 2 20.4 2 21C2 21.6 2.4 22 3 22H21C21.6 22 22 21.6 22 21C22 20.4 21.6 20 21 20Z" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <span class="fs-4 fw-bold">
                                            <div data-kt-countup="true" data-kt-countup-value="{{ $kilometraje }}" data-kt-countup-prefix="">0</div>
                                            <br />
                                            Kilometraje
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item col-12 col-lg mb-5 mb-lg-0">
                                    <a
                                        class="nav-link btn btn-flex btn-color-muted btn-outline btn-outline-default btn-active-danger d-flex flex-grow-1 flex-column flex-center py-5 h-1250px h-lg-175px"
                                        data-bs-toggle="tab"
                                        href="#kt_general_widget_1_5"
                                    >
                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/art/art007.svg-->
                                        <span class="svg-icon svg-icon-4x mb-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path
                                                    opacity="0.3"
                                                    d="M20.859 12.596L17.736 13.596L10.388 20.944C10.2915 21.0406 10.1769 21.1172 10.0508 21.1695C9.9247 21.2218 9.78953 21.2486 9.65302 21.2486C9.5165 21.2486 9.3813 21.2218 9.25519 21.1695C9.12907 21.1172 9.01449 21.0406 8.918 20.944L2.29999 14.3229C2.10543 14.1278 1.99619 13.8635 1.99619 13.588C1.99619 13.3124 2.10543 13.0481 2.29999 12.853L11.853 3.29999C11.9495 3.20341 12.0641 3.12679 12.1902 3.07452C12.3163 3.02225 12.4515 2.9953 12.588 2.9953C12.7245 2.9953 12.8597 3.02225 12.9858 3.07452C13.1119 3.12679 13.2265 3.20341 13.323 3.29999L21.199 11.176C21.3036 11.2791 21.3797 11.4075 21.4201 11.5486C21.4605 11.6898 21.4637 11.8391 21.4295 11.9819C21.3953 12.1247 21.3249 12.2562 21.2249 12.3638C21.125 12.4714 20.9989 12.5514 20.859 12.596Z"
                                                    fill="black"
                                                />
                                                <path
                                                    d="M14.8 10.184C14.7447 10.1843 14.6895 10.1796 14.635 10.1699L5.816 8.69997C5.55436 8.65634 5.32077 8.51055 5.16661 8.29469C5.01246 8.07884 4.95035 7.8106 4.99397 7.54897C5.0376 7.28733 5.18339 7.05371 5.39925 6.89955C5.6151 6.7454 5.88334 6.68332 6.14498 6.72694L14.963 8.19692C15.2112 8.23733 15.435 8.36982 15.59 8.56789C15.7449 8.76596 15.8195 9.01502 15.7989 9.26564C15.7784 9.51626 15.6642 9.75001 15.479 9.92018C15.2939 10.0904 15.0514 10.1846 14.8 10.184ZM17 18.6229C17 19.0281 17.0985 19.4272 17.287 19.7859C17.4755 20.1446 17.7484 20.4521 18.0821 20.6819C18.4158 20.9117 18.8004 21.0571 19.2027 21.1052C19.605 21.1534 20.0131 21.103 20.3916 20.9585C20.7702 20.814 21.1079 20.5797 21.3758 20.2757C21.6437 19.9716 21.8336 19.607 21.9293 19.2133C22.025 18.8195 22.0235 18.4085 21.925 18.0154C21.8266 17.6223 21.634 17.259 21.364 16.9569L19.843 15.257C19.7999 15.2085 19.7471 15.1697 19.688 15.1432C19.6289 15.1167 19.5648 15.1029 19.5 15.1029C19.4352 15.1029 19.3711 15.1167 19.312 15.1432C19.2529 15.1697 19.2001 15.2085 19.157 15.257L17.636 16.9569C17.2254 17.4146 16.9988 18.0081 17 18.6229ZM10.388 20.9409L17.736 13.5929H1.99999C1.99921 13.7291 2.02532 13.8643 2.0768 13.9904C2.12828 14.1165 2.2041 14.2311 2.29997 14.3279L8.91399 20.9409C9.01055 21.0381 9.12539 21.1152 9.25188 21.1679C9.37836 21.2205 9.51399 21.2476 9.65099 21.2476C9.78798 21.2476 9.92361 21.2205 10.0501 21.1679C10.1766 21.1152 10.2914 21.0381 10.388 20.9409Z"
                                                    fill="black"
                                                />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <span class="fs-4 fw-bold">
                                            <div data-kt-countup="true" data-kt-countup-value="{{ $combustible }}" data-kt-countup-prefix="">0</div>
                                            <br />
                                            Combustible
                                        </span>
                                    </a>
                                </li>
                            </ul>
                            <!--begin::Tab content-->
                            <div class="tab-content">
                                <div class="tab-pane fade" id="kt_general_widget_1_1">
                                    <!--begin::Tables Widget 2-->
                                    <div class="card">
                                        <!--begin::Header-->
                                        <div class="card-header border-0 pt-5">
                                            <h3 class="card-title align-items-start flex-column">
                                                <span class="card-label fw-bolder fs-3 mb-1">Entregas</span>
                                                <span class="text-muted mt-1 fw-bold fs-7">Cantidad de entregas por mes y clientes</span>
                                            </h3>
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Body-->
                                        <div class="card-body py-3">

                                            <div class="card card-bordered">
                                                <div class="card-body">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div>
                                                                <canvas id="delivery_monthly" class="mh-300px"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Tables Widget 2-->
                                </div>
                                <div class="tab-pane fade" id="kt_general_widget_1_2">
                                    <!--begin::Tables Widget 3-->
                                    <div class="card">
                                        <!--begin::Header-->
                                        <div class="card-header border-0 pt-5">
                                            <h3 class="card-title align-items-start flex-column">
                                                <span class="card-label fw-bolder fs-3 mb-1">Facturación</span>
                                                <span class="text-muted mt-1 fw-bold fs-7">Facturación de viajes + adicionales por mes y clientes</span>
                                            </h3>
                                            <div class="card-toolbar">
												<select class="form-select form-select-solid lh-1 py-3" name="billing_id" id="billing_id" data-placeholder="TODOS">
													<option value="0">TODOS</option>
													@foreach($clients as $client)
													<option value="{{ $client->id }}">{{ $client->name }}</option>
													@endforeach
												</select>
											</div>
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Body-->
                                        <div class="card-body py-3">

                                            <div class="card card-bordered">
                                                <div class="card-body">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div>
                                                                <canvas id="billing_monthly" class="mh-300px"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!--begin::Body-->
                                    </div>
                                    <!--end::Tables Widget 3-->
                                </div>
                                <div class="tab-pane fade show active" id="kt_general_widget_1_3">
                                    <!--begin::Tables Widget 5-->
                                    <div class="card">
                                        <!--begin::Header-->
                                        <div class="card-header border-0 pt-5">
                                            <h3 class="card-title align-items-start flex-column">
                                                <span class="card-label fw-bolder fs-3 mb-1">Viajes</span>
                                                <span class="text-muted mt-1 fw-bold fs-7">Listado de viajes registrados en el sistema ({{ number_format($viajes) }}).</span>
                                            </h3>
                                            <div class="card-toolbar">
												<select class="form-select form-select-solid lh-1 py-3" name="client_id" id="client_id" data-placeholder="TODOS">
													<option value="0">TODOS</option>
													@foreach($clients as $client)
													<option value="{{ $client->id }}">{{ $client->name }}</option>
													@endforeach
												</select>
											</div>
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Body-->
                                        <div class="card-body py-3">

                                            <div class="card card-bordered">
                                                <div class="card-body">
                                                    <div class="container">
                                                      <div class="row">
                                                        <div class="col-sm">
                                                          <canvas id="bookings_monthly" class="mh-300px"></canvas>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Tables Widget 5-->
                                </div>
                                <div class="tab-pane fade" id="kt_general_widget_1_4">
                                    <!--begin::Tables Widget 4-->
                                    <div class="card">
                                        <!--begin::Header-->
                                        <div class="card-header border-0 pt-5">
                                            <h3 class="card-title align-items-start flex-column">
                                                <span class="card-label fw-bolder fs-3 mb-1">Kilometraje</span>
                                                <span class="text-muted mt-1 fw-bold fs-7">Historico de kilometrajes por mes</span>
                                            </h3>
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Body-->
                                        <div class="card-body py-3">

                                            <div class="card card-bordered">
                                                <div class="card-body">
                                                    <canvas id="mileage_monthly" class="mh-300px"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Tables Widget 4-->
                                </div>
                                <div class="tab-pane fade" id="kt_general_widget_1_5">
                                    <!--begin::Tables Widget 1-->
                                    <div class="card">
                                        <!--begin::Header-->
                                        <div class="card-header border-0 pt-5">
                                            <h3 class="card-title align-items-start flex-column">
                                                <span class="card-label fw-bolder fs-3 mb-1">Combustible</span>
                                                <span class="text-muted fw-bold fs-7">Historico de Combustible por mes</span>
                                            </h3>
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Body-->
                                        <div class="card-body py-3">

                                            <div class="card card-bordered">
                                                <div class="card-body">
                                                    <canvas id="fuel_monthly" class="mh-300px"></canvas>
                                                </div>
                                            </div>

                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--endW::Tables Widget 1-->
                                </div>
                            </div>
                            <!--end::Tab content-->
                        </div>
                        <!--end::General Widget 1-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
    @section('extra_js')
    <script>
        $(document).ready(function(){
            getChartData('TODOS');
        });
        
        $(document).on( "change", "#client_id,#billing_id", function() {
            var id = this.value;
            getChartData(id);
        });
        
        function getChartData(id)
        {
            var MonthLabels = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
            var Colors = ['#009EF7', '#009EF7', '#009EF7', '#009EF7', '#009EF7', '#009EF7', '#009EF7', '#009EF7', '#009EF7', '#009EF7', '#009EF7', '#009EF7'];
            var url = $('#chart_data_url').val();
            url = url.replace(':id', id);
            
            $.get(url, function(data, status){
                
                if (Chart.getChart("bookings_monthly"))
                    Chart.getChart("bookings_monthly").destroy();
                    
                if (Chart.getChart("delivery_monthly"))
                    Chart.getChart("delivery_monthly").destroy();
                    
                if (Chart.getChart("billing_monthly"))
                    Chart.getChart("billing_monthly").destroy();
                    
                if (Chart.getChart("mileage_monthly"))
                    Chart.getChart("mileage_monthly").destroy();
                    
                if (Chart.getChart("fuel_monthly"))
                    Chart.getChart("fuel_monthly").destroy();
                
                //setup
                const data_bookings_monthly = {
                    labels: MonthLabels,
                    datasets: [{
                        data: data.bookings,
                        backgroundColor: Colors,
                        borderWidth: 0.5 ,
                        borderColor: '#ddd'
                    }]
                };
                const data_delivery_monthly = {
                    labels: MonthLabels,
                    datasets: [{
                        data: data.delivery_monthly,
                        backgroundColor: Colors,
                        borderWidth: 0.5 ,
                        borderColor: '#ddd'
                    }]
                };
                const data_billing_monthly = {
                    labels: MonthLabels,
                    datasets: [{
                        data: data.billings,
                        backgroundColor: Colors,
                        borderWidth: 0.5 ,
                        borderColor: '#ddd'
                    }]
                };
                const data_mileage_monthly = {
                    labels: MonthLabels,
                    datasets: [{
                        data: data.mileage_monthly,
                        backgroundColor: Colors,
                        borderWidth: 0.5 ,
                        borderColor: '#ddd'
                    }]
                };
                const data_fuel_monthly = {
                    labels: MonthLabels,
                    datasets: [{
                        data: data.fuel_monthly,
                        backgroundColor: Colors,
                        borderWidth: 0.5 ,
                        borderColor: '#ddd'
                    }]
                };
                
                //config
                const config_bookings_monthly = {
                    type: 'bar',
                    data: data_bookings_monthly,
                    options: {
                        borderRadius: 4,
                        legend: {
                            display: false
                        },
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.yLabel;
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                        }
                    }
                };
                const config_delivery_monthly = {
                    type: 'bar',
                    data: data_delivery_monthly,
                    options: {
                        borderRadius: 4,
                        legend: {
                            display: false
                        },
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.yLabel;
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                        }
                    }
                };
                const config_billing_monthly = {
                    type: 'bar',
                    data: data_billing_monthly,
                    options: {
                        borderRadius: 4,
                        legend: {
                            display: false
                        },
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.yLabel;
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                        }
                    }
                };
                const config_mileage_monthly = {
                    type: 'bar',
                    data: data_mileage_monthly,
                    options: {
                        borderRadius: 4,
                        legend: {
                            display: false
                        },
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.yLabel;
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                        }
                    }
                };
                const config_fuel_monthly = {
                    type: 'bar',
                    data: data_fuel_monthly,
                    options: {
                        borderRadius: 4,
                        legend: {
                            display: false
                        },
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.yLabel;
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                        }
                    }
                };
                //init (render)
                let BookingsMontly = new Chart(
                    document.getElementById('bookings_monthly').getContext('2d'),
                    config_bookings_monthly
                );
                
                let DeliveryMonthly = new Chart(
                    document.getElementById('delivery_monthly').getContext('2d'),
                    config_delivery_monthly
                );
                
                let BillingMonthly = new Chart(
                    document.getElementById('billing_monthly').getContext('2d'),
                    config_billing_monthly
                );
                
                let MilleageMonthly = new Chart(
                    document.getElementById('mileage_monthly').getContext('2d'),
                    config_mileage_monthly
                );
                
                let FuelMonthly = new Chart(
                    document.getElementById('fuel_monthly').getContext('2d'),
                    config_fuel_monthly
                );
                
                $('#client_id').val(id);
                $('#billing_id').val(id);
            });
        }
    </script>
    @endsection
<!--end::Post-->
@endsection