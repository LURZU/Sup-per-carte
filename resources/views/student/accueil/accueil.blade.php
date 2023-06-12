<x-app-layout>
    @section('display_title_h1', 'd-none')
<div>
    <h1 class="fs-4 fw-bold text-center mt-4">Bienvenue sur SUP'PER Carte</h1>
    <p class="text-center">Choisis une carte mémoire*</p>

    <div class="d-flex"> 
        <div class="w-50 me-1 h-100" >
            <a style="color: #333333; text-decoration: none" href="{{route('programme.select')}}">
            <div class="py-2" style="border-radius: 10px 10px 0px 0px; background-color: #D5D5D5;">
                <p class="text-center fw-bold fs-5 mt-5">
                Programme<br> quotidien
                </p>
                <p>
                <p class="text-center" style="font-size: 13px">Mode ancrage</p>
            </div>
            <a class="d-block w-100 text-center py-2  text-white" style="background-color: #333333; font-size: 16px ; border-radius: 0px 0px 10px 10px; text-decoration: none;" href="{{ route('programme.select') }}">C'est parti !</a>
            </a>
        </div>
        <div class="w-50 ms-1" >
            <a style="color: #333333; text-decoration: none" href="{{route('programme.select')}}">
            <div class="py-2" style="background-color: #D5D5D5; border-radius: 15px 15px 0px 0px;">
                <p class="text-center fw-bold fs-5 mt-5">
                Entrainement<br> libre
                </p>
                <p class="text-center" style="font-size: 13px">Carte en plus</p>
            </div>
            <a class="d-block w-100 text-center py-2 text-white" style="background-color: #333333; font-size: 16px ;border-radius: 0px 0px 10px 10px; text-decoration: none;" href="{{ route('programme.select') }}">C'est parti !</a>
            </a>
        </div>
    </div>

    <a href="{{route('programme.mycard.select')}}"class="w-100 text-center d-block mt-4 py-2 text-white" style="font-size: 18px; background-color: #333333; border-radius: 8px; text-decoration: none; color: white!important">J'utilise mes cartes crées</a>

    <p class="text-center mt-3 mb-0">Je n'ai pas de carte mémoire ?</p>
    <a class="text-center mt-0  w-100 text-center d-block" style="color: #333333" href="{{route('card.create')}}">Je crée une carte</a>

    <p class="text-center mt-2" style="font-size: 14px">* Qu'est ce qu'une carte mémoire ?<br>
        C'est un système d'auto evaluation où tous les <br>
        jours tu as des petites questions sur les bases <br>
        du cours qui te permettent de réviser
    </p>

</div>
</x-app-layout>