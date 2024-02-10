@extends('layouts.app')

    @section('extra_css')
    <link href="{{ asset('assets/css/jquery-confirm.min.css') }}" rel="stylesheet" type="text/css" />
    @endsection

    @section('toolbar')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Listado de Ordenes de Trabajo</h1>
            <!--end::Title-->
            <!--begin::Separator-->
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <!--end::Separator-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Mantenimientos</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-300 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-dark">Listado de Ordenes de Trabajo</li>
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
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text" id="search-box" class="form-control form-control-solid w-250px ps-15" placeholder="Buscar" />
                    </div>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
						<!--begin::Menu-->
						<button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
							<!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
							<span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="black"></path>
								</svg>
							</span>
							Filtros
							<!--end::Svg Icon-->
						</button>
						<!--begin::Menu 1-->
						<div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_62291577778df" style="">
							<!--begin::Header-->
							<div class="px-7 py-5">
								<div class="fs-5 text-dark fw-bolder"> Opciones de Filtro</div>
							</div>
							<!--end::Header-->
							<!--begin::Menu separator-->
							<div class="separator border-gray-200"></div>
							<!--end::Menu separator-->
							<!--begin::Form-->
							<div class="px-7 py-5">
								<!--begin::Input group-->
								<div class="mb-10">
									<!--begin::Label-->
									<label class="form-label fw-bold">Ordenar Por:</label>
									<!--end::Label-->
									<!--begin::Input-->
									<div>
										<select class="w-100 form-select form-select-solid" id="sort_by" name="sort_by">
											<option value="">N/A</option>
											<option value="customer_id">Cliente</option>
											<option value="pickup">Fecha</option>
											<option value="center_id">Centro</option>
											<option value="vehicle_id">Equipo</option>
											<option value="driver_id">Chofer</option>
											<option value="helper">Ayudante</option>
											<option value="travellers">Transporte</option>
										</select>
									</div>
									<!--end::Input-->
								</div>
								<div class="mb-10">
									<!--begin::Label-->
									<label class="form-label fw-bold">Orden Tipo:</label>
									<!--end::Label-->
									<!--begin::Input-->
									<div>
										<select class="w-100 form-select form-select-solid" id="sort_type" name="sort_type">
											<option value="desc">Descendiente</option>
											<option value="asc">Ascendente</option>
										</select>
									</div>
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<div class="d-flex justify-content-end">
									<button type="button" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true" onclick="update_data()">Aplicar</button>
								</div>
								<!--end::Actions-->
							</div>
							<!--end::Form-->
						</div>
						<!--end::Menu 1-->
						<!--end::Menu-->
					</div>
                    
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                        
                        <!--begin::Export-->
                        <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_customers_export_modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="black" />
                                <path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="black" />
                                <path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->Exportar</button>
                        <!--end::Export-->
                        <!--begin::Add customer-->
                        <a href="{{ route('work-orders.create') }}" class="btn btn-primary">Agregar</a>
                        <!--end::Add customer-->
                    </div>
                    
                    <!--end::Toolbar-->
                    <!--begin::Group actions-->
                    <div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
                        <div class="fw-bolder me-5">
                        <span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected</div>
                        <button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected">Delete Selected</button>
                    </div>
                    <!--end::Group actions-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0" id="search-data-container">
                @include('dynamics/work-orders')
            </div>

            <input type="hidden" name="assign-driver-url" id="assign-driver-url" value="{{ route('work-orders.assign', ':id') }}" />
            <input type="hidden" name="work_orders_url" id="work_orders_url" value="{{ route('work-orders.index') }}" />
            <input type="hidden" name="search_url" id="search_url" value="{{ route('work-orders.search') }}" />
            <input type="hidden" name="hidden_page" id="hidden_page" value="1" />

            <form class="hidden" action="{{ route('work-orders.destroy', ':id') }}" method="post" id="frm-crud-destroy">
                @csrf
                @method('DELETE')
            </form>
            
            <div class="modal fade" tabindex="-1" id="kt_modal_1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('work-orders.assign_post') }}" name="frm-crud-add" id="frm-crud-add" method="post">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Asignar Vehículo y Chofer</h5>
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <span class="svg-icon svg-icon-2x"></span>
                                </div>
                                <!--end::Close-->
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="work_order_id" name="work_order_id" value="">
                                <div id="modal-container-data"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Asignar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" tabindex="-1" id="kt_modal_2">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('work-orders.convert', ':id') }}" name="frm-modal-convert" id="frm-modal-convert" method="post">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Deseas Procesar la Orden de Trabajo?</h5>
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <span class="svg-icon svg-icon-2x"></span>
                                </div>
                                <!--end::Close-->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Procesar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
    @section('extra_js')
    <script src="{{ asset('assets/js/jquery-confirm.min.js') }}"></script>
    <script>
    function update_data()
    {
        var query = $('#search-box').val();
        var page = $('#hidden_page').val();
        fetch_data(page, query);
    }
    function AbstractCrudAdd(){
        var url = $('#work_orders_url').val();
        window.location.replace(url);
    }
    function triggerAssigment(id){
        var url = $('#assign-driver-url').val();
        url = url.replace(':id', id);
        $.get(url, function(data, status){
            $('#modal-container-data').html('');
            $('#modal-container-data').html(data);
            $('#driver_id, #vehicle_id').select2();
        });
    }
    
    function triggerConvert(id){
        var url = $('#frm-modal-convert').attr('action');
        url = url.replace(':id', id);
        $('#frm-modal-convert').attr('action', url);
    }
    </script>
    @endsection
    
</div>
<!--end::Post-->
@endsection