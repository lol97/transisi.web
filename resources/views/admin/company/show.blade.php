@extends('layouts.app')

@section('content')
<div  class="card">
    <div class="card-header"><h2>{{ $company->name }}</h2></div>
    <div class="card-body row">
        <div class="col-sm-4 fill">
            <img src="{{ $company->logoImage->url }}" alt="">
        </div>
        <div class="col-sm-8">
            <table class="table table-responsive">
                <tr>
                    <td>Nama Perusahaan </td>
                    <td>{{ $company->name }}</td>
                </tr>
                <tr>
                    <td>Email Perusahaan </td>
                    <td>{{ $company->email }}</td>
                </tr>
                <tr>
                    <td>Website Perusahaan </td>
                    <td><a href="{{ $company->website }}">{{ $company->website }}</a></td>
                </tr>
            </table>
            <a href="{{ route('company.edit', $company) }}" class="btn btn-warning">Ubah Data</a>
        </div>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header">list pegawai</div>
    <div class="card-body">
        <table class="table table-responsive">
            <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>
                            <form action="{{ route('employee.destroy', $employee) }}" id="form_destroy_{{ $employee }}" method="POST">
                                @method('delete')
                                @csrf
                            </form>
                            <a href="{{ route('employee.show', $employee) }}" class="btn btn-info">Detail</a>
                            <a href="{{ route('employee.edit', $employee) }}" class="btn btn-warning">Edit</a>
                            <button class="btn btn-danger" type="submit" form="form_destroy_{{ $employee }}">Destroy</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $employees->links() }}
    </div>
</div>
@endsection
