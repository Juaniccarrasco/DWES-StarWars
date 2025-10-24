<?php

namespace App\Http\Controllers;

use App\Models\Ship;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShipController extends Controller
{
    

    public function getShips(Request $request){
        $ships = Ship::all();

        return response()-> json($ships,200);
    }

    public function getShip(Request $request, $id_ship){
        $ship = Ship::find($id_ship);

        return response()->json($ship);
    }

    public function postShip(Request $request){
        $ship= new Ship();

        try {
            $ship = $ship->create($request->all());
            return response()->json(['message' => $ship->id_ship],200);
        } catch (\Exception $e) {
            $mensaje = 'Clave duplicada';
            return response()->json(['mens' => $mensaje],404);
        }
    }

    public function deleteShip(Request $request, $id_ship){
        try{
            $ship = Ship::find($id_ship);
            if($ship){
                $ship->delete();
                return response()->json(['message' => 'Nave eliminada correctamente.'], 200);
            }else {
                return response()->json(['message' => 'Nave no encontrada.'], 404);
            }
        }catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener las propiedades',
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function updateShip(Request $request, $id_ship){
        $ship = Ship::find($id_ship);
            if($ship){
                $ship->update([
                    $ship->name_ship = $request->get('name_ship'),
                    $ship->model = 	$request->get('model'),
                    $ship->class = $request->get('class'),
                    $ship->tripulation = $request->get('tripulation'),
                    $ship->passengers = $request->get('passengers')
                ]);
                return response()->json(['message' => 'Nave modificada correctamente.'], 200);
            }else {
                return response()->json(['message' => 'Nave no encontrada.'], 404);
            }
    }

    public function patchShip(Request $request, $id_ship){
        $ship = Ship::find($id_ship);
        if($ship){
            $dataRequest= $request->all();
            $fillables = $ship->getFillable();
            $updatableData=[];
            foreach ($fillables as $key) {
                if($request->has($key)){
                    $updatableData[$key] = $request->input($key);
                }
            }
            if(empty($updatableData)){
                return response()->json(['message' => 'Ningún campo que actualizar'], 422);
            }
            $actualizableData= array_intersect_key($dataRequest, array_flip($updatableData));
            $ship->update($actualizableData);
            return response()->json(['message' => 'Nave modificada correctamente.'], 200);
        }else{
            return response()->json(['message' => 'Nave no encontrada.'], 404);
        }
    }
}
