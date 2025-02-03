<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RecipeMaster;
use App\Models\Material;
use App\Models\RecipeMaterial;
use App\Models\MaterialSubCategory;
use DataTables;
use DB;
use Illuminate\Support\Facades\Response;



class RecipeMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $metaTitle = 'Recipe Summary - Cosmic ERP';
        if ($request->ajax()) {
            $query = RecipeMaster::select('id','recipe_name','status');
            if ($request->has('SearchData') && !empty($request->SearchData)) {
                $search = $request->get('SearchData');
                $query->where('recipe_name', 'like', '%' . $search . '%'); // Filter permissions by name
            }
            return DataTables::of($query)
            ->addColumn('recipe_name', function ($recipe) {
                return $recipe->recipe_name ?? '-';
            })
            ->addColumn('status', function ($recipe) {
                return $recipe->status ? 'Active' : 'Inactive';
            })
            ->addColumn('action', function($recipe) {
                $editUrl = route('recipes.edit', $recipe->id);
                $btn = '';
                    $btn = '<a href="' . $editUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons share-icon-tag"></span></a>';
                    $btn .= '<a href="javascript:void(0)" class="btn-sm m-1 delete-recipe" data-id="' . $recipe->id . '"><span class="table-group-icons edit-icon-tag"></span></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->orderColumn('recipe_name', function ($query, $order) {
                $query->orderBy('recipe_name', $order); // Correct ordering logic for 'name'
            })
            ->make(true);
        }
        return view('admin.recipe.index',compact('metaTitle'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $metaTitle = 'Create Recipe - Cosmic ERP';
        $materials = Material::select('id','material_name','sub_category')->where('category_id',1)->get();
        $submaterials = MaterialSubCategory::select('id','sub_cat_name',)->where('parent_category_id',1)->get();
        return view('admin.recipe.create', compact('metaTitle','materials','submaterials'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $validated = $request->validate([
            'recipe_name' => 'required|string',  // Ensure 'recipe_name' is an array
            'top_layer'=> 'min:0|max:100',
            'middle_layer'=> 'min:0|max:100',
            'material_id.*' => 'required|string',
            'submaterial_id.*' => 'required|string',
            'up.*' => 'required|string',
            'down.*' => 'required|string',
            'percentage.*' => 'required|string',

        ], [
            'recipe_name.required' => 'Please enter Recipe Name.',
            'top_layer.integer' => 'Please enter top Layer.',
            'middle_layer.integer' => 'Please enter Middle Layer.',
        ]);
        $RecipeMasters = RecipeMaster::create([
            'recipe_name' => $request->recipe_name,
            'top_layer' => $request->top_layer,
            'middle_layer' => $request->middle_layer,
            'status' => $request->status,
        ]);
        foreach ($validated['material_id'] as $key => $materialId) {
            RecipeMaterial::create([
                'recipe_master_id' => $RecipeMasters->id,
                'material_id' => $materialId,
                'submaterial_id'=>$validated['submaterial_id'][$key] ?? null,
                'up' => $validated['up'][$key] ?? null,
                'downs' => $validated['down'][$key] ?? null,
                'percentage' => $validated['percentage'][$key] ?? null,
            ]);
        }
        return redirect()->route('recipes.index')->with('success', 'Recipe created successfully!');
     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $metaTitle = 'Edit Recipe - Cosmic ERP';
        $recipe = RecipeMaster::find($id);
        $materials = Material::select('id','material_name','sub_category')->where('category_id',1)->get();
        $RecipeMaterials = RecipeMaterial::where('recipe_master_id',$id)->get();
        // $materials = Material::select('id','material_name','sub_category')->where('category_id',1)->get();
        $submaterials = MaterialSubCategory::select('id','sub_cat_name',)->where('parent_category_id',1)->get();
        return view('admin.recipe.edit', compact('metaTitle','recipe','materials','RecipeMaterials','submaterials'));
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
        $validatedData = $request->validate([
            'recipe_name' => 'required|string',  // Ensure 'recipe_name' is an array
            'top_layer' => 'min:0|max:100',  // Ensure 'recipe_name' is an array
            'middle_layer' => 'min:0|max:100',  // Ensure 'recipe_name' is an array
            'material_id.*' => 'required|string',
            'submaterial_id.*' => 'required|string',
            'up.*' => 'required|string',
            'down.*' => 'required|string',
            'percentage.*' => 'required|string',

        ], [
            'recipe_name.required' => 'Please enter Recipe Name.',
            'top_layer.integer' => 'Please enter Top Layer.',
            'middle_layer.integer' => 'Please enter Middle Layer.',
        ]);
        $recipe = RecipeMaster::findOrFail($id);
        $recipe->update([ 
            'recipe_name' => $request->recipe_name,
            'top_layer' => $request->top_layer,
            'middle_layer' => $request->middle_layer,
            'status' => $request->status,]);
        $recipe->save();
    
        // Delete existing items associated with this price list
        RecipeMaterial::where('recipe_master_id', $id)->delete();
    
        // Recreate items with data from the request
        if (!empty($validatedData['material_id'])) {
            foreach ($validatedData['material_id'] as $index => $materialId) {
                RecipeMaterial::create([
                    'recipe_master_id' => $recipe->id,
                    'material_id' => $materialId,
                    'submaterial_id' => $validatedData['submaterial_id'][$index] ?? null,
                    'up' => $validatedData['up'][$index] ?? null,
                    'downs' => $validatedData['down'][$index] ?? null,
                    'percentage' => $validatedData['percentage'][$index] ?? null,
                ]);
            }
        }
        
        return redirect()->route('recipes.index')->with('success', 'Recipe updated successfully!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recipe = RecipeMaster::findOrFail($id);
        if($recipe){
            $recipe->delete();
            return Response::json(['success' => 'Recipe deleted successfully.']);    
        }
        return Response::json(['error' => 'Recipe not found.'], 404);
    }
}
