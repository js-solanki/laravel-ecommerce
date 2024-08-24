<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(5);
        return view('dashboard.role.list')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.role.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data =  $request->all();
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'status' => 'required|numeric'
       ]);
   
       Role::create([
        'name' => $request->input('name'),
        'status' => $request->input('status'),
        ]);
        return redirect()->route('admin-role-list')->with('success', 'Form submitted successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        return view('dashboard.role.add', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        
        if ($id) {
            $role = Role::findOrFail($id);
            $request->validate([
               'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
               'status' => 'required|numeric'
            ]);
           
            $role->update([
                  'name' => $request->input('name'),
                  'status' => $request->input('status'),
            ]);
            return redirect()->route('admin-role-list')->with('success', 'Role updated successfully');
         } else {
            return view('dashboard.role.add');
         }
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
        //
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
       $role->delete();
       return redirect()->route('admin-role-list')->with('success', 'Role deleted successfully');
    }
}
