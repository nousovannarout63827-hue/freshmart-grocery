<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardApiController extends Controller
{
    public function getStats()
    {
        return response()->json([
            'total_orders' => Order::count(),
            'categories_count' => Category::count(),
            'products_count' => Product::count(),
            'low_stock_count' => Product::whereColumn('quantity', '<=', 'min_stock_level')->count(),
        ]);
    }
}
