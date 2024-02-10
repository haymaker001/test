@extends('layouts.app')

    @section('toolbar')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Informe de Paradas</h1>
            <!--end::Title-->
            <!--begin::Separator-->
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <!--end::Separator-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Reportes</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-300 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-dark">Informe de Paradas</li>
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
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
    @endsection

@section('content')
<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->



    <div id="kt_content_container" class="container-xxl">

        <form action="{{ route('reports.travel') }}" method="POST">
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
                            <input type="text" class="form-control mb-2 date" name="from" id="from" value="{{ $from }}" />
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
                            <input type="text" class="form-control mb-2 date" name="to" id="to" value="{{ $to }}" />
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
                                <option value="">N/A</option>
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
                                <option value="{{ $center->id }}" @if($center_select == $center->id) selected="" @endif  >{{ $center->name }}</option>
                                @endforeach
                            </select>
                            <!--end::Select2-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Nombre del centro.</div>
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

        <!--begin::Card-->
        <div class="card">
            <!--begin::Card body-->
            <div class="card-body pt-0" id="search-data-container">
                <div class="card card-p-0 card-flush">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
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
                                <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Buscar" />
                            </div>
                            <!--end::Search-->
                            <!--begin::Export buttons-->
                            <div id="kt_datatable_example_1_export" class="d-none"></div>
                            <!--end::Export buttons-->
                        </div>
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <!--begin::Export dropdown-->
                            <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                Exportar Reporte
                            </button>
                            <!--begin::Menu-->
                            <div id="kt_datatable_example_1_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-export="copy">
                                        Copiar al portapapeles
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-export="excel">
                                        Exportar como Excel
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-export="csv">
                                        Exportar como CSV
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-export="pdf">
                                        Exportar como PDF
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                            <!--end::Export dropdown-->
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example_1">
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase">
                                    <th >Localidad</th>
                                    <th >Cantidad de Paradas</th>
                                    <th >Montos</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <tbody class="fw-bold text-gray-600">
                                @foreach($locations as $location)
                                <tr class="odd">
                                    <td>{{ $location->location ?? 'N/A' }}</td>
                                    <td>{{ $location->counter }}</td>
                                    <td>{{ number_format($location->amount, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
    @section('extra_js')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        "use strict";

        var to = $('#to').val();
        var from = $('#from').val();

        // Class definition
        var KTDatatablesButtons = function () {
            // Shared variables
            var table;
            var datatable;

            // Private functions
            var initDatatable = function () {
                // Set date data order
                const tableRows = table.querySelectorAll('tbody tr');

                /*tableRows.forEach(row => {
                    const dateRow = row.querySelectorAll('td');
                    const realDate = moment(dateRow[3].innerHTML, "DD MMM YYYY, LT").format(); // select date from 4th column in table
                    dateRow[3].setAttribute('data-order', realDate);
                });*/

                // Init datatable --- more info on datatables: https://datatables.net/manual/
                datatable = $(table).DataTable({
                    "info": false,
                    'order': [[ 1, "asc" ]],
                    'pageLength': 10,
                    responsive: true,
                });
            }

            // Hook export buttons
            var exportButtons = () => {
                const documentTitle = 'Informe de Paradas - Periodo Desde: ' + from + ' Hasta: ' + to;
                var buttons = new $.fn.dataTable.Buttons(table, {
                    buttons: [
                        {
                            extend: 'copyHtml5',
                            title: documentTitle
                        },
                        {
                            extend: 'excelHtml5',
                            title: documentTitle
                        },
                        {
                            extend: 'csvHtml5',
                            title: documentTitle
                        },
                        {
                            extend: 'pdfHtml5',
                            title: documentTitle
                        }
                    ]
                }).container().appendTo($('#kt_datatable_example_1_export'));

                // Hook dropdown menu click event to datatable export buttons
                const exportButtons = document.querySelectorAll('#kt_datatable_example_1_export_menu [data-kt-export]');
                exportButtons.forEach(exportButton => {
                    exportButton.addEventListener('click', e => {
                        e.preventDefault();

                        // Get clicked export value
                        const exportValue = e.target.getAttribute('data-kt-export');
                        const target = document.querySelector('.dt-buttons .buttons-' + exportValue);

                        // Trigger click event on hidden datatable export buttons
                        target.click();
                    });
                });
            }

            // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
            var handleSearchDatatable = () => {
                const filterSearch = document.querySelector('[data-kt-filter="search"]');
                filterSearch.addEventListener('keyup', function (e) {
                    datatable.search(e.target.value).draw();
                });
            }

            // Public methods
            return {
                init: function () {
                    table = document.querySelector('#kt_datatable_example_1');

                    if ( !table ) {
                        return;
                    }

                    initDatatable();
                    exportButtons();
                    handleSearchDatatable();
                }
            };
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTDatatablesButtons.init();
        });
    </script>
    @endsection
<!--end::Post-->
@endsection