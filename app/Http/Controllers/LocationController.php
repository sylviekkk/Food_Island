<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\location;
use Illuminate\Http\Request;

class LocationController extends Controller

    {
        public function createLocation(Request $request){
            $request->validate(
                [
                    'name'=>'required',
                    'area_code'=>'required'
                ]
            );
            
                $location = new location();
                $location->name = $request->name;
                $location->area_code = $request->area_code;
    
                $newLocation = $location->save();
    
                if($newLocation){
                    return response()->json(["Created",$location]);
                }
                else{
                    return "Location Not Saved.";
                }
    
        }
    
        public function index(){
            try{
                $location = location::all();
    
                if($location){
                    return response()->json($location);
                }
                else{
                    return "No Location Was found";
                }
            } catch(\Exception $e){
                return response()->json([
                    "Error"=>"No Location Was Found!"
                ]);
            }
        }
    
        public function getLocation($id){
            try{
                $location = location::findOrFail($id);
    
                if($location){
                    return response()->json($location);
                }
                else{
                    return "Location With id `$id` Was not found";
                }
            } catch(\Exception $e){
                return response()->json([
                    "Error"=>"Location Not Found!"
                ]);
            }
        }
    
        
        public function updateLocation(Request $request, $id){
            $request->validate(
                [
                    'name'=>'required',
                    'area_code'=>'required'
                ]
            );
    
            try{
                $location = location::findOrFail($id);
                if($location){
                    $location->name=$request->name;
                    $location->area_code = $request->area_code;
    
                $newLocation = $location->save();
    
                if($newLocation){
                    return response()->json($newLocation);
                }
            }
                else{
                    return "Location Not Saved.";
                }
    
            } catch(\Exception $e){
                return response()->json([
                    "Error"=>"Location Was not Created"
                ]);
            }
        }
    
        public function deleteLocation($id){
            try {
                $existingLocation = location::findOrFail($id);
                if($existingLocation){
                    $existingLocation->destroy($id);
                    return response()->json("Location id `$id` Has been deleted!");
                }
                else{
                    return "Location Not Deleted.";
                }
    
            } catch(\Exception $e){
                return response()->json([
                    "Error"=>"Location Was not Deleted"
                ]);
            }
        }
        
    }
    

