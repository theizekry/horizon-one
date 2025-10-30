@extends('dashboard::dashboard.layouts.master')

@section('title', 'Core Module')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h1>Hello World</h1>
                    <p>Module: {!! config('core.name') !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
