<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class PriceListExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $items;
    protected $priceListName;
    protected $discount;

    public function __construct($items, $priceListName, $discount)
    {
        $this->items = $items;
        $this->priceListName = $priceListName;
        $this->discount = $discount;
    }

    public function collection()
    {
        return $this->items;
    }

    public function headings(): array
    {
        return [
            ['Price List: ' . $this->priceListName, 'Discount: ' . $this->discount],
            ['Product Name', 'Min Qty', 'Rate', 'Discount Rate', 'Special Rate']
        ];
    }

    public function map($item): array
    {
        return [
            $item->product->product_name,
            $item->min_qty,
            $item->rate,
            $item->discount_rate,
            $item->special_rate,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => [
                'font' => [
                    'bold' => true,
                    'size' => 14
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ]
            ],
            2    => [
                'font' => [
                    'bold' => true,
                ],
            ],
        ];
    }
}


