jQuery(document).ready(function($) {

    jQuery( "#menu-select-menu" ).change(function() {
        window.location = jQuery(this).find("option:selected").val();
    });

});
