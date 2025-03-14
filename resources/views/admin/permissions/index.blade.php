@extends('layouts.app')

@section('content')
    <h1>Permissions</h1>
    <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">Créer une permission</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>
                        <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-primary">Modifier</a>
                        <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" style="display:inline">
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