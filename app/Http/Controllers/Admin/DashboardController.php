<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'revenue_today' => Order::whereDate('created_at', today())->where('status', 'completed')->sum('final_amount'),
            'revenue_month' => Order::whereMonth('created_at', now()->month)->where('status', 'completed')->sum('final_amount'),
            'pending_orders' => Order::where('status', 'pending')->count(),
        ];

        $recent = Order::with('user')->latest()->limit(5)->get();

        // Doanh thu 7 ngày gần nhất
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $revenue = Order::whereDate('created_at', $date)
                ->where('status', 'completed')
                ->sum('final_amount');
            $chartData[] = ['date' => $date->format('d/m'), 'revenue' => (float) $revenue];
        }

        return view('admin.dashboard', compact('stats', 'recent', 'chartData'));
    }
}
