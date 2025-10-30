@extends('dashboard::dashboard.layouts.master')

@section('title', 'Report Module')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h1>Report Module</h1>
                    <p>Module: {!! config('report.name') !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
