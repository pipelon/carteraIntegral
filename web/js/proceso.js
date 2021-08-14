/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* FUNCION CUANDO TODO EL DOM ESTÁ CARGADO */
jQuery("document").ready(function () {

    /* USO DE TOOLTIP */
    $(function () {
        $("[data-toggle='tooltip']").tooltip();
    });
    ;
    /* USO DE POPOVER PARA MOSTRAR AYUDAS EN LOS CAMPOS */
    $(function () {
        $("[data-toggle='popover']").popover();
    });

    /* MOSTRAR CAMPO COMENTARIOS EN CADA CHECK DE ESTUDIO DE CREDITO AL CARGAR */
    jQuery(".check-bien").each(function () {
        if (jQuery(this).is(":checked")) {
            jQuery(".comentario-bienes-" + jQuery(this).val()).show();
        }
    });

    /* ABRIR CAMPO COMENTARIOS SI UN CHECK DE ESTUDIO DE CREDITO ES SELECCIONADO */
    jQuery(".check-bien").change(function () {
        if (jQuery(this).is(":checked")) {
            jQuery(".comentario-bienes-" + jQuery(this).val()).show();
        } else {
            jQuery(".comentario-bienes-" + jQuery(this).val()).hide();
            jQuery(".comentario-bienes-" + jQuery(this).val()).val("");
        }
    });

    /* FUNCIONES PARA EL CONSOLIDADO DE PAGOS */
    jQuery(".dynamicform_wrapper").on("afterInsert", function (e, item) {
        jQuery(".dynamicform_wrapper .panel-title-pagos").each(function (index) {
            jQuery(this).html("Pago: " + (index + 1));


        });
        $(".krajee-datepicker").each(function () {
            $(this).kvDatepicker({
                format: 'yyyy-mm-dd',
                language: 'es',
                changeMonth: true,
                changeYear: true,
                autoclose: true,
                todayBtn: true,
                todayHighlight: true
            });
        });

    });

    jQuery(".dynamicform_wrapper").on("afterDelete", function (e) {
        jQuery(".dynamicform_wrapper .panel-title-pagos").each(function (index) {
            jQuery(this).html("Pago: " + (index + 1));
        });
    });

});

