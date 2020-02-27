@extends('layouts.app')

@section('content')
<div  class="card">
    <div class="card-header"><h3>{{ $employee->name }}</h3></div>
    <div class="card-body row">
        <div class="col-sm-4">
            <div class="row fill">
                <img src="{{ $employee->companyR->logoImage->url }}" alt="">
            </div>
            <div class="row">
                <p class="col-offset-4">{{ $employee->companyR->name }}</p>
            </div>
        </div>
        <div class="col-sm-8">
            <table class="table table-responsive">
                <tr>
                    <td>Nama</td>
                    <td>{{ $employee->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $employee->email }}</td>
                </tr>
                <tr>
                    <td>Perusahaan</td>
                    <td>{{ $employee->companyR->name }}</td>
                </tr>
            </table>
            <a href="{{ route('employee.edit', $employee) }}" class="btn btn-warning">Ubah Data</a>
        </div>
    </div>
</div>
@endsection
