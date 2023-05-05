<h1>le paquet de cartes</h1>
@if (auth()->user()->hasRole('student'))
@foreach ($list_card_all as $list_card)

<p>Creée par {{$list_card->created_by}}</p>
<p>Chapitre {{$list_card->card_chapitre}}</p>
<p>Niveau : {{$list_card->level}}</p>
<p>Créée le : {{$list_card->created_at}}</p>
<p>Question: {{$list_card->question}}</p>
<p>Réponse : {{$list_card->response}}</p>
<br>

@endforeach
@endif
