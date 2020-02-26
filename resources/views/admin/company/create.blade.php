@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Tambah Perusahaan</div>
    <div class="card-body">
        <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nama Perusahaan</label>
                <input type="text" class="form-control" required name="name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" required name="email">
            </div>
            <div class="form-group">
                <label for="email">Logo</label>
                <input type="file" class="form-control-file" required name="logo">
            </div>
            <div class="form-group">
                <label for="website">Webiste</label>
                <input type="text" class="form-control" required name="website">
            </div>
            <button type="submit" class="btn btn-success">Tambahkan</button>
        </form>
    </div>
</div>
@endsection
