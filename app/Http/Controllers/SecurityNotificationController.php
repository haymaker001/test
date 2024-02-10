<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\SecurityNotificationImage;
use App\Models\SecurityNotification;
use App\Models\Center;
use App\Models\Vehicle;
use App\Models\EventType;
use Carbon\Carbon;
use Image;
use Auth;

class SecurityNotificationController extends Controller
{
    function index()
    {
        $notifications = SecurityNotification::orderBy('id', 'desc')->paginate(10);
        return view('security-notifications.index', compact('notifications'));
    }
    
    function create()
    {
        
    }

    function store(Request $request)
    {

    }
    
    public function edit(SecurityNotification $security_notification)
    {
        $centers = Center::all();
        $vehicles = Vehicle::all();
        $event_types = EventType::all();   
        $notification = $security_notification;
        return view('security-notifications.edit', compact('notification', 'event_types', 'vehicles', 'centers'));
    }

    public function update(Request $request, SecurityNotification $security_notification)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'created_date' => 'required|date',
            'event_type_id' => 'required|exists:event_types,id',
            'place' => 'required|string',
            'location' => 'required|string',
            'center_id' => 'required|exists:centers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'notes' => 'nullable|string'
        ]);

        $security_notification->fill($data);
        $security_notification->save();
    }

    function destroy(SecurityNotification $security_notification)
    {
        $security_notification->delete();
    }
    
    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $filter = str_replace("%", " ", $filter);

            $notifications = SecurityNotification::where('name', 'like', '%' . $filter . '%')
                ->orWhere('place', 'like', '%' . $filter . '%')
                ->orWhere('location', 'like', '%' . $filter . '%')
                ->orWhere('phone', 'like', '%' . $filter . '%')
                ->orderBy('id', 'desc')->paginate(10);

            return view('dynamics.security-notifications', compact('notifications'))->render();
        }
    }
}