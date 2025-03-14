@extends('layouts.app')

@section('content')
    <h1>Modifier un utilisateur</h1>
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
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
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
@endsection