<?php

namespace App\Exports;

use App\Models\CustomerOrder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $orders = CustomerOrder::query();

        if ($this->request->filled('start_date') && $this->request->filled('end_date')) {
            $orders->whereBetween('order_date', [$this->request->start_date, $this->request->end_date]);
        }

        if ($this->request->filled('status')) {
            $orders->where('status', $this->request->status);
        }

        // Add other filters...

        return $orders->get();
    }

    public function headings(): array
    {
        return [
            'Order ID', 'Customer Name', 'Order Date', 'Product Name', 'Quantity', 'Total Price', 'Status'
        ];
    }
}