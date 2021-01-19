<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\ShipOrder;
use App\Services\DataSavingService;
use App\Utils\XML\XMLParser;
use App\Utils\XML\XMLReader;
use Illuminate\Http\Request;

class XMLHandlerController extends Controller
{

    private DataSavingService $service;

    public function __construct(DataSavingService $service)
    {
        $this->service = $service;
    }

    public function handle(Request $request){
        $path = $request->path;
        $filename = $request->name;
        $file = $path . $filename;
        try {
            $xml = XMLReader::read($file);
        } catch (\Exception $ex){
            return response()->json($ex->getMessage(), 400);
        }
        if (XMLParser::check($xml) == Person::class) {
            $people = XMLParser::toPerson($xml);
            $response = $this->service->savePeople($people);
        } else if (XMLParser::check($xml) == ShipOrder::class) {
            $shiporders = XMLParser::toShiporder($xml);
            $response = $this->service->saveShiporders($shiporders);
        }
        $status = count($response['errors']) > 0 ? 400 : 200;
        return response()->json($response, $status);
    }



}
