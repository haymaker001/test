@extends('layouts.app')

    @section('toolbar')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Editar Centro</h1>
            <!--end::Title-->
            <!--begin::Separator-->
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <!--end::Separator-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted"><a href="{{ route('centers.index') }}">Listado de Centros</a></li>
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

            <form action="{{ route('centers.update', $center->id) }}" id="frm-crud-update" method="post">
                @METHOD('PUT')
                @csrf
                <!--begin::Card-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Editar Centro</h2>
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
                                    <input type="text" class="form-control mb-2" name="name" value="{{ $center->name }}" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Nombre del centro.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="customer_id">Cliente</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="customer_id" data-control="select2" data-placeholder="seleccionar item">
                                        <option></option>
                                        @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" @if($customer->id == $center->customer_id) selected="" @endif >{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Nombre del cliente del centro.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                            </div>
                        </div>
                        <!--end::Card body-->
                </div>
                <!--end::Card-->
                <div class="d-flex justify-content-end mt-10">
                    <!--begin::Button-->
                    <a href="{{ route('centers.index') }}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancelar</a>
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