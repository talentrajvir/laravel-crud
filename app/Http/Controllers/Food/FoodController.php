<?php 

namespace App\Http\Controllers\Food; 

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 
use App\Models\Role;
use App\Models\User;
use App\Models\Food;



class FoodController extends Controller 
{ 
	public function __construct() 
	{ 
		$this->middleware("auth");
	} 

	public function index() 
	{ 
		return view('food.index');
	}
    public function saveFoodDetails(Request $request)
    { 
        //check if all details are provided
        $this->validate($request, [
            'pcode' => 'required',
            'pname' => 'required',
            'time' => 'required',
            'food_type' => 'required',
            'ingredients' => 'required',
        ]);

        //get current user's id
        $userId = Auth::id();
        $food = new Food;//save data in foods table
        $food->pcode = $request->input('pcode');
        $food->user_id = $userId;
        $food->pname = $request->input('pname');
        $food->time = $request->input('time');
        $food->receipe = $request->input('food_type');
        $food->ingredients = $request->input('ingredients');
        $food->save();

        return redirect()->route('foodListing');
    }
    public function foodListing()
    { 
         //get current user's id
        $userId = Auth::id();//get data from foods table
        $foodList = Food::where('user_id',$userId)->orderBy('id', 'DESC')->paginate(15);

        return view('food.list', compact('foodList'));
    }
    public function destroy($id)
    {

        $food = Food::find($id);//find data from foods table

        if(!$food){
            $this->flashMessage('warning', 'Item not found!', 'danger');            
            return redirect()->route('foodListing');
        }

        $food->delete();//remove data from foods table

        $this->flashMessage('check', 'Item successfully deleted!', 'success');

        return redirect()->route('foodListing');
    }

	
}