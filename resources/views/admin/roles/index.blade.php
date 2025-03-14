@extends('layouts.app')

@section('content')
    <h1>Rôles</h1>
    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Créer un rôle</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>
                        @foreach ($role->permissions as $permission)
                            {{ $permission->name }}<br>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary">Modifier</a>
                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display:inline">
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