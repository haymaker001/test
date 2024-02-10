<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FuelConsumption;
use App\Models\Location;
use App\Models\Booking;
use App\Models\Rate;
use App\models\User;
use Auth;


class HomeController extends Controller
{
    private $execution_time;
    private $magaya_api_url;
    private $date_from;
    private $date_to;
    private $token;
    private $user;
    private $pass;
    
    private $locationList;
    
    function __construct()
    {
        $this->locationList = Location::all();
        $this->execution_time = 600; // 10 minutos
        $this->date_from = '2023-10-24';
        $this->date_to = '2023-10-24';
        $this->user = '35069.admin';
        $this->pass = 'Kutirimifaro@01';
        $this->magaya_api_url = 'https://35069.magayacloud.com/api/Invoke?Handler=CSSoapService';
    }
    
    function settings()
    {
        return view('settings');
    }
    
    function extraer_desp_xml($texto) {
        $resultado = [];
        
        // Parseamos el XML
        $documento = new \DOMDocument();
        $documento->loadXML($texto);
        
        // Obtenemos todos los tag <Number>
        $tag_number = $documento->getElementsByTagName("Number");
        
        // Recorremos los tag <Number>
        foreach ($tag_number as $tag) {
            // Obtenemos el contenido del tag
            $contenido = $tag->textContent;
            
            // Dividimos el contenido en palabras
            $palabras = explode(" ", $contenido);
            
            // Añadimos las palabras al resultado
            $resultado[] = $palabras;
        }
        // Devolvemos el array de resultados
        return $resultado;
    }

    
    function extractAccessKey($string) {
        $start = strpos($string, '<access_key>');
        $end = strpos($string, '</access_key>', $start);
        
        if ($start === false || $end === false) {
            return null;
        }

        $accessKey = substr($string, $start + 12, $end - $start - 12);
        return $accessKey;
    }
    
    function extractNumbers($xml) {
        $numeros = array();

        $xml = simplexml_load_string($xml);
        return $xml;
    }
    
