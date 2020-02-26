@extends('layouts.app')

@section('content')
<div  class="card">
    <div class="card-header">{{ $company->name }}</div>
    <div card-body>
        <img src="{{ $company->logoImage->url }}" alt="">
        <h3>{{ $company->email }}</h3>
        <h3>{{ $company->website }}</h3>
    </div>
    <div class="card-body">
        <table class="table table-responsive">
            <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Perusahaan</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->companyR->name }}</td>
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
