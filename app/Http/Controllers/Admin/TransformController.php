<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transform;
use Illuminate\Support\Facades\Response;
use DataTables;
use PDF;


class TransformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        $metaTitle = 'Transport Summary - Cosmic ERP';
        if ($request->ajax()) {
        $query = Transform::select('id','name','phone','location','pin')->orderBy('id', 'desc');
        // $searchTerm = $request->get('search')['value'];
        if ($request->has('SearchData') && !empty($request->SearchData)) {
            $search = $request->get('SearchData');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%')
                  ->orWhere('location', 'like', '%' . $search . '%')
                  ->orWhere('pin', 'like', '%' . $search . '%');
            });
        }
        return DataTables::of($query)
            ->addColumn('name', function ($transport) {
                return $transport->name ?? '-';
            })
            ->addColumn('phone', function ($transport) {
                return $transport->phone ?? '-';
            })
            ->addColumn('location', function ($transport) {
                return $transport->location ?? '-';
            })
            ->addColumn('pin', function ($transport) {
                return $transport->pin ?? '-';
            })
            ->addColumn('action', function($transport) {
                $editUrl = route('transport.edit', $transport->id);
                // $deleteUrl = route('transports.destroy', $transport->id);
                $pdfUrl = route('transport.pdf', $transport->id);
                $printUrl = route('transport.print', $transport->id);
                $viewUrl = route('transport.view', $transport->id);
                $btn = '';
                if (auth()->user()->can('Transport Edit')) {
                    $btn = '<a href="' . $editUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons share-icon-tag"></span></a>';
                }
                $btn .= '<a href="' . $viewUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons eye-icon-tag"></span></a>';

                if (auth()->user()->can('Transport Pdf')) {
                    
                $btn .= '<a href="' . $pdfUrl . '" class="btn-sm m-1" target="_blank"><i class="files-group-icons files-icon-tag"></i></a>';
                }
                if (auth()->user()->can('Transport Print')) {
                    
                $btn .= '<a href="' . $printUrl . '" class="btn-sm m-1" target="_blank"><i class="printss-group-icons printss-icon-tag"></i></a>';
                }
                if (auth()->user()->can('Transport Delete')) {
                    
                $btn .= '<a href="javascript:void(0)" class="btn-sm m-1 delete-transport" data-id="' . $transport->id . '"><span class="table-group-icons edit-icon-tag"></span></a>';
                }
                
                
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.transports.index',compact('metaTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $metaTitle = 'Create Transport - Cosmic ERP';
        return view('admin.transports.create',compact('metaTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15|unique:transforms,phone',
            'location' => 'required|string|max:255',
            'pin' => 'required|string|max:10',
        ]);

        $transform =Transform::create($request->all());
        return redirect()->route('transport.index')->with('success', 'transport created successfully!');

    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15|unique:transforms,phone',
            'location' => 'required|string|max:255',
            'pin' => 'required|string|max:10',
        ]);

        $transform =Transform::create($request->all());

        return response()->json([
            'success' => 'Data saved successfully!',
            'newOption' => [
                'value' => $transform->id,
                'text' => $transform->name
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transports = Transform::find($id);
        return view('admin.transports.view', compact('transports'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $metaTitle = 'Edit Transport - Cosmic ERP';
        $transports = Transform::find($id);
        return view('admin.transports.edit', compact('transports','metaTitle'));
    }
    public function print($id)
    {
        $transports = Transform::find($id);
        return view('admin.transports.print', compact('transports'));
    }
    public function generatePDF($id)
    {
        $transports = Transform::find($id);
        $data = compact('transports');
        $pdf = PDF::loadView('admin.transports.pdf', $data);

        return $pdf->download('transport' . $id . '.pdf');
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
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15|unique:transforms,phone,' . $id,
            'location' => 'required|string|max:255',
            'pin' => 'required|string|max:10',
        ]);
        $transform = Transform::findOrFail($id);
        $transform->update($request->all());
        return redirect()->route('transport.index')->with('success', 'transport Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transport = Transform::findOrFail($id);
        if($transport){
            $transport->delete();
            return Response::json(['success' => 'transport deleted successfully.']);    
        }
        return Response::json(['error' => 'transport not found.'], 404);
    }
}
