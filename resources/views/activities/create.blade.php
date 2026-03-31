@extends('layouts.app')

@section('title', 'Create Activity')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-slate-900 mb-2">Create Activity</h1>
            <p class="text-slate-600">Add a new activity to track</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form action="{{ route('activities.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Activity Title *</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        placeholder="e.g., Daily SMS count comparison"
                        class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-lg focus:outline-none focus:border-blue-500 focus:bg-white transition-all @error('title') border-red-500 @enderror"
                        required autofocus />
                    @error('title')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18.101 12.93a1 1 0 00-1.414-1.414L10 17.586l-6.687-6.687a1 1 0 00-1.414 1.414l8 8a1 1 0 001.414 0l8-8z"
                                    clip-rule="evenodd" />
                                </path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="4" placeholder="Add more details about this activity..."
                        class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-lg focus:outline-none focus:border-blue-500 focus:bg-white transition-all @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18.101 12.93a1 1 0 00-1.414-1.414L10 17.586l-6.687-6.687a1 1 0 00-1.414 1.414l8 8a1 1 0 001.414 0l8-8z"
                                    clip-rule="evenodd" />
                                </path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="date" class="block text-sm font-semibold text-slate-700 mb-2">Date *</label>
                    <input type="date" name="date" id="date" value="{{ old('date', now()->toDateString()) }}"
                        class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-lg focus:outline-none focus:border-blue-500 focus:bg-white transition-all @error('date') border-red-500 @enderror"
                        required />
                    @error('date')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18.101 12.93a1 1 0 00-1.414-1.414L10 17.586l-6.687-6.687a1 1 0 00-1.414 1.414l8 8a1 1 0 001.414 0l8-8z"
                                    clip-rule="evenodd" />
                                </path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit"
                        class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 px-4 rounded-lg hover:shadow-lg font-semibold transition-all duration-200">
                        Create Activity
                    </button>
                    <a href="{{ route('activities.index') }}"
                        class="flex-1 border-2 border-slate-200 text-slate-700 py-3 px-4 rounded-lg hover:bg-slate-50 font-semibold transition-all text-center">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