    function get_token()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
              CURLOPT_URL => $this->magaya_api_url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>'<?xml version="1.0" encoding="utf-8"?>
            <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
              <soap:Body>
                <StartSessionIn>
                  <user>' . $this->user . '</user>
                  <pass>' . $this->pass . '</pass>
                </StartSessionIn>
              </soap:Body>
            </soap:Envelope>
            ',
              CURLOPT_HTTPHEADER => array(
                'Content-Type: text/xml; charset=utf-8',
                'SOAPAction: #StartSession'
              ),
        ));

        $response = curl_exec($curl);

        $accessKey = $this->extractAccessKey($response);

        if ($response === false)
        {
            echo "Error en la solicitud cURL: " . curl_error($curl);
        }
        else
        {
            if (empty($accessKey)) {
                return response()->json(['error' => 'Access key not found'], 404);
            }
            return $accessKey;
        }
        curl_close($curl);
    }
    
    function demo()
    {
        
        $curl = curl_init();
        $key = $this->get_token();
        $date_from = $this->date_from;
        $date_to = $this->date_to;
        $flags = 0; // Los flags que deseas
        $record_quantity = 2; // Cambia este valor al número de registros que deseas recuperar
        $backwards_order = true; // Cambia a true o false según lo que necesites
        
        ini_set('max_execution_time', $this->execution_time);
        
        // Define la solicitud SOAP con los parámetros para GetFirstTransbyDate
        $requestBody = '<?xml version="1.0" encoding="utf-8"?>
        <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
          <soap:Body>
            <GetFirstTransbyDate>
              <access_key>' . $key .'</access_key>
              <type>CR</type>
              <start_date>' . $date_from . '</start_date>
              <end_date>' . $date_to . '</end_date>
              <flags>' . $flags . '</flags>
              <record_quantity>' . $record_quantity . '</record_quantity>
              <backwards_order>' . ($backwards_order ? 'true' : 'false') . '</backwards_order>
            </GetFirstTransbyDate>
          </soap:Body>
        </soap:Envelope>';
        
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->magaya_api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $requestBody,
            CURLOPT_HTTPHEADER => [
                "Content-Type: text/xml; charset=utf-8",
                "SOAPAction: #GetFirstTransbyDate",
            ],
        ]);
        
        $response = curl_exec($curl);
        echo $response;
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        $curl = curl_init();
        $key = $this->get_token();
        $date_from = $this->date_from;
        $date_to = $this->date_to;
        $flags = 0x40;//0x2 + 0x10 + 0x200 + 0x40;
        
        ini_set('max_execution_time', $this->execution_time);
        
        // Define la solicitud SOAP
        $requestBody = '<?xml version="1.0" encoding="utf-8"?>
        <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
          <soap:Body>
            <GetTransRangeByDateIn>
              <access_key>' . $key .'</access_key>
              <type>CR</type>
              <start_date>' . $date_from . '</start_date>
              <end_date>' . $date_to . '</end_date>
              <flags>0</flags>
            </GetTransRangeByDateIn>
          </soap:Body>
        </soap:Envelope>';
        
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->magaya_api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $requestBody,
            CURLOPT_HTTPHEADER => [
                "Content-Type: text/xml; charset=utf-8",
                "SOAPAction: #GetTransRangeByDate",
            ],
        ]);
        
        $response = curl_exec($curl);
        
        $numeros = array();
        $doc = new \DOMDocument();
        
        $response = str_replace('no_error', '', $response);
        

        //$doc->loadXML($response);
        
        echo ($response);
        //die();

        // Obtener el elemento <trans_list_xml>
        $transListXml = $doc->getElementsByTagName('trans_list_xml')->item(0);
        
        return $doc;
        
        if ($transListXml) {
            // Obtener el contenido del elemento <trans_list_xml>
            $transListXmlContent = $transListXml->textContent;
        
            // Crear un nuevo DOMDocument para el contenido de <trans_list_xml>
            $contentDoc = new \DOMDocument();
            $contentDoc->loadXML($transListXmlContent);
        
            // Crear un objeto DOMXPath para consultar el contenido
            $contentXpath = new \DOMXPath($contentDoc);
            $contentXpath->registerNamespace("ns", "http://www.magaya.com/XMLSchema/V1");
        
            // Consultar todos los elementos <CargoRelease>
            $cargoReleases = $contentXpath->query('//ns:CargoRelease');
        
            // Iterar a través de los elementos <CargoRelease>
            foreach ($cargoReleases as $cargoRelease) {
                $number = $cargoRelease->getElementsByTagName('Number')->item(0)->nodeValue;
                $numeros[] = ["number" => $number];
            }
        } else {
            echo "No se encontró la etiqueta <trans_list_xml> en la respuesta SOAP.";
        }

        return response()->json([
            'data' => $numeros
        ]);
    }
    
    function rec()
    {
        $curl = curl_init();
        $key = $this->get_token();
        $date_from = $this->date_from;
        $date_to = $this->date_to;
        
        ini_set('max_execution_time', $this->execution_time);
        
        // Define la solicitud SOAP
        $requestBody = '<?xml version="1.0" encoding="utf-8"?>
        <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
          <soap:Body>
            <GetTransRangeByDateIn>
              <access_key>' . $key .'</access_key>
              <type>CR</type>
              <start_date>' . $date_from . '</start_date>
              <end_date>' . $date_to . '</end_date>
              <flags>0</flags>
            </GetTransRangeByDateIn>
          </soap:Body>
        </soap:Envelope>';
        
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->magaya_api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $requestBody,
            CURLOPT_HTTPHEADER => [
                "Content-Type: text/xml; charset=utf-8",
                "SOAPAction: #GetTransRangeByDate",
            ],
        ]);
        
        $response = curl_exec($curl);
        
        $numeros = array();
        $doc = new \DOMDocument();
        
        $response = str_replace('no_error', '', $response);

        //$doc->loadXML($response);
        
        echo ($response);
        die();

        // Obtener el elemento <trans_list_xml>
        $transListXml = $doc->getElementsByTagName('trans_list_xml')->item(0);
        
        return $doc;
        
        if ($transListXml) {
            // Obtener el contenido del elemento <trans_list_xml>
            $transListXmlContent = $transListXml->textContent;
        
            // Crear un nuevo DOMDocument para el contenido de <trans_list_xml>
            $contentDoc = new \DOMDocument();
            $contentDoc->loadXML($transListXmlContent);
        
            // Crear un objeto DOMXPath para consultar el contenido
            $contentXpath = new \DOMXPath($contentDoc);
            $contentXpath->registerNamespace("ns", "http://www.magaya.com/XMLSchema/V1");
        
            // Consultar todos los elementos <CargoRelease>
            $cargoReleases = $contentXpath->query('//ns:CargoRelease');
        
            // Iterar a través de los elementos <CargoRelease>
            foreach ($cargoReleases as $cargoRelease) {
                $number = $cargoRelease->getElementsByTagName('Number')->item(0)->nodeValue;
                $numeros[] = ["number" => $number];
            }
        } else {
            echo "No se encontró la etiqueta <trans_list_xml> en la respuesta SOAP.";
        }

        return response()->json([
            'data' => $numeros
        ]);
    }

	function index()
	{
		$data[] = null;
		$user = Auth::user();
		if($user->position->dashboard == 'SI'){
		    $view = 'home';
            $year = date('Y');
            $bookings = Booking::whereYear('pickup', $year)->get();
            $customers = User::where('user_type', 'customer')->get();
            $consumptions = FuelConsumption::whereYear('created_date', $year)->get();

			$data['viajes'] = count($bookings);
            $data['destinos']  = $bookings->sum('destinations');
            $data['clients']  = $customers;
            $data['clientes']  = $customers->pluck('name')->all();
            $data['kilometraje'] = $consumptions->sum('total_mileage');
            $data['combustible'] = $consumptions->sum('number_of_gallons');
            $data['facturacion'] = $bookings->sum('rate') + $bookings->sum('additionals');
			
		}
		else{
			$view = 'home-simple';
		}
		return view($view, $data);
	}
	
	function charts($id)
	{
	    $customer = intval($id);
	    $data['bookings'] = $this->getMonthlyBookings($customer);
	    $data['billings'] = $this->getMonthlyBilling($customer);
	    $data['delivery_monthly'] = $this->getMonthlyDestinations();
	    $data['mileage_monthly'] = $this->getMonthlyMileage();
	    $data['fuel_monthly'] = $this->getMontlyGallons();
	    return $data;
	}

    function getMonthlyBookings($customer)
    {
        $data = array();
        $year = date('Y');
        
        if($customer == 0){
            $bookings = DB::select(
            DB::raw('SELECT COUNT(id) number FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 1 AND deleted_at IS NULL
                UNION ALL
                SELECT COUNT(id) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 2 AND deleted_at IS NULL
                UNION ALL
                SELECT COUNT(id) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 3 AND deleted_at IS NULL
                UNION ALL
                SELECT COUNT(id) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 4 AND deleted_at IS NULL
                UNION ALL
                SELECT COUNT(id) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 5 AND deleted_at IS NULL
                UNION ALL
                SELECT COUNT(id) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 6 AND deleted_at IS NULL
                UNION ALL
                SELECT COUNT(id) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 7 AND deleted_at IS NULL
                UNION ALL
                SELECT COUNT(id) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 8 AND deleted_at IS NULL
                UNION ALL
                SELECT COUNT(id) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 9 AND deleted_at IS NULL
                UNION ALL
                SELECT COUNT(id) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 10 AND deleted_at IS NULL
                UNION ALL
                SELECT COUNT(id) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 11 AND deleted_at IS NULL
                UNION ALL
                SELECT COUNT(id) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 12 AND deleted_at IS NULL')
            );
        } else {
            $bookings = DB::select(
            DB::raw('SELECT COUNT(id) number FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '" AND MONTH(pickup) = 1 AND deleted_at IS NULL
                UNION ALL
                SELECT COUNT(id) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '"  AND MONTH(pickup) = 2 AND deleted_at IS NULL
                UNION ALL
                SELECT COUNT(id) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '"  AND MONTH(pickup) = 3 AND deleted_at IS NULL
                UNION ALL
                SELECT COUNT(id) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '"  AND MONTH(pickup) = 4 AND deleted_at IS NULL
                UNION ALL
                SELECT COUNT(id) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '"  AND MONTH(pickup) = 5 AND deleted_at IS NULL
                UNION ALL
                SELECT COUNT(id) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '"  AND MONTH(pickup) = 6 AND deleted_at IS NULL
                UNION ALL
                SELECT COUNT(id) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '"  AND MONTH(pickup) = 7 AND deleted_at IS NULL
                UNION ALL
                SELECT COUNT(id) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '"  AND MONTH(pickup) = 8 AND deleted_at IS NULL
                UNION ALL
                SELECT COUNT(id) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '"  AND MONTH(pickup) = 9 AND deleted_at IS NULL
                UNION ALL
                SELECT COUNT(id) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '"  AND MONTH(pickup) = 10 AND deleted_at IS NULL
                UNION ALL
                SELECT COUNT(id) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '"  AND MONTH(pickup) = 11 AND deleted_at IS NULL
                UNION ALL
                SELECT COUNT(id) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '"  AND MONTH(pickup) = 12 AND deleted_at IS NULL')
            );
        }
        
        foreach($bookings as $key => $booking)
            array_push($data, floatval($booking->number));
        
        return $data;
    }

    function getMonthlyDestinations()
    {
        $data = array();
        $year = date('Y');
        $bookings = DB::select(
            DB::raw('SELECT SUM(destinations) number FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 1 AND deleted_at IS NULL
            UNION ALL
            SELECT SUM(destinations) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 2 AND deleted_at IS NULL
            UNION ALL
            SELECT SUM(destinations) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 3 AND deleted_at IS NULL
            UNION ALL
            SELECT SUM(destinations) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 4 AND deleted_at IS NULL
            UNION ALL
            SELECT SUM(destinations) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 5 AND deleted_at IS NULL
            UNION ALL
            SELECT SUM(destinations) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 6 AND deleted_at IS NULL
            UNION ALL
            SELECT SUM(destinations) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 7 AND deleted_at IS NULL
            UNION ALL
            SELECT SUM(destinations) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 8 AND deleted_at IS NULL
            UNION ALL
            SELECT SUM(destinations) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 9 AND deleted_at IS NULL
            UNION ALL
            SELECT SUM(destinations) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 10 AND deleted_at IS NULL
            UNION ALL
            SELECT SUM(destinations) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 11 AND deleted_at IS NULL
            UNION ALL
            SELECT SUM(destinations) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 12 AND deleted_at IS NULL')
        );
        
        foreach($bookings as $key => $booking)
            array_push($data, intval($booking->number));
        
        return $data;
    }    

    function getMonthlyBilling($customer)
    {
        $data = array();
        $year = date('Y');
        
        if($customer == 0){
        
            $bookings = DB::select(
                DB::raw('SELECT SUM(rate) + SUM(additionals) number FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 1 AND deleted_at IS NULL
                UNION ALL
                SELECT SUM(rate) + SUM(additionals) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 2 AND deleted_at IS NULL
                UNION ALL
                SELECT SUM(rate) + SUM(additionals) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 3 AND deleted_at IS NULL
                UNION ALL
                SELECT SUM(rate) + SUM(additionals) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 4 AND deleted_at IS NULL
                UNION ALL
                SELECT SUM(rate) + SUM(additionals) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 5 AND deleted_at IS NULL
                UNION ALL
                SELECT SUM(rate) + SUM(additionals) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 6 AND deleted_at IS NULL
                UNION ALL
                SELECT SUM(rate) + SUM(additionals) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 7 AND deleted_at IS NULL
                UNION ALL
                SELECT SUM(rate) + SUM(additionals) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 8 AND deleted_at IS NULL
                UNION ALL
                SELECT SUM(rate) + SUM(additionals) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 9 AND deleted_at IS NULL
                UNION ALL
                SELECT SUM(rate) + SUM(additionals) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 10 AND deleted_at IS NULL
                UNION ALL
                SELECT SUM(rate) + SUM(additionals) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 11 AND deleted_at IS NULL
                UNION ALL
                SELECT SUM(rate) + SUM(additionals) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND MONTH(pickup) = 12 AND deleted_at IS NULL')
            );
        } else {
            $bookings = DB::select(
                DB::raw('SELECT SUM(rate) + SUM(additionals) number FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '" AND MONTH(pickup) = 1 AND deleted_at IS NULL
                UNION ALL
                SELECT SUM(rate) + SUM(additionals) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '" AND MONTH(pickup) = 2 AND deleted_at IS NULL
                UNION ALL
                SELECT SUM(rate) + SUM(additionals) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '" AND MONTH(pickup) = 3 AND deleted_at IS NULL
                UNION ALL
                SELECT SUM(rate) + SUM(additionals) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '" AND MONTH(pickup) = 4 AND deleted_at IS NULL
                UNION ALL
                SELECT SUM(rate) + SUM(additionals) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '" AND MONTH(pickup) = 5 AND deleted_at IS NULL
                UNION ALL
                SELECT SUM(rate) + SUM(additionals) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '" AND MONTH(pickup) = 6 AND deleted_at IS NULL
                UNION ALL
                SELECT SUM(rate) + SUM(additionals) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '" AND MONTH(pickup) = 7 AND deleted_at IS NULL
                UNION ALL
                SELECT SUM(rate) + SUM(additionals) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '" AND MONTH(pickup) = 8 AND deleted_at IS NULL
                UNION ALL
                SELECT SUM(rate) + SUM(additionals) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '" AND MONTH(pickup) = 9 AND deleted_at IS NULL
                UNION ALL
                SELECT SUM(rate) + SUM(additionals) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '" AND MONTH(pickup) = 10 AND deleted_at IS NULL
                UNION ALL
                SELECT SUM(rate) + SUM(additionals) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '" AND MONTH(pickup) = 11 AND deleted_at IS NULL
                UNION ALL
                SELECT SUM(rate) + SUM(additionals) FROM bookings WHERE YEAR(pickup) = ' . $year . ' AND customer_id = "' . $customer . '" AND MONTH(pickup) = 12 AND deleted_at IS NULL')
            );
        }
        
        foreach($bookings as $key => $booking)
            array_push($data, floatval($booking->number));
        
        return $data;
    }

    function getCustomerBookings($customers)
    {
        $data = array();
        foreach ($customers as $key => $customer) {
            array_push($data, $customer->bookings->count());
        }
        return $data;
    }

    function getCustomerDestinations($customers)
    {
        $data = array();
        foreach ($customers as $key => $customer) {
            array_push($data, $customer->bookings->sum('destinations'));
        }
        return $data;
    }

    function getCustomerBilling($customers)
    {
        $data = array();
        foreach ($customers as $key => $customer) {
            $facturacion = $customer->bookings->sum('rate') + $customer->bookings->sum('additionals');
            array_push($data, $facturacion);
        }
        return $data;
    }

    function getMonthlyMileage()
    {
        $data = array();
        $year = date('Y');
        $bookings = DB::select(
            DB::raw('SELECT SUM(total_mileage) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 1 AND deleted_at is null
            UNION ALL
            SELECT SUM(total_mileage) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 2 AND deleted_at is null
            UNION ALL
            SELECT SUM(total_mileage) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 3 AND deleted_at is null
            UNION ALL
            SELECT SUM(total_mileage) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 4 AND deleted_at is null
            UNION ALL
            SELECT SUM(total_mileage) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 5 AND deleted_at is null
            UNION ALL
            SELECT SUM(total_mileage) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 6 AND deleted_at is null
            UNION ALL
            SELECT SUM(total_mileage) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 7 AND deleted_at is null
            UNION ALL
            SELECT SUM(total_mileage) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 8 AND deleted_at is null
            UNION ALL
            SELECT SUM(total_mileage) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 9 AND deleted_at is null
            UNION ALL
            SELECT SUM(total_mileage) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 10 AND deleted_at is null
            UNION ALL
            SELECT SUM(total_mileage) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 11 AND deleted_at is null
            UNION ALL
            SELECT SUM(total_mileage) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 12 AND deleted_at is null')
        );
        
        foreach($bookings as $key => $booking)
            array_push($data, floatval($booking->number));
        
        return $data;
    }

    function getMontlyGallons()
    {
        $data = array();
        $year = date('Y');
        $bookings = DB::select(
            DB::raw('SELECT SUM(number_of_gallons) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 1 AND deleted_at is null
            UNION ALL
            SELECT SUM(number_of_gallons) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 2 AND deleted_at is null
            UNION ALL
            SELECT SUM(number_of_gallons) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 3 AND deleted_at is null
            UNION ALL
            SELECT SUM(number_of_gallons) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 4 AND deleted_at is null
            UNION ALL
            SELECT SUM(number_of_gallons) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 5 AND deleted_at is null
            UNION ALL
            SELECT SUM(number_of_gallons) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 6 AND deleted_at is null
            UNION ALL
            SELECT SUM(number_of_gallons) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 7 AND deleted_at is null
            UNION ALL
            SELECT SUM(number_of_gallons) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 8 AND deleted_at is null
            UNION ALL
            SELECT SUM(number_of_gallons) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 9 AND deleted_at is null
            UNION ALL
            SELECT SUM(number_of_gallons) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 10 AND deleted_at is null
            UNION ALL
            SELECT SUM(number_of_gallons) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 11 AND deleted_at is null
            UNION ALL
            SELECT SUM(number_of_gallons) number FROM fuel_consumptions WHERE vehicle_id NOT IN (SELECT id FROM vehicles WHERE is_reportable = 0) AND ' . $year . ' = YEAR(created_date) AND MONTH(created_date) = 12 AND deleted_at is null')
        );
           
        
        foreach($bookings as $key => $booking)
            array_push($data, $booking->number);
        
        return $data;
    }

	//helpers
    /* Determina la cantidad de destinos de los viajes de los cliente seg煤n su configuraci贸n */
    public function destinations($booking)
    {
        $customer = $booking->customer;
        $locationList = $this->locationList;
        if($customer->calculation_type == 'cantidad_destinos')
        {
            $destinations = 1;
            foreach(explode(",", $booking->locations) as $location)
            {
                $location = $locationList->where('id', $location)->first();
                //validar que los adicionales no sean sumados a la cantidad de destinos
                $validation = Str::startsWith($location->location, 'Adicional');
                if($location->location_type == 'PD')
                    if(!$validation)
                        $destinations += intval($location->location);
            }
            return $destinations;
        }
        
        if($customer->calculation_type == 'ruta_mas_larga')
        {
            $destinations = 0;
            foreach(explode(",", $booking->locations) as $location)
            {
                $location = $locationList->where('id', $location)->first();
                //validar que los adicionales no sean sumados a la cantidad de destinos
                $validation = Str::startsWith($location->location, 'Adicional');
                $aditional = (intval($location->location) == 0) ? 1 : intval($location->location);
                
                if($location->location_type == 'DT' && $validation == false)
                    $destinations += $aditional;
            }
            return $destinations;
        }
    }

    /* Determina el calculo de los adicionales de las rutas seg煤n configuraci贸n del cliente */
    public function calculate_aditionals($data)
    {
        $higestRate = 0;
        $client = $data->customer;
        $locations = $data->locations;
        $amount = $client->amount ?? 0;
        $locationList = $this->locationList;
        $clientAdditionals = intval($data->customer->additional ?? 0);
        if($clientAdditionals == 0)
        {
            foreach(explode(",", $locations) as $location)
            {
                $location = $locationList->where('id', $location)->first();
                if($location->location_type == 'PD'){
                    $number = intval($location->location);
                    $validation = Str::startsWith($location->location, 'Adicional');
                    if($number > 2 || ($validation))
                    {
                        $rate = Rate::where('location_id', $location->id)
                            ->where('customer_id', $data->customer_id)
                            ->where('center_id',   $data->center_id)
                            ->where('travel_type_id', $data->travel_type_id)
                            ->where('vehicle_type_id', $data->vehicle_type_id)->first();
                            
                        $rate = $rate->rate ?? 0;
                        $higestRate += $rate;
                    }
                }
            }
            $aditionals = $higestRate;
            return $higestRate;
        }
        else
        {
            $destinations = $this->destinations($data);
            $higestRate = $data->destinations > $client->additional ? (($destinations - $client->additional) * $amount) : 0;
            return $higestRate;
        }
    }

	function number_shorten($number, $precision = 1, $divisors = null, $prefix = null) {
        // Setup default $divisors if not provided
        if (!isset($divisors)) {
            $divisors = array(
                pow(1000, 0) => '', // 1000^0 == 1
                pow(1000, 1) => ' K', // Thousand
                pow(1000, 2) => ' M', // Million
                pow(1000, 3) => ' B', // Billion
                pow(1000, 4) => ' T', // Trillion
                pow(1000, 5) => ' Qa', // Quadrillion
                pow(1000, 6) => ' Qi', // Quintillion
            );    
        }
    
        // Loop through each $divisor and find the
        // lowest amount that matches
        foreach ($divisors as $divisor => $shorthand) {
            if (abs($number) < ($divisor * 1000)) {
                // We found a match!
                break;
            }
        }
    
        // We found our match, or there were no matches.
        // Either way, use the last defined value for $divisor.
        return $prefix . number_format($number / $divisor, $precision);// . $shorthand;
    }

    function random_part() {
	    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
	}

	function randomHEX($amount) {
		$result = "";
		for ($i = 0 ; $i < $amount; $i++) {
			$result .= $this->random_part();
		}
		return $result;
	}
}
