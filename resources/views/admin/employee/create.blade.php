@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Tambah Pekerja</div>
    <div class="card-body">
        <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nama Pekerja</label>
                <input type="text" class="form-control" required name="name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" required name="email">
            </div>
            <div class="form-group">
                <label for="website">Perusahaan</label>
                <select name="company" id="company" class="form-control" required>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Tambahkan</button>
        </form>
    </div>
</div>
@endsection
