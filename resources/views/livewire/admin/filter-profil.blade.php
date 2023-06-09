<div>
    <a class="btn btn-primary" style="background-color: #333333; border-color: #333333; position: absolute!important; top: 50px; right: 50px;" href='{{route('admin.profil.create')}}'> Creér un nouveau profil <i class="fa-solid fa-user-plus m-2"></i></a>
    @include('components.searchbar')
    <div class="d-flex justify-content-between mb-4">
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check mx-2 rounded" name="btnradio" id="btnradio1" wire:model="role" value="all" autocomplete="off" checked>
            <label class="btn btn-outline-secondary mx-2 rounded" for="btnradio1">Tous</label>

            <input type="radio" class="btn-check mx-2 rounded" name="btnradio" id="btnradio2" wire:model="role" value="etudiant" autocomplete="off">
            <label class="btn btn-outline-secondary mx-2 rounded" for="btnradio2">Étudiants</label>

            <input type="radio" class="btn-check mx-2 rounded" name="btnradio" id="btnradio3" wire:model="role" value="enseignant" autocomplete="off">
            <label class="btn btn-outline-secondary mx-2 rounded" for="btnradio3">Enseignants</label>
        </div>

        <select class="form-select" style="width: 15%" wire:model="sorting">
            <option value="default" selected hidden disabled>Trier par</option>
            <option value="date_desc">Date de création - Descendant</option>
            <option value="date_asc">Date de création - Ascendant</option>
            <option value="name_az">Nom - A à Z</option>
            <option value="name_za">Nom - Z à A</option>
        </select>
    </div>



        <div class="w-100">
            <div class="row justify-content-center">
                    <div class="card border-0 w-100">
                    <div class="card-body p-0 w-100">
                        <table class="table w-100 custom-table">
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>
                                            <strong>{{ $user->name }}</strong><br>
                                            @if($user->role_name == 'etudiant')
                                                {{ $user->role_name.' / '.$user->formation->label }}
                                            @elseif($user->role_name == 'enseignant')
                                            {{ $user->role_name.' / ' }}
                                            @foreach($user->matieres_list as $matiere)
                                                {{ $matiere }},
                                            @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    Créée le {{ $user->created_at ? $user->created_at->format('d/m/Y') : '-' }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-end">
                                                <div class="btn-group">
                                                    <button class="btn btn-secondary dropdown-toggle disablebg" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical" style="color: #333333;"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li> <a class="dropdown-item" href="{{ route('admin.profil.edit', $user->id) }}">Modifier</a></li>
                                                        <li><form action="{{ route('admin.profil.destroy', $user->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item">Supprimer</button>
                                                            </form></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class=" w-100">
                                        <td  class="text-center">Aucun utilisateur ne correspond à votre recherche.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>


            </div>
        </div>
    </div>
</div>
