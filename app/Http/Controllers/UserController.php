<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Independent;

use Illuminate\Validation\Rule;

use Illuminate\Support\Collection;

use App\Http\Controllers\AppBaseController;

use App\Models\UserPermission;


class UserController extends AppBaseController
{
    public function index(Request $request){
		$query = '%'.$request->nameQuery.'%';
		$orderBy = ($request->orderBy == null ? 'first_name' : $request->orderBy) ;
		$orderDirection = ($request->orderDirection == null ? 'asc' : $request->orderDirection) ;
		//$orderDirection = $request->orderDirection;
    	if ($request->perPagePaginate !== null) {
    		$perPage = $request->perPagePaginate;
    		return User::where('first_name', 'like', $query)
	            ->orWhere('last_name', 'like', $query)
				->orderby($orderBy, $orderDirection)
				->paginate($perPage);    						
    	}else{
    		return User::where('first_name', 'like', $query)
	            ->orWhere('last_name', 'like', $query)
				->orderby($orderBy, $orderDirection)
				->get();
    	}
    	
    }

    public function show(int $user_id){
        $user = User::find($user_id);
        if(is_null($user)){
        	$error[0]='No user found with the given id';
        	return $error;
        }
        return $user;
    }

    public function destroy(int $user_id){
        $user = User::find($user_id);
        if(is_null($user)){
			return response()->json(    			
    			['status' =>  'ERROR', 
    			'error'    =>  "No user found with the given id"]
				,404);
        }else{
			$user->delete();
			return response()->json([
			    'status' =>  'DELETED', 
			    'user'    =>  $user
			]
			, 200);
        }
    }


    public function store(Request $request){
		$request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
        $user = User::create([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
        ]);

        $user->save();

        return  $user;
    }

    public function update(int $user_id){
		$user = User::find($user_id);
		if(is_null($user)){
        	$error[0]='No user found with the given id';
        	return $error;
        }else{
			request()->validate([
	            'first_name' => ['required', 'string', 'max:255'],
	            'last_name' => ['required', 'string', 'max:255'],
	            'username' => ['required', 'string', 'max:255',  Rule::unique('users')->ignore($user)],
	            'email' => ['required', 'string', 'email', 'max:255',  Rule::unique('users')->ignore($user)],
	        ]);

	        $user->first_name = request('first_name');
	        $user->last_name = request('last_name');
	        $user->username = request('username');
	        $user->email = request('email');

	        $user->save();

	        return $user;
	    }
        
    }

    public function signInPermissions(Request $request){

        $signedInUser = $request->User();
        // dd($signedInUser); 
        $myIndependents = UserPermission::
            with('permission')
            ->with('independent')
            ->
            where('user_id', '=', $signedInUser['id'])
            ->get();
        // dd($myIndependents->toArray());
        // ->groupBy('independent_id')
        return $this->sendResponse($myIndependents->toArray(), 'Independent permissions retrieved successfully');

        // dd($myIndependents->toArray());

     //    // dd($request->User());
	    // $signedInUser = $request->User();
     //    $userPermissions =  User::with('userPermission.permission')
     //    						->with('userPermission.independent')
     //    						->where('id', $signedInUser['id'])
     //    						->get();
     //    $userPermissions = $userPermissions
     //    		->pluck('userPermission')
     //    		->flatten()
     //    		->groupBy('independent_id')
    	// 		;

    	// return $userPermissions;

	}
}
