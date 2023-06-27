<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//agregamos
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;


class RolController extends Controller
{
    function __construct()
    {
         
         $this->middleware('permission:roles', ['only' => ['create','store' , 'destroy' , 'edit','update' , 'index' ]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
         //Con paginación
         $roles = Role::paginate(5);
         return view('roles.index',compact('roles'));
         //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $roles->links() !!} 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('roles.crear',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index');                        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{
    $role = Role::find($id);
    $permissions = Permission::get();
    $rolePermissions = DB::table("role_has_permissions")
        ->where("role_has_permissions.role_id", $id)
        ->pluck('role_has_permissions.permission_id')
        ->all();

    return view('roles.show', compact('role', 'permissions', 'rolePermissions'));
}
    



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('roles.editar',compact('role','permission','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index');                        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function destroy($id)
     {
         $role = Role::findOrFail($id);
     
         if ($role->users()->exists()) {
             return redirect()->route('roles.index')->with('error', 'No se puede eliminar el rol porque tiene usuarios asociados.');
         }
     
         $restrictedRoles = ['administrador', 'cliente'];
     
         if (in_array($role->name, $restrictedRoles)) {
             return redirect()->route('roles.index')->with('error', 'Este rol no se puede eliminar del sistema.');
         }
     
         $role->delete();
     
         return redirect()->route('roles.index')->with('success', 'Rol eliminado correctamente.');
     }
    public function updateStatus($id)
    {
        $role = Role::find($id);
        $role->is_active = !$role->is_active; // Invierte el estado actual
        $role->save();

        return redirect()->route('roles.index')->with('success', 'Estado del rol actualizado correctamente.');
    }
    
    
}
