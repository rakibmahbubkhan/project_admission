@extends('layouts.admin')
@section('content')
<div class="container-fluid p-6">
    <div class="flex justify-between mb-4">
        <h2 class="text-2xl font-bold">Admission Forms</h2>
        <a href="{{ route('admin.forms.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Create New</a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Title / Offer</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">University</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Intake / Degree</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Fees (Tuition)</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($forms as $form)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <div class="font-bold">{{ $form->offer_title ?? $form->title }}</div>
                        <div class="text-xs text-gray-500">{{ $form->major }}</div>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $form->university_name_override ?? $form->university->name }}
                        <br><span class="text-xs text-gray-500">{{ $form->location }}</span>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <div>{{ $form->intake }}</div>
                        <div class="text-xs text-gray-500">{{ $form->degree }} ({{ $form->teaching_language }})</div>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ number_format($form->tuition_fees, 2) }}
                        <div class="text-xs text-green-600">{{ $form->scholarship_type }}</div>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <span class="relative inline-block px-3 py-1 font-semibold leading-tight {{ $form->isPublished ? 'text-green-900' : 'text-red-900' }}">
                            <span aria-hidden class="absolute inset-0 opacity-50 rounded-full {{ $form->isPublished ? 'bg-green-200' : 'bg-red-200' }}"></span>
                            <span class="relative">{{ $form->isPublished ? 'Published' : 'Draft' }}</span>
                        </span>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                        <a href="{{ route('admin.forms.edit', $form->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                        <form action="{{ route('admin.forms.destroy', $form->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:text-red-900" onclick="return confirm('Delete this form?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection