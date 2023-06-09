@extends('admin.base')

@section('content')
    
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Matieres <a href="{{ route('admin.matiere.create') }}" class="btn btn-primary">Créer une matiere</a></div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom de la matière</th>
                                    <th>Assigné à la formation Formation</th>
                                    <th>Enseignants référent</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($matieres as $matiere)
                                    <tr>
                                        <td>{{ $matiere->label }}</td>
                                        <td>{{ implode(', ', $matiere->formationLabels) }}</td>
                                        <td>{{ $matiere->label }}</td>
                                        <td>
                                            <a href="{{ route('admin.matiere.edit', $matiere->id) }}" class="btn btn-primary">Modifier</a>
                                            <form action="{{ route('admin.matiere.destroy', $matiere->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                            <!-- Ajoutez d'autres options de modification si nécessaire -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
