@extends('layouts.app')

@section('content')
<div  class="card">
    <div class="card-header">{{ $company->name }}</div>
    <div card-body>
        <img src="{{ $company->logoImage->url }}" alt="">
        <h3>{{ $company->email }}</h3>
        <h3>{{ $company->website }}</h3>
    </div>
</div>
@endsection
