<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerOrder;
use App\Models\Material;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdersExport;
use DataTables;
use Session;
use App\Models\LaminationProductionOrder;
use App\Models\ExtruderProductionOrder;
use App\Models\RewindingProductionOrder;
use App\Models\StitchingProductionOrder;
use App\Models\PackingProductionOrder;
use App\Models\Customer;
use App\Models\MaterialIn;
use App\Models\MaterialOut;
use App\Models\LaminationOrderHistory;
use App\Models\ExtruderOrderHistory;
use App\Models\RewindingOrderHistory;
use App\Models\PackingOrderHistory;
use App\Models\StitchingOrderHistory;
use Carbon\Carbon;
use PDF;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $metaTitle = 'Reports Summary - Cosmic ERP';
        if ($request->ajax()) {
            $query = CustomerOrder::with('customer')
                ->select(['id', 'customer_id', 'order_date', 'status'])->orderBy('id', 'desc');
        
            if ($request->start_date) {
                $query->whereDate('order_date', '>=', $request->start_date);
            }
            if ($request->end_date) {
                $query->whereDate('order_date', '<=', $request->end_date);
            }
            if ($request->status) {
                $query->where('status', $request->status);
            }
            if ($request->customer_name) {
                $query->whereHas('customer', function($q) use ($request) {
                    $q->where('first_name', 'like', '%' . $request->customer_name . '%');
                });
            }
        
            return DataTables::of($query)
                ->editColumn('customer_id', function ($order) {
                    return $order->customer ? $order->customer->first_name : '-';
                })
                ->make(true);
        }
        
        $chartDataQuery = CustomerOrder::selectRaw('DATE(order_date) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date');
        
        if ($request->start_date) {
            $chartDataQuery->whereDate('order_date', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $chartDataQuery->whereDate('order_date', '<=', $request->end_date);
        }
        if ($request->status) {
            $chartDataQuery->where('status', $request->status);
        }
        if ($request->customer_name) {
            $chartDataQuery->whereHas('customer', function($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->customer_name . '%');
            });
        }
        
        $chartData = $chartDataQuery->get();
        
        return view('admin.reports.index', [
            'chartData' => $chartData
        ],compact('metaTitle'));
    }

    public function orderReports(Request $request)
{
    $metaTitle = 'Order Reports - Cosmic ERP';

    // Fetch all customers for the dropdown
    $customers = Customer::select('id', 'company_name')->orderBy('company_name')->get();

    info('999999999');
    info($request->customer_name);

    if ($request->ajax()) {
        $query = CustomerOrder::with('customer')
            ->select(['id', 'customer_id', 'order_date', 'status'])->orderBy('id', 'desc');
    
        if ($request->start_date) {
            $query->whereDate('order_date', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->whereDate('order_date', '<=', $request->end_date);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->customer_name) {
            $query->whereHas('customer', function($q) use ($request) {
                $q->where('company_name', 'like', '%' . $request->customer_name . '%');
            });
        }
    
        return DataTables::of($query)
            ->editColumn('customer_id', function ($order) {
                return $order->customer ? $order->customer->company_name : '-';
            })
            ->make(true);
    }
    
    $chartDataQuery = CustomerOrder::selectRaw('DATE(order_date) as date, COUNT(*) as count')
        ->groupBy('date')
        ->orderBy('date');
    
    if ($request->start_date) {
        $chartDataQuery->whereDate('order_date', '>=', $request->start_date);
    }
    if ($request->end_date) {
        $chartDataQuery->whereDate('order_date', '<=', $request->end_date);
    }
    if ($request->status) {
        $chartDataQuery->where('status', $request->status);
    }
    if ($request->customer_name) {
        $chartDataQuery->whereHas('customer', function($q) use ($request) {
            $q->where('company_name', 'like', '%' . $request->customer_name . '%');
        });
    }
    
    $chartData = $chartDataQuery->get();
    
    return view('admin.reports.orders', [
        'chartData' => $chartData,
        'customers' => $customers
    ], compact('metaTitle'));
}

    public function export(Request $request)
    {
        return Excel::download(new OrdersExport($request), 'orders_report.xlsx');
    }
 
    function formatIndianCurrency($number) {
        $number = (string) $number;
    
        if (strpos($number, '.') !== false) {
            list($integerPart, $decimalPart) = explode('.', $number);
        } else {
            $integerPart = $number;
            $decimalPart = '';
        }

        $integerPart = str_replace(',', '', $integerPart);

        $lastThreeDigits = substr($integerPart, -3);
        $otherDigits = substr($integerPart, 0, -3);
    
        if ($otherDigits !== '') {

            $otherDigits = preg_replace('/(?<=\d)(?=(\d{2})+(?!\d))/', ',', $otherDigits);
            $integerPart = $otherDigits . ',' . $lastThreeDigits;
        } else {
            $integerPart = $lastThreeDigits;
        }
    
        if ($decimalPart !== '') {
            return '₹.' . $integerPart . '.' . $decimalPart;
        }
    
        return '₹.' . $integerPart;
    }

    
    private function customRound($value) {
        if ($value >= 100000) {
            return round($value, -5);
        } else {
            return round($value, -4);
        }
    }

//     public function laminationReports(Request $request)
// {
//     $metaTitle = 'Lamination Reports - Cosmic ERP';

//     if ($request->ajax()) {
//         $query = LaminationProductionOrder::select(
//             'lamination_production_orders.created_at as date',                 // Date
//             'customer_orders.id as order_id',                      // Sales Order ID
//             'production_order.id as production_order_id',                      // Production Order ID
//             'customers.company_name as customer_name',                         // Customer Name
//             'products.product_name',                                           // Product Name
//             'lamination_production_orders.status',                             // Status
//             'lamination_production_orders.machine',                            // Machine
//             'lamination_production_orders.meter',                              // Meter
//             'production_order.bundle_quantity',                                // Quantity Required
//             'customer_orders.order_id as sales_order_id'                       // Sales Order ID
//         )
//         ->leftJoin('products', 'lamination_production_orders.product_id', '=', 'products.id')
//         ->leftJoin('production_order', 'lamination_production_orders.production_order_id', '=', 'production_order.id')
//         ->leftJoin('product_orders', function($join) {
//             $join->on('lamination_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
//                 ->on('lamination_production_orders.product_id', '=', 'product_orders.product_id');
//         })
//         ->leftJoin('customer_orders', 'lamination_production_orders.customer_order_id', '=', 'customer_orders.id')
//         ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id')
//         ->where('lamination_production_orders.status', 'completed');

//         // Filters for start date, end date, and category
//         if ($request->start_date) {
//             $query->whereDate('lamination_production_orders.created_at', '>=', $request->start_date);
//         }

//         if ($request->end_date) {
//             $query->whereDate('lamination_production_orders.created_at', '<=', $request->end_date);
//         }

//         if ($request->category) {
//             $query->whereIn('products.category', $request->category);
//         }

//         // Apply sorting based on request inputs
//         if ($request->has('order')) {
//             $columnIndex = $request->input('order.0.column'); // Get the column index for sorting
//             $sortDirection = $request->input('order.0.dir'); // Get the sort direction (asc/desc)
//             $column = $request->input("columns.$columnIndex.data"); // Get the column name based on index

//             // Define column mappings to database fields
//             $sortableColumns = [
//                 'date' => 'lamination_production_orders.created_at',
//                 'sales_order_id' => 'customer_orders.order_id',
//                 'production_order_id' => 'production_order.id',
//                 'customer_name' => 'customers.company_name',
//                 'product_name' => 'products.product_name',
//                 'status' => 'lamination_production_orders.status',
//                 'bundle_quantity' => 'production_order.bundle_quantity',
//                 'machine' => 'lamination_production_orders.machine',
//                 'meter' => 'lamination_production_orders.meter'
//             ];

//             if (isset($sortableColumns[$column])) {
//                 $query->orderBy($sortableColumns[$column], $sortDirection);
//             } else {
//                 $query->orderBy('lamination_production_orders.id', 'desc'); // Default sort
//             }
//         } else {
//             $query->orderBy('lamination_production_orders.id', 'desc'); // Default sort
//         }

//         return DataTables::of($query)
//             ->addIndexColumn()
//             ->editColumn('date', function ($row) {
//                 return $row->date ? Carbon::parse($row->date)->format('d-m-Y') : '-';
//             })
//             ->editColumn('sales_order_id', fn($row) => $row->sales_order_id ?? '-')
//             ->editColumn('production_order_id', fn($row) => $row->production_order_id ?? '-')
//             ->editColumn('customer_name', fn($row) => $row->customer_name ?? '-')
//             ->editColumn('product_name', fn($row) => $row->product_name ?? '-')
//             ->editColumn('status', fn($row) => $row->status ? ucfirst($row->status) : '-')
//             ->editColumn('bundle_quantity', fn($row) => intVal($row->bundle_quantity) ?? '-')
//             ->editColumn('machine', fn($row) => $row->machine ?? '-')
//             ->editColumn('meter', fn($row) => $row->meter ?? '-')
//             ->make(true);
//     }

//     // Bar Graph Data Calculation
//     $barGraphDataRaw = LaminationProductionOrder::selectRaw(
//         'YEAR(lamination_production_orders.created_at) as year, 
//         SUM(customer_orders.amount) as total_amount'
//     )
//     ->leftJoin('customer_orders', 'lamination_production_orders.customer_order_id', '=', 'customer_orders.id')
//     ->when($request->start_date, fn($query) => $query->whereDate('lamination_production_orders.created_at', '>=', $request->start_date))
//     ->when($request->end_date, fn($query) => $query->whereDate('lamination_production_orders.created_at', '<=', $request->end_date))
//     ->when($request->category, fn($query) => $query->whereIn('products.category', $request->category))
//     ->where('lamination_production_orders.status', 'completed')
//     ->groupBy('year')
//     ->orderBy('year', 'asc')
//     ->get();

//     // Processing Bar Graph Data
//     $barGraphData = [];
//     foreach ($barGraphDataRaw as $data) {
//         if ($data->total_amount == 0) {
//             continue;
//         }
//         $barGraphData[$data->year] = ['amount' => $data->total_amount];
//     }

//     $amounts = array_column($barGraphData, 'amount');
//     $maxAmount = !empty($amounts) ? max($amounts) : 0;
//     $numberOfParts = 6;

//     if ($maxAmount > 0) {
//         $stepValue = ceil($maxAmount / $numberOfParts);
//         $roundedMaxAmount = ceil($maxAmount / $stepValue) * $stepValue;
//     } else {
//         $stepValue = 1;
//         $roundedMaxAmount = 0;
//     }

//     $numberOfSteps = $roundedMaxAmount / $stepValue;
//     foreach ($barGraphData as $year => $data) {
//         $percentage = ($data['amount'] / $roundedMaxAmount) * 100;
//         $barGraphData[$year]['percentage'] = min(100, round($percentage, 2));
//     }

//     $barRanges = [];
//     for ($i = 0; $i <= $numberOfParts; $i++) {
//         $amount = $i * $stepValue;
//         $roundedAmount = $this->customRound($amount);
//         $barRanges[] = $this->formatIndianCurrency($roundedAmount);
//     }

//     return view('admin.reports.lamination-report', compact('barGraphData', 'barRanges', 'metaTitle'));
// }

// public function laminationReports(Request $request)
// {
//     $metaTitle = 'Lamination Reports - Cosmic ERP';
//     $startOfMonth = Carbon::now()->startOfMonth();
//     $endOfMonth = Carbon::now()->endOfMonth();
//     if ($request->ajax()) {
//         $query = LaminationOrderHistory::select(
//             'lamination_order_history.created_at',                 // Date
//             'customer_orders.id as order_id',                      // Sales Order ID
//             'production_order.id as production_order_id',                      // Production Order ID
//             'customers.company_name as customer_name',                         // Customer Name
//             'products.product_name',                                           // Product Name
//             'lamination_order_history.date',                             // Status
//             'lamination_order_history.machine',                            // Machine
//             'lamination_order_history.meter',                              // Meter
//             'lamination_order_history.this_orders_completed_quantity',                              // Meter
//             'production_order.bundle_quantity',                                // Quantity Required
//             'customer_orders.order_id as sales_order_id',                     // Sales Order ID
//             'lamination_production_orders.id as lamination_production_order_id'                       // Sales Order ID
//         )
//         ->leftJoin('lamination_production_orders', 'lamination_order_history.lamination_production_order_id', '=', 'lamination_production_orders.id')
//         ->leftJoin('products', 'lamination_production_orders.product_id', '=', 'products.id')
//         ->leftJoin('production_order', 'lamination_production_orders.production_order_id', '=', 'production_order.id')
//         ->leftJoin('product_orders', function($join) {
//             $join->on('lamination_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
//                 ->on('lamination_production_orders.product_id', '=', 'product_orders.product_id');
//         })
//         ->leftJoin('customer_orders', 'lamination_production_orders.customer_order_id', '=', 'customer_orders.id')
//         ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id')
//         ->whereBetween('lamination_order_history.created_at', [$startOfMonth, $endOfMonth]);
//        // ->where('lamination_production_orders.status', 'completed');
//         // Filters for start date, end date, and category
//         if ($request->start_date) {
//             $query->whereDate('lamination_order_history.created_at', '>=', $request->start_date);
//         }

//         if ($request->end_date) {
//             $query->whereDate('lamination_order_history.created_at', '<=', $request->end_date);
//         }

//         if ($request->category) {
//             $query->whereIn('products.category', $request->category);
//         }

//         // Apply sorting based on request inputs
//         if ($request->has('order')) {
//             $columnIndex = $request->input('order.0.column'); // Get the column index for sorting
//             $sortDirection = $request->input('order.0.dir'); // Get the sort direction (asc/desc)
//             $column = $request->input("columns.$columnIndex.data"); // Get the column name based on index

//             // Define column mappings to database fields
//             $sortableColumns = [
//                 'date' => 'lamination_order_history.created_at',
//                 'sales_order_id' => 'customer_orders.order_id',
//                 'production_order_id' => 'production_order.id',
//                 'customer_name' => 'customers.company_name',
//                 'product_name' => 'products.product_name',
//                 //'status' => 'lamination_order_history.status',
//                 'bundle_quantity' => 'production_order.bundle_quantity',
//                 'machine' => 'lamination_order_history.machine',
//                 'meter' => 'lamination_order_history.meter',
//                 'this_orders_completed_quantity' => 'lamination_order_history.this_orders_completed_quantity'
//             ];

//             if (isset($sortableColumns[$column])) {
//                 $query->orderBy($sortableColumns[$column], $sortDirection);
//             } else {
//                 $query->orderBy('lamination_order_history.id', 'desc'); // Default sort
//             }
//         } else {
//             $query->orderBy('lamination_order_history.id', 'desc'); // Default sort
//         }

//         return DataTables::of($query)
//             ->addIndexColumn()
//             ->editColumn('date', function ($row) {
//                 return $row->date ? Carbon::parse($row->date)->format('d-m-Y') : '-';
//             })
//             ->editColumn('sales_order_id', fn($row) => $row->sales_order_id ?? '-')
//             ->editColumn('production_order_id', fn($row) => $row->production_order_id ?? '-')
//             ->editColumn('customer_name', fn($row) => $row->customer_name ?? '-')
//             ->editColumn('product_name', fn($row) => $row->product_name ?? '-')
//             ->editColumn('this_orders_completed_quantity', fn($row) => $row->this_orders_completed_quantity ?? '-')
//             ->editColumn('bundle_quantity', fn($row) => intVal($row->bundle_quantity) ?? '-')
//             ->editColumn('machine', fn($row) => $row->machine ?? '-')
//             ->editColumn('meter', fn($row) => $row->meter ?? '-')
//             ->make(true);
//     }

//     // Bar Graph Data Calculation
//     $barGraphDataRaw = LaminationOrderHistory::selectRaw(
//         'YEAR(lamination_order_history.created_at) as year, 
//         SUM(customer_orders.amount) as total_amount'
//     )
//     ->leftJoin('lamination_production_orders', 'lamination_order_history.lamination_production_order_id', '=', 'lamination_production_orders.id')
//     ->leftJoin('customer_orders', 'lamination_production_orders.customer_order_id', '=', 'customer_orders.id')
//     ->when($request->start_date, fn($query) => $query->whereDate('lamination_order_history.created_at', '>=', $request->start_date))
//     ->when($request->end_date, fn($query) => $query->whereDate('lamination_order_history.created_at', '<=', $request->end_date))
//     ->when($request->category, fn($query) => $query->whereIn('products.category', $request->category))
//    // ->where('lamination_order_history.status', 'completed')
//    ->whereBetween('lamination_order_history.created_at', [$startOfMonth, $endOfMonth])
//     ->groupBy('year')
//     ->orderBy('year', 'asc')
//     ->get();

//     // Processing Bar Graph Data
//     $barGraphData = [];
//     foreach ($barGraphDataRaw as $data) {
//         if ($data->total_amount == 0) {
//             continue;
//         }
//         $barGraphData[$data->year] = ['amount' => $data->total_amount];
//     }

//     $amounts = array_column($barGraphData, 'amount');
//     $maxAmount = !empty($amounts) ? max($amounts) : 0;
//     $numberOfParts = 6;

//     if ($maxAmount > 0) {
//         $stepValue = ceil($maxAmount / $numberOfParts);
//         $roundedMaxAmount = ceil($maxAmount / $stepValue) * $stepValue;
//     } else {
//         $stepValue = 1;
//         $roundedMaxAmount = 0;
//     }

//     $numberOfSteps = $roundedMaxAmount / $stepValue;
//     foreach ($barGraphData as $year => $data) {
//         $percentage = ($data['amount'] / $roundedMaxAmount) * 100;
//         $barGraphData[$year]['percentage'] = min(100, round($percentage, 2));
//     }

//     $barRanges = [];
//     for ($i = 0; $i <= $numberOfParts; $i++) {
//         $amount = $i * $stepValue;
//         $roundedAmount = $this->customRound($amount);
//         $barRanges[] = $this->formatIndianCurrency($roundedAmount);
//     }

//     return view('admin.reports.lamination-report', compact('barGraphData', 'barRanges', 'metaTitle'));
// }

public function laminationReports(Request $request)
{
    $metaTitle = 'Lamination Reports - Cosmic ERP';
    $startOfMonth = Carbon::now()->startOfMonth();
    $endOfMonth = Carbon::now()->endOfMonth();

    if ($request->ajax()) {
        $query = LaminationOrderHistory::select(
            'lamination_order_history.id', // Date
            'lamination_order_history.created_at', // Date
            'customer_orders.id as order_id', // Sales Order ID
            'production_order.id as production_order_id', // Production Order ID
            'customers.company_name as customer_name', // Customer Name
            'users.name as user_name',
            'products.product_name', // Product Name
            'lamination_order_history.date', // Status
            'lamination_order_history.machine', // Machine
            'lamination_order_history.meter', // Meter
            'lamination_order_history.this_orders_completed_quantity', // Completed Quantity
            'production_order.bundle_quantity', // Quantity Required
            'production_order.rewinding_bharti as bharti',
            'production_order.rewinding_length as length',
            'customer_orders.order_id as sales_order_id', // Sales Order ID
            'lamination_production_orders.id as lamination_production_order_id' // Lamination Production Order ID
        )
            ->leftJoin('lamination_production_orders', 'lamination_order_history.lamination_production_order_id', '=', 'lamination_production_orders.id')
            ->leftJoin('products', 'lamination_production_orders.product_id', '=', 'products.id')
            ->leftJoin('production_order', 'lamination_production_orders.production_order_id', '=', 'production_order.id')
            ->leftJoin('product_orders', function ($join) {
                $join->on('lamination_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
                    ->on('lamination_production_orders.product_id', '=', 'product_orders.product_id');
            })
            ->leftJoin('customer_orders', 'lamination_production_orders.customer_order_id', '=', 'customer_orders.id')
            ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id')
            ->leftJoin('users', 'lamination_order_history.user_id', '=', 'users.id')
            ->whereBetween('lamination_order_history.created_at', [$startOfMonth, $endOfMonth]);
            
        if ($request->start_date) {
            $query->whereDate('lamination_order_history.created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('lamination_order_history.created_at', '<=', $request->end_date);
        }

        if ($request->category) {
            $query->whereIn('products.category', $request->category);
        }

        if ($request->has('order')) {
            $columnIndex = $request->input('order.0.column');
            $sortDirection = $request->input('order.0.dir');
            $column = $request->input("columns.$columnIndex.data");

            $sortableColumns = [
                'date' => 'lamination_order_history.created_at',
                'sales_order_id' => 'customer_orders.order_id',
                'production_order_id' => 'production_order.id',
                'customer_name' => 'customers.company_name',
                'user_name' => 'users.name',
                'product_name' => 'products.product_name',
                'bundle_quantity' => 'production_order.bundle_quantity',
                'machine' => 'lamination_order_history.machine',
                'meter' => 'lamination_order_history.meter',
                'this_orders_completed_quantity' => 'lamination_order_history.this_orders_completed_quantity',
            ];

            if (isset($sortableColumns[$column])) {
                $query->orderBy($sortableColumns[$column], $sortDirection);
            } else {
                $query->orderBy('lamination_order_history.id', 'desc');
            }
        } else {
            $query->orderBy('lamination_order_history.id', 'desc');
        }

        return DataTables::of($query)
            ->addIndexColumn()
            // ->addColumn('full_name', function ($customer) {
            //     return $customer->first_name . ' ' . $customer->last_name;
            // })
            ->editColumn('user_name', fn($row) => $row->user_name ?? '-')
            ->editColumn('date', fn($row) => $row->date ? Carbon::parse($row->date)->format('d-m-Y') : '-')
            ->editColumn('sales_order_id', fn($row) => $row->sales_order_id ?? '-')
            ->editColumn('production_order_id', fn($row) => $row->production_order_id ?? '-')
            ->editColumn('customer_name', fn($row) => $row->customer_name ?? '-')
            // ->editColumn('user_name', fn($row) => $row->user_name ?? '-')
            ->editColumn('product_name', fn($row) => $row->product_name ?? '-')
            ->editColumn('this_orders_completed_quantity', function($row) {
                if ($row->this_orders_completed_quantity && $row->bharti && $row->length) {
                    $bundles = $row->this_orders_completed_quantity / $row->bharti / $row->length;
                    return number_format($bundles, 1);
                }
                return '-';
            })
            ->editColumn('bundle_quantity', fn($row) => intVal($row->bundle_quantity) ?? '-')
            ->editColumn('machine', fn($row) => $row->machine ?? '-')
            ->editColumn('meter', fn($row) => $row->meter ?? '-')
            ->addColumn('action', function ($row) {
                $pdfUrl = route('reports.laminationdata.pdf', $row->id);
                $btn = '';
                    $btn = '<a href="'.$pdfUrl.'" class="btn-sm m-1" target="_blank"><i class="files-group-icons files-icon-tag"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    // // Bar Graph Data Calculation - Divided into 3 Parts (10 Days Each)
    $mid1 = $startOfMonth->copy()->addDays(9); // 10th day of the month
    $mid2 = $mid1->copy()->addDays(10); // 20th day of the month

    $dateRanges = [
        ['start' => $startOfMonth, 'end' => $mid1],
        ['start' => $mid1->copy()->addDay(), 'end' => $mid2],
        ['start' => $mid2->copy()->addDay(), 'end' => $endOfMonth],
    ];

    $barGraphData = [];
    foreach ($dateRanges as $index => $range) {
        $totalmeter = LaminationOrderHistory::selectRaw('SUM(lamination_order_history.meter) as total_meter')
            ->leftJoin('lamination_production_orders', 'lamination_order_history.lamination_production_order_id', '=', 'lamination_production_orders.id')
            ->leftJoin('customer_orders', 'lamination_production_orders.customer_order_id', '=', 'customer_orders.id')
            ->whereBetween('lamination_order_history.created_at', [$range['start'], $range['end']])
            ->value('total_meter');

        $barGraphData[] = [
            'label' => "Part " . ($index + 1),
            'meter' => $totalmeter ?? 0,
        ];
    }
    $maxAmount = max(array_column($barGraphData, 'meter')) ?: 1;
    info('maxAmount');
    info($maxAmount);
    foreach ($barGraphData as $key => $data) {
        $barGraphData[$key]['percentage'] = round(($data['meter'] / $maxAmount) * 100, 2);
    }

    $maxAmount = max(array_column($barGraphData, 'meter')) ?: 1;
    $step = ceil($maxAmount / 5); // Divide into 5 steps for the Y-axis
    $barRanges = range(0, $maxAmount, $step);
    //     $barGraphData = LaminationOrderHistory::selectRaw('DATE(created_at) as date, SUM(meter) as total_meter')
    //     ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
    //     ->groupBy('created_at')
    //     ->orderBy('created_at')
    //     ->get()
    //     ->map(function ($item) {
    //         return [
    //             'created_at' => Carbon::parse($item->date)->format('d M'), // Format date for X-axis
    //             'meter' => $item->total_meter ?? 0,
    //         ];
    //     })
    //     ->toArray();

    // // Calculate the maximum meter value for scaling the Y-axis
    // $maxMeter = max(array_column($barGraphData, 'meter')) ?: 1;
    // $step = ceil($maxMeter / 5);  // Divide into 5 steps
    // $barRanges = range(0, $maxMeter, $step);

    return view('admin.reports.lamination-report', compact('barGraphData', 'metaTitle', 'barRanges'));
}


public function generateLaminationPDF($id)
{
    $query = LaminationOrderHistory::select(
        'lamination_order_history.id', // Date
        'lamination_order_history.created_at', // Date
        'customer_orders.id as order_id', // Sales Order ID
        'production_order.id as production_order_id', // Production Order ID
        'customers.company_name as customer_name', // Customer Name
        'products.product_name', // Product Name
        'lamination_production_orders.status', // Status
        'lamination_order_history.date', 
        'lamination_order_history.machine', // Machine
        'lamination_order_history.meter', // Meter
        'lamination_order_history.this_orders_completed_quantity', // Completed Quantity
        'production_order.bundle_quantity', // Quantity Required
        'customer_orders.order_id as sales_order_id', // Sales Order ID
        'lamination_production_orders.id as lamination_production_order_id' // Lamination Production Order ID
    )
        ->leftJoin('lamination_production_orders', 'lamination_order_history.lamination_production_order_id', '=', 'lamination_production_orders.id')
        ->leftJoin('products', 'lamination_production_orders.product_id', '=', 'products.id')
        ->leftJoin('production_order', 'lamination_production_orders.production_order_id', '=', 'production_order.id')
        ->leftJoin('product_orders', function ($join) {
            $join->on('lamination_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
                ->on('lamination_production_orders.product_id', '=', 'product_orders.product_id');
        })
        ->leftJoin('customer_orders', 'lamination_production_orders.customer_order_id', '=', 'customer_orders.id')
        ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id')
        ->where('lamination_order_history.id', $id);
    // print_r($id);
    // exit;
    // $query = LaminationProductionOrder::select(
    //         'lamination_production_orders.created_at as date',                 // Date
    //         'customer_orders.id as order_id',                      // Sales Order ID
    //         'production_order.id as production_order_id',                      // Production Order ID
    //         'customers.company_name as customer_name',                         // Customer Name
    //         'products.product_name',                                           // Product Name
    //         'lamination_production_orders.status',                             // Status
    //         'lamination_production_orders.machine',                            // Machine
    //         'lamination_production_orders.meter',                              // Meter
    //         'production_order.bundle_quantity',                                // Quantity Required
    //         'customer_orders.order_id as sales_order_id'                       // Sales Order ID
    //     )
    //     ->leftJoin('products', 'lamination_production_orders.product_id', '=', 'products.id')
    //     ->leftJoin('production_order', 'lamination_production_orders.production_order_id', '=', 'production_order.id')
    //     ->leftJoin('product_orders', function($join) {
    //         $join->on('lamination_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
    //             ->on('lamination_production_orders.product_id', '=', 'product_orders.product_id');
    //     })
    //     ->leftJoin('customer_orders', 'lamination_production_orders.customer_order_id', '=', 'customer_orders.id')
    //     ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id')
    //     ->where('lamination_production_orders.status', 'completed'); 

    $laminationData = $query->get();
    $pdf = PDF::loadView('admin.reports.lamination-report-pdf', compact('laminationData'));
    return $pdf->download('lamination_report.pdf');
}


//     public function extruderReports(Request $request)
// {
//     $metaTitle = 'Extruder Reports - Cosmic ERP';

//     if ($request->ajax()) {
//         $query = ExtruderProductionOrder::select(
//             'extruder_production_orders.created_at as date',                 // Date
//             'customer_orders.id as order_id ',                               // Sales Order Id
//             'production_order.id as production_order_id',                    // Production Order ID
//             'customers.company_name as customer_name',                       // Customer Name
//             'products.product_name',                                         // Product Name
//             'extruder_production_orders.status',                             // Status
//             'extruder_production_orders.machine',                            // Machine
//             'extruder_production_orders.shift',                              // Shift
//             'production_order.bundle_quantity',                              // Bundle Quantity
//             'customer_orders.order_id as sales_order_id'                     // Sales Order ID
//         )
//         ->leftJoin('products', 'extruder_production_orders.product_id', '=', 'products.id')
//         ->leftJoin('production_order', 'extruder_production_orders.production_order_id', '=', 'production_order.id')
//         ->leftJoin('product_orders', function($join) {
//             $join->on('extruder_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
//                  ->on('extruder_production_orders.product_id', '=', 'product_orders.product_id');
//         })
//         ->leftJoin('customer_orders', 'extruder_production_orders.customer_order_id', '=', 'customer_orders.id')
//         ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id')
//         ->where('extruder_production_orders.status', 'completed'); 

//         // Apply filters for start date, end date, and category
//         if ($request->start_date) {
//             $query->whereDate('extruder_production_orders.created_at', '>=', $request->start_date);
//         }

//         if ($request->end_date) {
//             $query->whereDate('extruder_production_orders.created_at', '<=', $request->end_date);
//         }

//         if ($request->category) {
//             $query->whereIn('products.category', $request->category);
//         }

//         // Sorting
//         $columnIndex = $request->input('order.0.column'); // Column index
//         $columnName = $request->input("columns.$columnIndex.name"); // Column name
//         $sortDirection = $request->input('order.0.dir'); // Sort direction (asc or desc)

//         // Apply sorting if column name and direction are provided
//         if ($columnName && $sortDirection) {
//             $query->orderBy($columnName, $sortDirection);
//         } else {
//             // Default order
//             $query->orderBy('extruder_production_orders.id', 'desc');
//         }

//         return DataTables::of($query)
//             ->addIndexColumn()
//             ->editColumn('date', function ($row) {
//                 return $row->date ? Carbon::parse($row->date)->format('d-m-Y') : '-';
//             })
//             ->editColumn('sales_order_id', fn($row) => $row->sales_order_id ?? '-')
//             ->editColumn('production_order_id', fn($row) => $row->production_order_id ?? '-')
//             ->editColumn('customer_name', fn($row) => $row->customer_name ?? '-')
//             ->editColumn('product_name', fn($row) => $row->product_name ?? '-')
//             ->editColumn('status', fn($row) => $row->status ? ucfirst($row->status) : '-')
//             ->editColumn('bundle_quantity', fn($row) => $row->bundle_quantity ?? '-')
//             ->editColumn('machine', fn($row) => $row->machine ?? '-')
//             ->editColumn('shift', fn($row) => $row->shift ?? '-')
//             ->make(true);
//     }

//     // Bar Graph Data Calculation
//     $barGraphDataRaw = ExtruderProductionOrder::selectRaw(
//         'YEAR(extruder_production_orders.created_at) as year, 
//         SUM(customer_orders.amount) as total_amount'
//     )
//     ->leftJoin('customer_orders', 'extruder_production_orders.customer_order_id', '=', 'customer_orders.id')
//     ->when($request->start_date, fn($query) => $query->whereDate('extruder_production_orders.created_at', '>=', $request->start_date))
//     ->when($request->end_date, fn($query) => $query->whereDate('extruder_production_orders.created_at', '<=', $request->end_date))
//     ->when($request->category, fn($query) => $query->whereIn('products.category', $request->category))
//     ->where('extruder_production_orders.status', 'completed')
//     ->groupBy('year')
//     ->orderBy('year', 'asc')
//     ->get();

//     // Processing Bar Graph Data
//     $barGraphData = [];
//     foreach ($barGraphDataRaw as $data) {
//         if ($data->total_amount == 0) {
//             continue;
//         }
//         $barGraphData[$data->year] = ['amount' => $data->total_amount];
//     }

//     $amounts = array_column($barGraphData, 'amount');
//     $maxAmount = !empty($amounts) ? max($amounts) : 0;
//     $numberOfParts = 6;

//     if ($maxAmount > 0) {
//         $stepValue = ceil($maxAmount / $numberOfParts);
//         $roundedMaxAmount = ceil($maxAmount / $stepValue) * $stepValue;
//     } else {
//         $stepValue = 1;
//         $roundedMaxAmount = 0;
//     }

//     $numberOfSteps = $roundedMaxAmount / $stepValue;
//     foreach ($barGraphData as $year => $data) {
//         $percentage = ($data['amount'] / $roundedMaxAmount) * 100;
//         $barGraphData[$year]['percentage'] = min(100, round($percentage, 2));
//     }

//     $barRanges = [];
//     for ($i = 0; $i <= $numberOfParts; $i++) {
//         $amount = $i * $stepValue;
//         $roundedAmount = $this->customRound($amount);
//         $barRanges[] = $this->formatIndianCurrency($roundedAmount);
//     }

//     return view('admin.reports.extruder-report', compact('barGraphData', 'barRanges', 'metaTitle'));
// }
public function extruderReports(Request $request)
{
    $metaTitle = 'Extruder Reports - Cosmic ERP';

    if ($request->ajax()) {
        $query = ExtruderOrderHistory::select(
            'extruder_order_history.id',   
            'extruder_order_history.created_at as date',                 // Date
            'customer_orders.id as order_id ',                               // Sales Order Id
            'production_order.id as production_order_id',                    // Production Order ID
            'customers.company_name as customer_name',                       // Customer Name
            'products.product_name',                                         // Product Name
            'extruder_production_orders.status',                             // Status
            'extruder_order_history.machine',                            // Machine
            'extruder_order_history.shift',                              // Shift
            'production_order.bundle_quantity',                              // Bundle Quantity
            'customer_orders.order_id as sales_order_id' ,                    // Sales Order ID
            'extruder_production_orders.id as extruder_production_order_id'
        )
        ->leftJoin('extruder_production_orders', 'extruder_order_history.extruder_production_order_id', '=', 'extruder_production_orders.id')
        ->leftJoin('products', 'extruder_production_orders.product_id', '=', 'products.id')
        ->leftJoin('production_order', 'extruder_production_orders.production_order_id', '=', 'production_order.id')
        ->leftJoin('product_orders', function($join) {
            $join->on('extruder_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
                 ->on('extruder_production_orders.product_id', '=', 'product_orders.product_id');
        })
        ->leftJoin('customer_orders', 'extruder_production_orders.customer_order_id', '=', 'customer_orders.id')
        ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id');
        // ->where('extruder_production_orders.status', 'completed'); 

        // Apply filters for start date, end date, and category
        if ($request->start_date) {
            $query->whereDate('extruder_production_orders.created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('extruder_production_orders.created_at', '<=', $request->end_date);
        }

        if ($request->category) {
            $query->whereIn('products.category', $request->category);
        }

        // Sorting
        $columnIndex = $request->input('order.0.column'); // Column index
        $columnName = $request->input("columns.$columnIndex.name"); // Column name
        $sortDirection = $request->input('order.0.dir'); // Sort direction (asc or desc)

        // Apply sorting if column name and direction are provided
        if ($columnName && $sortDirection) {
            $query->orderBy($columnName, $sortDirection);
        } else {
            // Default order
            $query->orderBy('extruder_production_orders.id', 'desc');
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('date', function ($row) {
                return $row->date ? Carbon::parse($row->date)->format('d-m-Y') : '-';
            })
            ->editColumn('sales_order_id', fn($row) => $row->sales_order_id ?? '-')
            ->editColumn('production_order_id', fn($row) => $row->production_order_id ?? '-')
            ->editColumn('customer_name', fn($row) => $row->customer_name ?? '-')
            ->editColumn('product_name', fn($row) => $row->product_name ?? '-')
            ->editColumn('status', fn($row) => $row->status ? ucfirst($row->status) : '-')
            ->editColumn('bundle_quantity', fn($row) => $row->bundle_quantity ?? '-')
            ->editColumn('machine', fn($row) => $row->machine ?? '-')
            ->editColumn('shift', fn($row) => $row->shift ?? '-')
            ->addColumn('action', function ($row) {
                $pdfUrl = route('reports.extruderdata.pdf', $row->id);
                $btn = '';
                    $btn = '<a href="'.$pdfUrl.'" class="btn-sm m-1" target="_blank"><i class="files-group-icons files-icon-tag"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    // Bar Graph Data Calculation
    $barGraphDataRaw = ExtruderProductionOrder::selectRaw(
        'YEAR(extruder_production_orders.created_at) as year, 
        SUM(customer_orders.amount) as total_amount'
    )
    ->leftJoin('customer_orders', 'extruder_production_orders.customer_order_id', '=', 'customer_orders.id')
    ->when($request->start_date, fn($query) => $query->whereDate('extruder_production_orders.created_at', '>=', $request->start_date))
    ->when($request->end_date, fn($query) => $query->whereDate('extruder_production_orders.created_at', '<=', $request->end_date))
    ->when($request->category, fn($query) => $query->whereIn('products.category', $request->category))
    ->where('extruder_production_orders.status', 'completed')
    ->groupBy('year')
    ->orderBy('year', 'asc')
    ->get();

    // Processing Bar Graph Data
    $barGraphData = [];
    foreach ($barGraphDataRaw as $data) {
        if ($data->total_amount == 0) {
            continue;
        }
        $barGraphData[$data->year] = ['amount' => $data->total_amount];
    }

    $amounts = array_column($barGraphData, 'amount');
    $maxAmount = !empty($amounts) ? max($amounts) : 0;
    $numberOfParts = 6;

    if ($maxAmount > 0) {
        $stepValue = ceil($maxAmount / $numberOfParts);
        $roundedMaxAmount = ceil($maxAmount / $stepValue) * $stepValue;
    } else {
        $stepValue = 1;
        $roundedMaxAmount = 0;
    }

    $numberOfSteps = $roundedMaxAmount / $stepValue;
    foreach ($barGraphData as $year => $data) {
        $percentage = ($data['amount'] / $roundedMaxAmount) * 100;
        $barGraphData[$year]['percentage'] = min(100, round($percentage, 2));
    }

    $barRanges = [];
    for ($i = 0; $i <= $numberOfParts; $i++) {
        $amount = $i * $stepValue;
        $roundedAmount = $this->customRound($amount);
        $barRanges[] = $this->formatIndianCurrency($roundedAmount);
    }

    return view('admin.reports.extruder-report', compact('barGraphData', 'barRanges', 'metaTitle'));
}
public function generateExtruderPDF($id)
{
    $query = ExtruderOrderHistory::select(
        'extruder_order_history.id',   
        'extruder_order_history.created_at as date',                 // Date
        'customer_orders.id as order_id ',                               // Sales Order Id
        'production_order.id as production_order_id',                    // Production Order ID
        'customers.company_name as customer_name',                       // Customer Name
        'products.product_name',                                         // Product Name
        'extruder_production_orders.status',                             // Status
        'extruder_order_history.machine',                            // Machine
        'extruder_order_history.shift',                              // Shift
        'production_order.bundle_quantity',                              // Bundle Quantity
        'customer_orders.order_id as sales_order_id' ,                    // Sales Order ID
        'extruder_production_orders.id as extruder_production_order_id'
    )
    ->leftJoin('extruder_production_orders', 'extruder_order_history.extruder_production_order_id', '=', 'extruder_production_orders.id')
    ->leftJoin('products', 'extruder_production_orders.product_id', '=', 'products.id')
    ->leftJoin('production_order', 'extruder_production_orders.production_order_id', '=', 'production_order.id')
    ->leftJoin('product_orders', function($join) {
        $join->on('extruder_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
             ->on('extruder_production_orders.product_id', '=', 'product_orders.product_id');
    })
    ->leftJoin('customer_orders', 'extruder_production_orders.customer_order_id', '=', 'customer_orders.id')
    ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id')
    ->where('lamination_order_history.id', $id);

    $extruderData = $query->get();
    $pdf = PDF::loadView('admin.reports.extruder-report-pdf', compact('extruderData'));
    return $pdf->download('extruder_report.pdf');
}
public function rewindingReports(Request $request)
{
    $metaTitle = 'Rewinding Reports - Cosmic ERP';

    if ($request->ajax()) {
        $query = RewindingOrderHistory::select(
            'rewinding_order_history.id',                 // Date
            'rewinding_order_history.created_at as date',                 // Date
            'customer_orders.id as order_id ',                               // Sales Order Id
            'production_order.id as production_order_id',                    // Production Order ID
            'customers.company_name as customer_name',                       // Customer Name
            'products.product_name',                                         // Product Name
            'rewinding_production_orders.status',                             // Status
            'rewinding_order_history.contractor',                            // Machine
            'rewinding_order_history.rolls',                              // Shift
            'rewinding_order_history.remark',                              // Shift
            'production_order.bundle_quantity',                              // Bundle Quantity
            'customer_orders.order_id as sales_order_id'   ,                  // Sales Order ID
            'rewinding_production_orders.id as rewinding_production_order_id' // Lamination Production Order ID
        )
        ->leftJoin('rewinding_production_orders', 'rewinding_order_history.rewinding_production_order_id', '=', 'rewinding_production_orders.id')
        ->leftJoin('products', 'rewinding_production_orders.product_id', '=', 'products.id')
        ->leftJoin('production_order', 'rewinding_production_orders.production_order_id', '=', 'production_order.id')
        ->leftJoin('product_orders', function($join) {
            $join->on('rewinding_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
                 ->on('rewinding_production_orders.product_id', '=', 'product_orders.product_id');
        })
        ->leftJoin('customer_orders', 'rewinding_production_orders.customer_order_id', '=', 'customer_orders.id')
        ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id');
        // ->where('rewinding_production_orders.status', 'completed');

        // Apply filters for start date, end date, and category
        if ($request->start_date) {
            $query->whereDate('rewinding_production_orders.created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('rewinding_production_orders.created_at', '<=', $request->end_date);
        }

        if ($request->category) {
            $query->whereIn('products.category', $request->category);
        }

        // Sorting
        $columnIndex = $request->input('order.0.column'); // Column index
        $columnName = $request->input("columns.$columnIndex.name"); // Column name
        $sortDirection = $request->input('order.0.dir'); // Sort direction (asc or desc)

        // Apply sorting if column name and direction are provided
        if ($columnName && $sortDirection) {
            $query->orderBy($columnName, $sortDirection);
        } else {
            // Default order
            $query->orderBy('rewinding_production_orders.id', 'desc');
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('date', function ($row) {
                return $row->date ? Carbon::parse($row->date)->format('d-m-Y') : '-';
            })
            ->editColumn('sales_order_id', fn($row) => $row->sales_order_id ?? '-')
            ->editColumn('production_order_id', fn($row) => $row->production_order_id ?? '-')
            ->editColumn('customer_name', fn($row) => $row->customer_name ?? '-')
            ->editColumn('product_name', fn($row) => $row->product_name ?? '-')
            ->editColumn('status', fn($row) => $row->status ? ucfirst($row->status) : '-')
            ->editColumn('bundle_quantity', fn($row) => $row->bundle_quantity ?? '-')
            ->editColumn('contractor', fn($row) => $row->contractor ?? '-')
            ->editColumn('rolls', fn($row) => $row->rolls ?? '-')
            ->editColumn('remark', fn($row) => $row->remark ?? '-')
            ->addColumn('action', function ($row) {
                $pdfUrl = route('reports.rewindingdata.pdf', $row->id);
                $btn = '';
                    $btn = '<a href="'.$pdfUrl.'" class="btn-sm m-1" target="_blank"><i class="files-group-icons files-icon-tag"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    // Bar Graph Data Calculation
    $barGraphDataRaw = RewindingProductionOrder::selectRaw(
        'YEAR(rewinding_production_orders.created_at) as year, 
        SUM(customer_orders.amount) as total_amount'
    )
    ->leftJoin('customer_orders', 'rewinding_production_orders.customer_order_id', '=', 'customer_orders.id')
    ->when($request->start_date, fn($query) => $query->whereDate('rewinding_production_orders.created_at', '>=', $request->start_date))
    ->when($request->end_date, fn($query) => $query->whereDate('rewinding_production_orders.created_at', '<=', $request->end_date))
    // ->when($request->category, fn($query) => $query->whereIn('products.category', $request->category))
    ->where('rewinding_production_orders.status', 'completed')
    ->groupBy('year')
    ->orderBy('year', 'asc')
    ->get();

    // Processing Bar Graph Data
    $barGraphData = [];
    foreach ($barGraphDataRaw as $data) {
        if ($data->total_amount == 0) {
            continue;
        }
        $barGraphData[$data->year] = ['amount' => $data->total_amount];
    }

    $amounts = array_column($barGraphData, 'amount');
    $maxAmount = !empty($amounts) ? max($amounts) : 0;
    $numberOfParts = 6;

    if ($maxAmount > 0) {
        $stepValue = ceil($maxAmount / $numberOfParts);
        $roundedMaxAmount = ceil($maxAmount / $stepValue) * $stepValue;
    } else {
        $stepValue = 1;
        $roundedMaxAmount = 0;
    }

    $numberOfSteps = $roundedMaxAmount / $stepValue;
    foreach ($barGraphData as $year => $data) {
        $percentage = ($data['amount'] / $roundedMaxAmount) * 100;
        $barGraphData[$year]['percentage'] = min(100, round($percentage, 2));
    }

    $barRanges = [];
    for ($i = 0; $i <= $numberOfParts; $i++) {
        $amount = $i * $stepValue;
        $roundedAmount = $this->customRound($amount);
        $barRanges[] = $this->formatIndianCurrency($roundedAmount);
    }
    return view('admin.reports.rewindingreport', compact('barGraphData', 'barRanges', 'metaTitle'));
    // return view('admin.reports.lamination-report', compact('barGraphData', 'metaTitle', 'barRanges'));
}

// public function rewindingReports(Request $request)
// {
//     $metaTitle = 'Rewinding Reports - Cosmic ERP';

//     if ($request->ajax()) {
//         $query = RewindingProductionOrder::select(
//             'rewinding_production_orders.created_at as date',                 // Date
//             'customer_orders.id as order_id ',                               // Sales Order Id
//             'production_order.id as production_order_id',                    // Production Order ID
//             'customers.company_name as customer_name',                       // Customer Name
//             'products.product_name',                                         // Product Name
//             'rewinding_production_orders.status',                             // Status
//             'rewinding_production_orders.contractor',                            // Machine
//             'rewinding_production_orders.rolls',                              // Shift
//             'rewinding_production_orders.remark',                              // Shift
//             'production_order.bundle_quantity',                              // Bundle Quantity
//             'customer_orders.order_id as sales_order_id'                     // Sales Order ID
//         )
//         ->leftJoin('products', 'rewinding_production_orders.product_id', '=', 'products.id')
//         ->leftJoin('production_order', 'rewinding_production_orders.production_order_id', '=', 'production_order.id')
//         ->leftJoin('product_orders', function($join) {
//             $join->on('rewinding_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
//                  ->on('rewinding_production_orders.product_id', '=', 'product_orders.product_id');
//         })
//         ->leftJoin('customer_orders', 'rewinding_production_orders.customer_order_id', '=', 'customer_orders.id')
//         ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id')
//         ->where('rewinding_production_orders.status', 'completed');

//         // Apply filters for start date, end date, and category
//         if ($request->start_date) {
//             $query->whereDate('rewinding_production_orders.created_at', '>=', $request->start_date);
//         }

//         if ($request->end_date) {
//             $query->whereDate('rewinding_production_orders.created_at', '<=', $request->end_date);
//         }

//         if ($request->category) {
//             $query->whereIn('products.category', $request->category);
//         }

//         // Sorting
//         $columnIndex = $request->input('order.0.column'); // Column index
//         $columnName = $request->input("columns.$columnIndex.name"); // Column name
//         $sortDirection = $request->input('order.0.dir'); // Sort direction (asc or desc)

//         // Apply sorting if column name and direction are provided
//         if ($columnName && $sortDirection) {
//             $query->orderBy($columnName, $sortDirection);
//         } else {
//             // Default order
//             $query->orderBy('rewinding_production_orders.id', 'desc');
//         }

//         return DataTables::of($query)
//             ->addIndexColumn()
//             ->editColumn('date', function ($row) {
//                 return $row->date ? Carbon::parse($row->date)->format('d-m-Y') : '-';
//             })
//             ->editColumn('sales_order_id', fn($row) => $row->sales_order_id ?? '-')
//             ->editColumn('production_order_id', fn($row) => $row->production_order_id ?? '-')
//             ->editColumn('customer_name', fn($row) => $row->customer_name ?? '-')
//             ->editColumn('product_name', fn($row) => $row->product_name ?? '-')
//             ->editColumn('status', fn($row) => $row->status ? ucfirst($row->status) : '-')
//             ->editColumn('bundle_quantity', fn($row) => $row->bundle_quantity ?? '-')
//             ->editColumn('contractor', fn($row) => $row->contractor ?? '-')
//             ->editColumn('rolls', fn($row) => $row->rolls ?? '-')
//             ->editColumn('remark', fn($row) => $row->remark ?? '-')
//             ->make(true);
//     }

//     // Bar Graph Data Calculation
//     $barGraphDataRaw = RewindingProductionOrder::selectRaw(
//         'YEAR(rewinding_production_orders.created_at) as year, 
//         SUM(customer_orders.amount) as total_amount'
//     )
//     ->leftJoin('customer_orders', 'rewinding_production_orders.customer_order_id', '=', 'customer_orders.id')
//     ->when($request->start_date, fn($query) => $query->whereDate('rewinding_production_orders.created_at', '>=', $request->start_date))
//     ->when($request->end_date, fn($query) => $query->whereDate('rewinding_production_orders.created_at', '<=', $request->end_date))
//     ->when($request->category, fn($query) => $query->whereIn('products.category', $request->category))
//     ->where('rewinding_production_orders.status', 'completed')
//     ->groupBy('year')
//     ->orderBy('year', 'asc')
//     ->get();

//     // Processing Bar Graph Data
//     $barGraphData = [];
//     foreach ($barGraphDataRaw as $data) {
//         if ($data->total_amount == 0) {
//             continue;
//         }
//         $barGraphData[$data->year] = ['amount' => $data->total_amount];
//     }

//     $amounts = array_column($barGraphData, 'amount');
//     $maxAmount = !empty($amounts) ? max($amounts) : 0;
//     $numberOfParts = 6;

//     if ($maxAmount > 0) {
//         $stepValue = ceil($maxAmount / $numberOfParts);
//         $roundedMaxAmount = ceil($maxAmount / $stepValue) * $stepValue;
//     } else {
//         $stepValue = 1;
//         $roundedMaxAmount = 0;
//     }

//     $numberOfSteps = $roundedMaxAmount / $stepValue;
//     foreach ($barGraphData as $year => $data) {
//         $percentage = ($data['amount'] / $roundedMaxAmount) * 100;
//         $barGraphData[$year]['percentage'] = min(100, round($percentage, 2));
//     }

//     $barRanges = [];
//     for ($i = 0; $i <= $numberOfParts; $i++) {
//         $amount = $i * $stepValue;
//         $roundedAmount = $this->customRound($amount);
//         $barRanges[] = $this->formatIndianCurrency($roundedAmount);
//     }

//     return view('admin.reports.rewindingreport', compact('barGraphData', 'barRanges', 'metaTitle'));
// }

// public function rewindingReports(Request $request)
// {
//     $metaTitle = 'Rewinding Reports - Cosmic ERP';
//     $startOfMonth = Carbon::now()->startOfMonth();
//     $endOfMonth = Carbon::now()->endOfMonth();

//     if ($request->ajax()) {
//         $query = RewindingOrderHistory::select(
//             'rewinding_order_history.created_at', // Date
//             'customer_orders.id as order_id', // Sales Order ID
//             'production_order.id as production_order_id', // Production Order ID
//             'customers.company_name as customer_name', // Customer Name
//             'products.product_name', // Product Name
//             'rewinding_order_history.date', // Status
//             'rewinding_order_history.contractor', // Machine
//             'rewinding_order_history.rolls', // Meter
//             'rewinding_order_history.remark', // Meter
//             'rewinding_order_history.this_orders_completed_quantity', // Completed Quantity
//             'production_order.bundle_quantity', // Quantity Required
//             'customer_orders.order_id as sales_order_id', // Sales Order ID
//             'rewinding_production_orders.id as rewinding_production_order_id' // Lamination Production Order ID
//         )
//             ->leftJoin('rewinding_production_orders', 'rewinding_order_history.rewinding_production_order_id', '=', 'lamination_production_orders.id')
//             ->leftJoin('products', 'rewinding_production_orders.product_id', '=', 'products.id')
//             ->leftJoin('production_order', 'rewinding_production_orders.production_order_id', '=', 'production_order.id')
//             ->leftJoin('product_orders', function ($join) {
//                 $join->on('rewinding_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
//                     ->on('rewinding_production_orders.product_id', '=', 'product_orders.product_id');
//             })
//             ->leftJoin('customer_orders', 'rewinding_production_orders.customer_order_id', '=', 'customer_orders.id')
//             ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id')
//             ->whereBetween('rewinding_order_history.created_at', [$startOfMonth, $endOfMonth]);

//         if ($request->start_date) {
//             $query->whereDate('rewinding_order_history.created_at', '>=', $request->start_date);
//         }

//         if ($request->end_date) {
//             $query->whereDate('rewinding_order_history.created_at', '<=', $request->end_date);
//         }

//         if ($request->category) {
//             $query->whereIn('products.category', $request->category);
//         }

//         if ($request->has('order')) {
//             $columnIndex = $request->input('order.0.column');
//             $sortDirection = $request->input('order.0.dir');
//             $column = $request->input("columns.$columnIndex.data");

//             $sortableColumns = [
//                 'date' => 'rewinding_order_history.created_at',
//                 'sales_order_id' => 'customer_orders.order_id',
//                 'production_order_id' => 'production_order.id',
//                 'customer_name' => 'customers.company_name',
//                 'product_name' => 'products.product_name',
//                 'bundle_quantity' => 'production_order.bundle_quantity',
//                 'machine' => 'rewinding_order_history.machine',
//                 'meter' => 'rewinding_order_history.meter',
//                 'this_orders_completed_quantity' => 'rewinding_order_history.this_orders_completed_quantity',
//             ];

//             if (isset($sortableColumns[$column])) {
//                 $query->orderBy($sortableColumns[$column], $sortDirection);
//             } else {
//                 $query->orderBy('rewinding_order_history.id', 'desc');
//             }
//         } else {
//             $query->orderBy('rewinding_order_history.id', 'desc');
//         }

//         return DataTables::of($query)
//             ->addIndexColumn()
//             ->editColumn('date', fn($row) => $row->date ? Carbon::parse($row->date)->format('d-m-Y') : '-')
//             ->editColumn('sales_order_id', fn($row) => $row->sales_order_id ?? '-')
//             ->editColumn('production_order_id', fn($row) => $row->production_order_id ?? '-')
//             ->editColumn('customer_name', fn($row) => $row->customer_name ?? '-')
//             ->editColumn('product_name', fn($row) => $row->product_name ?? '-')
//             ->editColumn('this_orders_completed_quantity', fn($row) => $row->this_orders_completed_quantity ?? '-')
//             ->editColumn('bundle_quantity', fn($row) => intVal($row->bundle_quantity) ?? '-')
//             ->editColumn('machine', fn($row) => $row->machine ?? '-')
//             ->editColumn('meter', fn($row) => $row->meter ?? '-')
//             ->make(true);
//     }

//     // Bar Graph Data Calculation - Divided into 3 Parts (10 Days Each)
//     $mid1 = $startOfMonth->copy()->addDays(9); // 10th day of the month
//     $mid2 = $mid1->copy()->addDays(10); // 20th day of the month

//     $dateRanges = [
//         ['start' => $startOfMonth, 'end' => $mid1],
//         ['start' => $mid1->copy()->addDay(), 'end' => $mid2],
//         ['start' => $mid2->copy()->addDay(), 'end' => $endOfMonth],
//     ];

//     $barGraphData = [];
//     foreach ($dateRanges as $index => $range) {
//         $totalAmount = LaminationOrderHistory::selectRaw('SUM(customer_orders.amount) as total_amount')
//             ->leftJoin('rewinding_production_orders', 'rewinding_order_history.rewinding_production_order_id', '=', 'rewinding_production_orders.id')
//             ->leftJoin('customer_orders', 'rewinding_production_orders.customer_order_id', '=', 'customer_orders.id')
//             ->whereBetween('rewinding_order_history.created_at', [$range['start'], $range['end']])
//             ->value('total_amount');

//         $barGraphData[] = [
//             'label' => "Part " . ($index + 1),
//             'amount' => $totalAmount ?? 0,
//         ];
//     }

//     $maxAmount = max(array_column($barGraphData, 'amount')) ?: 1;
//     foreach ($barGraphData as $key => $data) {
//         $barGraphData[$key]['percentage'] = round(($data['amount'] / $maxAmount) * 100, 2);
//     }

//     $maxAmount = max(array_column($barGraphData, 'amount')) ?: 1;
//     $step = ceil($maxAmount / 5); // Divide into 5 steps for the Y-axis
//     $barRanges = range(0, $maxAmount, $step);

//     return view('admin.reports.lamination-report', compact('barGraphData', 'metaTitle', 'barRanges'));
// }

public function generateRewindingPDF($id)
{
    $query = RewindingOrderHistory::select(
        'rewinding_order_history.id',                 // Date
        'rewinding_order_history.created_at as date',                 // Date
        'customer_orders.id as order_id ',                               // Sales Order Id
        'production_order.id as production_order_id',                    // Production Order ID
        'customers.company_name as customer_name',                       // Customer Name
        'products.product_name',                                         // Product Name
        'rewinding_production_orders.status',                             // Status
        'rewinding_order_history.contractor',                            // Machine
        'rewinding_order_history.rolls',                              // Shift
        'rewinding_order_history.remark',                              // Shift
        'production_order.bundle_quantity',                              // Bundle Quantity
        'customer_orders.order_id as sales_order_id'   ,                  // Sales Order ID
        'rewinding_production_orders.id as rewinding_production_order_id' // Lamination Production Order ID
    )
    ->leftJoin('rewinding_production_orders', 'rewinding_order_history.rewinding_production_order_id', '=', 'rewinding_production_orders.id')
    ->leftJoin('products', 'rewinding_production_orders.product_id', '=', 'products.id')
    ->leftJoin('production_order', 'rewinding_production_orders.production_order_id', '=', 'production_order.id')
    ->leftJoin('product_orders', function($join) {
        $join->on('rewinding_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
             ->on('rewinding_production_orders.product_id', '=', 'product_orders.product_id');
    })
    ->leftJoin('customer_orders', 'rewinding_production_orders.customer_order_id', '=', 'customer_orders.id')
    ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id')
    ->where('rewinding_order_history.id', $id);

    $rewindingData = $query->get();
    $pdf = PDF::loadView('admin.reports.rewinding-report-pdf', compact('rewindingData'));
    return $pdf->download('rewinding_report.pdf');
}
public function stitchingReports(Request $request)
{
    $metaTitle = 'Silai Reports - Cosmic ERP';

    if ($request->ajax()) {
        $query = StitchingOrderHistory::select(
            'stitching_order_histories.id',                 // Date
            'stitching_order_histories.created_at as date',                 // Date
            'customer_orders.id as order_id ',                               // Sales Order Id
            'production_order.id as production_order_id',                    // Production Order ID
            'customers.company_name as customer_name',                       // Customer Name
            'products.product_name',                                         // Product Name
            'stitching_production_orders.status',                             // Status
            'stitching_order_histories.labour_name',                            // Machine
            'stitching_order_histories.bdl_qty',                              // Shift
            'stitching_order_histories.qty_per_bdl',                              // Shift
            'stitching_order_histories.remark',                              // Shift
            'production_order.bundle_quantity',                              // Bundle Quantity
            'customer_orders.order_id as sales_order_id',                     // Sales Order ID
            'stitching_production_orders.id as stitching_production_order_id'
        )
        ->leftJoin('stitching_production_orders', 'stitching_order_histories.stitching_production_order_id', '=', 'stitching_production_orders.id')
        ->leftJoin('products', 'stitching_production_orders.product_id', '=', 'products.id')
        ->leftJoin('production_order', 'stitching_production_orders.production_order_id', '=', 'production_order.id')
        ->leftJoin('product_orders', function($join) {
            $join->on('stitching_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
                 ->on('stitching_production_orders.product_id', '=', 'product_orders.product_id');
        })
        ->leftJoin('customer_orders', 'stitching_production_orders.customer_order_id', '=', 'customer_orders.id')
        ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id');
        // ->where('stitching_production_orders.status', 'completed');

        // Apply filters for start date, end date, and category
        if ($request->start_date) {
            $query->whereDate('stitching_order_histories.created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('stitching_order_histories.created_at', '<=', $request->end_date);
        }

        if ($request->category) {
            $query->whereIn('products.category', $request->category);
        }

        // Sorting
        $columnIndex = $request->input('order.0.column'); // Column index
        $columnName = $request->input("columns.$columnIndex.name"); // Column name
        $sortDirection = $request->input('order.0.dir'); // Sort direction (asc or desc)

        // Apply sorting if column name and direction are provided
        if ($columnName && $sortDirection) {
            $query->orderBy($columnName, $sortDirection);
        } else {
            // Default order
            $query->orderBy('stitching_order_histories.id', 'desc');
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('date', function ($row) {
                return $row->date ? Carbon::parse($row->date)->format('d-m-Y') : '-';
            })
            ->editColumn('sales_order_id', fn($row) => $row->sales_order_id ?? '-')
            ->editColumn('production_order_id', fn($row) => $row->production_order_id ?? '-')
            ->editColumn('customer_name', fn($row) => $row->customer_name ?? '-')
            ->editColumn('product_name', fn($row) => $row->product_name ?? '-')
            ->editColumn('status', fn($row) => $row->status ? ucfirst($row->status) : '-')
            ->editColumn('bundle_quantity', fn($row) => $row->bundle_quantity ?? '-')
            ->editColumn('labour_name', fn($row) => $row->labour_name ?? '-')
            ->editColumn('bundle_qty', fn($row) => $row->bundle_qty ?? '-')
            ->editColumn('qty_per_bdl', fn($row) => $row->qty_per_bdl ?? '-')
            ->editColumn('remark', fn($row) => $row->remark ?? '-')
            ->addColumn('action', function ($row) {
                $pdfUrl = route('reports.stitchingdata.pdf', $row->id);
                $btn = '';
                    $btn = '<a href="'.$pdfUrl.'" class="btn-sm m-1" target="_blank"><i class="files-group-icons files-icon-tag"></i></a>';
                return $btn;
            })
            ->make(true);
    }

    // Bar Graph Data Calculation
    // $barGraphDataRaw = StitchingOrderHistory::selectRaw(
    //     'YEAR(stitching_order_histories.created_at) as year, 
    //     SUM(customer_orders.amount) as total_amount'
    // )
    $barGraphDataRaw = StitchingProductionOrder::selectRaw(
        'YEAR(stitching_production_orders.created_at) as year, 
        SUM(customer_orders.amount) as total_amount'
    )
    ->leftJoin('customer_orders', 'stitching_production_orders.customer_order_id', '=', 'customer_orders.id')
    ->when($request->start_date, fn($query) => $query->whereDate('stitching_production_orders.created_at', '>=', $request->start_date))
    ->when($request->end_date, fn($query) => $query->whereDate('stitching_production_orders.created_at', '<=', $request->end_date))
    // ->when($request->category, fn($query) => $query->whereIn('products.category', $request->category))
    // ->where('stitching_production_orders.status', 'completed')
    ->groupBy('year')
    ->orderBy('year', 'asc')
    ->get();

    // Processing Bar Graph Data
    $barGraphData = [];
    foreach ($barGraphDataRaw as $data) {
        if ($data->total_amount == 0) {
            continue;
        }
        $barGraphData[$data->year] = ['amount' => $data->total_amount];
    }

    $amounts = array_column($barGraphData, 'amount');
    $maxAmount = !empty($amounts) ? max($amounts) : 0;
    $numberOfParts = 6;

    if ($maxAmount > 0) {
        $stepValue = ceil($maxAmount / $numberOfParts);
        $roundedMaxAmount = ceil($maxAmount / $stepValue) * $stepValue;
    } else {
        $stepValue = 1;
        $roundedMaxAmount = 0;
    }

    $numberOfSteps = $roundedMaxAmount / $stepValue;
    foreach ($barGraphData as $year => $data) {
        $percentage = ($data['amount'] / $roundedMaxAmount) * 100;
        $barGraphData[$year]['percentage'] = min(100, round($percentage, 2));
    }

    $barRanges = [];
    for ($i = 0; $i <= $numberOfParts; $i++) {
        $amount = $i * $stepValue;
        $roundedAmount = $this->customRound($amount);
        $barRanges[] = $this->formatIndianCurrency($roundedAmount);
    }

    return view('admin.reports.stitching-report', compact('barGraphData', 'barRanges', 'metaTitle'));
}
// public function stitchingReports(Request $request)
// {
//     $metaTitle = 'Silai Reports - Cosmic ERP';

//     if ($request->ajax()) {
//         $query = stitchingProductionOrder::select(
//             'stitching_production_orders.created_at as date',                 // Date
//             'customer_orders.id as order_id ',                               // Sales Order Id
//             'production_order.id as production_order_id',                    // Production Order ID
//             'customers.company_name as customer_name',                       // Customer Name
//             'products.product_name',                                         // Product Name
//             'stitching_production_orders.status',                             // Status
//             'stitching_production_orders.labour_name',                            // Machine
//             'stitching_production_orders.bundle_qty',                              // Shift
//             'stitching_production_orders.qty_per_bdl',                              // Shift
//             'stitching_production_orders.remark',                              // Shift
//             'production_order.bundle_quantity',                              // Bundle Quantity
//             'customer_orders.order_id as sales_order_id'                     // Sales Order ID
//         )
//         ->leftJoin('products', 'stitching_production_orders.product_id', '=', 'products.id')
//         ->leftJoin('production_order', 'stitching_production_orders.production_order_id', '=', 'production_order.id')
//         ->leftJoin('product_orders', function($join) {
//             $join->on('stitching_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
//                  ->on('stitching_production_orders.product_id', '=', 'product_orders.product_id');
//         })
//         ->leftJoin('customer_orders', 'stitching_production_orders.customer_order_id', '=', 'customer_orders.id')
//         ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id')
//         ->where('stitching_production_orders.status', 'completed');

//         // Apply filters for start date, end date, and category
//         if ($request->start_date) {
//             $query->whereDate('stitching_production_orders.created_at', '>=', $request->start_date);
//         }

//         if ($request->end_date) {
//             $query->whereDate('stitching_production_orders.created_at', '<=', $request->end_date);
//         }

//         if ($request->category) {
//             $query->whereIn('products.category', $request->category);
//         }

//         // Sorting
//         $columnIndex = $request->input('order.0.column'); // Column index
//         $columnName = $request->input("columns.$columnIndex.name"); // Column name
//         $sortDirection = $request->input('order.0.dir'); // Sort direction (asc or desc)

//         // Apply sorting if column name and direction are provided
//         if ($columnName && $sortDirection) {
//             $query->orderBy($columnName, $sortDirection);
//         } else {
//             // Default order
//             $query->orderBy('stitching_production_orders.id', 'desc');
//         }

//         return DataTables::of($query)
//             ->addIndexColumn()
//             ->editColumn('date', function ($row) {
//                 return $row->date ? Carbon::parse($row->date)->format('d-m-Y') : '-';
//             })
//             ->editColumn('sales_order_id', fn($row) => $row->sales_order_id ?? '-')
//             ->editColumn('production_order_id', fn($row) => $row->production_order_id ?? '-')
//             ->editColumn('customer_name', fn($row) => $row->customer_name ?? '-')
//             ->editColumn('product_name', fn($row) => $row->product_name ?? '-')
//             ->editColumn('status', fn($row) => $row->status ? ucfirst($row->status) : '-')
//             ->editColumn('bundle_quantity', fn($row) => $row->bundle_quantity ?? '-')
//             ->editColumn('labour_name', fn($row) => $row->labour_name ?? '-')
//             ->editColumn('bundle_qty', fn($row) => $row->bundle_qty ?? '-')
//             ->editColumn('qty_per_bdl', fn($row) => $row->qty_per_bdl ?? '-')
//             ->editColumn('remark', fn($row) => $row->remark ?? '-')
//             ->make(true);
//     }

//     // Bar Graph Data Calculation
//     $barGraphDataRaw = stitchingProductionOrder::selectRaw(
//         'YEAR(stitching_production_orders.created_at) as year, 
//         SUM(customer_orders.amount) as total_amount'
//     )
//     ->leftJoin('customer_orders', 'stitching_production_orders.customer_order_id', '=', 'customer_orders.id')
//     ->when($request->start_date, fn($query) => $query->whereDate('stitching_production_orders.created_at', '>=', $request->start_date))
//     ->when($request->end_date, fn($query) => $query->whereDate('stitching_production_orders.created_at', '<=', $request->end_date))
//     ->when($request->category, fn($query) => $query->whereIn('products.category', $request->category))
//     ->where('stitching_production_orders.status', 'completed')
//     ->groupBy('year')
//     ->orderBy('year', 'asc')
//     ->get();

//     // Processing Bar Graph Data
//     $barGraphData = [];
//     foreach ($barGraphDataRaw as $data) {
//         if ($data->total_amount == 0) {
//             continue;
//         }
//         $barGraphData[$data->year] = ['amount' => $data->total_amount];
//     }

//     $amounts = array_column($barGraphData, 'amount');
//     $maxAmount = !empty($amounts) ? max($amounts) : 0;
//     $numberOfParts = 6;

//     if ($maxAmount > 0) {
//         $stepValue = ceil($maxAmount / $numberOfParts);
//         $roundedMaxAmount = ceil($maxAmount / $stepValue) * $stepValue;
//     } else {
//         $stepValue = 1;
//         $roundedMaxAmount = 0;
//     }

//     $numberOfSteps = $roundedMaxAmount / $stepValue;
//     foreach ($barGraphData as $year => $data) {
//         $percentage = ($data['amount'] / $roundedMaxAmount) * 100;
//         $barGraphData[$year]['percentage'] = min(100, round($percentage, 2));
//     }

//     $barRanges = [];
//     for ($i = 0; $i <= $numberOfParts; $i++) {
//         $amount = $i * $stepValue;
//         $roundedAmount = $this->customRound($amount);
//         $barRanges[] = $this->formatIndianCurrency($roundedAmount);
//     }

//     return view('admin.reports.stitching-report', compact('barGraphData', 'barRanges', 'metaTitle'));
// }

public function generateStitchingPDF($id)
{
    $query = StitchingOrderHistory::select(
        'stitching_order_histories.id',                 // Date
        'stitching_order_histories.created_at as date',                 // Date
        'customer_orders.id as order_id ',                               // Sales Order Id
        'production_order.id as production_order_id',                    // Production Order ID
        'customers.company_name as customer_name',                       // Customer Name
        'products.product_name',                                         // Product Name
        'stitching_production_orders.status',                             // Status
        'stitching_order_histories.labour_name',                            // Machine
        'stitching_order_histories.bdl_qty',                              // Shift
        'stitching_order_histories.qty_per_bdl',                              // Shift
        'stitching_order_histories.remark',                              // Shift
        'production_order.bundle_quantity',                              // Bundle Quantity
        'customer_orders.order_id as sales_order_id',                     // Sales Order ID
        'stitching_production_orders.id as stitching_production_order_id'
    )
    ->leftJoin('stitching_production_orders', 'stitching_order_histories.stitching_production_order_id', '=', 'stitching_production_orders.id')
    ->leftJoin('products', 'stitching_production_orders.product_id', '=', 'products.id')
    ->leftJoin('production_order', 'stitching_production_orders.production_order_id', '=', 'production_order.id')
    ->leftJoin('product_orders', function($join) {
        $join->on('stitching_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
             ->on('stitching_production_orders.product_id', '=', 'product_orders.product_id');
    })
    ->leftJoin('customer_orders', 'stitching_production_orders.customer_order_id', '=', 'customer_orders.id')
    ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id')
    ->where('stitching_order_histories.id', $id);

    $stitchingData = $query->get();
    $pdf = PDF::loadView('admin.reports.stitching-report-pdf', compact('stitchingData'));
    return $pdf->download('stitching_report.pdf');
}
// public function packingReports(Request $request)
// {
//     $metaTitle = 'Packing Reports - Cosmic ERP';

//     if ($request->ajax()) {
//         $query = PackingProductionOrder::select(
//             'packing_production_orders.created_at as date',                 // Date
//             'customer_orders.id as order_id ',                               // Sales Order Id
//             'production_order.id as production_order_id',                    // Production Order ID
//             'customers.company_name as customer_name',                       // Customer Name
//             'products.product_name',                                         // Product Name
//             'packing_production_orders.status',                             // Status
//             'packing_production_orders.labour_name',                            // Machine
//             'packing_production_orders.bags_per_box_qty',                              // Shift
//             'packing_production_orders.steping_required',                              // Shift                        // Shift
//             'production_order.bundle_quantity',                              // Bundle Quantity
//             'customer_orders.order_id as sales_order_id'                     // Sales Order ID
//         )
//         ->leftJoin('products', 'packing_production_orders.product_id', '=', 'products.id')
//         ->leftJoin('production_order', 'packing_production_orders.production_order_id', '=', 'production_order.id')
//         ->leftJoin('product_orders', function($join) {
//             $join->on('packing_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
//                  ->on('packing_production_orders.product_id', '=', 'product_orders.product_id');
//         })
//         ->leftJoin('customer_orders', 'packing_production_orders.customer_order_id', '=', 'customer_orders.id')
//         ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id')
//         ->where('packing_production_orders.status', 'completed');


//         // Apply filters for start date, end date, and category
//         if ($request->start_date) {
//             $query->whereDate('packing_production_orders.created_at', '>=', $request->start_date);
//         }

//         if ($request->end_date) {
//             $query->whereDate('packing_production_orders.created_at', '<=', $request->end_date);
//         }

//         if ($request->category) {
//             $query->whereIn('products.category', $request->category);
//         }

//         // Sorting
//         $columnIndex = $request->input('order.0.column'); // Column index
//         $columnName = $request->input("columns.$columnIndex.name"); // Column name
//         $sortDirection = $request->input('order.0.dir'); // Sort direction (asc or desc)

//         // Apply sorting if column name and direction are provided
//         if ($columnName && $sortDirection) {
//             $query->orderBy($columnName, $sortDirection);
//         } else {
//             // Default order
//             $query->orderBy('packing_production_orders.id', 'desc');
//         }

//         return DataTables::of($query)
//             ->addIndexColumn()
//             ->editColumn('date', function ($row) {
//                 return $row->date ? Carbon::parse($row->date)->format('d-m-Y') : '-';
//             })
//             ->editColumn('sales_order_id', fn($row) => $row->sales_order_id ?? '-')
//             ->editColumn('production_order_id', fn($row) => $row->production_order_id ?? '-')
//             ->editColumn('customer_name', fn($row) => $row->customer_name ?? '-')
//             ->editColumn('product_name', fn($row) => $row->product_name ?? '-')
//             ->editColumn('status', fn($row) => $row->status ? ucfirst($row->status) : '-')
//             ->editColumn('bundle_quantity', fn($row) => $row->bundle_quantity ?? '-')
//             ->editColumn('labour_name', fn($row) => $row->labour_name ?? '-')
//             ->editColumn('bags_per_box_qty', fn($row) => $row->bags_per_box_qty ?? '-')
//             ->editColumn('steping_required', fn($row) => $row->steping_required ?? '-')
//             ->make(true);
//     }

//     // Bar Graph Data Calculation
//     $barGraphDataRaw = PackingProductionOrder::selectRaw(
//         'YEAR(packing_production_orders.created_at) as year, 
//         SUM(customer_orders.amount) as total_amount'
//     )
//     ->leftJoin('customer_orders', 'packing_production_orders.customer_order_id', '=', 'customer_orders.id')
//     ->when($request->start_date, fn($query) => $query->whereDate('packing_production_orders.created_at', '>=', $request->start_date))
//     ->when($request->end_date, fn($query) => $query->whereDate('packing_production_orders.created_at', '<=', $request->end_date))
//     ->when($request->category, fn($query) => $query->whereIn('products.category', $request->category))
//     ->where('packing_production_orders.status', 'completed')
//     ->groupBy('year')
//     ->orderBy('year', 'asc')
//     ->get();

//     // Processing Bar Graph Data
//     $barGraphData = [];
//     foreach ($barGraphDataRaw as $data) {
//         if ($data->total_amount == 0) {
//             continue;
//         }
//         $barGraphData[$data->year] = ['amount' => $data->total_amount];
//     }

//     $amounts = array_column($barGraphData, 'amount');
//     $maxAmount = !empty($amounts) ? max($amounts) : 0;
//     $numberOfParts = 6;

//     if ($maxAmount > 0) {
//         $stepValue = ceil($maxAmount / $numberOfParts);
//         $roundedMaxAmount = ceil($maxAmount / $stepValue) * $stepValue;
//     } else {
//         $stepValue = 1;
//         $roundedMaxAmount = 0;
//     }

//     $numberOfSteps = $roundedMaxAmount / $stepValue;
//     foreach ($barGraphData as $year => $data) {
//         $percentage = ($data['amount'] / $roundedMaxAmount) * 100;
//         $barGraphData[$year]['percentage'] = min(100, round($percentage, 2));
//     }

//     $barRanges = [];
//     for ($i = 0; $i <= $numberOfParts; $i++) {
//         $amount = $i * $stepValue;
//         $roundedAmount = $this->customRound($amount);
//         $barRanges[] = $this->formatIndianCurrency($roundedAmount);
//     }

//     return view('admin.reports.packing-report', compact('barGraphData', 'barRanges', 'metaTitle'));
// }
public function packingReports(Request $request)
{
    $metaTitle = 'Packing Reports - Cosmic ERP';

    if ($request->ajax()) {
        $query = PackingOrderHistory::select(
            'packing_order_histories.id',                 // Date
            'packing_order_histories.created_at as date',                 // Date
            'customer_orders.id as order_id ',                               // Sales Order Id
            'production_order.id as production_order_id',                    // Production Order ID
            'customers.company_name as customer_name',                       // Customer Name
            'products.product_name',                                         // Product Name
            'packing_production_orders.status',                             // Status
            'packing_order_histories.labour_name',                            // Machine
            'packing_order_histories.bags_per_box_qty',                              // Shift
            'packing_order_histories.steping_required',                              // Shift                        // Shift
            'production_order.bundle_quantity',                              // Bundle Quantity
            'customer_orders.order_id as sales_order_id',                 // Sales Order ID
            'packing_production_orders.id as packing_production_order_id'
        )
        ->leftJoin('packing_production_orders', 'packing_order_histories.packing_production_order_id', '=', 'packing_production_orders.id')
      
        ->leftJoin('products', 'packing_production_orders.product_id', '=', 'products.id')
        ->leftJoin('production_order', 'packing_production_orders.production_order_id', '=', 'production_order.id')
        ->leftJoin('product_orders', function($join) {
            $join->on('packing_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
                 ->on('packing_production_orders.product_id', '=', 'product_orders.product_id');
        })
        ->leftJoin('customer_orders', 'packing_production_orders.customer_order_id', '=', 'customer_orders.id')
        ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id');
        // ->where('packing_production_orders.status', 'completed');


        // Apply filters for start date, end date, and category
        if ($request->start_date) {
            $query->whereDate('packing_production_orders.created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('packing_production_orders.created_at', '<=', $request->end_date);
        }

        if ($request->category) {
            $query->whereIn('products.category', $request->category);
        }

        // Sorting
        $columnIndex = $request->input('order.0.column'); // Column index
        $columnName = $request->input("columns.$columnIndex.name"); // Column name
        $sortDirection = $request->input('order.0.dir'); // Sort direction (asc or desc)

        // Apply sorting if column name and direction are provided
        if ($columnName && $sortDirection) {
            $query->orderBy($columnName, $sortDirection);
        } else {
            // Default order
            $query->orderBy('packing_production_orders.id', 'desc');
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('date', function ($row) {
                return $row->date ? Carbon::parse($row->date)->format('d-m-Y') : '-';
            })
            ->editColumn('sales_order_id', fn($row) => $row->sales_order_id ?? '-')
            ->editColumn('production_order_id', fn($row) => $row->production_order_id ?? '-')
            ->editColumn('customer_name', fn($row) => $row->customer_name ?? '-')
            ->editColumn('product_name', fn($row) => $row->product_name ?? '-')
            ->editColumn('status', fn($row) => $row->status ? ucfirst($row->status) : '-')
            ->editColumn('bundle_quantity', fn($row) => $row->bundle_quantity ?? '-')
            ->editColumn('labour_name', fn($row) => $row->labour_name ?? '-')
            ->editColumn('bags_per_box_qty', fn($row) => $row->bags_per_box_qty ?? '-')
            ->editColumn('steping_required', fn($row) => $row->steping_required ?? '-')
            ->addColumn('action', function ($row) {
                $pdfUrl = route('reports.packingdata.pdf', $row->id);
                $btn = '';
                    $btn = '<a href="'.$pdfUrl.'" class="btn-sm m-1" target="_blank"><i class="files-group-icons files-icon-tag"></i></a>';
                return $btn;
            })
            ->make(true);
    }

    // Bar Graph Data Calculation
    $barGraphDataRaw = PackingProductionOrder::selectRaw(
        'YEAR(packing_production_orders.created_at) as year, 
        SUM(customer_orders.amount) as total_amount'
    )
    ->leftJoin('customer_orders', 'packing_production_orders.customer_order_id', '=', 'customer_orders.id')
    ->when($request->start_date, fn($query) => $query->whereDate('packing_production_orders.created_at', '>=', $request->start_date))
    ->when($request->end_date, fn($query) => $query->whereDate('packing_production_orders.created_at', '<=', $request->end_date))
    ->when($request->category, fn($query) => $query->whereIn('products.category', $request->category))
    ->where('packing_production_orders.status', 'completed')
    ->groupBy('year')
    ->orderBy('year', 'asc')
    ->get();

    // Processing Bar Graph Data
    $barGraphData = [];
    foreach ($barGraphDataRaw as $data) {
        if ($data->total_amount == 0) {
            continue;
        }
        $barGraphData[$data->year] = ['amount' => $data->total_amount];
    }

    $amounts = array_column($barGraphData, 'amount');
    $maxAmount = !empty($amounts) ? max($amounts) : 0;
    $numberOfParts = 6;

    if ($maxAmount > 0) {
        $stepValue = ceil($maxAmount / $numberOfParts);
        $roundedMaxAmount = ceil($maxAmount / $stepValue) * $stepValue;
    } else {
        $stepValue = 1;
        $roundedMaxAmount = 0;
    }

    $numberOfSteps = $roundedMaxAmount / $stepValue;
    foreach ($barGraphData as $year => $data) {
        $percentage = ($data['amount'] / $roundedMaxAmount) * 100;
        $barGraphData[$year]['percentage'] = min(100, round($percentage, 2));
    }

    $barRanges = [];
    for ($i = 0; $i <= $numberOfParts; $i++) {
        $amount = $i * $stepValue;
        $roundedAmount = $this->customRound($amount);
        $barRanges[] = $this->formatIndianCurrency($roundedAmount);
    }

    return view('admin.reports.packing-report', compact('barGraphData', 'barRanges', 'metaTitle'));
}
public function generatePackingPDF($id)
{
    // print_r($id);
    // exit;
    $query = PackingOrderHistory::select(
        'packing_order_histories.id',                 // Date
        'packing_order_histories.created_at as date',                 // Date
        'customer_orders.id as order_id ',                               // Sales Order Id
        'production_order.id as production_order_id',                    // Production Order ID
        'customers.company_name as customer_name',                       // Customer Name
        'products.product_name',                                         // Product Name
        'packing_production_orders.status',                             // Status
        'packing_order_histories.labour_name',                            // Machine
        'packing_order_histories.bags_per_box_qty',                              // Shift
        'packing_order_histories.steping_required',                              // Shift                        // Shift
        'production_order.bundle_quantity',                              // Bundle Quantity
        'customer_orders.order_id as sales_order_id',                 // Sales Order ID
        'packing_production_orders.id as packing_production_order_id'
    )
    ->leftJoin('packing_production_orders', 'packing_order_histories.packing_production_order_id', '=', 'packing_production_orders.id')
  
    ->leftJoin('products', 'packing_production_orders.product_id', '=', 'products.id')
    ->leftJoin('production_order', 'packing_production_orders.production_order_id', '=', 'production_order.id')
    ->leftJoin('product_orders', function($join) {
        $join->on('packing_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
             ->on('packing_production_orders.product_id', '=', 'product_orders.product_id');
    })
    ->leftJoin('customer_orders', 'packing_production_orders.customer_order_id', '=', 'customer_orders.id')
    ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id')
    ->where('packing_order_histories.id',$id);

    $packingData = $query->get();
    $pdf = PDF::loadView('admin.reports.packing-report-pdf', compact('packingData'));
    return $pdf->download('packing_report.pdf');
}

public function stockInwardReports(Request $request)
{
    $metaTitle = 'Stock Inward Reports - Cosmic ERP';

    if ($request->ajax()) {
        $query = MaterialIn::with(['user', 'category', 'materialSubCategory','material']);

        if ($request->has('SearchData') && !empty($request->SearchData)) {
            $search = $request->get('SearchData');
            $query->where(function ($q) use ($search) {
                $q->where('material_category_type', 'like', '%' . $search . '%')
                  ->orWhere('material_sub_category', 'like', '%' . $search . '%')
                  ->orWhere('unit1', 'like', '%' . $search . '%')
                  ->orWhere('unit2', 'like', '%' . $search . '%')
                  ->orWhereHas('material', function ($materialQuery) use ($search) {
                        $materialQuery->where('material_name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', '%' . $search . '%');
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
            ->addColumn('user_id', function ($material) {
                return $material->user ? $material->user->name : '-';
            })
            ->addColumn('material_category_type', function ($material) {
                return $material->category ? $material->category->name : '-';
            })
            ->addColumn('material_sub_category', function ($material) {
                return $material->materialSubCategory ? $material->materialSubCategory->sub_cat_name : '-';
            })
            ->addColumn('material_name', function ($material) {
                return $material->material ? $material->material->material_name : '-';
            })
            ->addColumn('unit2', function ($material) {
                return $material->unit2 ? $material->unit2 : '-';
            })
            ->addColumn('unit2_value', function ($material) {
                return $material->unit2_value ? $material->unit2_value : '-';
            })
            ->addColumn('action', function($material) {
                $pdfUrl = route('reports.inwardpdf', $material->id);
                $btn = '';
                $btn .= '<a href="' . $pdfUrl . '" class="btn-sm m-1" target="_blank"><i class="files-group-icons files-icon-tag" ></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    return view('admin.reports.stock-inward-reports', compact('metaTitle'));
}
public function generateInwardPDF( $id )
{
    $inworddata = MaterialIn::with(['user', 'category', 'materialSubCategory','material'])->where('id',$id)->get();
    $data = compact('inworddata');
    $pdf = PDF::loadView('admin.reports.inwardpdf', $data);

    return $pdf->download('inwardpdf_' . $id . '.pdf');
}
public function stockOutwardReports(Request $request)
{
    $metaTitle = 'Stock Outward Reports - Cosmic ERP';

    if ($request->ajax()) {
        $query = MaterialOut::with(['user', 'category', 'materialSubCategory','material']);

        if ($request->has('SearchData') && !empty($request->SearchData)) {
            $search = $request->get('SearchData');
            $query->where(function ($q) use ($search) {
                $q->where('material_category_type', 'like', '%' . $search . '%')
                  ->orWhere('material_sub_category', 'like', '%' . $search . '%')
                  ->orWhere('unit1', 'like', '%' . $search . '%')
                  ->orWhere('unit2', 'like', '%' . $search . '%')
                  ->orWhereHas('material', function ($materialQuery) use ($search) {
                        $materialQuery->where('material_name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', '%' . $search . '%');
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
            ->addColumn('user_id', function ($material) {
                return $material->user ? $material->user->name : '-';
            })
            ->addColumn('material_category_type', function ($material) {
                return $material->category ? $material->category->name : '-';
            })
            ->addColumn('material_sub_category', function ($material) {
                return $material->materialSubCategory ? $material->materialSubCategory->sub_cat_name : '-';
            })
            ->addColumn('material_name', function ($material) {
                return $material->material ? $material->material->material_name : '-';
            })
            ->addColumn('unit2', function ($material) {
                return $material->unit2 ? $material->unit2 : '-';
            })
            ->addColumn('unit2_value', function ($material) {
                return $material->unit2_value ? $material->unit2_value : '-';
            })
            ->addColumn('action', function($material) {
                $pdfUrl = route('reports.outwardpdf', $material->id);
                $btn = '';
                $btn .= '<a href="' . $pdfUrl . '" class="btn-sm m-1" target="_blank"><i class="files-group-icons files-icon-tag" ></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    return view('admin.reports.stock-outward-reports', compact('metaTitle'));
}
    public function generateOutwardPDF( $id )
    {
        $Outwarddata = MaterialOut::with(['user', 'category', 'materialSubCategory','material'])->where('id',$id)->get();
        $data = compact('Outwarddata');
        // return view('admin.reports.Outwardpdf', compact('Outwarddata'));

        $pdf = PDF::loadView('admin.reports.Outwardpdf', $data);

        return $pdf->download('Outwardpdf_' . $id . '.pdf');
    }
    
}