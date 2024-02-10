@extends('layouts.app')

    @section('toolbar')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Salida de Inventario</h1>
            <!--end::Title-->
            <!--begin::Separator-->
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <!--end::Separator-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <li class="breadcrumb-item text-muted">Mantenimientos - </li>
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted"><a href="{{ route('inventories-out.index') }}">Salida de Inventario - </a></li>
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
            
            <input type="hidden" name="item_warehouses_url" id="item_warehouses_url" value="{{ route('item-definitions.warehouses', ':id') }}">
            <input type="hidden" name="item_locations_url" id="item_locations_url" value="{{ route('warehouses.locations', ':id') }}">
 
            <form action="{{ route('inventories-out.store') }}" id="frm-crud-add" method="post">
                @csrf
                <input type="hidden" name="warehouse_sections_url" id="warehouse_sections_url" value="{{ route('warehouses.sections', ':id') }}">
                <!--begin::Card-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Salida de Inventario</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="d-flex flex-wrap gap-5 mb-10">
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="warehouse_location_id">Producto</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="item_definition_id" id="item_definition_id" data-control="select2" data-placeholder="seleccionar producto">
                                        <option value="">SELECCIONAR</option>
                                        @foreach($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->reference }} - {{ $item->name }} - {{ $item->brand }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Seleccionar el producto.</div>
                                    <!--end::Description-->
                                </div>
                                
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="warehouse_id">Almacen</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="warehouse_id" id="warehouse_id" data-control="select2" data-placeholder="seleccionar ubicación">
                                        <option></option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Ubicación del almacen del producto.</div>
                                    <!--end::Description-->
                                </div>
                                
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="warehouse_location_id">Ubicación</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="warehouse_location_id" id="warehouse_location_id" data-control="select2" data-placeholder="seleccionar ubicación">
                                        <option value="">SELECCIONAR</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Ubicación del almacen del producto.</div>
                                    <!--end::Description-->
                                </div>
                                
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="section_id">Sección</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="section_id" id="section_id" data-control="select2" data-placeholder="seleccionar ubicación">
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Seccion de la ubicacion.</div>
                                    <!--end::Description-->
                                </div>
                                
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="warehouse_location_id">Vehículo</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="vehicle_id" id="vehicle_id" data-control="select2" data-placeholder="seleccionar vehiculo">
                                        <option value="">SELECCIONAR</option>
                                        @foreach($vehicles as $warehouse)
                                        <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Vehículo al que se le aplicará las piezas.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            
                            <div class="d-flex flex-wrap gap-5 mb-10">
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="form-label required" for="pieces">Cantidad</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="number" class="form-control mb-2" name="pieces" id="pieces" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Cantidad de productos.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group
                                <div class="fv-row w-100 flex-md-root">
                                    <label class="required form-label" for="price">Precio</label>
                                    <input type="text" class="form-control mb-2" name="price" id="price" />
                                    <div class="text-muted fs-7">Precio del producto.</div>
                                </div>end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="form-label" for="technical">Técnico</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="hidden" class="form-control mb-2" name="technical" id="technical" />
                                    <select class="form-select form-select-solid" name="technician_id" id="technician_id" data-control="select2" data-placeholder="seleccionar tecnico">
                                        <option value="0">SELECCIONAR TECNICO</option>
                                        @foreach($technicians as $warehouse)
                                        <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Nombre del Técnico.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            
                            <div class="d-flex flex-wrap gap-5 mb-10">
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label" for="notes">Notas</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="notes" id="notes" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Notas de la entrada.</div>
                                    <!--end::Description-->
                                </div>
                                
                                
                                
                            </div>
                        </div>
                        <!--end::Card body-->
                </div>
                <!--end::Card-->
                <div class="d-flex justify-content-end mt-10">
                    <!--begin::Button-->
                    <a href="{{ route('inventories-out.index') }}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancelar</a>
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

@section('extra_js')
<script>
    $(document).on('change', '#item_definition_id', function() {
        var id = this.value;
        getWarehouses(id);
    });
    
    $(document).on('change', '#warehouse_id', function() {
        var id = $('#item_definition_id').val();
        getLocations(id);
    });
    
    function getWarehouses(id)
    {
        var warehouses   = $('#item_warehouses_url').val();
        var url         = warehouses.replace(':id', id);
        $('#warehouse_id').select2("destroy");

        $.get(url, function(response){
            var options ="<option value=''></option>";
            $.each(response, function(i, val){
                options += "<option value='"+val.id+"'>"+val.name+"</option>";
            });
            $('#warehouse_id').empty();
            $('#warehouse_id').append(options);
            $('#warehouse_id').select2();
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            $('#warehouse_id').empty();
            $('#warehouse_id').select2();
        });
    }
    
    function getLocations(id)
    {
        var locations   = $('#item_locations_url').val();
        var url         = locations.replace(':id', id);
        $('#warehouse_location_id').select2("destroy");

        $.get(url, function(response){
            var options ="<option value=''></option>";
            $.each(response, function(i, val){
                options += "<option value='"+val.warehouse_location.id+"'>"+val.warehouse_location.name+"</option>";
            });
            $('#warehouse_location_id').empty();
            $('#warehouse_location_id').append(options);
            $('#warehouse_location_id').select2();
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            $('#warehouse_location_id').empty();
            $('#warehouse_location_id').select2();
        });
    }
    
    $(document).on('change', '#warehouse_location_id', function() {
        var id = this.value;
        getWarehouseSections(id);
    });
    
    function getWarehouseSections(id)
    {
        var warehouse_location = $('#warehouse_sections_url').val();
        var url     = warehouse_location.replace(':id', id);
        $('#section_id').select2("destroy");

        $.get(url, function(response){
            var options ="<option value=''></option>";
            $.each(response, function(i, val){
                options += "<option value='"+val.id+"'>"+val.name+"</option>";
            });
            $('#section_id').empty();
            $('#section_id').append(options);
            $('#section_id').select2();
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            $('#section_id').empty();
            $('#section_id').select2();
        });
    }
</script>
@endsection