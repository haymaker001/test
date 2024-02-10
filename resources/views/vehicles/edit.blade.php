@extends('layouts.app')

    @section('toolbar')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Editar Vehículo</h1>
            <!--end::Title-->
            <!--begin::Separator-->
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <!--end::Separator-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted"><a href="{{ route('vehicles.index') }}">Listado de Vehículos</a></li>
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

            <form action="{{ route('vehicles.update', $vehicle->id) }}" id="frm-crud-update" method="post">
                @csrf
                @method('PUT')
                <!--begin::Card-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Editar Vehículo</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="d-flex flex-wrap gap-5 mb-10">
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="name">Nombre</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="name" id="name" value="{{ $vehicle->name }}" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Nombre del vehículo.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="model">Modelo</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="model" id="model" value="{{ $vehicle->model }}" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Modelo del vehículo.</div>
                                    <!--end::Description-->
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="year">Año</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="year" id="year" value="{{ $vehicle->year }}" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Año del vehículo.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="customer_id">Tipo de Vehículo</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_type_id" id="vehicle_type_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option></option>
                                        @foreach($vehicle_types as $vehicle_type)
                                        <option value="{{ $vehicle_type->id }}" @if($vehicle_type->id == $vehicle->vehicle_type_id) selected="" @endif  >{{ $vehicle_type->name }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Nombre del cliente del centro.</div>
                                    <!--end::Description-->
                                </div>
                            </div>
                            <div class="d-flex flex-wrap gap-5 mb-10">
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="customer_id">Grupo de Vehículo</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_group_id" id="vehicle_group_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option></option>
                                        @foreach($vehicle_groups as $vehicle_group)
                                        <option value="{{ $vehicle_group->id }}" @if($vehicle_group->id == $vehicle->vehicle_group_id) selected="" @endif >{{ $vehicle_group->name }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Nombre del cliente del centro.</div>
                                    <!--end::Description-->
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="customer_id">Ejes </label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="engine_type" id="engine_type" data-control="select2" data-placeholder="seleccionar item">
                                        <option value="Normal" @if($vehicle->engine_type == 'Normal') selected="" @endif >Normal</option>
                                        <option value="Sencillo" @if($vehicle->engine_type == 'Sencillo') selected="" @endif >Sencillo</option>
                                        <option value="Doble" @if($vehicle->engine_type == 'Doble') selected="" @endif >Doble</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Eje del vehiculo.</div>
                                    <!--end::Description-->
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="horse_power">Caballos de fuerza</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="horse_power" id="horse_power" value="{{ $vehicle->horse_power }}" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Caballos de fuerza del vehículo.</div>
                                    <!--end::Description-->
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="horse_power">Marca</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="color" id="color" value="{{ $vehicle->color }}" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Marca del vehículo.</div>
                                    <!--end::Description-->
                                </div>
                                
                            </div>
                            <div class="d-flex flex-wrap gap-5 mb-10">
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="form-label" for="vin">VIN</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="vin" id="vin" value="{{ $vehicle->vin }}" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">VIN del vehículo.</div>
                                    <!--end::Description-->
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="form-label" for="license_plate">Placa</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="license_plate" id="license_plate" value="{{ $vehicle->license_plate }}" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Placa del vehículo.</div>
                                    <!--end::Description-->
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="customer_id">Vehiculo es Visible en Rendimiento? </label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="is_reportable" id="is_reportable" data-control="select2" data-placeholder="seleccionar item">
                                        <option value="0" @if($vehicle->is_reportable == "0") selected="" @endif>NO</option>
                                        <option value="1" @if($vehicle->is_reportable == "1") selected="" @endif>SI</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Indica si el equipo es visible en el reporte de rendimiento.</div>
                                    <!--end::Description-->
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="outsource">Es Subcontratado? </label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="outsource" id="outsource" data-control="select2" data-placeholder="seleccionar item">
                                        <option value="0" @if($vehicle->outsource == "0") selected="" @endif>NO</option>
                                        <option value="1" @if($vehicle->outsource == "1") selected="" @endif>SI</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Indica si el equipo es subcontratado o no.</div>
                                    <!--end::Description-->
                                </div>
                            </div>
                        </div>
                        <!--end::Card body-->
                </div>
                <!--end::Card-->
                <div class="d-flex justify-content-end mt-10">
                    <!--begin::Button-->
                    <a href="{{ route('vehicles.index') }}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancelar</a>
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
@endsection