@extends('layouts.app')

    @section('toolbar')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Editar Orden De Trabajo</h1>
            <!--end::Title-->
            <!--begin::Separator-->
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <!--end::Separator-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted"><a href="{{ route('work-orders.index') }}">Listado de Ordenes</a></li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-dark">Editar</li>
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

            <form action="{{ route('work-orders.update', $booking->id) }}" id="frm-crud-update" method="post">
                @csrf
                @method('PUT')
                <!--begin::Card-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Editar Orden ({{ $booking->number }})</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="d-flex flex-wrap gap-5 mb-10">
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
                                    <div class="text-muted fs-7">Fecha de creación del consumo.</div>
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
                                    <div class="text-muted fs-7">Fecha de creación del consumo.</div>
                                    <!--end::Description-->
                                </div>
                                
                            </div>

                            <div class="d-flex flex-wrap gap-5 mb-10">
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

                        </div>
                        <!--end::Card body-->
                </div>
                
                <div class="card card-flush py-6 px-6 mt-10">
                    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1">NO. DE VIAJE ASIGNADO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_2">INGRESOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_3">COSTOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_4">BENEFICIO</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                            @if($booking->booking_id != null)
                            <h2><a href="{{ route('bookings.edit', $booking->booking_id) }}">VIAJE NO : {{ $booking->booking->id }}</a></h2>
                            @else
                            <h2>NO EXISTEN VIAJES PROCESADOS CON ESTA ORDEN DE TRABAJO</h2>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                            @if($booking->booking_id != null)
                            <h2> $ {{ number_format($booking->booking->rate + $booking->booking->additionals, 2) }}</h2>
                            @else
                            <h2>NO EXISTEN INGRESOS PROCESADOS CON ESTA ORDEN DE TRABAJO</p>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                            @if($booking->booking_id != null)
                            <h2> $ {{ number_format($booking->booking->rate_outsource + $booking->booking->additionals_outsource, 2) }}</h2>
                            @else
                            <h2>NO EXISTEN COSTOS PROCESADOS CON ESTA ORDEN DE TRABAJO</h2>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel">
                            @if($booking->booking_id != null)
                            <h2> $ {{ number_format((($booking->booking->rate + $booking->booking->additionals) - ($booking->booking->rate_outsource + $booking->booking->additionals_outsource)), 2) }}</h2>
                            @else
                            <h2>NO EXISTEN BENEFICIOS PROCESADOS CON ESTA ORDEN DE TRABAJO</h2>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!--end::Card-->
                <div class="d-flex justify-content-end mt-10">
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
            //var url = $('#bookings-list').val();
            //window.location.replace(url);
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