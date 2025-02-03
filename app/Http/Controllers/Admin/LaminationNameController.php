<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaminationName;
use DataTables;
use Illuminate\Support\Facades\Response;
use PDF;

class LaminationNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $metaTitle = 'Lamination Summary - Cosmic ERP';
        if ($request->ajax()) {
            $query = LaminationName::select('id','paper_name','lamination_name','gum_name','lamination_type');
            if ($request->has('SearchData') && !empty($request->SearchData)) {
                $search = $request->get('SearchData');
                $query->where(function($q) use ($search) {
                    $q->where('paper_name', 'like', '%' . $search . '%')
                      ->orWhere('lamination_name', 'like', '%' . $search . '%')
                      ->orWhere('gum_name', 'like', '%' . $search . '%')
                      ->orWhere('lamination_type', 'like', '%' . $search . '%');
                });
            }
            return DataTables::of($query)
                ->addColumn('paper_name', function ($lamination) {
                    return $lamination->paper_name ?? '-';
                })
                ->addColumn('lamination_name', function ($lamination) {
                    return $lamination->lamination_name ?? '-';
                })
                ->addColumn('gum_name', function ($lamination) {
                    return $lamination->gum_name ?? '-';
                })
                ->addColumn('lamination_type', function ($lamination) {
                    return $lamination->lamination_type ?? '-';
                })
                ->addColumn('action', function($lamination) {
                    $editUrl = route('laminations.edit', $lamination->id);
                    $pdfUrl = route('lamination.pdf', $lamination->id);
                    $printUrl = route('lamination.print', $lamination->id);
                    $viewUrl = route('lamination.view', $lamination->id);
                    // $deleteUrl = route('transports.destroy', $transport->id);
                    $btn = '';
                    if (auth()->user()->can('laminations Edit')) {
                        $btn = '<a href="' . $editUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons share-icon-tag"></span></a>';
                    }
                    $btn .= '<a href="' . $viewUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons eye-icon-tag"></span></a>';

                    if (auth()->user()->can('laminations Pdf')) {
                        $btn .= '<a href="' . $pdfUrl . '" class="btn-sm m-1" target="_blank"><i class="files-group-icons files-icon-tag" ></i></a>';
                    }
                    if (auth()->user()->can('laminations Print')) {
                        $btn .= '<a href="' . $printUrl . '" class="btn-sm m-1" target="_blank"><i class="printss-group-icons printss-icon-tag" ></i></a>';
                    }
                    if (auth()->user()->can('laminations Delete')) {
                        $btn .= '<a href="javascript:void(0)" class="btn-sm m-1 delete-transport" data-id="' . $lamination->id . '"><span class="table-group-icons edit-icon-tag"></span></a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->orderColumn('paper_name', 'paper_name $1')
                ->orderColumn('lamination_name', 'lamination_name $1')
                ->orderColumn('gum_name', 'gum_name $1')
                ->orderColumn('lamination_type', 'lamination_type $1')
                ->make(true);
            }
            return view('admin.lamination.index',compact('metaTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $metaTitle = 'Create Lamination - Cosmic ERP';
        return view('admin.lamination.create',compact('metaTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'paper_name.required' => 'Please enter Paper Name.',
            'lamination_name.required' => 'Please enter Lamination Name.',
            'gum_name.required' => 'Please enter Gum Name.',
            'lamination_type.required' => 'Please enter Lamination Type.',
        ]; 
        $request->validate([
            'paper_name' => 'required|string|max:255',
            'lamination_name' => 'required|string',
            'gum_name' => 'required|string|max:255',
            'lamination_type' => 'required|string|max:255',
        ], $messages);

        $Lamination =LaminationName::create($request->all());
        return redirect()->route('laminations.index')->with('success', 'Lamination created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $metaTitle = 'View Lamination - Cosmic ERP';
        $laminnations = LaminationName::find($id);
        return view('admin.lamination.view', compact('laminnations','metaTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $metaTitle = 'Edit Lamination - Cosmic ERP';
        $laminnations = LaminationName::find($id);
        return view('admin.lamination.edit', compact('laminnations','metaTitle'));
    }

    public function print($id)
    {
        $laminnations = LaminationName::find($id);
        return view('admin.lamination.print', compact('laminnations'));
    }
    public function generatePDF($id)
    {
        $laminnations = LaminationName::find($id);
        $data = compact('laminnations');
        $pdf = PDF::loadView('admin.lamination.pdf', $data);

        return $pdf->download('lamination' . $id . '.pdf');
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
        $messages = [
            'paper_name.required' => 'Please enter Paper Name.',
            'lamination_name.required' => 'Please enter Lamination Name.',
            'gum_name.required' => 'Please enter Gum Name.',
            'lamination_type.required' => 'Please enter Lamination Type*.',
        ];
        $request->validate([
            'paper_name' => 'required|string|max:255',
            'lamination_name' => 'required|string|max:255',
            'gum_name' => 'required|string|max:255',
            'lamination_type' => 'required|string|max:255',
        ],$messages);
        $lamination = LaminationName::findOrFail($id);
        $lamination->update($request->all());
        return redirect()->route('laminations.index')->with('success', 'Lamination Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lamination = LaminationName::findOrFail($id);
        if($lamination){
            $lamination->delete();
            return Response::json(['success' => 'lamination deleted successfully.']);    
        }
        return Response::json(['error' => 'lamination not found.'], 404);
    }
}
