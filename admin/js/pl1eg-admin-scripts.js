// Scripts per a l'administració del plugin elComplement

jQuery(document).ready(function($) {
    console.log('pl1eg admin script loaded'); // Missatge de consola per indicar que el script s'ha carregat

    // Exemple de funcionalitat: Canvia el color del botó de submissió quan es fa clic
    $('.submit').on('click', function() {
        $(this).css('background-color', '#005177'); // Canvia el color de fons del botó
    });
});
