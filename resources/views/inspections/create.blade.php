@extends('layouts.app')

    @section('toolbar')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Crear Registro de Inspección</h1>
            <!--end::Title-->
            <!--begin::Separator-->
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <!--end::Separator-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted"><a href="{{ route('inspections.index') }}">Listado de Inspecciones</a></li>
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
                            <h2>Crear Registro de Inspección.</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="d-flex flex-wrap gap-5 mb-10">
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="dashboard">Equipo / Ficha</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_id" id="vehicle_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option></option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Vehiculo a registrarle el consumo</div>
                                    <!--end::Description-->
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="form-label" for="initial_odometer">Kilometraje</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="initial_odometer" id="initial_odometer" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Kilometraje.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
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
                            </div>
                            
                            <div class="d-flex flex-wrap gap-5 mb-10">
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label text-danger" for="dashboard">Nivel de Aceite de Motor</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_id" id="vehicle_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option>BUENO</option>
                                        <option>MALO</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Vehiculo a registrarle el consumo</div>
                                    <!--end::Description-->
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label text-danger" for="dashboard">Nivel de Aceite Hidráulico del Guia</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_id" id="vehicle_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option>BUENO</option>
                                        <option>MALO</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Vehiculo a registrarle el consumo</div>
                                    <!--end::Description-->
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label text-danger" for="dashboard">Nivel de Aceite de Motor</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_id" id="vehicle_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option>BUENO</option>
                                        <option>MALO</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Vehiculo a registrarle el consumo</div>
                                    <!--end::Description-->
                                </div>
                            </div>
                            
                            <div class="d-flex flex-wrap gap-5 mb-10">
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label " for="dashboard">Condiciones de  Tapón  de Radiador</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_id" id="vehicle_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option>BUENO</option>
                                        <option>MALO</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Vehiculo a registrarle el consumo</div>
                                    <!--end::Description-->
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label text-danger" for="dashboard">Condiciones de Correas</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_id" id="vehicle_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option>BUENO</option>
                                        <option>MALO</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Vehiculo a registrarle el consumo</div>
                                    <!--end::Description-->
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label " for="dashboard">Condiciones de Mangueras</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_id" id="vehicle_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option>BUENO</option>
                                        <option>MALO</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Vehiculo a registrarle el consumo</div>
                                    <!--end::Description-->
                                </div>
                            </div>
                            
                            <div class="d-flex flex-wrap gap-5 mb-10">
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label text-danger" for="dashboard">Nivel de Aceite de Motor</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_id" id="vehicle_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option>BUENO</option>
                                        <option>MALO</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Vehiculo a registrarle el consumo</div>
                                    <!--end::Description-->
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label text-danger" for="dashboard">Nivel de Aceite Hidráulico del Guia</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_id" id="vehicle_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option>BUENO</option>
                                        <option>MALO</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Vehiculo a registrarle el consumo</div>
                                    <!--end::Description-->
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label text-danger" for="dashboard">Nivel de Aceite de Motor</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_id" id="vehicle_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option>BUENO</option>
                                        <option>MALO</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Vehiculo a registrarle el consumo</div>
                                    <!--end::Description-->
                                </div>
                            </div>
                            
                            <div class="d-flex flex-wrap gap-5 mb-10">
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label " for="dashboard">Condiciones de  Tapón  de Radiador</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_id" id="vehicle_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option>BUENO</option>
                                        <option>MALO</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Vehiculo a registrarle el consumo</div>
                                    <!--end::Description-->
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label text-danger" for="dashboard">Condiciones de Correas</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_id" id="vehicle_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option>BUENO</option>
                                        <option>MALO</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Vehiculo a registrarle el consumo</div>
                                    <!--end::Description-->
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label " for="dashboard">Condiciones de Mangueras</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_id" id="vehicle_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option>BUENO</option>
                                        <option>MALO</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Vehiculo a registrarle el consumo</div>
                                    <!--end::Description-->
                                </div>
                            </div>
                            
                            <div class="d-flex flex-wrap gap-5 mb-10">
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label text-danger" for="dashboard">Nivel de Aceite de Motor</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_id" id="vehicle_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option>BUENO</option>
                                        <option>MALO</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Vehiculo a registrarle el consumo</div>
                                    <!--end::Description-->
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label text-danger" for="dashboard">Nivel de Aceite Hidráulico del Guia</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_id" id="vehicle_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option>BUENO</option>
                                        <option>MALO</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Vehiculo a registrarle el consumo</div>
                                    <!--end::Description-->
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label text-danger" for="dashboard">Nivel de Aceite de Motor</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_id" id="vehicle_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option>BUENO</option>
                                        <option>MALO</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Vehiculo a registrarle el consumo</div>
                                    <!--end::Description-->
                                </div>
                            </div>
                            
                            <div class="d-flex flex-wrap gap-5 mb-10">
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label " for="dashboard">Condiciones de  Tapón  de Radiador</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_id" id="vehicle_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option>BUENO</option>
                                        <option>MALO</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Vehiculo a registrarle el consumo</div>
                                    <!--end::Description-->
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label text-danger" for="dashboard">Condiciones de Correas</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_id" id="vehicle_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option>BUENO</option>
                                        <option>MALO</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Vehiculo a registrarle el consumo</div>
                                    <!--end::Description-->
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label " for="dashboard">Condiciones de Mangueras</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_id" id="vehicle_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option>BUENO</option>
                                        <option>MALO</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Vehiculo a registrarle el consumo</div>
                                    <!--end::Description-->
                                </div>
                            </div>
                        </div>
                        <!--end::Card body-->
                </div>
                <!--end::Card-->
                <div class="d-flex justify-content-end mt-10">
                    <!--begin::Button-->
                    <a href="{{ route('inspections.index') }}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancelar</a>
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
    </script>
    @endsection
@endsection