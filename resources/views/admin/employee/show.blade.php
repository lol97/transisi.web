@extends('layouts.app')

@section('content')
<div  class="card">
    <div class="card-header">{{ $employee->name }}</div>
    <div card-body>
        <h3>{{ $employee->email }}</h3>
        <h3>{{ $employee->companyR->name }}</h3>
    </div>
</div>
@endsection
