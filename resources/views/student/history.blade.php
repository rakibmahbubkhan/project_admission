@extends('layouts.student')

@section('content')
<h3>Purchase History</h3>

<table class="table mt-4">
    <tr>
        <th>University</th>
        <th>Program</th>
        <th>Amount</th>
        <th>Date</th>
    </tr>

    @foreach($payments as $p)
    <tr>
        <td>{{ $p->admissionForm->university->name }}</td>
        <td>{{ $p->admissionForm->title }}</td>
        <td>{{ $p->admissionForm->application_fee }}</td>
        <td>{{ $p->created_at->format('d M Y') }}</td>
    </tr>
    @endforeach
</table>
@endsection
