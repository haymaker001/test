@extends('layouts.app')

@section('content')
<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <div class="card mb-10">
            <div class="card-body d-flex align-items-center p-5 p-lg-8">
                <!--begin::Description-->
                <div class="ms-6">
                    <h3>¡Bienvenido de Nuevo: <br> {{ mb_strtoupper(Auth::user()->name) }}!</h3>
                    <p class="list-unstyled text-gray-600 fw-bold fs-6 p-0 m-0 mt-10">Esta nueva versión de Henríquez GO trae mejoras de rendimiento, seguridad y diseño, esperamos que sea de tu agrado. Por favor selecciona la opción que deseas utilizar.</p>
                </div>
                <!--end::Description-->
                <!--begin::Icon-->
                <div class="d-flex h-50px w-50px h-lg-80px w-lg-80px flex-shrink-0 flex-center position-relative align-self-start align-self-lg-center mt-3 mt-lg-0">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs051.svg-->
                    <span class="svg-icon svg-icon-primary position-absolute opacity-15">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70px" height="70px" viewBox="0 0 70 70" fill="none" class="h-50px w-50px h-lg-80px w-lg-80px">
                            <path d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z" fill="#000000"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->

                    <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
                    <span class="svg-icon svg-icon-2x svg-icon-lg-3x svg-icon-primary position-absolute">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="black"></path>
                            <rect x="6" y="12" width="7" height="2" rx="1" fill="black"></rect>
                            <rect x="6" y="7" width="12" height="2" rx="1" fill="black"></rect>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Icon-->
            </div>
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Post-->
@endsection