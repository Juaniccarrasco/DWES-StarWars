<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

abstract class Controller
{
    public function comproveAdmin($request){
        $admin_name= $request->json()['admin_name'];
        $admin_pass= $request->json()['admin_pass'];
        try{
            $id_user= DB::table('users')
            ->where('user_name','=',$admin_name)
            ->where('pass','=',$admin_pass)
            ->get('id_user');
        }catch (Exception $e){
            return response()->json(["Mensaje"=> "Credenciales inválidas"],500);
        }

        try{
            DB::table('users_role')
            ->where('id_user','=',$id_user)
            ->where('id_role', '=', 2)
            ->get();
        }catch(Exception $e){
            return response()->json(["Mensaje"=> "Credenciales inválidas"], 500);
        }

        return true;
    }
    public function getUsers(Request $request){
        if(self::comproveAdmin($request)){
            $people = DB::table('users')
            ->get();

            $data = [
                'pers' => $people
            ];

            return response()->json($data,200);
        }
    }

    public function getUser(Request $request, $id){
        if(self::comproveAdmin($request)){
            $user = DB::table('users')
            ->select()
            ->where('id_user',$id)
            ->get();

            return response()->json($user);
        }
    }

    public function postUser(Request $request) {
        if(self::comproveAdmin($request)){
            $user_name=$request['user_name'];
            $pass=$request['pass'];
            $mail=$request['mail'];
        
            try{
                $registro = DB::table('users')
                ->insert([
                    'user_name'=> $user_name,
                    'pass' => md5($pass),
                    'mail'=> $mail
                ]);
            }
            catch (Exception $e){
                return response()->json(["Status"=> "error", "Mensaje"=> $e->getMessage()],500);
            }
        
            return response()->json(['mensaje'=>'Registro insertado correctamente', 'registro' => $registro],200);
        }

        // if($validated= $request->validate([
        //     'user_name'=>'required|string|min:3|max:50',
        //     'pass'=>'nullable|string',
        //     'mail'=>'required|string|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
        // ])){
        //     try{
        //     $registro = DB::table('personas')
        //     ->insert($validated);
        //     }
        //     catch (Exception $e){
        //         return response()->json(["Status"=> "error", "Mensaje"=> $e->getMessage()],500);  
        //     }

        // }else return response()->json(["Status"=> "error", "Mensaje"=> "No se han encontrado los credenciales necesarios"],400);
        
        // return response()->json(['mensaje'=>'Registro insertado correctamente', 'registro' => $registro],200);
    }

    public function deleteUser(Request $request, $id){
        if(self::comproveAdmin($request)){
            try{
                DB::table('users')
                ->where('id_user', '=', $id)
                ->delete();
            }
            catch (Exception $e){
                return response() -> json(['Status'=> 'error', 'Mensaje'=> $e->getMessage(), 500]);
            }
        }
    }

    public function putUser(Request $request, $id){
        if(self::comproveAdmin($request)){
            if($request->has(['user_name','mail','pass']))
            $user_name = $request['user_name'];
            $mail = $request['mail'];
            $pass = md5($request['pass']);

            try{
                DB::table('users')
                ->where('id_user','=', $id)
                ->update(['user_name'=>$user_name,'pass'=>$pass, 'mail'=>$mail]);
            }
            catch (Exception $e){
                return response() -> json(['Status'=> 'error', 'Mensaje'=> $e->getMessage(), 500]);
            }
        }
    }
    
    public function patchUser (Request $request, $id){
        if(self::comproveAdmin($request)){
            $patchArray=$request->json()->all();
            // foreach ($request as $key => $value) {
            //     $patchArray[$key] = $value;
            // }

            unset($patchArray['admin_name'], $patchArray['admin_pass']);
            if(isset($patchArray['pass'])){
                $patchArray['pass']=md5($patchArray['pass']);
            }

            // if(isset($patchArray['admin_name'])){
            //     unset($patchArray['admin_name']);
            // }
            
            // if(isset($patchArray['admin_pass'])){
            //     unset($patchArray['admin_pass']);
            // }

            try{
                DB::table('users')
                ->where('id_user','=', $id)
                ->update($patchArray);
            }
            catch (Exception $e){
                return response() -> json(['Status'=> 'error', 'Mensaje'=> $e->getMessage(), 500]);
            }

            /*$keyValName=[];
            if($request->has('user_name')){
                $user_name=$request['user_name'];
                $keyValName=['user_name' => $user_name];
            }
            $keyValPass=[];
            if($request->has('pass')){
                $pass=$request['pass'];
                $keyValPass=['pass'=> $pass];
            }
            $keyValMail=[];
            if($request->has('mail')){
                $mail=$request['mail'];
                $keyValMail=['mail'=> $mail];
            }
            $mergedArray=array_merge($keyValName,$keyValPass,$keyValMail);
                try{
                DB::table('users')
                ->where('id_user','=', $id)
                ->update($mergedArray);
            }
            catch (Exception $e){
                return response() -> json(['Status'=> 'error', 'Mensaje'=> $e->getMessage(), 500]);
            }*/
        }
    }
}
