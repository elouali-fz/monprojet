@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Modifier l'état</h2>
    <form action="{{ route('etats.update', $etat->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="etat">État</label>
            <input type="text" name="etat" value="{{ $etat->etat }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Mettre à jour</button>
    </form>
</div>
@endsection

