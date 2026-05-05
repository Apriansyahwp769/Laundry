<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Complaint;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();
        
        // 1. Total Processed Today (Kg)
        $totalProcessedToday = Order::whereDate('completed_at', $today)
            ->where('status', 'delivered')
            ->sum('total_weight') ?? 0;

        // 2. Orders in Queue
        $ordersInQueue = Order::whereIn('status', ['waiting', 'washing', 'ironing', 'ready'])->count();

        // 3. Unhandled Complaints
        $unhandledComplaints = Complaint::whereIn('status', ['new', 'investigating'])->count();

        // 4. Weekly Revenue Data for Chart
        $chartLabels = [];
        $chartData = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $chartLabels[] = $date->format('D');
            
            $revenue = Order::where('status', 'delivered')
                ->whereDate('completed_at', $date->toDateString())
                ->sum('total_price');
            
            $chartData[] = (float) $revenue;
        }

        $weeklyRevenue = array_sum($chartData);

        // 5. Attention Required (Complaints with order info)
        $attentionRequired = Complaint::with(['order'])
            ->whereIn('status', ['new', 'investigating'])
            ->orderByRaw("FIELD(priority, 'high', 'medium', 'low')")
            ->latest()
            ->take(5)
            ->get();

        // ✅ KUMPULKAN SEMUA DALAM ARRAY $stats (sesuai yang diharapkan view)
        $stats = [
            'total_processed_today' => $totalProcessedToday,
            'orders_in_queue' => $ordersInQueue,
            'unhandled_complaints' => $unhandledComplaints,
            'weekly_revenue' => $weeklyRevenue,
            'chart_labels' => $chartLabels,
            'chart_data' => $chartData,
        ];

        return view('admin.dashboard', compact('stats', 'attentionRequired'));
    }
}