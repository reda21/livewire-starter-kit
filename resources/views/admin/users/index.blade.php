@extends('layouts.app')

@section('content')
    <h1>Utilisateurs</h1>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Créer un utilisateur</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôles</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            {{ $role->name }}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($user->permissions as $permission)
                            {{ $permission->name }}<br>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Modifier</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection