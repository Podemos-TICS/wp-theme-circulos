jQuery(document).ready(function($) {

    jQuery( "#menu-select-menu" ).change(function() {
        window.location = jQuery(this).find("option:selected").val();
    });

    $('#search').click(function() {
      $('#searchform_container').toggleClass('open');
    });

});
