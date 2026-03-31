@extends('layouts.app')

@section('title', 'Activity Reports')

@section('content')
    <div>
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-slate-900 mb-2">Activity Reports</h1>
            <p class="text-slate-600">Analyze activity updates across custom date ranges</p>
        </div>

        <!-- Filters Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <h2 class="text-lg font-bold text-slate-900 mb-6">Filter Reports</h2>
            <form action="{{ route('reports.index') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div>
                        <label for="start_date" class="block text-sm font-semibold text-slate-700 mb-2">Start Date</label>
                        <input type="date" name="start_date" id="start_date" value="{{ $startDate }}"
                            class="w-full px-4 py-2.5 bg-slate-50 border-2 border-slate-200 rounded-lg focus:outline-none focus:border-blue-500 focus:bg-white transition-all" />
                    </div>

                    <div>
                        <label for="end_date" class="block text-sm font-semibold text-slate-700 mb-2">End Date</label>
                        <input type="date" name="end_date" id="end_date" value="{{ $endDate }}"
                            class="w-full px-4 py-2.5 bg-slate-50 border-2 border-slate-200 rounded-lg focus:outline-none focus:border-blue-500 focus:bg-white transition-all" />
                    </div>

                    <div class="flex gap-2 items-end">
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 text-white py-2.5 px-4 rounded-lg hover:shadow-lg font-semibold transition-all">
                            <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
                            </svg>
                            Filter
                        </button>
                        <a href="{{ route('reports.index') }}"
                            class="bg-slate-200 text-slate-700 py-2.5 px-4 rounded-lg hover:bg-slate-300 font-semibold transition-all">
                            Reset
                        </a>
                    </div>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('reports.export', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-600 to-teal-600 text-white py-3 px-6 rounded-lg hover:shadow-lg font-semibold transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        Export to CSV
                    </a>
                </div>
            </form>
        </div>

        <!-- Results -->
        @if ($updates->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gradient-to-r from-slate-100 to-slate-50 border-b-2 border-slate-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-bold text-slate-900">Activity</th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-slate-900">Status</th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-slate-900">Personnel</th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-slate-900">Notes</th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-slate-900">Updated</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @foreach ($updates as $update)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 text-sm">
                                        <a href="{{ route('activities.show', $update->activity) }}"
                                            class="text-blue-600 hover:text-blue-700 font-semibold">
                                            {{ $update->activity->title }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <span
                                            class="px-3 py-1 rounded-full text-white text-xs font-bold
                                            {{ $update->status === 'done' ? 'bg-gradient-to-r from-emerald-600 to-emerald-700' : 'bg-gradient-to-r from-amber-600 to-amber-700' }}">
                                            {{ ucfirst($update->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold text-slate-900">{{ $update->user->name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600">
                                        @if ($update->remark)
                                            <div class="max-w-xs truncate" title="{{ $update->remark }}">
                                                {{ $update->remark }}
                                            </div>
                                        @else
                                            <span class="text-slate-400 italic">—</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600 font-medium whitespace-nowrap">
                                        {{ $update->updated_at_specific->format('M d, H:i') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
                    {{ $updates->links() }}
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-2">No activity records found</h3>
                <p class="text-slate-600 mb-6">Try adjusting your date range to find activity updates</p>
            </div>
        @endif
    </div>
@endsection
