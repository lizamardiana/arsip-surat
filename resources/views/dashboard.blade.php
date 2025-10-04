@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">📊 Dashboard</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <p>Selamat datang, {{ auth()->user()->name }}! 🎉</p>
            <p class="text-success">You're logged in!</p>
        </div>
    </div>
</div>
@endsection
