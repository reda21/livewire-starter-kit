@extends('layouts.app')

@section('content')
    <h1>Attribuer des rôles et permissions à un utilisateur</h1>
    <form action="{{ route('admin.users.assign', $user->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="roles">Rôles</label>
            <select name="roles[]" id="roles" class="form-control" multiple>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="permissions">Permissions</label>
            <select name="permissions[]" id="permissions" class="form-control" multiple>
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->id }}" {{ $user->permissions->contains($permission->id) ? 'selected' : '' }}>{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Attribuer</button>
    </form>
@endsection