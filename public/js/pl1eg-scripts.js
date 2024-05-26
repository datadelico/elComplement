// Scripts per al frontend del plugin elComplement

jQuery(document).ready(function($) {
    console.log('pl1eg frontend script loaded'); // Missatge de consola per indicar que el script s'ha carregat

    // Exemple de funcionalitat: Afegeix una classe CSS a paràgrafs quan es fa clic
    $('.entry-content p').on('click', function() {
        $(this).toggleClass('highlight'); // Alterna la classe 'highlight' quan es fa clic
    });
});

