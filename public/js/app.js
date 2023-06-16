$('document').ready(function () {

    $('.burger-menu').click(function () {
        $('#sidebar-wrapper').slideToggle();
    });
    const icons = document.querySelectorAll('.icon');
    icons.forEach(icon => {
        icon.addEventListener('click', (event) => {
            icon.classList.toggle("open");
        });
    });

    /* Formations */
    $('body').on('click', '.btn.formations', function (e) {
        cardsFiltersToggleDropDown('formations');
    });

    /* Matières */
    $('body').on('click', '.btn.matieres', function (e) {
        cardsFiltersToggleDropDown('matieres');
    });

    /* Chapitres */
    $('body').on('click', '.btn.chapitres', function (e) {
        cardsFiltersToggleDropDown('chapitres');
    });

    /* Niveaux */
    $('body').on('click', '.btn.niveaux', function (e) {
        cardsFiltersToggleDropDown('niveaux');
    });

    /**
     * Function for filter dropdown
     * @param btn
     */
    function cardsFiltersToggleDropDown(btn) {
        let collapse = $('body .collapse.' + btn);
        let icon = $('body .btn.' + btn + ' i');
        if (collapse.hasClass('show')) {
            collapse.removeClass('show');
            icon.removeClass('fa-chevron-up')
            icon.addClass('fa-chevron-down')
        } else {
            collapse.addClass('show')
            icon.removeClass('fa-chevron-down')
            icon.addClass('fa-chevron-up')
        }
    }

/* Cartes */
// For tabs in card list
    $(".nav-tabs a").click(function () {
        $(this).tab('show');
    });

});


// For card filter
$('body').on('click', '#apply-filters', function () {
    let selectedFormation = [];
    $('#formationsCheckboxes input[type=checkbox]').each(function () {
        if ($(this).is(":checked")) {
            selectedFormation.push($(this).val());
        }
    });

    let selectedMatiere = [];
    $('#matieresCheckboxes input[type=checkbox]').each(function () {
        if ($(this).is(":checked")) {
            selectedMatiere.push($(this).val());
        }
    });

    let selectedChapitre = [];
    $('#chapitresCheckboxes input[type=checkbox]').each(function () {
        if ($(this).is(":checked")) {
            selectedChapitre.push($(this).val());
        }
    });

    let selectedNiveau = [];
    $('#niveauxCheckboxes input[type=checkbox]').each(function () {
        if ($(this).is(":checked")) {
            selectedNiveau.push($(this).val());
        }
    });

    window.livewire.emit('applyFilters', selectedFormation, selectedMatiere, selectedChapitre, selectedNiveau);
});







