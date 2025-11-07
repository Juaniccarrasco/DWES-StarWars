<?php

namespace App\Http\Controllers;

use App\Models\Manteinance;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ManteinanceController extends Controller
{

    public function postManteinance(Request $request, $idShip){

        $data= $data = array_merge($request->all(), ['id_ship' => $idShip]);

        $rules = [
            'date' => 'required|date',
            'description' => 'nullable|string',
            'cost' => 'required|numeric|min:0',
            'id_Ship'=> 'exists:ships,id_ship'
        ];

        $validator = Validator::make($data,$rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ],400);
        }

        // $validated = $request->validate([
        //     'cost'=> 'required|integer',
        //     'description'=> 'string'
        // ]);

        // $validator = Validator::make(
        //     ['idShip'=> $idShip],
        //     ['idShip'=>'required|integer|exists:ships,id_ship']
        // );

        // if($validator->fails()){
        //     return response()->json(['success'=>false, 'errors'=>$validator->errors()], 400);
        // }

        try{
            print_r($data);
            $manteinance = Manteinance::create($data);
            return response()->json(['message' => $manteinance->id_ship],200);
        } catch (\Exception $e) {
            $mensaje = 'Fallo al crear el mantenimiento';
            return response()->json([
                'message' => $mensaje,
                'error' => $e->getMessage()
            ], 500);
        }


    }

    public function getManteinance(Request $request, $idMaintenance){
        try{
            $maintenance = Manteinance::find($idMaintenance);
            return response()->json($maintenance);
        }catch(Exception $e){
            $mensaje = 'Fallo al crear el mantenimiento';
            return response()->json([
                'message' => $mensaje,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getManteinanceByDates(Request $request, $initialDate, $finalDate){
        
        $validator=Validator::make(
            ['initialDate' => $initialDate],
            ['initialDate' => 'required|date|'],
            ['finalDate' => $finalDate],
            ['finalDate' => 'required|date|']
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ],400);
        }

        try{
            $maintenance = Manteinance::where('date' ,'>', $initialDate)
            ->where('date' ,'<', $finalDate)->get();
            return response()->json($maintenance);
        }catch(Exception $e){
            $mensaje = 'Fallo al crear el mantenimiento';
            return response()->json([
                'message' => $mensaje,
                'error' => $e->getMessage()
            ], 500);
        }
    
    }

}
