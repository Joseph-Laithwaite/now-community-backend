<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Independent;

class IndependentController extends Controller
{
    public function index(){
    	$independents = Independent::with('brands')->latest()->paginate(5);
    	return view('$independents.index', compact('$independents'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show(int $independent_id){
        return Independent::find($independent_id);
    }


    public function store(Request $request)
    {   
        $this->validate($request, [
            'name' => 'required',
            /*'email' => 'required',
            'type' => 'required',*/
        ]);

        return Independent::create([
           'name' => $request['name'],
           /*'email' => $request['email'],
           'password' => \Hash::make($request['password']),
           'type' => $request['type'],*/
        ]);
    }


    public function update(Request $request, $id)
    {   
        $this->validate($request, [
            'name' => 'required',
            /*'email' => 'required',
            'type' => 'required',*/
        ]);

        $Independent = Independent::findOrFail($id);

        $Independent->update($request->all());
    }

    public function destroy($id)
    {
        $Independent = Independent::findOrFail($id);
        $Independent->delete();
        return response()->json([
         'message' => 'Independent deleted successfully'
        ]);
    }

}
