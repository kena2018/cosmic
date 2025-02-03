<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use DataTables;
use App\Models\Product;
use App\Models\MaterialCategory;
use App\Models\Stock;
use App\Models\MaterialSubCategory;
use Illuminate\Support\Facades\Response;
use PDF;

class MaterialStockController extends Controller
{
    public function index(Request $request)
    {
        $metaTitle = 'Stock Summary - Cosmic ERP';

        if ($request->ajax()) {
            $query = Stock::query();
        
            // Apply search filters
            if ($request->has('SearchData') && !empty($request->SearchData)) {
                $search = $request->get('SearchData');
                $query->where(function ($q) use ($search) {
                    $q->where('unit1_value', 'like', '%' . $search . '%')
                      ->orWhere('unit1', 'like', '%' . $search . '%')
                      ->orWhere('id', 'like', '%' . $search . '%')
                      ->orWhereHas('material', function ($materialQuery) use ($search) {
                          $materialQuery->where('material_name', 'like', '%' . $search . '%');
                      })
                      ->orWhereHas('category', function ($categoryQuery) use ($search) {
                          $categoryQuery->where('name', 'like', '%' . $search . '%');
                      })
                      ->orWhereHas('materialSubCategory', function ($materialSubQuery) use ($search) {
                          $materialSubQuery->where('sub_cat_name', 'like', '%' . $search . '%');
                      });
                });
            }
        
            return DataTables::of($query)
                ->addColumn('material_name', function ($stock) {
                    return $stock->material ? $stock->material->material_name : '-';
                })
                ->addColumn('category_id', function ($stock) {
                    return $stock->category ? $stock->category->name : '-';
                })
                ->addColumn('sub_category', function ($stock) {
                    return $stock->materialSubCategory ? $stock->materialSubCategory->sub_cat_name : '-';
                })
                ->addColumn('action', function ($stock) {
                    $viewUrl = route('materialStock.view', $stock->id);
                    $pdfUrl = route('materialStock.pdf', $stock->id);
                    $printUrl = route('materialStock.print', $stock->id);
                    $btn = '';
        
                    if (auth()->user()->can('Material Stock Pdf')) {
                        $btn .= '<a href="' . $pdfUrl . '" class="btn-sm m-1" target="_blank"><i class="files-group-icons files-icon-tag"></i></a>';
                    }
                    if (auth()->user()->can('Material Stock Print')) {
                        $btn .= '<a href="' . $printUrl . '" class="btn-sm m-1" target="_blank"><i class="printss-group-icons printss-icon-tag"></i></a>';
                    }
        
                    return $btn;
                })
                ->rawColumns(['action'])
                
                ->orderColumn('unit1_value', 'unit1_value $1')
                ->orderColumn('unit1', 'unit1 $1')
                ->make(true);
        }
        

        return view('admin.material-stock.index', compact('metaTitle'));
    }
    public function show($id)
    {
        $metaTitle = 'View Stock - Cosmic ERP';
        $stock = Stock::findOrFail($id);
        return view('admin.material-stock.view', compact('stock','metaTitle'));
    }
    public function pdf($id)
    {
        $stock = Stock::findOrFail($id);
        $data = compact('stock');
        $pdf = PDF::loadView('admin.material-stock.pdf', $data);
        // return view('admin.material-stock.pdf', compact('stock'));
        return $pdf->download('material-stock' . $id . '.pdf');
    }
    public function print($id)
    {
        $stock = Stock::findOrFail($id);
        return view('admin.material-stock.print', compact('stock'));
    }
}
