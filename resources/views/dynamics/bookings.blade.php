<!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_customers_table .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="min-w-125px">No</th>
                                <th class="min-w-125px">Cliente</th>
                                <th class="min-w-125px">Fecha</th>
                                <th class="min-w-125px">Centro</th>
                                <th class="min-w-125px">Equipo</th>
                                <th class="min-w-125px">Chofer</th>
                                <th class="min-w-125px">Transporte</th>
                                <th class="text-end min-w-70px">Acciones</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600">
                            @foreach($bookings as $booking)
                            <tr id="{{ $booking->id }}" >
                                <!--begin::Checkbox-->
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <!--end::Checkbox-->
                                <!--begin::Name=-->
                                @if($booking->work_order_id != null)
                                <td>
                                    <a href="{{ route('work-orders.edit', $booking->work_order_id) }}" class="text-gray-800 text-hover-primary mb-1">{{ $booking->work_order->number }}</a>
                                </td>
                                @else
                                <td>
                                    <a href="javascript:void(0)" class="text-gray-800 text-hover-primary mb-1">HGO{{ $booking->id }}</a>
                                </td>
                                @endif
                                <td>
                                    <a href="javascript:void(0)" class="text-gray-800 text-hover-primary mb-1">{{ $booking->customer->name }}</a>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-gray-800 text-hover-primary mb-1">{{ $booking->dropoff }}</a>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-gray-800 text-hover-primary mb-1">{{ $booking->center->name ?? 'N/A' }}</a>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-gray-800 text-hover-primary mb-1">{{ $booking->vehicle->name ?? 'N/A' }}</a>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-gray-800 text-hover-primary mb-1">{{ $booking->driver->name ?? 'N/A' }}</a>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-gray-800 text-hover-primary mb-1">{{ $booking->travellers ?? 'N/A' }}</a>
                                </td>
                                <td class="text-end">

                                    <div class="d-flex justify-content-end flex-shrink-0">
                                        
                                        @if(!$booking->payed)
                                        <a href="#" class="btn btn-icon btn-bg-light btn-warning btn-sm me-1 confirm-payment" id="{{ $booking->id }}" title="Confirmar Pago" data-bs-toggle="modal" data-bs-target="#kt_modal_1" >
                                            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <i class="fas fa-file-alt"></i>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                        @else
                                        <a href="#" class="btn btn-icon btn-bg-light btn-success btn-sm me-1" title="Pago Confirmado" data-bs-toggle="modal" data-bs-target="#kt_modal_2">
                                            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <i class="fas fa-file-invoice-dollar"></i>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                        @endif
                                        
                                        <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
                                                    <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                        
                                        <a href="{{ route('bookings.pdf', $booking->id) }}" target="_blank" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 booking-pdf">
                                            <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen005.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z" fill="black"/>
                                                <rect x="7" y="17" width="6" height="2" rx="1" fill="black"/>
                                                <rect x="7" y="12" width="10" height="2" rx="1" fill="black"/>
                                                <rect x="7" y="7" width="6" height="2" rx="1" fill="black"/>
                                                <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"/>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                        @if($booking->attachment != null)
                                        <a href="{{ url('assets/media/attachments/' . $booking->attachment) }}" target="_blank" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <!--begin::Svg Icon | path: assets/media/icons/duotune/communication/com008.svg-->
                                            <span class="svg-icon svg-icon-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M4.425 20.525C2.525 18.625 2.525 15.525 4.425 13.525L14.825 3.125C16.325 1.625 18.825 1.625 20.425 3.125C20.825 3.525 20.825 4.12502 20.425 4.52502C20.025 4.92502 19.425 4.92502 19.025 4.52502C18.225 3.72502 17.025 3.72502 16.225 4.52502L5.82499 14.925C4.62499 16.125 4.62499 17.925 5.82499 19.125C7.02499 20.325 8.82501 20.325 10.025 19.125L18.425 10.725C18.825 10.325 19.425 10.325 19.825 10.725C20.225 11.125 20.225 11.725 19.825 12.125L11.425 20.525C9.525 22.425 6.425 22.425 4.425 20.525Z" fill="black"/>
                                            <path d="M9.32499 15.625C8.12499 14.425 8.12499 12.625 9.32499 11.425L14.225 6.52498C14.625 6.12498 15.225 6.12498 15.625 6.52498C16.025 6.92498 16.025 7.525 15.625 7.925L10.725 12.8249C10.325 13.2249 10.325 13.8249 10.725 14.2249C11.125 14.6249 11.725 14.6249 12.125 14.2249L19.125 7.22493C19.525 6.82493 19.725 6.425 19.725 5.925C19.725 5.325 19.525 4.825 19.125 4.425C18.725 4.025 18.725 3.42498 19.125 3.02498C19.525 2.62498 20.125 2.62498 20.525 3.02498C21.325 3.82498 21.725 4.825 21.725 5.925C21.725 6.925 21.325 7.82498 20.525 8.52498L13.525 15.525C12.325 16.725 10.525 16.725 9.32499 15.625Z" fill="black"/>
                                            </svg></span>
                                            <!--end::Svg Icon-->
                                        </a>
                                        @endif
                                        <a href="javascript:void(0)" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm destroy">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
                                                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
                                                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                    </div>

                                </td>
                                <!--end::Action=-->
                            </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                    {{ $bookings->links() }}