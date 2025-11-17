@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Super Admin Dashboard</h3>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card p-3">
                <h5>Total Agents</h5>
                <h2>{{ $total_agents }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <h5>Total Students</h5>
                <h2>{{ $total_students }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <h5>Total Forms</h5>
                <h2>{{ $total_forms }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <h5>Total Submissions</h5>
                <h2>{{ $total_submissions }}</h2>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card p-3">
                <h5>Total Commission</h5>
                <h2>${{ number_format($total_commission, 2) }}</h2>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3">
                <h5>Paid Commission</h5>
                <h2>${{ number_format($paid_commission, 2) }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection
