@extends('layouts.app')

@section('content')

<div class="col-md-8">
    <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <h3>TOTAL PERUSAHAAN</h3>
            <h4>{{ $totals_companies }}</h4>

            <h3>TOTAL KARYAWAN</h3>
            <h4>{{ $totals_employees }}</h4>
        </div>
    </div>
</div>

@endsection
