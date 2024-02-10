@extends('layouts.app')

    @section('toolbar')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Crear Registro de Consumo</h1>
            <!--end::Title-->
            <!--begin::Separator-->
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <!--end::Separator-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted"><a href="{{ route('fuel-consumptions.index') }}">Listado de Registro de Consumo</a></li>
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
            <input type="hidden" name="frm-odometer" id="frm-odometer" value="{{ route('fuel-consumptions.odometer', ':id') }}">
            <form action="{{ route('fuel-consumptions.store') }}" id="frm-crud-add" method="post">
                @csrf
                <!--begin::Card-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Crear Registro de Consumo.</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="d-flex flex-wrap gap-5 mb-10">
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="dashboard">Centro de Distribucón</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="supply_center_id" id="supply_center_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option></option>
                                        @if(intval(auth::user()->supply_center_id) > 0)
                                            <option value="{{ auth::user()->supply_center->id }}" data-type="{{ auth::user()->supply_center->supply_center_type }}">{{ auth::user()->supply_center->name }}</option>
                                        @else
                                            @foreach($supply_centers as $supply_center)
                                            <option value="{{ $supply_center->id }}" data-type="{{ $supply_center->supply_center_type }}">{{ $supply_center->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Centro de distribución.</div>
                                    <!--end::Description-->
                                </div>
                                
                                <div class="fv-row w-100 flex-md-root other" style="display: none">
                                    <!--begin::Label-->
                                    <label class="form-label" for="other">Nombre de Abastecimiento</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="other" id="other" value="" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Lugar de abastecimiento Provicional.</div>
                                    <!--end::Description-->
                                </div>
                                
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="client_id">Cliente</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="client_id" id="client_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option></option>
                                        @foreach($clients as $client)
                                        <option value="{{ $client->id }}" >{{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Nombre del cliente.</div>
                                    <!--end::Description-->
                                </div>
                                
                                
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="dashboard">Equipo / Ficha</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_id" id="vehicle_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option></option>
                                        @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}" data-id="{{ $vehicle->id }}" >{{ $vehicle->name }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Vehiculo a registrarle el consumo</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                
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
                            </div>
                            <div class="d-flex flex-wrap gap-5 mb-10">
                                
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="created_date"> Fecha de Creación </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2 date" name="created_date" id="created_date" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Fecha de creación del consumo.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                
                                
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="form-label" for="initial_odometer">Odometro Inicial</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="initial_odometer" id="initial_odometer" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Fecha de creación del consumo.</div>
                                    <!--end::Description-->
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="final_odometer">Odometro Final</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="final_odometer" id="final_odometer" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Fecha de creación del consumo.</div>
                                    <!--end::Description-->
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="number_of_gallons">Cantidad de Galones</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="number_of_gallons" id="number_of_gallons" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Fecha de creación del consumo.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <div class="d-flex flex-wrap gap-5 mb-10">
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="form-label" for="initial_odometer">Notas</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <textarea class="form-control mb-2" name="notes" id="notes"></textarea>
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Notas del registro de consumo.</div>
                                    <!--end::Description-->
                                </div>
                            </div>
                        </div>
                        <!--end::Card body-->
                </div>
                <!--end::Card-->
                <div class="d-flex justify-content-end mt-10">
                    <!--begin::Button-->
                    <a href="{{ route('fuel-consumptions.index') }}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancelar</a>
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
    <script>
        $("#vehicle_id").on("change",function(){
            var id = $(this).find(":selected").data("id");
            var url= $('#frm-odometer').val();
            url = url.replace(':id', id);
            
            $.get(url, function(odometer){
                console.log(odometer);
                if(odometer == "0"){
                    $("#initial_odometer").focus();
                    $("#initial_odometer").val(odometer);
                    $("#initial_odometer").prop("readonly", false);
                }
                else {
                    $("#initial_odometer").val(odometer);
                    @if(Auth::user()->user_type == 'S')
                    $("#initial_odometer").prop("readonly", false);
                    @else
                    $("#initial_odometer").prop("readonly", true);
                    @endif
                }
            });
        });
        
        $(document).on('change', '#supply_center_id', function() {
            var Outsource = $(this).find(':selected').attr('data-type');
            if(Outsource == 'PROVICIONAL') {
                $(".other").show('slow');
            }
            else
                $(".other").hide('slow');
        });
    </script>
    @endsection
@endsection