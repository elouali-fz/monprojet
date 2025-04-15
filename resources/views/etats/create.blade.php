@include('layouts.header')

<div class="container mt-4">
    <h2>Ajouter un état</h2>
    <form action="{{ route('etats.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="etat">Nom de l'état</label>
            <input type="text" name="etat" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-2">Ajouter</button>
    </form>
</div>

@include('layouts.footer')
