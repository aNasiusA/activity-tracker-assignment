<?php

namespace App\Http\Controllers;

use App\Models\ActivityUpdate;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display the reporting view with activity history
     */
    public function index(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = ActivityUpdate::with(['activity', 'user'])
            ->orderBy('updated_at_specific', 'desc');

        if ($startDate) {
            $query->whereDate('updated_at_specific', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('updated_at_specific', '<=', $endDate);
        }

        $updates = $query->paginate(20);

        return view('reports.index', [
            'updates' => $updates,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    /**
     * Export report to CSV
     */
    public function export(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = ActivityUpdate::with(['activity', 'user'])
            ->orderBy('updated_at_specific', 'desc');

        if ($startDate) {
            $query->whereDate('updated_at_specific', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('updated_at_specific', '<=', $endDate);
        }

        $updates = $query->get();

        $filename = 'activity-report-' . now()->format('Y-m-d-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($updates) {
            $file = fopen('php://output', 'w');
            // Headers
            fputcsv($file, [
                'Activity',
                'Status',
                'Personnel',
                'Remark',
                'Updated At',
            ]);

            // Data
            foreach ($updates as $update) {
                fputcsv($file, [
                    $update->activity->title,
                    ucfirst($update->status),
                    $update->user->name,
                    $update->remark ?? '',
                    $update->updated_at_specific->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
