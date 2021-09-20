<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ApiResponser;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function index() 
    {
        $users = $this->user::all();
        
        return $this->validResponse($users);
    }
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password'=> 'required|min:8|confirmed',
            'application_id' => 'required',
        ];

        $this->validate($request, $rules);

        try {
            DB::beginTransaction();

            $user = $this->user::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            $user->applications()->attach($request->application_id);

            $user->roles()->attach(2);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
      
        return $this->validResponse($user, Response::HTTP_CREATED);
    }
    public function show($id)
    {   
        $user = $this->user::find($id);

        return $this->validResponse($user);
       
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'max:255',
            'email' => 'email|unique:user,email' . $id,
            'password'=> 'min:8|confirmed',
        ];
        $this->validate($request, $rules);

        $user = $this->user::findOrFail($id);

        if($user->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
       
        $user->update($request->all());

        return $this->validResponse($user);
    }
    public function destory($id) 
    {
        $user = $this->user::findOrFail($id);

        $user->delete();

        return $this->validResponse($user);
    }
    public function me(Request $request) 
    {
        return $this->validResponse($request->user());
    }
}
