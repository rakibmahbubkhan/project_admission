@extends('layouts.agent')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Submit Applications</h2>
        <p class="text-sm text-gray-500">Apply for university programs on behalf of your students.</p>
    </div>

    {{-- Filter Section --}}
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <form action="{{ route('Partner.forms.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <input type="text" name="search" placeholder="Search Program or University..." value="{{ request('search') }}" class="rounded-md border-gray-300">
            
            <select name="university_id" class="rounded-md border-gray-300">
                <option value="">All Universities</option>
                @foreach($universities as $uni)
                    <option value="{{ $uni->id }}" {{ request('university_id') == $uni->id ? 'selected' : '' }}>
                        {{ $uni->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                <i class="fas fa-filter mr-1"></i> Filter
            </button>
            
            <a href="{{ route('Partner.forms.index') }}" class="text-center bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                Reset
            </a>
        </form>
    </div>

    {{-- Forms Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($forms as $form)
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow border border-gray-100 flex flex-col h-full">
            <div class="p-5 flex-grow">
                <div class="flex justify-between items-start mb-3">
                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                        {{ $form->degree ?? 'Degree' }}
                    </span>
                    @if($form->deadline)
                        <span class="text-xs text-red-500 font-medium">
                            <i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($form->deadline)->format('M d') }}
                        </span>
                    @endif
                </div>
                
                <h3 class="text-lg font-bold text-gray-800 mb-1 line-clamp-2" title="{{ $form->title }}">
                    {{ $form->offer_title ?? $form->title }}
                </h3>
                <p class="text-sm text-blue-600 font-medium mb-3">
                    <i class="fas fa-university mr-1"></i> {{ $form->university->name }}
                </p>

                <div class="text-sm text-gray-500 space-y-1 mb-4">
                    <p><i class="fas fa-language w-5"></i> {{ $form->teaching_language ?? 'English' }}</p>
                    <p><i class="fas fa-map-marker-alt w-5"></i> {{ $form->location ?? 'China' }}</p>
                    <p><i class="fas fa-yen-sign w-5"></i> {{ $form->tuition_fees ?? 'N/A' }} / year</p>
                </div>
            </div>

            <div class="bg-gray-50 px-5 py-3 border-t border-gray-100 mt-auto">
                <form action="{{ route('Partner.forms.apply', $form->id) }}" method="GET" class="flex gap-2">
                    <select name="student_id" required class="flex-1 text-sm rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Select Student...</option>
                        @foreach($myStudents as $student)
                            <option value="{{ $student->id }}">{{ $student->user->name ?? 'Student' }} ({{ $student->passport_number ?? 'No PP' }})</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md transition">
                        Apply
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-10 text-gray-500">
            <i class="fas fa-folder-open text-4xl mb-3 text-gray-300"></i>
            <p>No active admission forms found matching your criteria.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $forms->links() }}
    </div>
</div>
@endsection