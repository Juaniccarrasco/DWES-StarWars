<?php

namespace App\Http\Controllers;

use App\Models\Pilot;
use App\Models\Ship;
use App\Models\Ship_Pilot;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
            ->whereNull('unassigned')
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
                                    "id_ship"=>$ship->id_ship],201);

        }catch (Exception $e){
            return response()->json(["Error"=> $e->getMessage()], $e->getCode());
        }
    }

    public function unassignPilot(Request $request, $idPilot, $idShip){
        try{

            // $validator = Validator::make($request->all(),[
            //     'idPilot' => 'required|integer|exists:pilotos,id'
            // ]);

            $validator = $validator = Validator::make(
                ['idPilot' => $idPilot],
                ['idPilot' => 'required|integer|exists:pilots,id_pilot']
            );

            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()],400);
            }

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
            
            // $exists = Ship_Pilot::where('id_pilot',$idPilot)
            // ->where('id_ship',$idShip)
            // ->exists();

            $ship = Ship_Pilot::where('id_pilot',$idPilot)
            ->where('id_ship',$idShip)
            ->whereNull('unassigned')
            ->first();

            //if($ship_pilot){
            if(!$ship){
                throw new Exception("Esta nave no está asignada a ese piloto",409);
            }

            // $ship->pilots()->detach([
            //     $idPilot => ['id_ship' => $idShip]
            // ]);
            // $ship->unassignedPilots()->updateExistingPivot((int)$idPilot, [
            //     'unassigned' => now()
            // ]);

            echo('aqui');

            $pilot->ships()->updateExistingPivot($idShip,[
                'unassigned'=> now()
            ]);

            return response()-> json(["message"=> "Piloto desasignado",
                                    "id_pilot"=>$pilot->id_pilot,
                                    "id_ship"=>$ship->id_ship],201);

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

    public function historyPilotsAssigned(){
        $assignedPilots= Pilot::has('ships')->get();
        if($assignedPilots){
            return response()->json(['message' => $assignedPilots], 200);
        }else{
            return response()->json(['message' => 'Pilotos no encontrados.'], 404);
        }
    }

    public function listPilotsAssigned(){
        $assignedPilots= Pilot::has('assignedShips')->get();
        if($assignedPilots){
            $ships= Ship::has('pilots')->get();
            if(!$ships){
                return response()->json(['message' => 'Nave no encontrada.'], 404);
            }
            return response()->json(['pilots' => $assignedPilots,
                                    'ships'=>$ships], 200);
        }else{
            return response()->json(['message' => 'Pilotos no encontrados.'], 404);
        }
    }
}
