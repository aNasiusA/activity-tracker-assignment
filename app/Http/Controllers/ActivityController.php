<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ActivityController extends Controller
{
    /**
     * Display all activities for today and recent updates
     */
    public function index(Request $request)
    {
        $date = $request->query('date', now()->toDateString());
        $parsedDate = Carbon::createFromFormat('Y-m-d', $date)->startOfDay();
        
        $activities = Activity::whereDate('date', $parsedDate)
            ->with(['updates' => function ($query) {
                $query->orderBy('updated_at_specific', 'desc');
            }, 'updates.user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('activities.index', [
            'activities' => $activities,
            'date' => $date,
            'selectedDate' => $date,
        ]);
    }

    /**
     * Show the form for creating a new activity
     */
    public function create()
    {
        return view('activities.create');
    }

    /**
     * Store a newly created activity
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'date' => ['required', 'date'],
        ]);

        Activity::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        return redirect()
            ->route('activities.index', ['date' => $request->date])
            ->with('success', 'Activity created successfully!');
    }

    /**
     * Show activity details
     */
    public function show(Activity $activity)
    {
        $activity->load(['updates' => function ($query) {
            $query->orderBy('updated_at_specific', 'desc');
        }, 'updates.user']);

        return view('activities.show', compact('activity'));
    }

    /**
     * Update activity status
     */
    public function updateStatus(Request $request, Activity $activity)
    {
        $request->validate([
            'status' => ['required', 'in:pending,done'],
            'remark' => ['nullable', 'string'],
        ]);

        ActivityUpdate::create([
            'activity_id' => $activity->id,
            'user_id' => Auth::id(),
            'status' => $request->status,
            'remark' => $request->remark,
            'updated_at_specific' => now(),
        ]);

        return back()->with('success', 'Activity status updated successfully!');
    }

    /**
     * Delete an activity
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()->route('activities.index')->with('success', 'Activity deleted successfully!');
    }
}
