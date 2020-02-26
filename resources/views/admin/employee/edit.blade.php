@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Tambah Perusahaan</div>

    <div class="card-body">
        <form action="{{ route('employee.update', $employee) }}" method="POST" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" required name="name" value="{{ $employee->name }}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" required name="email" value="{{ $employee->email }}">
            </div>
            <div class="form-group">
                <label for="company">company</label>
                <select name="company" id="company" class="form-control">
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ $company->id === $employee->company ? 'selected' : ''  }}>{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-warning">Edit</button>
        </form>
    </div>
</div>
@endsection
