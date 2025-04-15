@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Ajouter un mode de règlement</h2>
    <form action="{{ route('mode_reglements.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="mode">Mode</label>
            <input type="text" name="mode" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-2">Enregistrer</button>
    </form>
</div>
@endsection

