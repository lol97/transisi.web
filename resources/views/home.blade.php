@extends('layouts.app')

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body row">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card col-sm-6">
                <div class="card-body">
                    <div class="card-title"><h3>TOTAL PERUSAHAAN</h3></div>
                    <h2>{{ $totals_companies }}</h2>
                </div>
            </div>
            <div class="card col-sm-6">
                <div class="card-body">
                    <div class="card-title"><h3>TOTAL KARYAWAN</h3></div>
                    <h2>{{ $totals_employees }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
