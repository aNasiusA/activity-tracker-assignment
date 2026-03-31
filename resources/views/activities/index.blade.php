@extends('layouts.app')

@section('title', 'Activities Dashboard')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Sidebar: Quick Actions & Date -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Date Picker Card -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl shadow-lg p-6">
                <label for="dateSelect" class="block text-sm font-semibold text-slate-700 mb-3">Select Date</label>
                <form action="{{ route('activities.index') }}" method="GET">
                    <input type="date" name="date" id="dateSelect" value="{{ $selectedDate }}"
                        class="w-full px-4 py-2.5 bg-white border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-500 transition-all font-medium"
                        onchange="this.form.submit()" />
                </form>
            </div>

            <!-- New Activity Button -->
            <a href="{{ route('activities.create') }}"
                class="w-full block bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 px-4 rounded-lg hover:shadow-lg font-semibold transition-all text-center">
                <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                New Activity
            </a>

            <!-- Reports Button -->
            <a href="{{ route('reports.index') }}"
                class="w-full block bg-gradient-to-r from-emerald-600 to-emerald-700 text-white py-3 px-4 rounded-lg hover:shadow-lg font-semibold transition-all text-center">
                <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                </svg>
                View Reports
            </a>
        </div>

        <!-- Main Content: Activities List -->
        <div class="lg:col-span-3">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-4xl font-bold text-slate-900 mb-2">
                    {{ \Carbon\Carbon::parse($selectedDate)->format('l, F j') }}
                </h1>
                <p class="text-slate-600">{{ $activities->count() }}
                    {{ $activities->count() === 1 ? 'activity' : 'activities' }} today</p>
            </div>

            @if ($activities->isEmpty())
                <!-- Empty State -->
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-2">No activities yet</h3>
                    <p class="text-slate-600 mb-6">Create your first activity to get started</p>
                    <a href="{{ route('activities.create') }}"
                        class="inline-block bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 px-8 rounded-lg font-semibold hover:shadow-lg transition-all">
                        Create First Activity
                    </a>
                </div>
            @else
                <!-- Activities Cards Grid -->
                <div class="space-y-4">
                    @foreach ($activities as $activity)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all group">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex-1">
                                        <h3
                                            class="text-xl font-bold text-slate-900 group-hover:text-blue-600 transition-colors">
                                            {{ $activity->title }}</h3>
                                        @if ($activity->description)
                                            <p class="text-slate-600 mt-2 text-sm">{{ $activity->description }}</p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Current Status -->
                                @if ($activity->latestUpdate())
                                    <div
                                        class="bg-gradient-to-r {{ $activity->latestUpdate()->status === 'done' ? 'from-emerald-50 to-teal-50 border-l-4 border-emerald-500' : 'from-amber-50 to-orange-50 border-l-4 border-amber-500' }} rounded-lg p-4 mt-4 space-y-3">
                                        <div class="flex items-center gap-3">
                                            @if ($activity->latestUpdate()->status === 'done')
                                                <div class="bg-emerald-500 rounded-full p-2">
                                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <span class="text-sm font-bold text-emerald-800">Completed</span>
                                            @else
                                                <div class="bg-amber-500 rounded-full p-2">
                                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <span class="text-sm font-bold text-amber-800">Pending</span>
                                            @endif
                                        </div>

                                        <div class="grid grid-cols-2 gap-3 text-sm">
                                            <div>
                                                <p class="text-slate-600 text-xs font-medium">Updated by</p>
                                                <p class="font-semibold text-slate-900">
                                                    {{ $activity->latestUpdate()->user->name }}</p>
                                            </div>
                                            <div>
                                                <p class="text-slate-600 text-xs font-medium">Time</p>
                                                <p class="font-semibold text-slate-900">
                                                    {{ $activity->latestUpdate()->updated_at_specific->format('H:i') }}</p>
                                            </div>
                                        </div>

                                        @if ($activity->latestUpdate()->remark)
                                            <div class="border-t border-slate-200 pt-3 mt-3">
                                                <p class="text-xs font-medium text-slate-600 mb-1">Remark</p>
                                                <p class="text-slate-700 italic">{{ $activity->latestUpdate()->remark }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                <!-- Update History -->
                                @if ($activity->updates->count() > 1)
                                    <details class="mt-4">
                                        <summary
                                            class="text-sm text-blue-600 hover:text-blue-700 cursor-pointer font-medium flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            View all {{ $activity->updates->count() }} updates
                                        </summary>
                                        <div class="mt-3 space-y-2">
                                            @foreach ($activity->updates as $update)
                                                <div class="bg-slate-50 p-3 rounded-lg border border-slate-200 text-sm">
                                                    <div class="flex items-center gap-2 mb-1">
                                                        <span
                                                            class="px-2 py-0.5 rounded text-white text-xs font-bold
                                                            {{ $update->status === 'done' ? 'bg-emerald-600' : 'bg-amber-600' }}">
                                                            {{ ucfirst($update->status) }}
                                                        </span>
                                                        <span
                                                            class="text-slate-600 font-medium">{{ $update->user->name }}</span>
                                                        <span
                                                            class="text-slate-500 ml-auto">{{ $update->updated_at_specific->format('H:i') }}</span>
                                                    </div>
                                                    @if ($update->remark)
                                                        <p class="text-slate-700">{{ $update->remark }}</p>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </details>
                                @endif

                                <!-- Action Buttons -->
                                <div class="flex gap-2 mt-5 pt-4 border-t border-slate-200">
                                    <a href="{{ route('activities.show', $activity) }}"
                                        class="flex-1 bg-blue-50 text-blue-600 hover:bg-blue-100 py-2 px-3 rounded-lg font-semibold transition-all text-center text-sm">
                                        Update Status
                                    </a>
                                    <form action="{{ route('activities.destroy', $activity) }}" method="POST"
                                        class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-full bg-red-50 text-red-600 hover:bg-red-100 py-2 px-3 rounded-lg font-semibold transition-all text-sm"
                                            onclick="return confirm('Delete this activity?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
