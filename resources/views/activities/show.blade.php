@extends('layouts.app')

@section('title', 'Update Activity')

@section('content')
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('activities.index') }}"
                class="text-blue-600 hover:text-blue-700 font-semibold flex items-center gap-2 mb-4">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Back to Dashboard
            </a>
            <h1 class="text-4xl font-bold text-slate-900 mb-2">{{ $activity->title }}</h1>
            @if ($activity->description)
                <p class="text-slate-600 text-lg">{{ $activity->description }}</p>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form Section -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Update Status</h2>

                    <form action="{{ route('activities.updateStatus', $activity) }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="status" class="block text-sm font-semibold text-slate-700 mb-3">Select Status
                                *</label>
                            <select name="status" id="status"
                                class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-lg focus:outline-none focus:border-blue-500 focus:bg-white transition-all font-medium"
                                required>
                                <option value="">-- Choose a status --</option>
                                <option value="pending" class="py-2">⏳ Pending - Work in progress</option>
                                <option value="done" class="py-2">✅ Done - Completed</option>
                            </select>
                        </div>

                        <div>
                            <label for="remark" class="block text-sm font-semibold text-slate-700 mb-3">Add Notes</label>
                            <textarea name="remark" id="remark" rows="5" placeholder="Document any important details..."
                                class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-lg focus:outline-none focus:border-blue-500 focus:bg-white transition-all">{{ old('remark') }}</textarea>
                        </div>

                        <div class="flex gap-3 pt-4">
                            <button type="submit"
                                class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 px-4 rounded-lg hover:shadow-lg font-semibold transition-all">
                                <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                Save Update
                            </button>
                            <a href="{{ route('activities.index') }}"
                                class="flex-1 border-2 border-slate-200 text-slate-700 py-3 px-4 rounded-lg hover:bg-slate-50 font-semibold transition-all text-center">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Card -->
            <div>
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl shadow-lg p-6 border border-blue-200">
                    <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wide mb-4">Activity Info</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs font-medium text-slate-600 mb-1">Date</p>
                            <p class="text-lg font-bold text-slate-900">{{ $activity->date->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-600 mb-1">Day</p>
                            <p class="text-lg font-bold text-slate-900">{{ $activity->date->format('l') }}</p>
                        </div>
                        <div class="pt-4 border-t border-blue-200">
                            <p class="text-xs font-medium text-slate-600 mb-2">Total Updates</p>
                            <p class="text-3xl font-bold text-blue-600">{{ $activity->updates->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update History -->
        @if ($activity->updates->count() > 0)
            <div class="mt-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">History</h2>
                <div class="space-y-4">
                    @foreach ($activity->updates as $update)
                        <div
                            class="bg-white rounded-2xl shadow-lg overflow-hidden border-l-4 {{ $update->status === 'done' ? 'border-emerald-500' : 'border-amber-500' }}">
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center gap-3">
                                        @if ($update->status === 'done')
                                            <div class="bg-emerald-500 rounded-full p-2">
                                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-bold text-slate-900">Completed</p>
                                                <p class="text-sm text-slate-600">{{ $update->status }}</p>
                                            </div>
                                        @else
                                            <div class="bg-amber-500 rounded-full p-2">
                                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-bold text-slate-900">Pending</p>
                                                <p class="text-sm text-slate-600">{{ $update->status }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <time
                                        class="text-sm font-semibold text-slate-600">{{ $update->updated_at_specific->format('M d, H:i') }}</time>
                                </div>

                                <div class="grid grid-cols-2 gap-4 mb-4 pb-4 border-b border-slate-200">
                                    <div>
                                        <p class="text-xs font-medium text-slate-600 mb-1">Updated by</p>
                                        <p class="font-semibold text-slate-900">{{ $update->user->name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-slate-600 mb-1">Time</p>
                                        <p class="font-semibold text-slate-900">
                                            {{ $update->updated_at_specific->format('H:i') }}</p>
                                    </div>
                                </div>

                                @if ($update->remark)
                                    <div>
                                        <p class="text-xs font-medium text-slate-600 mb-2">Notes</p>
                                        <p class="text-slate-700 italic">{{ $update->remark }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
