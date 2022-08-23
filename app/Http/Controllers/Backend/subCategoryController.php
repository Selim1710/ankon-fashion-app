<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;

use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function manageSubCategory()
    {
        $subcategory = Subcategory::with('category')->orderBy('id','desc')->get();
        return view('admin.layouts.subCategory.subCategory_table', compact('subcategory'));
    }

    public function addSubCategory()
    {
        $categories = Category::select('id', 'category_name')->get();
        return view('admin.layouts.subCategory.add_subCategory', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sub_category_name' => 'required|unique:subcategories|max:20'
        ]);
        Subcategory::create([
            'sub_category_name' => $request->sub_category_name,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('admin.manage.subCategory')->with('message', 'Sub-Category added successfully');
    }

    public function edit($id)
    {
        $subCategory = Subcategory::find($id);
        return view('admin.layouts.subCategory.edit_subCategory', compact('subCategory'));
    }
    public function update(Request $request,$id){
        $subCategory = Subcategory::find($id);
        $subCategory->update([
            'sub_category_name' => $request->sub_category_name,
        ]);
        return redirect()->route('admin.manage.subCategory')->with('message', 'Sub-Category Updated Successfully');

    }
    public function delete($id){
        $subCategory = Subcategory::find($id);
        $subCategory->delete();
        return redirect()->route('admin.manage.subCategory')->with('error', 'Sub-Category Deleted');
    }
}
