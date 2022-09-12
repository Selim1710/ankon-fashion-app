<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
 
    public function manageSupplier()
    {
        $suppliers = User::all();
        return view('admin.layouts.supplier.supplier_table',compact('suppliers'));

    }

    public function add()
    {
        return view('admin.layouts.supplier.add_supplier');
    }
    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|max:20',
            'phone' => 'required',
            'password' => 'required',
            'address' => 'required',
            'role' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
            'address' => $request->address,
            'role' => $request->role,
        ]);
        return redirect()->route('admin.manage.supplier')->with('message', 'Supplier added successfully');
    }

    public function edit($id)
    {
        $supplier = User::find($id);
        return view('admin.layouts.supplier.edit_supplier', compact('supplier'));
    }

    public function delete($id)
    {
        //
    }

    
    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
