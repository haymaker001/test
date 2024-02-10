@extends('layouts.app')

    @section('toolbar')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Roles</h1>
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
                <li class="breadcrumb-item text-dark">Roles</li>
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

    @section('extra_css')
    <link href="{{ asset('assets/plugins/custom/jstree/jstree.bundle.css') }}" rel="stylesheet" type="text/css" />
    @endsection

@section('content')
<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->

    <div id="kt_content_container" class="container-xxl">

        <form action="{{ route('roles.roles') }}" method="POST" id="frm-save-permissions">
            @csrf
            <!--begin::Card-->
            <div class="card mb-7">
                <!--begin::Card body-->
                <div class="card-body">

                    <input type="hidden" id="permissions" name="permissions" value="">
                    <input type="hidden" id="url_position_permissions" value="{{ route('roles.permissions', ':id') }}">

                    <div class="d-flex flex-wrap gap-5 mb-2">
                        <div class="fv-row w-100 flex-md-root">
                            <!--begin::Label-->
                            <label class="required form-label" for="customer_id">Posición</label>
                            <!--end::Label-->
                            <!--begin::Select2-->
                            <select class="form-select form-select-solid" name="position_id" id="position_id" data-placeholder="seleccionar item">
                                <option></option>
                                @foreach($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                                @endforeach
                            </select>
                            <!--end::Select2-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Nombre de la posición.</div>
                            <!--end::Description-->
                        </div>                                           
                    </div>
                    <div class="d-flex flex-wrap gap-5 mb-2">
                        <div class="fv-row w-100 flex-md-root">

                            <label class="required form-label" for="permissions-tree">Roles / Permisos</label>

                            <div class="selectablejstree" id="permissions-tree">
                            </div>
                        </div>
                    </div>

                </div>
                <!--end::Card body-->
            </div>
            <div class="d-flex justify-content-end mt-10">
                    <!--begin::Button-->
                    <a href="#" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancelar</a>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                        <span class="indicator-label">Guardar</span>
                        <span class="indicator-progress">Por favor espere... 
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
            <!--end::Card-->
        </form>

    </div>
    <!--end::Container-->
</div>
    @section('extra_js')
    <script src="{{ asset('assets/js/jstree/jstree.min.js') }}"></script>
    <script>
        $('#permissions-tree').jstree({
            'plugins': ["wholerow", "checkbox", "types"],
            'core': {
                "themes" : {
                    "responsive": false
                },
                'data' : [
                @foreach ($menus as $menu)
                {
                    'text' : '{{ mb_strtoupper($menu->name) }}',
                    @if(count($menu->children))
                        @include('dynamics.roles', ['childs' => $menu->children])
                    @endif
                },
                @endforeach
                ]
            }
        });

        $('#position_id').change(function(){
            var id = (this).value;
            var url_permissions = $('#url_position_permissions').val();
            url_permissions = url_permissions.replace(':id', id);
            $.get(url_permissions, function(data, status){
                $("#permissions-tree").jstree("uncheck_all");
                for(var i = 0; i < data.length; i++)
                    $('#permissions-tree').jstree("check_node", "#"+data[i]);
            }).fail(function(jqXHR, textStatus, errorThrown){
                $("#permissions-tree").jstree("uncheck_all");
            });
        });

        $('#frm-save-permissions').on('submit', function(e){
            e.preventDefault();
            var id = $('#position_id').val();
            if(!id){
                alert('* Debes seleccionar una posición');
                return false;
            }
            $('#permissions').val($('#permissions-tree').jstree(true).get_selected());
            var form = $('#frm-save-permissions');
            var url     = form.attr('action');
            url = url.replace(':id', id);
            var data    = form.serialize();
            $.post(url, data, function(response){
                show_success_message('Registros editados exitosamente');
            }).fail(function(jqXHR, textStatus, errorThrown){
                show_errors_message(jqXHR);
            });
        });
    </script>
    @endsection
<!--end::Post-->
@endsection