@extends('layouts.app')

    @section('toolbar')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Editar Usuario</h1>
            <!--end::Title-->
            <!--begin::Separator-->
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <!--end::Separator-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted"><a href="{{ route('users.index') }}">Listado de Usuario</a></li>
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

            <form action="{{ route('users.update', $user->id) }}" id="frm-crud-update" method="post">
                @csrf
                @method('PUT')
                
                <div class="card ">
                    <div class="card-header card-header-stretch">
                        <h2 class="card-title">Editar Usuario</h2>
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_7"> <i class="fas fa-info-circle"></i> &nbsp; Datos Generales</a>
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
                                        <label class="required form-label" for="name">Nombre</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control mb-2" name="name" id="name" value="{{ $user->name }}" />
                                        <!--end::Input-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Nombre del usuario.</div>
                                        <!--end::Description-->
                                    </div>
    
                                    <div class="fv-row w-100 flex-md-root">
                                        <!--begin::Label-->
                                        <label class="required form-label" for="name">Identificación</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control mb-2 identification" name="rnc" id="rnc" value="{{ $user->rnc }}" />
                                        <!--end::Input-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Identificación del usuario.</div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row w-100 flex-md-root">
                                        <!--begin::Label-->
                                        <label class="required form-label" for="rnc">Email</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control mb-2 " name="email" id="email" value="{{ $user->email }}" />
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
                                        <label class="required form-label" for="rnc">Contraseña</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="password" class="form-control mb-2 " name="password" id="password" />
                                        <!--end::Input-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Contraseña del usuario.</div>
                                        <!--end::Description-->
                                    </div>
    
                                    <div class="fv-row w-100 flex-md-root">
                                        <!--begin::Label-->
                                        <label class="required form-label" for="position_id">Posición</label>
                                        <!--end::Label-->
                                        <!--begin::Select2-->
                                        <select class="form-select form-select-solid" name="position_id" id="position_id" data-control="select2" data-placeholder="seleccionar item">
                                            <option></option>
                                            @foreach($positions as $position)
                                            <option value="{{ $position->id }}" @if($position->id == $user->position_id) selected="" @endif >{{ $position->name }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Select2-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Permisos del usuario .</div>
                                        <!--end::Description-->
                                    </div>
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
                                            @foreach($supply_centers as $supply_center)
                                            <option value="{{ $supply_center->id }}" @if($supply_center->id == $user->supply_center_id) selected="" @endif  >{{ $supply_center->name }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Select2-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Determina si el usuario tiene un centro de distribución especifico asignado o no.</div>
                                        <!--end::Description-->
                                    </div>
                                    
                                    <div class="fv-row w-100 flex-md-root">
                                        <!--begin::Label-->
                                        <label class="required form-label" for="customer_id">Cliente Asignado</label>
                                        <!--end::Label-->
                                        <!--begin::Select2-->
                                        <select class="form-select form-select-solid" name="customer_id" id="customer_id" data-control="select2" data-placeholder="seleccionar item">
                                            <option value="0">N/A</option>
                                            @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}" @if($customer->id == $user->customer_id) selected="" @endif  >{{ $customer->name }}</option>
                                            @endforeach
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