@extends('layouts.student')

@section('content')
<h2 class="text-2xl font-bold mb-4">My Submitted Applications</h2>

<div class="bg-white rounded shadow p-4">

    <table class="w-full border">
        <tr class="bg-gray-100 border-b">
            <th class="p-2 text-left">Form</th>
            <th class="p-2 text-left">University</th>
            <th class="p-2 text-left">Status</th>
            <th class="p-2 text-left">Submitted Date</th>
        </tr>

        @foreach ($submissions as $s)
            <tr class="border-b">
                <td class="p-2">{{ $s->form->title }}</td>
                <td class="p-2">{{ $s->form->university->name }}</td>
                <td class="p-2">{{ ucfirst($s->status) }}</td>
                <td class="p-2">{{ $s->created_at->format('d M, Y') }}</td>
            </tr>
        @endforeach

    </table>
</div>

@endsection
