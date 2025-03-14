@extends('layouts.app')

@section('content')
    <h1>Modifier un rôle</h1>
    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" required>
        </div>
        <div class="form-group">
            <label for="display_name">Nom affiché</label>
            <input type="text" name="display_name" id="display_name" class="form-control" value="{{ $role->display_name }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $role->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="permissions">Permissions</label>
            <select name="permissions[]" id="permissions" class="form-control" multiple>
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->id }}" {{ $role->permissions->contains($permission->id) ? 'selected' : '' }}>{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
@endsection