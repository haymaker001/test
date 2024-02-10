@extends('layouts.app')

    @section('toolbar')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Procesar Conduce</h1>
            <!--end::Title-->
            <!--begin::Separator-->
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <!--end::Separator-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted"><a href="{{ route('work-orders.index') }}">Listado de Orden de Trabajo </a> - </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-dark">Procesar</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    @endsection

@section('content')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            
            <input type="hidden" name="bookings-list" id="bookings-list" value="{{ route('work-orders.index') }}">
            <input type="hidden" name="customer_centers_url" id="customer_centers_url" value="{{ route('customers.centers', ':id') }}">
            <input type="hidden" name="customer_locations_url" id="customer_locations_url" value="{{ route('customers.locations', ':id') }}">

            <form action="{{ route('bookings.store') }}" id="frm-crud-add" method="post">
                @csrf
                <input type="hidden" name="work_order_id" id="work_order_id" value="{{ $booking->id }}">
                <!--begin::Card-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Procesar Conduce</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="d-flex flex-wrap gap-5 mb-4">
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="customer_id">Cliente</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="customer_id" id="customer_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option></option>
                                        @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" @if($customer->id == $booking->customer_id) selected="" @endif >{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Nombre del cliente.</div>
                                    <!--end::Description-->
                                </div>
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="customer_id">Centro</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="center_id" id="center_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option></option>
                                        @foreach($booking->customer->centers as $center)
                                        <option value="{{ $center->id }}" @if($center->id == $booking->center_id) selected="" @endif >{{ $center->name }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Nombre del centro.</div>
                                    <!--end::Description-->
                                </div>

                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="pickup"> Fecha y Hora de Recogida </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2 datetime" name="pickup" id="pickup" value="{{ $booking->pickup }}" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Fecha y Hora de Recogida</div>
                                    <!--end::Description-->
                                </div>

                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="dropoff"> Fecha y Hora de Entrega </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2 datetime" name="dropoff" id="dropoff" value="{{ $booking->dropoff }}" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Fecha y Hora de Entrega.</div>
                                    <!--end::Description-->
                                </div>
                                
                            </div>
                            <div class="d-flex flex-wrap gap-5 mb-4">

                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="vehicle_id">Equipo / Ficha</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_id" id="vehicle_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option></option>
                                        @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}" data-id="{{ $vehicle->id }}" @if($vehicle->id == $booking->vehicle_id) selected="" @endif >{{ $vehicle->name }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Vehiculo del viaje</div>
                                    <!--end::Description-->
                                </div>

                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="driver_id">Chofer</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="driver_id" id="driver_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option></option>
                                        @foreach($drivers as $driver)
                                        <option value="{{ $driver->id }}" @if($driver->id == $booking->driver_id) selected="" @endif >{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Chofer del viaje</div>
                                    <!--end::Description-->
                                </div>


                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="form-label" for="helper">Ayudante</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="helper" id="helper" value="{{ $booking->helper }}" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Ayudante del chofer.</div>
                                    <!--end::Description-->
                                </div>

                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="form-label" for="travellers">No Conduce</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="travellers" id="travellers" value="{{ $booking->travellers }}" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">No Conduce de viaje.</div>
                                    <!--end::Description-->
                                </div>

                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="form-label" for="container">Contenedor</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="container" id="container" value="{{ $booking->container }}" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">No. de Contenedor viaje.</div>
                                    <!--end::Description-->
                                </div>

                                
                            </div>

                            <div class="d-flex flex-wrap gap-5 mb-4">

                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="form-label" for="dolly">Dolly</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="dolly" id="dolly" value="{{ $booking->dolly }}" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Dolly.</div>
                                    <!--end::Description-->
                                </div>
                                
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="form-label" for="package">Bultos</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="package" id="package" value="{{ $booking->package }}" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Desglose de carga.</div>
                                    <!--end::Description-->
                                </div>

                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="vehicle_type_id">Tipo Camión</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_type_id" id="vehicle_type_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option></option>
                                        @foreach($vehicle_types as $key => $value)
                                        <option value="{{ $key }}" @if($key == $booking->vehicle_type_id) selected="" @endif >{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Nombre del Tipo Camión.</div>
                                    <!--end::Description-->
                                </div>

                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="customer_id">Tipo de Viaje </label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="travel_type_id" id="travel_type_id" data-control="select2" data-placeholder="seleccionar item">
                                        @foreach($travel_types as $travel_type)
                                        <option value="{{ $travel_type->id }}" @if($travel_type->id == $booking->travel_type_id) selected="" @endif >{{ $travel_type->name }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Nombre del Tipo de Viaje.</div>
                                    <!--end::Description-->
                                </div>

                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="form-label" for="diet">Dieta</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="diet" id="diet" value="{{ $booking->diet }}" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Dieta del viaje.</div>
                                    <!--end::Description-->
                                </div>

                            </div>

                            <div class="d-flex flex-wrap gap-5 mb-4">
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="customer_id">Localidades</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="locations[]" id="locations" data-control="select2" multiple="multiple" data-placeholder="seleccionar item">
                                        <option></option>
                                        @foreach($booking->customer->locations as $location)
                                        <option value="{{ $location->id }}" >{{ $location->location }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Nombre de la localidad.</div>
                                    <!--end::Description-->
                                </div>
                            </div>
                            
                            <div class="d-flex flex-wrap gap-5 mb-4">
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="form-label" for="attachment"> Adjunto de Viaje </label> <br>
                                    @if($booking->attachment != null)
                                    <a href="{{ url('assets/media/attachments/' . $booking->attachment) }}" target="_blank" class="btn btn-bg-light btn-icon-dark btn-text-dark me-2 mb-2">
										<!--begin::Svg Icon | path: icons/duotune/general/gen006.svg-->
										<span class="svg-icon svg-icon-1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M22 5V19C22 19.6 21.6 20 21 20H19.5L11.9 12.4C11.5 12 10.9 12 10.5 12.4L3 20C2.5 20 2 19.5 2 19V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5ZM7.5 7C6.7 7 6 7.7 6 8.5C6 9.3 6.7 10 7.5 10C8.3 10 9 9.3 9 8.5C9 7.7 8.3 7 7.5 7Z" fill="black"></path>
												<path d="M19.1 10C18.7 9.60001 18.1 9.60001 17.7 10L10.7 17H2V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V12.9L19.1 10Z" fill="black"></path>
											</svg>
										</span>
										<!--end::Svg Icon--> {{ $booking->attachment ?? 'N/A' }}
									</a>
									@endif
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="file" class="form-control mb-2" name="attachment" id="attachment" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Campo para Adjuntar PDF.</div>
                                    <!--end::Description-->
                                </div>
                            </div>

                            <div class="d-flex flex-wrap gap-5 mb-4">
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="form-label" for="note">Notas</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <textarea class="form-control mb-2" name="note" id="note">{{ $booking->note }}</textarea>
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Notas del registro.</div>
                                    <!--end::Description-->
                                </div>
                            </div>

                        </div>
                        <!--end::Card body-->
                </div>
                <!--end::Card-->
                <div class="d-flex justify-content-end mt-4">
                    <!--begin::Button-->
                    <a href="{{ route('bookings.index') }}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancelar</a>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                        <span class="indicator-label">Guardar</span>
                        <span class="indicator-progress">Por favor espere... 
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
            </form>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->

    @section('extra_js')
    <script type="text/javascript">
    $('#locations').val([{{ $booking->locations }}]).trigger("change");
    </script>
    <script>
        $(document).on('change', '#customer_id', function() {
            var id = this.value;
            getCustomerCenters(id);
            getCustomerLocations(id);
        });
        
        function AbstractCrudUpdate(){
            var url = $('#bookings-list').val();
            window.location.replace(url);
        }

        function getCustomerCenters(id)
        {
            var centers = $('#customer_centers_url').val();
            var url     = centers.replace(':id', id);
            $('#center_id').select2("destroy");

            $.get(url, function(response){
                var options ="<option value=''></option>";
                $.each(response, function(i, val){
                    options += "<option value='"+val.id+"'>"+val.name+"</option>";
                });
                $('#center_id').empty();
                $('#center_id').append(options);
                $('#center_id').select2();
            })
            .fail(function(jqXHR, textStatus, errorThrown){
                $('#center_id').empty();
                $('#center_id').select2();
            });
        }

        function getCustomerLocations(id)
        {
            var centers = $('#customer_locations_url').val();
            var url     = centers.replace(':id', id);
            $('#location_id').select2("destroy");

            $.get(url, function(response){
                var options ="<option value=''></option>";
                $.each(response, function(i, val){
                    options += "<option value='"+val.id+"'>"+val.location+"</option>";
                });
                $('#location_id').empty();
                $('#location_id').append(options);
                $('#location_id').select2();
            })
            .fail(function(jqXHR, textStatus, errorThrown){
                $('#location_id').empty();
                $('#location_id').select2();
            });
        }
    </script>
    @endsection

@endsection