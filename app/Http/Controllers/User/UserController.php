<?php 

namespace App\Http\Controllers\User; 

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;  
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UpdatePasswordUserRequest;
use App\Models\User; 
use App\Models\Role; 
use App\Models\ProblemType; 
use App\Models\ProblemLevel; 

class UserController extends Controller 
{ 
    public function index()
    { 
        $this->authorize('show-user', User::class);

        $users = User::paginate(15);

        return view('users.index', compact('users'));
    }

    public function show($id)
    { 
    	$this->authorize('show-user', User::class);

    	$user = User::find($id);

    	if(!$user){
        	$this->flashMessage('warning', 'User not found!', 'danger');            
            return redirect()->route('user');
        }  

        $roles = Role::all();

		$roles_ids = Role::rolesUser($user);      	               

        return view('users.show',compact('user', 'roles', 'roles_ids'));
    }

    public function create()
    {
        $this->authorize('create-user', User::class);

        $roles = Role::all();

        return view('users.create',compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $this->authorize('create-user', User::class);

        $request->merge(['password' => bcrypt($request->get('password'))]);

        $user = User::create($request->all());

        $roles = $request->input('roles') ? $request->input('roles') : [];

        $user->roles()->sync($roles);

        $this->flashMessage('check', 'User successfully added!', 'success');

        return redirect()->route('user.create');
    }

    public function edit($id)
    { 
    	$this->authorize('edit-user', User::class);

    	$user = User::find($id);

    	if(!$user){
        	$this->flashMessage('warning', 'User not found!', 'danger');            
            return redirect()->route('user');
        }  

        $roles = Role::all();

		$roles_ids = Role::rolesUser($user);       	               

        return view('users.edit',compact('user', 'roles', 'roles_ids'));
    }

    public function update(UpdateUserRequest $request,$id)
    {
    	$this->authorize('edit-user', User::class);

    	$user = User::find($id);

        if(!$user){
        	$this->flashMessage('warning', 'User not found!', 'danger');            
            return redirect()->route('user');
        }

        $user->update($request->all());

        $roles = $request->input('roles') ? $request->input('roles') : [];

        $user->roles()->sync($roles);

        $this->flashMessage('check', 'User updated successfully!', 'success');

        return redirect()->route('user');
    }

    public function updatePassword(UpdatePasswordUserRequest $request,$id)
    {
    	$this->authorize('edit-user', User::class);

    	$user = User::find($id);

        if(!$user){
        	$this->flashMessage('warning', 'User not found!', 'danger');            
            return redirect()->route('user');
        }

        $request->merge(['password' => bcrypt($request->get('password'))]);

        $user->update($request->all());

        $this->flashMessage('check', 'User password updated successfully!', 'success');

        return redirect()->route('user');
    }

    public function editPassword($id)
    { 
    	$this->authorize('edit-user', User::class);

    	$user = User::find($id);

    	if(!$user){
        	$this->flashMessage('warning', 'User not found!', 'danger');            
            return redirect()->route('user');
        }              	               

        return view('users.edit_password',compact('user'));
    }

    public function destroy($id)
    {
        $this->authorize('destroy-user', User::class);

        $user = User::find($id);

        if(!$user){
            $this->flashMessage('warning', 'User not found!', 'danger');            
            return redirect()->route('user');
        }

        $user->delete();

        $this->flashMessage('check', 'User successfully deleted!', 'success');

        return redirect()->route('user');
    }
    public function addtype(Request $request)
    {
        return view('users.addtype');
    }
    public function addlevel(Request $request)
    {
        return view('users.addlevel');
    }
    public function problem(Request $request)
    {
        $this->validate($request, [
            'problem_type' => 'required|unique:problem_types,problem_type' 
        ]);
        $type = ProblemType::create($request->all());
        
        $this->flashMessage('check', 'Problem type successfully added!', 'success');

        return redirect()->route('problemlist');
    }
    public function problemlist(Request $request)
    {
        $list = ProblemType::orderBy('id', 'DESC')->paginate(15);

        return view('users.problemlist', compact('list'));
    }
    public function level(Request $request)
    {
        $this->validate($request, [
            'problem_level' => 'required|unique:problem_levels,problem_level' 
        ]);
       
        $level = ProblemLevel::create($request->all());
        

        $this->flashMessage('check', 'Problem level successfully added!', 'success');

        return redirect()->route('levellist');
    }
    public function levellist(Request $request)
    {
        $list = ProblemLevel::orderBy('id', 'DESC')->paginate(15);

        return view('users.levellist', compact('list'));
    }
    public function destroyproblem($id)
    {
        $record = ProblemType::find($id);

        if(!$record){
            $this->flashMessage('warning', 'Item not found!', 'danger');            
            return redirect()->route('problemlist');
        }

        $record->delete();

        $this->flashMessage('check', 'Item successfully deleted!', 'success');

        return redirect()->route('problemlist');
    }
    public function destroylevel($id)
    {
        $record = ProblemLevel::find($id);

        if(!$record){
            $this->flashMessage('warning', 'Item not found!', 'danger');            
            return redirect()->route('levellist');
        }

        $record->delete();

        $this->flashMessage('check', 'Item successfully deleted!', 'success');

        return redirect()->route('levellist');
    }
}