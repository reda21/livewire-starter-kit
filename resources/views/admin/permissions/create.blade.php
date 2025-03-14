@extends('layouts.app')

@section('content')
    <h1>Créer une permission</h1>
    <form action="{{ route('admin.permissions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="display_name">Nom affiché</label>
            <input type="text" name="display_name" id="display_name" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
@endsection