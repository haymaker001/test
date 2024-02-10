@extends('layouts.app')

    @section('toolbar')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Crear Conduce</h1>
            <!--end::Title-->
            <!--begin::Separator-->
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <!--end::Separator-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted"><a href="{{ route('bookings.index') }}">Listado de Conduces</a></li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-dark">Crear</li>
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
            
            <input type="hidden" name="bookings-list" id="bookings-list" value="{{ route('bookings.index') }}">
            <input type="hidden" name="customer_centers_url" id="customer_centers_url" value="{{ route('customers.centers', ':id') }}">
            <input type="hidden" name="customer_locations_url" id="customer_locations_url" value="{{ route('customers.locations', ':id') }}">

            <form action="{{ route('bookings.store') }}" id="frm-crud-add" method="post" enctype="multipart/form-data">
                @csrf
                <!--begin::Card-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Crear Conduce</h2>
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
                                        @if(intval(auth::user()->customer_id) > 0)
                                            <option value="{{ auth::user()->customer->id }}">{{ auth::user()->customer->name }}</option>
                                        @else
                                            @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}" >{{ $customer->name }}</option>
                                            @endforeach
                                        @endif
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
                                    <input type="text" class="form-control mb-2 datetime" name="pickup" id="pickup" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Fecha de Recogida del Viaje.</div>
                                    <!--end::Description-->
                                </div>

                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="dropoff"> Fecha y Hora de Entrega </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2 datetime" name="dropoff" id="dropoff" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Fecha de Entrega del Viaje.</div>
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
                                        <option value="{{ $vehicle->id }}" data-id="{{ $vehicle->id }}" data-outsource="{{ $vehicle->outsource }}" >{{ $vehicle->name }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Vehiculo del viaje</div>
                                    <!--end::Description-->
                                </div>
                                
                                <div class="fv-row w-100 flex-md-root outsource" style="display: none">
                                    <!--begin::Label-->
                                    <label class="form-label" for="license_plate">Placa</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="license_plate" id="license_plate" value="" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Placa del subcontratado.</div>
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
                                        <option value="{{ $driver->id }}" data-type="{{ $driver->driver_type }}"  >{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Chofer del viaje</div>
                                    <!--end::Description-->
                                </div>
                                
                                <div class="fv-row w-100 flex-md-root driver-outsource" style="display: none">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="subcontractor_id">Nombre Contratista</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="subcontractor_id" id="subcontractor_id">
                                        <option></option>
                                        @foreach($subcontractors as $driver)
                                        <option value="{{ $driver->id }}" data-type="{{ $driver->driver_type }}"  >{{ $driver->name }}</option>
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
                                    <input type="text" class="form-control mb-2" name="helper" id="helper" />
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
                                    <input type="text" class="form-control mb-2" name="travellers" id="travellers" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">No Conduce de viaje.</div>
                                    <!--end::Description-->
                                </div>

                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="form-label" for="container">Contenedor 1</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="container" id="container" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">No. de Contenedor viaje.</div>
                                    <!--end::Description-->
                                </div>

                                
                            </div>

                            <div class="d-flex flex-wrap gap-5 mb-4">

                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="form-label" for="dolly">Contenedor 2</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="dolly" id="dolly" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Contenedor 2.</div>
                                    <!--end::Description-->
                                </div>
                                
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="form-label" for="package">Bultos</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="package" id="package" />
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
                                        <option value="{{ $key }}" >{{ $value }}</option>
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
                                        <option value="{{ $travel_type->id }}" >{{ $travel_type->name }}</option>
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
                                    <input type="text" class="form-control mb-2" name="diet" id="diet" />
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
                                    <select class="form-select form-select-solid" name="locations[]" id="location_id" data-control="select2" multiple="multiple" data-placeholder="seleccionar item">
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
                                    <label class="form-label" for="attachment"> Adjunto de Viaje </label>
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
                                    <textarea class="form-control mb-2" name="note" id="note"></textarea>
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
    @section('extra_js')
    <script>
        $(document).on('change', '#customer_id', function() {
            var id = this.value;
            getCustomerCenters(id);
            getCustomerLocations(id);
        });
        
        $(document).on('change', '#vehicle_id', function() {
            var Outsource = $(this).find(':selected').attr('data-outsource');
            if(Outsource == 1) {
                $(".outsource").show('slow');
                $('#license_plate').focus();
            }
            else
                $(".outsource").hide('slow');
        });
        
        $(document).on('change', '#driver_id', function() {
            var Type = $(this).find(':selected').attr('data-type');
            if(Type == 'SUBCONTRATADO') {
                $(".driver-outsource").show('slow');
                $('#subcontractor_id').focus();
            }
            else
                $(".driver-outsource").hide('slow');
        });
        
        function AbstractCrudAdd(){
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
    <!--end::Post-->
@endsection