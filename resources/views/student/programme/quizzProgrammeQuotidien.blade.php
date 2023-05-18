    <div class="container">
        <h1>Quizz</h1>
        
        @foreach ($cards as $card)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Question: {{ $card->question }}</h5>
                    <p class="card-text">Matière: {{ $card->matiere }}</p>
                    <p class="card-text">Chapitre: {{ $card->chapitre }}</p>
                    <p class="card-text">Niveau: {{ $card->level }}</p>
                    <p class="card-text">Réponse: {{ $card->response }}</p>
                </div>
            </div>
        @endforeach
        
        <div class="text-center">
          
        </div>
    </div>