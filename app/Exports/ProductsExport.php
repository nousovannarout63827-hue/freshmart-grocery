<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCharts;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;

class ProductsExport implements FromCollection, WithHeadings, WithMapping, WithCharts, WithEvents
{
    public function collection()
    {
        return Product::with('category')->get();
    }

    public function headings(): array
    {
        return ["Product Name", "Category", "Price ($)", "Stock Qty", "Status", "Total Value ($)"];
    }

    public function map($product): array
    {
        return [
            $product->name,
            $product->category->name ?? 'N/A',
            $product->price,
            $product->quantity,
            $product->quantity <= 5 ? 'Low Stock' : 'In Stock',
            $product->price * $product->quantity
        ];
    }

    public function charts()
    {
        $rowCount = Product::count() + 1;
        
        $dataSeriesLabels = [new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$F$1', null, 1)];
        $xAxisTickValues = [new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$A$2:$A$' . $rowCount, null, $rowCount - 1)];
        $dataSeriesValues = [new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$F$2:$F$' . $rowCount, null, $rowCount - 1)];

        $series = new DataSeries(
            DataSeries::TYPE_BARCHART,
            DataSeries::GROUPING_STANDARD,
            range(0, count($dataSeriesValues) - 1),
            $dataSeriesLabels,
            $xAxisTickValues,
            $dataSeriesValues
        );

        $plotArea = new PlotArea(null, [$series]);
        $legend = new Legend(Legend::POSITION_RIGHT, null, false);
        $title = new Title('Stock Value by Product');

        return new Chart('chart1', $title, $legend, $plotArea);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $rowCount = Product::count() + 1;
                $totalRow = $rowCount + 1;

                // Apply AutoFilter to the header (A1:F1)
                $sheet->setAutoFilter('A1:F1');
                
                // Add a Summary Row at the bottom
                $sheet->setCellValue("E{$totalRow}", "GRAND TOTAL:");
                $sheet->setCellValue("F{$totalRow}", "=SUM(F2:F{$rowCount})");

                // Styling for the summary row
                $sheet->getStyle("E{$totalRow}:F{$totalRow}")->getFont()->setBold(true);
            },
        ];
    }
}
