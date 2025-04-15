@extends('layouts.app')

@section('content')
    <h2>Modifier la Sous-Famille</h2>
    <form action="{{ route('sous_familles.update', $sous_famille->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="famille_id">Famille</label>
            <select name="famille_id" class="form-control" required>
                @foreach ($familles as $famille)
                    <option value="{{ $famille->id }}" {{ $sous_famille->famille_id == $famille->id ? 'selected' : '' }}>
                        {{ $famille->libelle }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Libellé</label>
            <input type="text" name="libelle" class="form-control" value="{{ $sous_famille->libelle }}" required>
        </div>
        <div class="mb-3">
            <label>Image actuelle</label><br>
            @if ($sous_famille->image)
                <img src="{{ asset('storage/' . $sous_famille->image) }}" width="100"><br><br>
            @endif
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
@endsection