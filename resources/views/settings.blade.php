@extends('layouts.app')

    @section('toolbar')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Configuración General</h1>
            <!--end::Title-->
            <!--begin::Separator-->
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <!--end::Separator-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Configuración</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-300 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-dark">Generales</li>
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

            <form action="{{ route('users.store') }}" id="frm-crud-add" method="post">
                @csrf
                
                <div class="card ">
                    <div class="card-header card-header-stretch">
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_7"> <i class="fas fa-info-circle"></i> &nbsp; Generales</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_8"> <i class="fas fa-user-check"></i> &nbsp; Adicionales</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="kt_tab_pane_7" role="tabpanel">
                                <div class="d-flex flex-wrap gap-5 mb-10">
                                    <!--begin::Input group-->
                                    <div class="fv-row w-100 flex-md-root">
                                        <!--begin::Label-->
                                        <label class="required form-label" for="mileage_adjustment">Ajuste de Kilometraje</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control mb-2" name="mileage_adjustment" id="mileage_adjustment" />
                                        <!--end::Input-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">.</div>
                                        <!--end::Description-->
                                    </div>
    
                                    <div class="fv-row w-100 flex-md-root">
                                        <!--begin::Label-->
                                        <label class="required form-label" for="administrative_and_financial_expenses">Gastos Administrativos. y Financieros</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control mb-2" name="administrative_and_financial_expenses" id="administrative_and_financial_expenses" />
                                        <!--end::Input-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7"></div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row w-100 flex-md-root">
                                        <!--begin::Label-->
                                        <label class="required form-label" for="driver_salary">Salario Chofer</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control mb-2" value="26000" name="driver_salary" id="driver_salary" />
                                        <!--end::Input-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Salario de chofer.</div>
                                        <!--end::Description-->
                                    </div>
                                    
                                    <!--end::Input group-->
                                </div>
    
                            </div>
                
                            <div class="tab-pane fade" id="kt_tab_pane_8" role="tabpanel">
                                <div class="d-flex flex-wrap gap-5 mb-10">
    
                                    <div class="fv-row w-100 flex-md-root">
                                        <!--begin::Label-->
                                        <label class="required form-label" for="supply_center_id">Centro Asignado</label>
                                        <!--end::Label-->
                                        <!--begin::Select2-->
                                        <select class="form-select form-select-solid" name="supply_center_id" id="supply_center_id" data-control="select2" data-placeholder="seleccionar item">
                                            <option value="0">N/A</option>
                                        </select>
                                        <!--end::Select2-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Determina si el usuario tiene un centro de distribuci��n especifico asignado o no.</div>
                                        <!--end::Description-->
                                    </div>
                                    
                                    <div class="fv-row w-100 flex-md-root">
                                        <!--begin::Label-->
                                        <label class="required form-label" for="customer_id">Cliente Asignado</label>
                                        <!--end::Label-->
                                        <!--begin::Select2-->
                                        <select class="form-select form-select-solid" name="customer_id" id="customer_id" data-control="select2" data-placeholder="seleccionar item">
                                            <option value="0">N/A</option>
                                        </select>
                                        <!--end::Select2-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Determina si el usuario tiene un cliente asignado o no.</div>
                                        <!--end::Description-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--begin::Card-->
                @if(1 != 1)
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Crear Usuario</h2>
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
                                    <input type="text" class="form-control mb-2" name="name" id="name" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Nombre del usuario.</div>
                                    <!--end::Description-->
                                </div>

                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="name">Identificaci��n</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2 identification" name="rnc" id="rnc" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Identificaci��n del usuario.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="rnc">Email</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2 " name="email" id="email" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Email del usuario.</div>
                                    <!--end::Description-->
                                </div>
                                
                                <!--end::Input group-->
                            </div>

                            <div class="d-flex flex-wrap gap-5 mb-10">
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="rnc">Contrase�0�9a</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="password" class="form-control mb-2 " name="password" id="password" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Contrase�0�9a del usuario.</div>
                                    <!--end::Description-->
                                </div>

                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="position_id">Posici��n</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="position_id" id="position_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option></option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Permisos del usuario .</div>
                                    <!--end::Description-->
                                </div>
                            </div>
                        </div>
                        <!--end::Card body-->
                </div>
                @endif
                <!--end::Card-->
                <div class="d-flex justify-content-end mt-10">
                    <!--begin::Button-->
                    <a href="{{ route('drivers.index') }}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancelar</a>
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