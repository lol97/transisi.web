@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Company List</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <table class="table table-responsive">
            <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Website</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email }}</td>
                        <td>{{ $company->website }}</td>
                        <td>
                            <form action="{{ route('company.destroy', $company) }}" id="form_destroy_{{ $company }}" method="POST">
                                @method('delete')
                                @csrf
                            </form>
                            <a href="{{ route('company.show', $company) }}" class="btn btn-info">Detail</a>
                            <a href="{{ route('company.edit', $company) }}" class="btn btn-warning">Edit</a>
                            <button class="btn btn-danger" type="submit" form="form_destroy_{{ $company }}">Destroy</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $companies->links() }}
    </div>
</div>
@endsection
