console.log('app.js chargé');
$('body').on('click', '.btn.formations', function(e) {
    if($('body .collapse.formations').hasClass('show')) {
        $('body .collapse.formations').removeClass('show');
        $('body .btn.formations i').removeClass('fa-chevron-up')
        $('body .btn.formations i').addClass('fa-chevron-down')
    } else {
        $('body .collapse.formations').addClass('show')
        $('body .btn.formations i').removeClass('fa-chevron-down')
        $('body .btn.formations i').addClass('fa-chevron-up')
    }
});

$('body').on('click', '.btn.matieres', function(e) {
    if($('body .collapse.matieres').hasClass('show')) {
        $('body .collapse.matieres').removeClass('show');
        $('body .btn.matieres i').removeClass('fa-chevron-up')
        $('body .btn.matieres i').addClass('fa-chevron-down')
    } else {
        $('body .collapse.matieres').addClass('show')
        $('body .btn.matieres i').removeClass('fa-chevron-down')
        $('body .btn.matieres i').addClass('fa-chevron-up')
    }
});

$('body').on('click', '.btn.chapitres', function(e) {
    if($('body .collapse.chapitres').hasClass('show')) {
        $('body .collapse.chapitres').removeClass('show');
        $('body .btn.chapitres i').removeClass('fa-chevron-up')
        $('body .btn.chapitres i').addClass('fa-chevron-down')
    } else {
        $('body .collapse.chapitres').addClass('show')
        $('body .btn.chapitres i').removeClass('fa-chevron-down')
        $('body .btn.chapitres i').addClass('fa-chevron-up')
    }
});

$('body').on('click', '.btn.niveaux', function(e) {
    if($('body .collapse.niveaux').hasClass('show')) {
        $('body .collapse.niveaux').removeClass('show');
        $('body .btn.niveaux i').removeClass('fa-chevron-up')
        $('body .btn.niveaux i').addClass('fa-chevron-down')
    } else {
        $('body .collapse.niveaux').addClass('show')
        $('body .btn.niveaux i').removeClass('fa-chevron-down')
        $('body .btn.niveaux i').addClass('fa-chevron-up')
    }
});

// For tabs in card list
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
});

// For card filter

$('body').on('click','#apply-filters', function() {
    var selectedFormation = [];
    $('#formationsCheckboxes input[type=checkbox]').each(function() {
        if ($(this).is(":checked")) {
            selectedFormation.push($(this).val());
        }
    });

    var selectedMatiere = [];
    $('#matieresCheckboxes input[type=checkbox]').each(function() {
        if ($(this).is(":checked")) {
            selectedMatiere.push($(this).val());
        }
    });

    var selectedChapitre = [];
    $('#chapitresCheckboxes input[type=checkbox]').each(function() {
        if ($(this).is(":checked")) {
            selectedChapitre.push($(this).val());
        }
    });

    var selectedNiveau = [];
    $('#niveauxCheckboxes input[type=checkbox]').each(function() {
        if ($(this).is(":checked")) {
            selectedNiveau.push($(this).val());
        }
    });

    window.livewire.emit('applyFilters', selectedFormation, selectedMatiere, selectedChapitre, selectedNiveau);
});



