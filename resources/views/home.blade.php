@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Menu</div>
                <div class="card-body">
                    <ul>
                        <li>
                            <a href="{{ route('company.index') }}">Company</a>
                            <ul>
                                <li><a href="{{ route('company.create') }}">Add Company</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('employee.index') }}">Employee</a>
                            <ul>
                                <li><a href="{{ route('employee.create') }}">Add Employee</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
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
    </div>
</div>
@endsection
