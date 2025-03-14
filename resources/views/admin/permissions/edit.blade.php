@extends('layouts.app')

@section('content')
    <h1>Modifier une permission</h1>
    <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $permission->name }}" required>
        </div>
        <div class="form-group">
            <label for="display_name">Nom affiché</label>
            <input type="text" name="display_name" id="display_name" class="form-control" value="{{ $permission->display_name }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $permission->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
@endsection