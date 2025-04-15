@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Modifier le mode de règlement</h2>
    <form action="{{ route('mode_reglements.update', $mode_reglement->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="mode">Mode</label>
            <input type="text" name="mode" value="{{ $mode_reglement->mode }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Mettre à jour</button>
    </form>
</div>
@endsection

