<div class="modal fade position-absolute" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true" style="z-index: 999999">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-end align-items-end border-0">
          <button type="button" class="" data-bs-dismiss="modal" aria-label="Fermer" style="background-color: #D5D5D5; border: 0px; border-radius: 50px; padding: 3px 6px!important;"><i class="fa-solid fa-xmark fa-xl"></i></button>
        </div>
        <div class="mb-0 text-center fw-bold fs-5">
        
          Êtes-vous sûr de vouloir supprimer cette carte ?
        </div>
        <div class="modal-footer d-flex justify-content-center align-items-center border-0">
            <button type="button" class="btn-principal inverse" data-bs-dismiss="modal">Non <i class="fa-regular fa-circle-xmark fa-xl ms-2"></i></button>
            <a id="confirmDelete" href="" rel="nofollow" class="btn-principal">Oui <i class="fa-regular fa-circle-check fa-xl ms-2"></i></a>            
        </div>
      </div>
    </div>
  </div>




<script>
   $(document).ready(function() {
        $('#confirmDeleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); 
        var url = button.data('url'); // data of the url

        // assign data url to the "oui" button of the delete modal
        $('#confirmDelete').attr('href', url);
        });
    });

</script>

@if(session('success'))
<div id="myModal" class="modal">
  
    <div class="modal-content">
        <div class="d-flex justify-content-end align-items-end">
            <span id="close"  style="cursor:pointer; background-color: #D5D5D5; border-radius: 50px; padding: 3px 6px!important;"><i class="fa-solid fa-xmark fa-xl"></i></span>
        </div>
        <i class="fa-solid fa-circle-check fa-2xl text-center mb-4"></i>
      <p id="success-message" class="mb-0 text-center fw-bold fs-5"></p>
      <div class="d-flex justify-content-center align-items-center m-4">
         <a class="btn-principal" id="close" href="" style="">Voir mes cartes créées <i class="fa-solid fa-clipboard-list ms-3"></i></a>
      </div>
    </div>
  </div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#success-message').text('{{ Session::get('success') }}');
        $('#myModal').css('display', 'block');
        
        $('#close').on('click', function() {
            $('#myModal').css('display', 'none');
        });
    });
</script>
@endif

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
@livewire('card.filter-card', ['list_card_all' => $list_card_all])
