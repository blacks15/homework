$(document).ready(function () {
    initialComponent();

    function initialComponent(){
        global.initialSelect('selectpicker');
        global.initialTooltip();
    
        $("#txtCodigoBuscar").focus();
    }
});