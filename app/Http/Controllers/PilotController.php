<?php

namespace App\Http\Controllers;

use App\Models\Pilot;
use App\Models\Ship;
use App\Models\Ship_Pilot;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PilotController extends Controller
{
    public function assignPilot(Request $request, $idPilot, $idShip){
        try{

            $ship = Ship::find($idShip);
            if(!$ship){
                throw new Exception("Nave no encontrada",404);
                // return response()-> json($ships,200);
            }
            $pilot = Pilot::find($idPilot);
            if(!$pilot){
                throw new Exception("Piloto no encontrado",404);
            }
            // $ship_pilot = Ship_Pilot::where('id_pilot',$idPilot)
            // ->where('id_ship',$idShip)
            // ->first();
            
            $exists = Ship_Pilot::where('id_pilot',$idPilot)
            ->where('id_ship',$idShip)
            ->exists();

            //if($ship_pilot){
            if($exists){
                throw new Exception("Nave ya asignada a ese piloto",409);
            }

            $ship->pilots()->attach($pilot->id_pilot,[
                'assigned' =>now(),
                'unassigned' => null
            ]);

            return response()-> json(["message"=> "Piloto asignado",
                                    "id_pilot"=>$pilot->id_pilot,
                                    "id_ship"=>$ship->id_ship],200);

        }catch (Exception $e){
            return response()->json(["Error"=> $e->getMessage()], $e->getCode());
        }
    }

    public function assignPilots(Request $request){
        try{

            $idShip = $request->input('id_ship');
            $ship = Ship::find($idShip);
            if(!$ship){
                throw new Exception("Nave no encontrada",404);
                // return response()-> json($ships,200);
            }
            
            $idPilots = $request->input(['id_pilots']);
            $pilots = Pilot::whereIn('id_pilot', $idPilots)->get();
            if (count($pilots) !== count($idPilots)) {
                throw new Exception("Al menos uno de los pilotos no ha sido encontrado", 404);
            }
            
            $existingAssignments = Ship_Pilot::where('id_ship',$idShip)
            //whereIn para recorrer arrays
            ->whereIn('id_pilot',$idPilots)
            ->pluck('id_pilot')
            ->toArray();
            
            if(!empty($existingAssignments)){
                throw new Exception("Al menos uno de los pilotos ya está asignado a esta nave", 409);
            }
            
            foreach ($pilots as $pilot) {
                $ship->pilots()->attach($pilot->id_pilot,[
                    'assigned' =>now(),
                    'unassigned' => null
                ]);                
            }

            return response()-> json(["message"=> "Pilotos asignados",
                                    "id_pilots"=>$idPilots,
                                    "id_ship"=>$ship->id_ship],200);

        }catch (Exception $e){
            return response()->json(["Error"=> $e->getMessage()], $e->getCode());
        }
    }
}
