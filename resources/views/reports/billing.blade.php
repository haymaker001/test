@extends('layouts.app')

    @section('toolbar')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Informe de Facturación</h1>
            <!--end::Title-->
            <!--begin::Separator-->
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <!--end::Separator-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Conduces</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-300 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-dark">Informe de Facturación</li>
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

        <form action="{{ route('reports.billing') }}" method="POST">
            @csrf
            <!--begin::Card-->
            <div class="card mb-7">
                <!--begin::Card body-->
                <div class="card-body">

                    <div class="d-flex flex-wrap gap-5 mb-2">
                        <div class="fv-row w-100 flex-md-root">
                            <!--begin::Label-->
                            <label class="required form-label" for="from"> Desde </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control mb-2 date" name="from" id="from" />
                            <!--end::Input-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Fecha desde.</div>
                            <!--end::Description-->
                        </div>

                        <div class="fv-row w-100 flex-md-root">
                            <!--begin::Label-->
                            <label class="required form-label" for="to"> Hasta </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control mb-2 date" name="to" id="to" />
                            <!--end::Input-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Fecha hasta.</div>
                            <!--end::Description-->
                        </div>
                        <div class="fv-row w-100 flex-md-root">
                            <!--begin::Label-->
                            <label class="required form-label" for="customer_id">Cliente</label>
                            <!--end::Label-->
                            <!--begin::Select2-->
                            <select class="form-select form-select-solid" name="customer_id" id="customer_id" data-control="select2" data-placeholder="seleccionar item">
                                <option></option>
                                @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" @if($customer_select == $customer->id) selected="" @endif   >{{ $customer->name }}</option>
                                @endforeach
                            </select>
                            <!--end::Select2-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Nombre del cliente.</div>
                            <!--end::Description-->
                        </div>

                        <div class="fv-row w-100 flex-md-root">
                            <!--begin::Label-->
                            <label class="required form-label" for="customer_id">Centro</label>
                            <!--end::Label-->
                            <!--begin::Select2-->
                            <select class="form-select form-select-solid" name="center_id" id="center_id" data-control="select2" data-placeholder="seleccionar item">
                                <option></option>
                                @foreach($centers as $center)
                                <option value="{{ $center->id }}" >{{ $center->name }}</option>
                                @endforeach
                            </select>
                            <!--end::Select2-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Nombre del centro.</div>
                            <!--end::Description-->
                        </div>

                        <div class="fv-row w-100 flex-md-root">
                            <!--begin::Label-->
                            <label class="required form-label" for="show_rate">Mostrar Tarífa?</label>
                            <!--end::Label-->
                            <!--begin::Select2-->
                            <select class="form-select form-select-solid" name="show_rate" id="show_rate" data-control="select2" data-placeholder="seleccionar item">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                            <!--end::Select2-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Determina si se ve la tarífa en el reporte</div>
                            <!--end::Description-->
                        </div>

                                           
                    </div>

                    <div class="d-flex align-items-center justify-content-end">
                        <a href="#" class="btn btn-active-light-primary btn-color-gray-400 me-3">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Generar Informe</button>
                    </div>

                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </form>

    </div>
    <!--end::Container-->
</div>
<!--end::Post-->
@endsection