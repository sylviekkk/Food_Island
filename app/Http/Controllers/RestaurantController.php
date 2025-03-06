<?php

namespace App\Http\Controllers;
use App\Models\Restaurant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function createRestaurant(Request $request){
        $request->validate(
            [
                'name'=>'required',
                'location_id'=>'required|integer|exists:locations,id'
            ]
        );
        
            $Restaurant = new Restaurant();
            $Restaurant->name = $request->name;
            $Restaurant->location_id = $request->location_id;

            $newRestaurant = $Restaurant->save();

            if($newRestaurant){
                return response()->json(["Created",$Restaurant]);
            }
            else{
                return "Restaurant Not Saved.";
            }

    }

    public function index(){
        try{
            $Restaurant = Restaurant::all();

            if($Restaurant){
                return response()->json($Restaurant);
            }
            else{
                return "No Restaurant Was found";
            }
        } catch(\Exception $e){
            return response()->json([
                "Error"=>"No Restaurant Was Found!"
            ]);
        }
    }

    public function getRestaurant($id){
        try{
            $Restaurant = Restaurant::findOrFail($id);

            if($Restaurant){
                return response()->json($Restaurant);
            }
            else{
                return "Restaurant With id `$id` Was not found";
            }
        } catch(\Exception $e){
            return response()->json([
                "Error"=>"Restaurant Not Found!"
            ]);
        }
    }

    
    public function updateRestaurant(Request $request, $id){
        $request->validate(
            [
                'name'=>'required',
                'location_id'=>'required'
            ]
        );

        try{
            $Restaurant = Restaurant::findOrFail($id);
            if($Restaurant){
                $Restaurant->name=$request->name;
                $Restaurant->location_id = $request->location_id;

            $newRestaurant = $Restaurant->save();

            if($newRestaurant){
                return response()->json($newRestaurant);
            }
        }
            else{
                return "Restaurant Not Saved.";
            }

        } catch(\Exception $e){
            return response()->json([
                "Error"=>"Restaurant Was not Created"
            ]);
        }
    }

    public function deleteRestaurant($id){
        try {
            $existingRestaurant = Restaurant::findOrFail($id);
            if($existingRestaurant){
                $existingRestaurant->destroy($id);
                return response()->json("Restaurant id `$id` Has been deleted!");
            }
            else{
                return "Restaurant Not Deleted.";
            }

        } catch(\Exception $e){
            return response()->json([
                "Error"=>"Restaurant Was not Deleted"
            ]);
        }
    }
}
