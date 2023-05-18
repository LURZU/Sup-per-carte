
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Dashboard</h2>
                <ul>
                    <li><a href="{{ route('parameters') }}">Paramètres</a></li>
                    <li><a href="{{ route('student_statistics') }}">Statistiques étudiant</a></li>
                    <li><a href="{{ route('created_cards') }}">Cartes créées</a></li>
                </ul>
            </div>
            <div class="col-md-6">
                <h2>Profils</h2>
                <ul>
                    <li><a href="{{ route('student_profile') }}">Profil étudiant</a></li>
                    <li><a href="{{ route('teacher_profile') }}">Profil enseignant</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
