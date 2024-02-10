<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;

use Auth;
use Carbon\Carbon;
use App\Models\Inventory;
use App\Models\FuelConsumption;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFuelConsumptionRequest;
use App\Http\Requests\UpdateFuelConsumptionRequest;

class FuelConsumptionController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $startDate = $now->copy()->subMonths(3)->startOfMonth()->toDateString();
        
        $lastMonthDay = date('t'); // Obtén el último día del mes actual
        $endDate = date('Y-m-d', strtotime(date('Y-m').'-'.$lastMonthDay));
        
        $startDate = $startDate . " 00:00:00";
        $endDate   = $endDate   . " 23:59:59";
        
        $fuel_consumptions = FuelConsumption::whereBetween('created_date', [$startDate, $endDate])
        ->orderBy('id', 'DESC')
        ->get([
            'id',
            'user_id',
            'erp_number',
            'supply_center_id',
            'other',
            'vehicle_id',
            'vehicle_type_id',
            'initial_odometer',
            'final_odometer',
            'number_of_gallons',
            'created_date',
            'total_mileage',
            'overall_yield',
            'client_id',
            'notes',
        ]);
        
        $fuel_consumptions->each(function ($fuel_consumption) {
            $fuel_consumption->vehicle->makeHidden([
                'model',
                'type_id',
                'vehicle_type_id',
                'year',
                'vehicle_group_id',
                'lic_exp_date',
                'exp_exp_date',
                'engine_type',
                'horse_power',
                'color',
                'vin',
                'license_plate',
                'mileage',
                'user_id',
                'width',
                'height',
                'outsource',
                'is_reportable',
                'created_at',
                'updated_at',
                'deleted_at',
                'vehicle_type',    
            ]);
            $fuel_consumption->supply_center->makeHidden([
                'name',
                'supply_center_type',
                'created_at',
                'updated_at',
                'deleted_at',   
            ]);
        });
        
        $fuel_consumptions->makeHidden(['user']);

        return $fuel_consumptions;
    }
    
    public function show(FuelConsumption $id)
    {
        return $id;
    }

    public function store(StoreFuelConsumptionRequest $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'supply_center_id' => 'required|exists:supply_centers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'initial_odometer' => 'nullable|numeric',
            'final_odometer' => 'required|numeric',
            //'final_odometer' => 'required|numeric|gte:initial_odometer|max:' . $limiter,
            'number_of_gallons' => 'required|numeric|min:1',
            'created_date' => 'required|date',
            'client_id' => 'nullable|exists:users,id',
            'vehicle_type_id' => 'required|integer|min:1',
            'notes' => 'nullable|string',
            'erp_number' => 'nullable|string'
        ]);
        
        $initial_odometer = $this->getInitialOdometer($request->vehicle_id);
        $total_mileage = intval($request->final_odometer) - intval($initial_odometer) ?? 0;
        $overall_yield = $request->number_of_gallons != 0 ? $total_mileage / $request->number_of_gallons ?? 1 : 0;
        
        $fuel_consumption = new FuelConsumption;
        $fuel_consumption->fill($data);
        $fuel_consumption->initial_odometer = $initial_odometer;
        $fuel_consumption->total_mileage = $total_mileage;
        $fuel_consumption->overall_yield = $overall_yield;
        $fuel_consumption->save();
        return $fuel_consumption->id;
    }

    public function update(UpdateFuelConsumptionRequest $request, $id)
    {
        $id = intval($id);
        $fuel_consumption = FuelConsumption::where('id', $id)->first();

        if ($fuel_consumption) {
            $fuel_consumption->supply_fuel_consumption_id = $request->fuel_consumption["supply_fuel_consumption_id"];
            $fuel_consumption->initial_odometer = $request->fuel_consumption["initial_odometer  "];
            $fuel_consumption->final_odometer = $request->fuel_consumption["final_odometer"];
            $fuel_consumption->number_of_gallons = $request->fuel_consumption["number_of_gallons"];
            $fuel_consumption->created_date = $request->fuel_consumption["created_date"];
            $fuel_consumption->total_mileage = $request->fuel_consumption["total_mileage"];
            $fuel_consumption->overall_yield = $request->fuel_consumption["overall_yield"];
            $fuel_consumption->notes = $request->fuel_consumption["notes"];
            $fuel_consumption->save();
            return $fuel_consumption;
        }
        return "Registro no encontrado.";
    }

    public function destroy($id)
    {
        $id = intval($id);
        $record = FuelConsumption::where('id', $id)->first();

        if ($record) {
            $record->delete();
            return "Registro eliminado exitosamente.";
        }
        return "Registro no encontrado."; 
    }
    
    function getInitialOdometer($id)
    {
        $id = intval($id);
        $odometer = FuelConsumption::where('vehicle_id', $id)
            ->whereNotNull('erp_number')->latest()->first();
        $odometer = $odometer->final_odometer ?? 0;    
        return $odometer;
    }
    
    function calculateTotalCost($vehicleId, $createdDate)
    {
        /*
        $totalCost = DB::table('inventories as out')
            ->select(DB::raw('SUM(in.price * out.pieces) as total_cost'))
            ->join('inventories as in', function ($join) use ($vehicleId, $createdDate) {
                $join->on('out.item_definition_id', '=', 'in.item_definition_id')
                    ->where('in.inventory_type', '=', 'IN')
                    ->where('out.vehicle_id', '=', $vehicleId)
                    ->where('out.inventory_type', '=', 'OUT')
                    ->where('in.created_at', '=', DB::raw('(SELECT MAX(created_at) FROM inventories WHERE item_definition_id = out.item_definition_id AND inventory_type = "IN")'));
            })
            ->groupBy('out.vehicle_id')
            ->value('total_cost');
    
        return $totalCost ?? 0;
        */
        
        $totalCost = 0;
        $latestInventoryItems = Inventory::where('inventory_type', 'OUT')
            ->where('vehicle_id', $vehicleId)
            ->latest('created_at')
            ->groupBy('item_definition_id')
            ->get();
    
        foreach ($latestInventoryItems as $item) {
            $latestInventoryItem = Inventory::where([
                ['item_definition_id', $item->item_definition_id],
                ['inventory_type', 'IN'],
            ])->latest('created_at')->first();
    
            $totalCost += ($latestInventoryItem !== null) ? $latestInventoryItem->price * $item->pieces : 0;
        }
        return $totalCost;
    }
    
    function dashboard()
    {
        set_time_limit(60);
        $startDate = Carbon::now()->subMonths(1)->startOfDay();
        $endDate = Carbon::today()->endOfDay();
        
        $fuel_consumptions = FuelConsumption::whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('id', 'DESC')
            ->with(['vehicle', 'supply_center', 'vehicle_type'])
            ->get();

        $formattedFuelConsumptions = $fuel_consumptions->map(function ($fuel_consumption) {
            
            $totalCost = $this->calculateTotalCost($fuel_consumption->vehicle_id, $fuel_consumption->created_at->toDateString());
            
            return [
                'vehicle_id' => $fuel_consumption->vehicle_id,
                'vehicle_name' => $fuel_consumption->vehicle->name,
                'created_date' => $fuel_consumption->created_at->toDateString(),
                'supply_center_name' => $fuel_consumption->supply_center->name,
                'number_of_gallons' => $fuel_consumption->number_of_gallons,
                'total_mileage' => $fuel_consumption->total_mileage,
                'vehicle_type_name' => $fuel_consumption->vehicle_type->name ?? 'N/A',
                'total_cost' => $totalCost,
            ];
        });

        return $formattedFuelConsumptions;
    }
}
