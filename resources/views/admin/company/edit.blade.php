@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Tambah Perusahaan</div>

    <div class="card-body">
        <form action="{{ route('company.update', $company) }}" method="POST" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="form-group">
                <label for="name">Nama Perusahaan</label>
                <input type="text" class="form-control" required name="name" value="{{ $company->name }}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" required name="email" value="{{ $company->email }}">
            </div>
            <div class="form-group">
                <label for="email">Logo</label>
                <input type="file" class="form-control-file" name="logo">
            </div>
            <div class="form-group">
                <label for="website">Webiste</label>
                <input type="text" class="form-control" required name="website" value="{{ $company->website }}">
            </div>
            <button type="submit" class="btn btn-warning">Edit</button>
        </form>
    </div>
</div>
@endsection
