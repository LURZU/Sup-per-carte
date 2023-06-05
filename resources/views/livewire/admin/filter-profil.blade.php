

<div>
<div class="d-flex justify-content-between align-items-center mb-3 border border-dark rounded"> 
    <input type="text" class="form-control border-0" placeholder="Recherche" wire:model="search">
    <i class="fas fa-search text-muted px-3"></i>
</div>
<div class="btn-group" role="group" aria-label="Basic radio toggle button group">
    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
    <label class="btn btn-outline-primary" for="btnradio1" value="all">Tous</label>
  
    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
    <label class="btn btn-outline-primary" for="btnradio2">Étudiants</label>
  
    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
    <label class="btn btn-outline-primary" for="btnradio3">Enseignants</label>
  </div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

             
                    
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Role / Formation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        @if($user->role_name == 'Etudiant')
                                        <td>{{ $user->role_name.' / '.$user->formation }}</td>
                                        @else
                                        <td>{{ $user->role_name }}</td>
                                        @endif
                                        <td>
                                            <a href="{{ route('admin.profil.edit', $user->id) }}" class="btn btn-primary">Modifier</a>
                                            <form action="{{ route('admin.profil.destroy', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                  
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
</div>
