<div class="grid grid-cols-12">
    <input type="hidden" name="work_order_id" id="work_order_id" value="{{ $work_order->id }}" />
    <div class="col-span-12 sm:col-span-12 mb-4">
        <label for="vehicle_id" class="form-label">Vehículo <span class="text-theme-6">*</span></label>
        <select class="form-select form-select-solid" name="vehicle_id" id="vehicle_id" data-control="select2" data-placeholder="seleccionar item">
            <option></option>
            @foreach($vehicles as $vehicle)
            <option value="{{ $vehicle->id }}" data-id="{{ $vehicle->id }}" >{{ $vehicle->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-span-12 sm:col-span-12">
        <label for="driver_id" class="form-label">Chofer <span class="text-theme-6">*</span></label>
        <select class="form-select form-select-solid" name="driver_id" id="driver_id" data-control="select2" data-placeholder="seleccionar item">
            <option></option>
            @foreach($drivers as $driver)
            <option value="{{ $driver->id }}" >{{ $driver->name }}</option>
            @endforeach
        </select>
    </div>
</div>