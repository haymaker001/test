<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Controllers\{
	UserController,
	MailController,
	RateController,
	RoleController,
	HomeController,
	DriverController,
	CenterController,
	ReportController,
	SectionController,
	SupplierController,
	FleetioController,
	BookingController,
	VehicleController,
	CustomerController,
	LocationController,
	PositionController,
	EventTypeController,
	WorkOrderController,
	InventoryController,
	WarehouseController,
	TravelTypeController,
	VehicleTypeController,
	InspectionController,
	SubcontractorController,
	InventoryInController,
	InventoryOutController,
	VehicleGroupController,
	SupplyCenterController,
	ItemDefinitionController,
	FuelConsumptionController,
	SecurityNotificationController,
};

Route::get('/demo', [HomeController::class, 'demo'])->name('demo');
Route::get('/rec', [HomeController::class, 'rec'])->name('rec');

Route::get('/token', [HomeController::class, 'get_token'])->name('token');

Route::get('/fleetio_service_reminders', [FleetioController::class, 'get_service_reminders'])->name('get_service_reminders');
Route::get('/fleetio_vehicles', [FleetioController::class, 'get_vehicles'])->name('get_vehicles');

Route::group(['middleware' => 'auth'], function (){
	
	Route::get('/pdf', [ReportController::class, 'pdf'])->name('pdf');
	Route::get('/settings', [HomeController::class, 'settings'])->name('settings');
	
	Route::get('/', [HomeController::class, 'index'])->name('home');
	Route::get('/home', [HomeController::class, 'index'])->name('home');
	Route::get('/charts/{id}', [HomeController::class, 'charts'])->name('charts');
	Route::get('/mails/{id}', [MailController::class, 'index'])->name('mails');
	
	Route::get('/security-notifications-search/', [SecurityNotificationController::class, 'search'])->name('security-notifications.search');
	Route::resource('/security-notifications', SecurityNotificationController::class);
	
	Route::get('/inspections-search/', [InspectionController::class, 'search'])->name('inspections.search');
	Route::resource('/inspections', InspectionController::class);
	
	Route::get('/event-types-search/', [EventTypeController::class, 'search'])->name('event-types.search');
	Route::resource('/event-types', EventTypeController::class);
	
	Route::get('/warehouses-search/', [WarehouseController::class, 'search'])->name('warehouses.search');
	Route::get('/warehouses-sections/{id}', [WarehouseController::class, 'sections'])->name('warehouses.sections');
	Route::get("/warehouses-item-definitions/{item_definition}", [WarehouseController::class, 'locations'])->name("warehouses.locations");
	Route::resource('/warehouses', WarehouseController::class); 
	
	Route::get('/item-definitions-warehouses/{id}', [ItemDefinitionController::class, 'warehouses'])->name('item-definitions.warehouses');
	Route::get('/item-definitions-search/', [ItemDefinitionController::class, 'search'])->name('item-definitions.search');
	Route::resource('/item-definitions', ItemDefinitionController::class);
	
	Route::resource('/sections', SectionController::class);
	
	Route::get('/inventories-in-pdf/{inventories_in}', [InventoryInController::class, 'pdf'])->name('inventories-in.pdf');
	Route::get('/inventories-in-search/', [InventoryInController::class, 'search'])->name('inventories-in.search');
	Route::resource('/inventories-in', InventoryInController::class);
	
	Route::get('/inventories-out-pdf/{inventories_out}', [InventoryOutController::class, 'pdf'])->name('inventories-out.pdf');
	Route::get('/inventories-out-search/', [InventoryOutController::class, 'search'])->name('inventories-out.search');
	Route::get('/inventories-out-items', [InventoryOutController::class, 'get_inventory_items']);
	Route::resource('/inventories-out', InventoryOutController::class);
	
	Route::get('/inventories-excel/', [ReportController::class, 'inventories_excel'])->name('inventories.excel');
	Route::get('/inventories-search/', [InventoryController::class, 'search'])->name('inventories.search');
	Route::resource('/inventories', InventoryController::class);
	
	Route::get('/suppliers-search/', [SupplierController::class, 'search'])->name('suppliers.search');
	Route::resource('/suppliers', SupplierController::class);

    Route::get('/rates-excel/', [ReportController::class, 'rates_excel'])->name('rates.excel');
	Route::get('/rates-search/', [RateController::class, 'search'])->name('rates.search');
	Route::resource('/rates', RateController::class);

	Route::get('/centers-search/', [CenterController::class, 'search'])->name('centers.search');
	Route::resource('/centers', CenterController::class);

	Route::get('/drivers-search/', [DriverController::class, 'search'])->name('drivers.search');
	Route::resource('/drivers', DriverController::class);

    Route::post('/bookings-confirm-payment/', [BookingController::class, 'confirm_payment'])->name('bookings-confirm-payment');
	Route::get("/bookings-pdf/{booking}", [BookingController::class, 'pdf'])->name("bookings.pdf");
	Route::get('/bookings-search/', [BookingController::class, 'search'])->name('bookings.search');
	Route::resource('/bookings', BookingController::class);
	
	Route::post('/work-orders-process/', [WorkOrderController::class, 'convert_to_booking_store'])->name('work-orders.convert_to_booking');
	Route::post('/work-orders-process/{work_order}', [WorkOrderController::class, 'convert_to_booking'])->name('work-orders.convert');
	Route::get('/work-orders-assign/{id}', [WorkOrderController::class, 'assign_driver'])->name('work-orders.assign');
	Route::post('/work-orders-assign/', [WorkOrderController::class, 'assign_driver_store'])->name('work-orders.assign_post');
	Route::get('/work-orders-search/', [WorkOrderController::class, 'search'])->name('work-orders.search');
	Route::resource('/work-orders', WorkOrderController::class);

	Route::get('/locations-search/', [LocationController::class, 'search'])->name('locations.search');
	Route::resource('/locations', LocationController::class);
	
	Route::get('/subcontractors-search/', [SubcontractorController::class, 'search'])->name('subcontractors.search');
	Route::resource('/subcontractors', SubcontractorController::class);

	Route::get('/positions-search/', [PositionController::class, 'search'])->name('positions.search');
	Route::resource('/positions', PositionController::class);

	Route::post('/roles', [RoleController::class, 'positions_store'])->name('roles.roles');
	Route::get('/roles-permissions/{position}', [RoleController::class, 'permissions'])->name('roles.permissions');
	Route::resource('/roles', RoleController::class)->only(['index']);

	Route::get('/users-search/', [UserController::class, 'search'])->name('users.search');
	Route::resource('/users', UserController::class);

    Route::get('/vehicles-excel/', [ReportController::class, 'vehicles_excel'])->name('vehicles.excel');
	Route::get('/vehicles-search/', [VehicleController::class, 'search'])->name('vehicles.search');
	Route::resource('/vehicles', VehicleController::class);

	Route::get("/customers-locations/{customer}", [CustomerController::class, 'locations'])->name("customers.locations");
	Route::get("/customers-centers/{customer}", [CustomerController::class, 'centers'])->name("customers.centers");
	Route::get('/customers-search/', [CustomerController::class, 'search'])->name('customers.search');
	Route::resource('/customers', CustomerController::class);

	Route::get('/travel-types-search/', [TravelTypeController::class, 'search'])->name('travel-types.search');
	Route::resource('/travel-types', TravelTypeController::class);

	Route::get('/vehicle-types-search/', [VehicleTypeController::class, 'search'])->name('vehicle-types.search');
	Route::resource('/vehicle-types', VehicleTypeController::class);

	Route::get('/supply-centers-search/', [SupplyCenterController::class, 'search'])->name('supply-centers.search');
	Route::resource('/supply-centers', SupplyCenterController::class);

	Route::get('/vehicle-groups-search/', [VehicleGroupController::class, 'search'])->name('vehicle-groups.search');
	Route::resource('/vehicle-groups', VehicleGroupController::class);

	Route::get('/fuel-consumptions-odometer/{id}', [FuelConsumptionController::class, 'odometer'])->name("fuel-consumptions.odometer");
	Route::get('/fuel-consumptions-search/', [FuelConsumptionController::class, 'search'])->name('fuel-consumptions.search');
	Route::resource('/fuel-consumptions', FuelConsumptionController::class);

    Route::get("/reports/booking-confirmation", [ReportController::class, 'booking_confirmation'])->name("reports.booking-confirmation");
	Route::post("/reports/booking-confirmation", [ReportController::class, 'booking_post_confirmation'])->name("reports.booking-confirmation");
    
	Route::get("/reports/booking", [ReportController::class, 'booking'])->name("reports.booking");
	Route::post("/reports/booking", [ReportController::class, 'booking_post'])->name("reports.booking");
	Route::get("/reports/booking/excel", [ReportController::class, 'booking_excel'])->name("reports.booking-excel");
	Route::post("/reports/booking/excel", [ReportController::class, 'booking_excel_post'])->name("reports.booking-excel");
	Route::get("/reports/profit", [ReportController::class, 'profit'])->name("reports.profit");
	Route::post("/reports/profit", [ReportController::class, 'profit_post'])->name("reports.profit");
	Route::get("/reports/consumptions", [ReportController::class, 'consumptions'])->name("reports.consumptions");
    Route::post("/reports/consumptions", [ReportController::class, 'consumptions_post'])->name("reports.consumptions");
    Route::get("/reports/billing", [ReportController::class, 'billing'])->name("reports.billing");
    Route::post("/reports/billing", [ReportController::class, 'billing_pdf'])->name("reports.billing-pdf");
    Route::get("/reports/travels", [ReportController::class, 'travel'])->name("reports.travel");
    Route::post("/reports/travels", [ReportController::class, 'travel_post'])->name("reports.travel");
    Route::get("/reports/inventories", [ReportController::class, 'inventories'])->name("reports.inventories");
    Route::post("/reports/inventories", [ReportController::class, 'inventories_post'])->name("reports.inventories");
    Route::get("/reports/weekly", [ReportController::class, 'weekly'])->name("reports.weekly");
	Route::post("/reports/weekly", [ReportController::class, 'weekly_post'])->name("reports.weekly");
	
	
	
	
	
	
	

});