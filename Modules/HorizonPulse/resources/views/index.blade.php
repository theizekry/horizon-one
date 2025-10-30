@extends('dashboard::dashboard.layouts.master')

@section('title', 'Horizon Pulse - Live Monitoring')

@section('content')
<x-horizonpulse::horizon-pulse-dashboard></x-horizonpulse::horizon-pulse-dashboard>
@endsection

@push('js')
    <script>
        console.log('Inline script is working...');
        document.addEventListener('DOMContentLoaded', function() {
            const targetElement = document.getElementById('horizon-pulse-dashboard');
            console.log('Target element found:', targetElement);
            if (targetElement) {
                targetElement.innerHTML = '<h1>Inline JavaScript is working!</h1><p>Vue should work too.</p>';
            }
        });
    </script>
    @vite(['Modules/HorizonPulse/resources/assets/js/app.js', 'Modules/HorizonPulse/resources/assets/sass/app.scss'])
@endpush
