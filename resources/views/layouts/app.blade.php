<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Henriquez Go!</title>
        <meta charset="utf-8" />
        <meta name="description" content="." />
        <meta name="keywords" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="Henriquez GO" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta property="og:url" content="https://henriquez.com.do/" />
        <meta property="og:site_name" content="Henriquez | Henriquez GO" />
        <link rel="canonical" href="https://henriquez.com.do/" />
   
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">
        <link rel="mask-icon" href="{{ asset('safari-pinned-tab.svg') }}" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->
        <!--begin::Page Vendor Stylesheets(used by this page)-->
        <!--end::Page Vendor Stylesheets-->
        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        @yield('extra_css')
        <style>
            input:focus {
                border-width: 2px !important;
                border-style: dashed !important;
            }
        </style>
        <!--end::Global Stylesheets Bundle-->
    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-enabled aside-fixed">
        <!--begin::Main-->
        <!--begin::Root-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Page-->
            <div class="page d-flex flex-row flex-column-fluid">
                <!--begin::Aside-->
                <div id="kt_aside" class="aside aside-dark aside-hoverable"
                    data-kt-drawer="true"
                    data-kt-drawer-name="aside"
                    data-kt-drawer-activate="{default: true, lg: false}"
                    data-kt-drawer-overlay="true"
                    data-kt-drawer-width="{default:'200px', '300px': '250px'}"
                    data-kt-drawer-direction="start"
                    data-kt-drawer-toggle="#kt_aside_mobile_toggle" >
                    <!--begin::Brand-->
                    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
                        <!--begin::Logo-->
                        <a href="{{ route('home') }}">
                            <img alt="Logo" src="{{ asset('assets/media/logos/henriquez-go.svg') }}" class="logo h-40px" />
                        </a>
                        <!--end::Logo-->
                        <!--begin::Aside toggler-->
                        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
                            <span class="svg-icon svg-icon-1 rotate-180">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path
                                        opacity="0.5"
                                        d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                                        fill="black"
                                    />
                                    <path
                                        d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                                        fill="black"
                                    />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Aside toggler-->
                    </div>
                    <!--end::Brand-->
                    <!--begin::Aside menu-->
                    <div class="aside-menu flex-column-fluid">
                        <!--begin::Aside Menu-->
                        <div
                            class="hover-scroll-overlay-y my-5 my-lg-5"
                            id="kt_aside_menu_wrapper"
                            data-kt-scroll="true"
                            data-kt-scroll-activate="{default: false, lg: true}"
                            data-kt-scroll-height="auto"
                            data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
                            data-kt-scroll-wrappers="#kt_aside_menu"
                            data-kt-scroll-offset="0"
                        >
                            <!--begin::Menu-->
                            <div
                                class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                                id="#kt_aside_menu"
                                data-kt-menu="true"
                                data-kt-menu-expand="false"
                            >
                                <div class="menu-item">
                                    <a
                                        class="menu-link"
                                        href="{{ route('home') }}"
                                        title="Tablero donde se ven todas las gráficas informativas."
                                        data-bs-toggle="tooltip"
                                        data-bs-trigger="hover"
                                        data-bs-dismiss="click"
                                        data-bs-placement="right"
                                    >
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: assets/media/icons/duotune/graphs/gra010.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M13.0021 10.9128V3.01281C13.0021 2.41281 13.5021 1.91281 14.1021 2.01281C16.1021 2.21281 17.9021 3.11284 19.3021 4.61284C20.7021 6.01284 21.6021 7.91285 21.9021 9.81285C22.0021 10.4129 21.5021 10.9128 20.9021 10.9128H13.0021Z"
                                                        fill="black"
                                                    />
                                                    <path
                                                        opacity="0.3"
                                                        d="M11.0021 13.7128V4.91283C11.0021 4.31283 10.5021 3.81283 9.90208 3.91283C5.40208 4.51283 1.90209 8.41284 2.00209 13.1128C2.10209 18.0128 6.40208 22.0128 11.3021 21.9128C13.1021 21.8128 14.7021 21.3128 16.0021 20.4128C16.5021 20.1128 16.6021 19.3128 16.1021 18.9128L11.0021 13.7128Z"
                                                        fill="black"
                                                    />
                                                    <path
                                                        opacity="0.3"
                                                        d="M21.9021 14.0128C21.7021 15.6128 21.1021 17.1128 20.1021 18.4128C19.7021 18.9128 19.0021 18.9128 18.6021 18.5128L13.0021 12.9128H20.9021C21.5021 12.9128 22.0021 13.4128 21.9021 14.0128Z"
                                                        fill="black"
                                                    />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">Tablero</span>
                                    </a>
                                </div>

                                <div class="menu-item">
                                    <div class="menu-content pt-8 pb-2">
                                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">Módulos</span>
                                    </div>
                                </div>
                                @if(in_array(1, $menus))
                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">                                
                                    <span class="menu-link">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                                        fill="black"
                                                    />
                                                    <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">Usuarios</span>
                                        <span class="menu-arrow"></span>
                                    </span>
                                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                                        ma
                                        @can('Choferes')
                                        <div class="menu-item">
                                            <a class="menu-link" href="{{ route('drivers.index') }}" title="Listado de choferes registrados en el sistema." data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Choferes</span>
                                            </a>
                                        </div>
                                        @endcan
                                        @can('Clientes')
                                        <div class="menu-item">
                                            <a
                                                class="menu-link"
                                                href="{{ route('customers.index') }}"
                                                title="Listado de clientes registrados en el sistema."
                                                data-bs-toggle="tooltip"
                                                data-bs-trigger="hover"
                                                data-bs-dismiss="click"
                                                data-bs-placement="right"
                                            >
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Clientes</span>
                                            </a>
                                        </div>
                                        @endcan
                                        @can('Usuarios')
                                        <div class="menu-item">
                                            <a  class="menu-link"
                                                href="{{ route('users.index') }}"
                                                title="Listado de usuarios registrados en el sistema."
                                                data-bs-toggle="tooltip"
                                                data-bs-trigger="hover"
                                                data-bs-dismiss="click"
                                                data-bs-placement="right"
                                            >
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Usuarios</span>
                                            </a>
                                        </div>
                                        @endcan
                                    </div>
                                </div>
                                @endif
                                @if(in_array(2, $menus))
                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                    <span class="menu-link">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z" fill="black" />
                                                    <path
                                                        opacity="0.3"
                                                        d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z"
                                                        fill="black"
                                                    />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">Equipos</span>
                                        <span class="menu-arrow"></span>
                                    </span>
                                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                                        @can('Gestionar Equipos')
                                        <div class="menu-item">
                                            <a
                                                class="menu-link"
                                                href="{{ route('vehicles.index') }}"
                                                title="Listado de vehículos registrados en el sistema."
                                                data-bs-toggle="tooltip"
                                                data-bs-trigger="hover"
                                                data-bs-dismiss="click"
                                                data-bs-placement="right"
                                            >
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Gestionar Equipos</span>
                                            </a>
                                        </div>
                                        @endcan
                                        @can('Gestionar Tipo Equipos')
                                        <div class="menu-item">
                                            <a
                                                class="menu-link"
                                                href="{{ route('vehicle-types.index') }}"
                                                title="Listado de tipos de vehículos registrados en el sistema."
                                                data-bs-toggle="tooltip"
                                                data-bs-trigger="hover"
                                                data-bs-dismiss="click"
                                                data-bs-placement="right"
                                            >
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Gestionar Tipo Equipos</span>
                                            </a>
                                        </div>
                                        @endcan
                                        @can('Gestionar Grupo de Equipos')
                                        <div class="menu-item">
                                            <a
                                                class="menu-link"
                                                href="{{ route('vehicle-groups.index') }}"
                                                title="Listado de tipos de vehículos registrados en el sistema."
                                                data-bs-toggle="tooltip"
                                                data-bs-trigger="hover"
                                                data-bs-dismiss="click"
                                                data-bs-placement="right"
                                            >
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Gestionar Grupo de Equipos</span>
                                            </a>
                                        </div>
                                        @endcan
                                    </div>
                                </div>
                                
                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                    <span class="menu-link">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z" fill="black" />
                                                    <path
                                                        opacity="0.3"
                                                        d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z"
                                                        fill="black"
                                                    />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">Ordenes de Trabajo</span>
                                        <span class="menu-arrow"></span>
                                    </span>
                                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                                        @can('Gestionar Tipo Equipos')
                                        <div class="menu-item">
                                            <a  class="menu-link"
                                                href="{{ route('work-orders.create') }}"
                                                title="Permite crear una nueva orden de trabajo."
                                                data-bs-toggle="tooltip"
                                                data-bs-trigger="hover"
                                                data-bs-dismiss="click"
                                                data-bs-placement="right">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Nueva Orden </span>
                                            </a>
                                        </div>
                                        @endcan
                                        @can('Gestionar Equipos')
                                        <div class="menu-item">
                                            <a
                                                class="menu-link"
                                                href="{{ route('work-orders.index') }}"
                                                title="Listado de Ordenes de trabajo en el sistema."
                                                data-bs-toggle="tooltip"
                                                data-bs-trigger="hover"
                                                data-bs-dismiss="click"
                                                data-bs-placement="right"
                                            >
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Gestionar Ordenes</span>
                                            </a>
                                        </div>
                                        @endcan
                                    </div>
                                </div>
                                @endif
                                
                                @if(in_array(3, $menus))
                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                    <span class="menu-link">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/technology/teh004.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                                        fill="black"
                                                    />
                                                    <path
                                                        opacity="0.3"
                                                        d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                                        fill="black"
                                                    />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">Conduces</span>
                                        <span class="menu-arrow"></span>
                                    </span>
                                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                                        @can('Nuevo Conduce')
                                        <div class="menu-item">
                                            <a class="menu-link" href="{{ route('bookings.create') }}" title="Permite agregar un nuevo conduce de despacho al sistema." data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Nuevo Conduce</span>
                                            </a>
                                        </div>
                                        @endcan
                                        @can('Gestionar Conduces')
                                        <div class="menu-item">
                                            <a class="menu-link" href="{{ route('bookings.index') }}" title="Listado de conduce agregados al sistema." data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Gestionar Conduces</span>
                                            </a>
                                        </div>
                                        @endcan
                                        @can('Informe de Conduces')
                                        <div class="menu-item">
                                            <a class="menu-link" href="{{ route('reports.booking') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Informe de Conduces</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link" href="{{ route('reports.profit') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Informe de Beneficios</span>
                                            </a>
                                        </div>
                                        @endcan
                                        @can('Informe de Facturación')
                                        <div class="menu-item">
                                            <a class="menu-link" href="{{ route('reports.billing') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Informe de Facturación</span>
                                            </a>
                                        </div>
                                        @endcan
                                        @can('Informe de Paradas')
                                        <div class="menu-item">
                                            <a class="menu-link" href="{{ route('reports.travel') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Informe de Paradas</span>
                                            </a>
                                        </div>
                                        @endcan
                                        <div class="menu-item">
                                            <a class="menu-link" href="{{ route('reports.booking-confirmation') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Informe Confirmación Pago Viajes</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link" href="{{ route('reports.weekly') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Informe Viajes Semanal</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(in_array(4, $menus))
                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                    <span class="menu-link">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/art/art007.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        opacity="0.3"
                                                        d="M20.859 12.596L17.736 13.596L10.388 20.944C10.2915 21.0406 10.1769 21.1172 10.0508 21.1695C9.9247 21.2218 9.78953 21.2486 9.65302 21.2486C9.5165 21.2486 9.3813 21.2218 9.25519 21.1695C9.12907 21.1172 9.01449 21.0406 8.918 20.944L2.29999 14.3229C2.10543 14.1278 1.99619 13.8635 1.99619 13.588C1.99619 13.3124 2.10543 13.0481 2.29999 12.853L11.853 3.29999C11.9495 3.20341 12.0641 3.12679 12.1902 3.07452C12.3163 3.02225 12.4515 2.9953 12.588 2.9953C12.7245 2.9953 12.8597 3.02225 12.9858 3.07452C13.1119 3.12679 13.2265 3.20341 13.323 3.29999L21.199 11.176C21.3036 11.2791 21.3797 11.4075 21.4201 11.5486C21.4605 11.6898 21.4637 11.8391 21.4295 11.9819C21.3953 12.1247 21.3249 12.2562 21.2249 12.3638C21.125 12.4714 20.9989 12.5514 20.859 12.596Z"
                                                        fill="black"
                                                    />
                                                    <path
                                                        d="M14.8 10.184C14.7447 10.1843 14.6895 10.1796 14.635 10.1699L5.816 8.69997C5.55436 8.65634 5.32077 8.51055 5.16661 8.29469C5.01246 8.07884 4.95035 7.8106 4.99397 7.54897C5.0376 7.28733 5.18339 7.05371 5.39925 6.89955C5.6151 6.7454 5.88334 6.68332 6.14498 6.72694L14.963 8.19692C15.2112 8.23733 15.435 8.36982 15.59 8.56789C15.7449 8.76596 15.8195 9.01502 15.7989 9.26564C15.7784 9.51626 15.6642 9.75001 15.479 9.92018C15.2939 10.0904 15.0514 10.1846 14.8 10.184ZM17 18.6229C17 19.0281 17.0985 19.4272 17.287 19.7859C17.4755 20.1446 17.7484 20.4521 18.0821 20.6819C18.4158 20.9117 18.8004 21.0571 19.2027 21.1052C19.605 21.1534 20.0131 21.103 20.3916 20.9585C20.7702 20.814 21.1079 20.5797 21.3758 20.2757C21.6437 19.9716 21.8336 19.607 21.9293 19.2133C22.025 18.8195 22.0235 18.4085 21.925 18.0154C21.8266 17.6223 21.634 17.259 21.364 16.9569L19.843 15.257C19.7999 15.2085 19.7471 15.1697 19.688 15.1432C19.6289 15.1167 19.5648 15.1029 19.5 15.1029C19.4352 15.1029 19.3711 15.1167 19.312 15.1432C19.2529 15.1697 19.2001 15.2085 19.157 15.257L17.636 16.9569C17.2254 17.4146 16.9988 18.0081 17 18.6229ZM10.388 20.9409L17.736 13.5929H1.99999C1.99921 13.7291 2.02532 13.8643 2.0768 13.9904C2.12828 14.1165 2.2041 14.2311 2.29997 14.3279L8.91399 20.9409C9.01055 21.0381 9.12539 21.1152 9.25188 21.1679C9.37836 21.2205 9.51399 21.2476 9.65099 21.2476C9.78798 21.2476 9.92361 21.2205 10.0501 21.1679C10.1766 21.1152 10.2914 21.0381 10.388 20.9409Z"
                                                        fill="black"
                                                    />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">Combustible</span>
                                        <span class="menu-arrow"></span>
                                    </span>
                                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                                        @can('Centro de Abastecimiento')
                                        <div class="menu-item">
                                            <a
                                                class="menu-link"
                                                href="{{ route('supply-centers.index') }}"
                                                title="Listado de centros de Abastecimiento de vehículos agregados al sistema."
                                                data-bs-toggle="tooltip"
                                                data-bs-trigger="hover"
                                                data-bs-dismiss="click"
                                                data-bs-placement="right"
                                            >
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Centro de Abastecimiento</span>
                                            </a>
                                        </div>
                                        @endcan
                                        @can('Registro de Combustible.')
                                        <div class="menu-item">
                                            <a
                                                class="menu-link"
                                                href="{{ route('fuel-consumptions.index') }}"
                                                title="Permite registrar el consumo de combustible que ha tenido un vehículo o equipo especifico del sistema."
                                                data-bs-toggle="tooltip"
                                                data-bs-trigger="hover"
                                                data-bs-dismiss="click"
                                                data-bs-placement="right"
                                            >
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Registro de Combustible.</span>
                                            </a>
                                        </div>
                                        @endcan
                                        @can('Informe de combustible')
                                        <div class="menu-item">
                                            <a class="menu-link" href="{{ route('reports.consumptions') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Informe de combustible</span>
                                            </a>
                                        </div>
                                        
                                        @endcan
                                        
                                    </div>
                                </div>
                                @endif
                                
                                @if(in_array(7, $menus))
                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                    <span class="menu-link">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/art/art007.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M3 13H10C10.6 13 11 13.4 11 14V21C11 21.6 10.6 22 10 22H3C2.4 22 2 21.6 2 21V14C2 13.4 2.4 13 3 13Z" fill="black" />
                                                    <path d="M7 16H6C5.4 16 5 15.6 5 15V13H8V15C8 15.6 7.6 16 7 16Z" fill="black" />
                                                    <path opacity="0.3" d="M14 13H21C21.6 13 22 13.4 22 14V21C22 21.6 21.6 22 21 22H14C13.4 22 13 21.6 13 21V14C13 13.4 13.4 13 14 13Z" fill="black" />
                                                    <path d="M18 16H17C16.4 16 16 15.6 16 15V13H19V15C19 15.6 18.6 16 18 16Z" fill="black" />
                                                    <path opacity="0.3" d="M3 2H10C10.6 2 11 2.4 11 3V10C11 10.6 10.6 11 10 11H3C2.4 11 2 10.6 2 10V3C2 2.4 2.4 2 3 2Z" fill="black" />
                                                    <path d="M7 5H6C5.4 5 5 4.6 5 4V2H8V4C8 4.6 7.6 5 7 5Z" fill="black" />
                                                    <path opacity="0.3" d="M14 2H21C21.6 2 22 2.4 22 3V10C22 10.6 21.6 11 21 11H14C13.4 11 13 10.6 13 10V3C13 2.4 13.4 2 14 2Z" fill="black" />
                                                    <path d="M18 5H17C16.4 5 16 4.6 16 4V2H19V4C19 4.6 18.6 5 18 5Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">Mantenimiento</span>
                                        <span class="menu-arrow"></span>
                                    </span>
                                    @can('Inventario')
                                    <div class="menu-sub menu-sub-accordion menu-active-bg">
										<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
											<span class="menu-link">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Inventario</span>
												<span class="menu-arrow"></span>
											</span>
											<div class="menu-sub menu-sub-accordion menu-active-bg">
											    <div class="menu-item">
													<a  class="menu-link"
                                                        href="{{ route('suppliers.index') }}"
                                                        title="Listado de suplidores de los productos de inventario."
                                                        data-bs-toggle="tooltip"
                                                        data-bs-trigger="hover"
                                                        data-bs-dismiss="click"
                                                        data-bs-placement="right">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Listado de Suplidores</span>
													</a>
												</div>
												<div class="menu-item">
													<a  class="menu-link"
                                                        href="{{ route('warehouses.index') }}"
                                                        title="Listado de ubicaciones de los productos de inventario."
                                                        data-bs-toggle="tooltip"
                                                        data-bs-trigger="hover"
                                                        data-bs-dismiss="click"
                                                        data-bs-placement="right">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Listado de Ubicaciones</span>
													</a>
												</div>
												
												<div class="menu-item">
													<a  class="menu-link"
                                                        href="{{ route('item-definitions.index') }}"
                                                        title="Listado de items de inventario agregados al sistema"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-trigger="hover"
                                                        data-bs-dismiss="click"
                                                        data-bs-placement="right">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Listado de Productos</span>
													</a>
												</div>
												
												<div class="menu-item">
													<a  class="menu-link"
                                                        href=""
                                                        title="Listado de Tecnicos de inventario"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-trigger="hover"
                                                        data-bs-dismiss="click"
                                                        data-bs-placement="right">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Listado de Tecnicos</span>
													</a>
												</div>
												
												<div class="menu-item">
													<a  class="menu-link"
                                                        href="{{ route('inventories.index') }}"
                                                        title="Listado de productos en inventario"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-trigger="hover"
                                                        data-bs-dismiss="click"
                                                        data-bs-placement="right">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Productos de Inventario</span>
													</a>
												</div>
												<div class="menu-item">
                                                    <a
                                                        class="menu-link"
                                                        href="{{ route('inventories-in.index') }}"
                                                        title="Permite registrar una entrada de inventario al sistema"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-trigger="hover"
                                                        data-bs-dismiss="click"
                                                        data-bs-placement="right"
                                                    >
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title">Inventario - Entradas</span>
                                                    </a>
                                                </div>
                                                <div class="menu-item">
                                                    <a
                                                        class="menu-link"
                                                        href="{{ route('inventories-out.index') }}"
                                                        title="Permite registrar una salida de inventario en el sistema"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-trigger="hover"
                                                        data-bs-dismiss="click"
                                                        data-bs-placement="right"
                                                    >
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title">Inventario - Salidas</span>
                                                    </a>
                                                </div>
												
												
												<div class="menu-item">
													<a  class="menu-link"
                                                        href="{{ route('reports.inventories') }}"
                                                        title="Permite registrar una salida de inventario en el sistema"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-trigger="hover"
                                                        data-bs-dismiss="click"
                                                        data-bs-placement="right">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Informe de Inventario</span>
													</a>
												</div>
											</div>
										</div>
									</div>
									@endcan
									<div class="menu-sub menu-sub-accordion menu-active-bg">
										<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
											<span class="menu-link">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Seguridad Ocupacional</span>
												<span class="menu-arrow"></span>
											</span>
											<div class="menu-sub menu-sub-accordion menu-active-bg">
											    <div class="menu-item">
													<a  class="menu-link"
                                                        href="{{ route('event-types.index') }}"
                                                        title="Creación de nueva inspección vehicular."
                                                        data-bs-toggle="tooltip"
                                                        data-bs-trigger="hover"
                                                        data-bs-dismiss="click"
                                                        data-bs-placement="right">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Tipos de Evento </span>
													</a>
												</div>
												<div class="menu-item">
													<a  class="menu-link"
                                                        href="{{ route('security-notifications.index') }}"
                                                        title="Listado de Incidencias vehiculares."
                                                        data-bs-toggle="tooltip"
                                                        data-bs-trigger="hover"
                                                        data-bs-dismiss="click"
                                                        data-bs-placement="right">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Listado de Incidencias</span>
													</a>
												</div>
											</div>
										</div>
									</div>
                                </div>
                                @endif
                                
                                @if(in_array(5, $menus))
                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                    <span class="menu-link">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z"
                                                        fill="black"
                                                    />
                                                    <path
                                                        d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z"
                                                        fill="black"
                                                    />
                                                    <path
                                                        opacity="0.3"
                                                        d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z"
                                                        fill="black"
                                                    />
                                                    <path
                                                        opacity="0.3"
                                                        d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z"
                                                        fill="black"
                                                    />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">Tarífas</span>
                                        <span class="menu-arrow"></span>
                                    </span>
                                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                                        @can('Nueva Tarífa')
                                        <div class="menu-item">
                                            <a class="menu-link" href="{{ route('rates.create') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Nueva Tarífa</span>
                                            </a>
                                        </div>
                                        @endcan
                                        @can('Gestionar Tarífas')
                                        <div class="menu-item">
                                            <a class="menu-link" href="{{ route('rates.index') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Gestionar Tarífas</span>
                                            </a>
                                        </div>
                                        @endcan
                                    </div>
                                </div>
                                @endif
                                @if(in_array(6, $menus))
                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion mb-1">
                                    <span class="menu-link">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/graphs/gra006.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        opacity="0.3"
                                                        d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z"
                                                        fill="black"
                                                    />
                                                    <path
                                                        d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z"
                                                        fill="black"
                                                    />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">Configuración</span>
                                        <span class="menu-arrow"></span>
                                    </span>
                                    <div class="menu-sub menu-sub-accordion">
                                        <div class="menu-item">
                                            <a class="menu-link" href="{{ route('settings') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Generales</span>
                                            </a>
                                        </div>
                                        @can('Centros')
                                        <div class="menu-item">
                                            <a class="menu-link" href="{{ route('centers.index') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Centros</span>
                                            </a>
                                        </div>
                                        @endcan
                                        @can('Localidades')
                                        <div class="menu-item">
                                            <a class="menu-link" href="{{ route('locations.index') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Localidades</span>
                                            </a>
                                        </div>
                                        @endcan
                                        @can('Posiciones')
                                        <div class="menu-item">
                                            <a class="menu-link" href="{{ route('positions.index') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Posiciones</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link" href="{{ route('subcontractors.index') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Sub Contratistas</span>
                                            </a>
                                        </div>
                                        @endcan
                                        @can('Roles')
                                        <div class="menu-item">
                                            <a class="menu-link" href="{{ route('roles.index') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Roles</span>
                                            </a>
                                        </div>
                                        @endcan
                                    </div>
                                </div>
                                @endif
                                <div class="menu-item">
                                    <div class="menu-content">
                                        <div class="separator mx-1 my-4"></div>
                                    </div>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" href="">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M16.95 18.9688C16.75 18.9688 16.55 18.8688 16.35 18.7688C15.85 18.4688 15.75 17.8688 16.05 17.3688L19.65 11.9688L16.05 6.56876C15.75 6.06876 15.85 5.46873 16.35 5.16873C16.85 4.86873 17.45 4.96878 17.75 5.46878L21.75 11.4688C21.95 11.7688 21.95 12.2688 21.75 12.5688L17.75 18.5688C17.55 18.7688 17.25 18.9688 16.95 18.9688ZM7.55001 18.7688C8.05001 18.4688 8.15 17.8688 7.85 17.3688L4.25001 11.9688L7.85 6.56876C8.15 6.06876 8.05001 5.46873 7.55001 5.16873C7.05001 4.86873 6.45 4.96878 6.15 5.46878L2.15 11.4688C1.95 11.7688 1.95 12.2688 2.15 12.5688L6.15 18.5688C6.35 18.8688 6.65 18.9688 6.95 18.9688C7.15 18.9688 7.35001 18.8688 7.55001 18.7688Z"
                                                        fill="black"
                                                    />
                                                    <path
                                                        opacity="0.3"
                                                        d="M10.45 18.9687C10.35 18.9687 10.25 18.9687 10.25 18.9687C9.75 18.8687 9.35 18.2688 9.55 17.7688L12.55 5.76878C12.65 5.26878 13.25 4.8687 13.75 5.0687C14.25 5.1687 14.65 5.76878 14.45 6.26878L11.45 18.2688C11.35 18.6688 10.85 18.9687 10.45 18.9687Z"
                                                        fill="black"
                                                    />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">Changelog 1.0.2</span>
                                    </a>
                                </div>
                            </div>
                            <!--end::Menu-->
                        </div>
                        <!--end::Aside Menu-->
                    </div>
                    <!--end::Aside menu-->
                    <!--begin::Footer-->
                    <div class="aside-footer flex-column-auto pt-5 pb-7 px-5" id="kt_aside_footer">
                        <a href="{{ url('/') }}" class="btn btn-custom btn-primary w-100" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" title="Documentación necesaria para comprender el uso básico del sistema.">
                            <span class="btn-label">Documentación</span>
                            <!--begin::Svg Icon | path: icons/duotune/general/gen005.svg-->
                            <span class="svg-icon btn-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path
                                        opacity="0.3"
                                        d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z"
                                        fill="black"
                                    />
                                    <rect x="7" y="17" width="6" height="2" rx="1" fill="black" />
                                    <rect x="7" y="12" width="10" height="2" rx="1" fill="black" />
                                    <rect x="7" y="7" width="6" height="2" rx="1" fill="black" />
                                    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </a>
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end::Aside-->
                <!--begin::Wrapper-->
                <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                    <!--begin::Header-->
                    <div id="kt_header" style="" class="header align-items-stretch">
                        <!--begin::Container-->
                        <div class="container-fluid d-flex align-items-stretch justify-content-between">
                            <!--begin::Aside mobile toggle-->
                            <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
                                <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                                    <span class="svg-icon svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
                                            <path
                                                opacity="0.3"
                                                d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                                fill="black"
                                            />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                            </div>
                            <!--end::Aside mobile toggle-->
                            <!--begin::Mobile logo-->
                            <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                                <a href="{{ route('home') }}" class="d-lg-none">
                                    <img alt="Logo" src="{{ asset('assets/media/logos/icono.svg') }}" class="h-30px" />
                                </a>
                            </div>
                            <!--end::Mobile logo-->
                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                                <!--begin::Navbar-->
                                <div class="d-flex align-items-center" id="kt_header_nav">
                                    <!--begin::Page title-->
                                    <div
                                        data-kt-swapper="true"
                                        data-kt-swapper-mode="prepend"
                                        data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_header_nav'}"
                                        class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0"
                                    ></div>
                                    <!--end::Page title-->
                                </div>
                                <!--end::Navbar-->
                                <!--begin::Toolbar wrapper-->
                                <div class="d-flex align-items-stretch flex-shrink-0">
                                    <!--begin::User menu-->
                                    <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                                        <!--begin::Menu wrapper-->
                                        <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                            <img src="{{ asset('assets/media/avatars/300-1.png') }}" alt="user" />
                                        </div>
                                        <!--begin::User account menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content d-flex align-items-center px-3">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-50px me-5">
                                                        <img alt="Logo" src="{{ asset('assets/media/avatars/300-1.png') }}" />
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::Username-->
                                                    @guest
                                                    <div class="d-flex flex-column">
                                                        <div class="fw-bolder d-flex align-items-center fs-5">Guest</div>
                                                        <a href="#" class="fw-bold text-muted text-hover-primary fs-7">N/A</a>
                                                    </div>
                                                    @else
                                                    <div class="d-flex flex-column">
                                                        <div class="fw-bolder d-flex align-items-center fs-5">{{ Auth::user()->name }}</div>
                                                        <a href="#" class="fw-bold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
                                                    </div>
                                                    @endguest
                                                    <!--end::Username-->
                                                </div>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator my-2"></div>
                                            <!--end::Menu separator-->
                                            @if(1 != 1)
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-5">
                                                <a href="javascript:void(0)" class="menu-link px-5">Mi Perfil</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-5">
                                                <a href="javascript:void(0)" class="menu-link px-5">
                                                    <span class="menu-text">Notificaciones</span>
                                                    <span class="menu-badge">
                                                        <span class="badge badge-light-danger badge-circle fw-bolder fs-7">3</span>
                                                    </span>
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator my-2"></div>
                                            <!--end::Menu separator-->
                                            @endif
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-5">
                                                <a
                                                    href="{{ route('logout') }}"
                                                    class="menu-link px-5"
                                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                                >
                                                    Cerrar Sesión
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                        <!--end::User account menu-->
                                        <!--end::Menu wrapper-->
                                    </div>
                                    <!--end::User menu-->
                                    <!--begin::Header menu toggle-->
                                    <!--end::Header menu toggle-->
                                </div>
                                <!--end::Toolbar wrapper-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Content-->
                    @yield('toolbar')
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        @yield('content')
                    </div>
                    <!--end::Content-->
                    <!--begin::Footer-->
                    <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                        <!--begin::Container-->
                        <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <!--begin::Copyright-->
                            <div class="text-dark order-2 order-md-1">
                                <span class="text-muted fw-bold me-1">2017-2022 Powered by: </span>
                                <a href="https://onertech.net/" target="_blank" class="text-gray-800 text-hover-primary">Onertech.net</a>
                            </div>
                            <!--end::Copyright-->
                            <!--begin::Menu-->
                            <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
                                <li class="menu-item">
                                    <a href="{{ url('/') }}" target="_blank" class="menu-link px-2">Versión 1.0.2</a>
                                </li>
                            </ul>
                            <!--end::Menu-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
        <!--end::Root-->
        <!--begin::Drawers-->
        <!--begin::Scrolltop-->
        <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
            <span class="svg-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
                    <path
                        d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                        fill="black"
                    />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Scrolltop-->
        <!--begin::Javascript-->
        <!--begin::Global Javascript Bundle(used by all pages)-->
        <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
        <!--end::Global Javascript Bundle-->
        <!--begin::Page Vendors Javascript(used by this page)-->
        <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <!--end::Page Vendors Javascript-->
        <!--begin::Page Custom Javascript(used by this page)-->
        <script src="../../assets/js/custom/apps/ecommerce/settings/settings.js"></script>
        <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
        <script src="{{ asset('assets/js/custom/intro.js') }}"></script>
        <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
        <script src="{{ asset('assets/js/notify.min.js') }}"></script>
        @yield('extra_js')
        <!--end::Page Custom Javascript-->
        <script type="text/javascript">

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });          

            $(".datetime").flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });

            $(".date").flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d",
            });

            Inputmask({
                "mask" : "999-9999999-9"
            }).mask(".identification");

            $(document).on('click', 'a.page-link', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                var query = $('#search-box').val();
                fetch_data(page, query);
            });

            $(document).on('keyup', '#search-box', function(){
                var query = $('#search-box').val();
                var page = $('#hidden_page').val();
                fetch_data(1, query);
            });

            function fetch_data(page, query)
            {
                var searchUrl = $('#search_url').val();
                var sort_by   = $('#sort_by').val() || "";
                var sort_type = $('#sort_type').val() || "";
                var full_url = searchUrl + "?page="+page+"&query="+query+"&sort_by="+sort_by+"&sort_type="+sort_type;
                
                console.log(full_url);
                
                $.ajax({
                    url: full_url,
                    success:function(data)
                    {
                        $('#search-data-container').html('');
                        $('#search-data-container').html(data);
                    }
                });
            }
            
            $('#frm-modal-crud-add').on('submit', function(e){
                e.preventDefault();
                var form = $('#frm-modal-crud-add');
                var url     = form.attr('action');
                var data = new FormData(this);

                $.ajax({
                    url: url,
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: form.attr('method'),
                    success: function(response)
                    {
                        $('#frm-modal-crud-add')[0].reset();
                        show_success_message('Operación realizada exitosamente!');
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        show_errors_message(jqXHR);
                    }
                });
            });

            $('#frm-crud-add').on('submit', function(e){
                e.preventDefault();
                var form = $('#frm-crud-add');
                var url     = form.attr('action');
                var data = new FormData(this);

                $.ajax({
                    url: url,
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: form.attr('method'),
                    success: function(response)
                    {
                        $('#frm-crud-add')[0].reset();
                        show_success_message('Registro creado exitosamente!');
                        if (typeof AbstractCrudAdd == 'function') {
                            AbstractCrudAdd(); 
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        show_errors_message(jqXHR);
                    }
                });
            });

            $('#frm-crud-update').on('submit', function(e){
                e.preventDefault();
                var form = $('#frm-crud-update');
                var url     = form.attr('action');
                var data = new FormData(this);

                $.ajax({
                    url: url,
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: form.attr('method'),
                    success: function(response)
                    {
                        show_success_message('Registro editado exitosamente!');
                        if (typeof AbstractCrudUpdate == 'function') {
                            AbstractCrudUpdate(); 
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        show_errors_message(jqXHR);
                    }
                });
            });

            $(document).on('click', 'a.destroy', function(e){
                var id = $(this).closest('tr').attr('id');
                e.preventDefault();

                var form = $('#frm-crud-destroy');
                var url     = form.attr('action');
                url = url.replace(':id', id);
                var data = form.serialize();

                Swal.fire({
                    title: 'Seguro que desea borrar el registro?',
                    text: "No podrás revertir esta operación!",
                    icon: 'danger',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Eliminar!'
                }).then((result) => {

                    if (result.isConfirmed) {
                        $.post(url, data, function(response){
                            $('tr#' + id).hide('slow');
                            show_success_message('Registro eliminado exitosamente!');
                        }).fail(function(jqXHR, textStatus, errorThrown){
                            show_errors_message(jqXHR);
                        });
                    }
                });
            });

            function show_loading()
            {
                swal({
                    title: 'Cargando data, por favor espere...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    timer: 2000,
                    onOpen: () => {
                        swal.showLoading();
                    }
                });
            }

            function show_success_message(message)
            {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toastr-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.success(message);
            }

            function show_error_message(message)
            {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toastr-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error(message);
            }

            function show_errors_message(data)
            {
                var errors = '';
                
                console.log(data);
                
                if(!data.responseJSON.errors)
                    errors += '* ' + data.responseJSON.message + '</br>';
                
                $.each(data.responseJSON.errors, function(key, value) {
                    errors += '* ' + value + '</br>';
                });

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toastr-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error(errors);
            }
        </script>
        <!--end::Javascript-->
    </body>
    <!--end::Body-->
</html>