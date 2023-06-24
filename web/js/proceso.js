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

    /* FUNCIONES PARA LAS TAREAS */
    jQuery(".dynamicform_wrapper_tareas").on("afterInsert", function (e, item) {
        jQuery(".dynamicform_wrapper_tareas .panel-title-tareas").each(function (index) {
            jQuery(this).html("Tarea: " + (index + 1));
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
        $(".dynamicform_wrapper_tareas .item:last input").removeAttr("disabled");
        $(".dynamicform_wrapper_tareas .item:last select").removeAttr("disabled");
        $(".dynamicform_wrapper_tareas .item:last input").removeAttr("readonly").val("");
        $(".dynamicform_wrapper_tareas .item:last .removeTarea").show();
    });
    jQuery(".dynamicform_wrapper_tareas").on("afterDelete", function (e) {
        jQuery(".dynamicform_wrapper_tareas .panel-title-tareas").each(function (index) {
            jQuery(this).html("Tarea: " + (index + 1));
        });
    });

    $('#dynamic-form').submit(function () {
        jQuery(".dynamicform_wrapper_tareas select, .dynamicform_wrapper_tareas input").each(function () {
            jQuery(this).removeAttr("disabled");
        });
    });

    /* FUNCIONES PARA LOS ACUERDOS DE PAGOS */
    jQuery(".dynamicform_wrapper_acuerdo_pagos").on("afterInsert", function (e, item) {
        jQuery(".dynamicform_wrapper_acuerdo_pagos .panel-title-pagos").each(function (index) {
            jQuery(this).html("Acuerdo: " + (index + 1));
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
    jQuery(".dynamicform_wrapper_acuerdo_pagos").on("afterDelete", function (e) {
        jQuery(".dynamicform_wrapper_acuerdo_pagos .panel-title-pagos").each(function (index) {
            jQuery(this).html("Acuerdo: " + (index + 1));
        });
    });


    /* FUNCIONES PARA LOS VALORES DE ACTIVACION */
    jQuery(".dynamicform_wrapper_valor_activacion").on("afterInsert", function (e, item) {
        jQuery(".dynamicform_wrapper_valor_activacion .panel-title-valor").each(function (index) {
            jQuery(this).html("Valor activación: " + (index + 1));
        });
    });
    jQuery(".dynamicform_wrapper_valor_activacion").on("afterDelete", function (e) {
        jQuery(".dynamicform_wrapper_valor_activacion .panel-title-valor").each(function (index) {
            jQuery(this).html("Valor activación: " + (index + 1));
        });
    });

    /* CREAR NOMBRE DE JUZGADO */
    $('#departamento-id, #ciudad-id').change(function () {
        $("#juzgado").val("");
        $("#codigoEntidad").val("");
        $("#codigoEspecialidad").val("");
        $("#codigoDespacho").val("");
        $("#radicado").val("");
    });

    /* CREAR NOMBRE DE JUZGADO 2 */
    $('#departamento-id-2, #ciudad-id-2').change(function () {
        $("#juzgado-2").val("");
        $("#codigoEntidad_2").val("");
        $("#codigoEspecialidad_2").val("");
        $("#codigoDespacho_2").val("");
        $("#radicado-2").val("");
    });

    /* CREAR NOMBRE DE JUZGADO 3 */
    $('#departamento-id-3, #ciudad-id-3').change(function () {
        $("#juzgado-3").val("");
        $("#codigoEntidad_3").val("");
        $("#codigoEspecialidad_3").val("");
        $("#codigoDespacho_3").val("");
        $("#radicado-3").val("");
    });

    $('#departamento-id').change(function () {
        /* OBTENGO EL CODIGO DEL DEPARTAMENTO */
        $.ajax({
            url: '../departamentos/datadepartamento',
            type: 'post',
            data: {
                id: $(this).val()
            },
            dataType: 'json',
            success: function (data) {
                $("#codigoDepartamento").val(data.codigo_departamento);
            }
        });
    });

    $('#ciudad-id').change(function () {
        /* OBTENGO EL CODIGO DEL DEPARTAMENTO */
        $.ajax({
            url: '../ciudades/dataciudad',
            type: 'post',
            data: {
                id: $(this).val()
            },
            dataType: 'json',
            success: function (data) {
                $("#codigoCiudad").val(data.codigo_ciudad);
            }
        });
    });

    $('#jurisdiccion-competent-id').change(function () {

        if ($("#departamento-id").val() != "" && $("#ciudad-id").val() != "" && $(this).val() != "") {
            let nombre = $("#departamento-id option:selected").text() + ", " +
                    $("#ciudad-id option:selected").text() + ", " +
                    $("#jurisdiccion-competent-id option:selected").text();
            $("#juzgado").val(nombre);
        } else {
            $("#juzgado").val("");
        }

        /* OBTENGO TODA LA INFO DE LA JURISDICCION NECESARIA PARA CREAR EL RADICADO */
        $.ajax({
            url: '../jurisdicciones-competentes/datajurisdiccion',
            type: 'post',
            data: {
                id: $(this).val()
            },
            dataType: 'json',
            async: false,
            success: function (data) {
                $("#codigoEntidad").val(data.codigo_entidad);
                $("#codigoEspecialidad").val(data.codigo_especialidad);
                $("#codigoDespacho").val(data.despacho);
            }
        });

    });

    // RADICADO 2
    $('#departamento-id-2').change(function () {
        /* OBTENGO EL CODIGO DEL DEPARTAMENTO */
        $.ajax({
            url: '../departamentos/datadepartamento',
            type: 'post',
            data: {
                id: $(this).val()
            },
            dataType: 'json',
            success: function (data) {
                $("#codigoDepartamento_2").val(data.codigo_departamento);
            }
        });
    });

    $('#ciudad-id-2').change(function () {
        /* OBTENGO EL CODIGO DEL DEPARTAMENTO */
        $.ajax({
            url: '../ciudades/dataciudad',
            type: 'post',
            data: {
                id: $(this).val()
            },
            dataType: 'json',
            success: function (data) {
                $("#codigoCiudad_2").val(data.codigo_ciudad);
            }
        });
    });

    $('#jurisdiccion-competent-id-2').change(function () {

        if ($("#departamento-id-2").val() != "" && $("#ciudad-id-2").val() != "" && $(this).val() != "") {
            let nombre = $("#departamento-id-2 option:selected").text() + ", " +
                    $("#ciudad-id-2 option:selected").text() + ", " +
                    $("#jurisdiccion-competent-id-2 option:selected").text();
            $("#juzgado-2").val(nombre);
        } else {
            $("#juzgado-2").val("");
        }

        /* OBTENGO TODA LA INFO DE LA JURISDICCION NECESARIA PARA CREAR EL RADICADO */
        $.ajax({
            url: '../jurisdicciones-competentes/datajurisdiccion',
            type: 'post',
            data: {
                id: $(this).val()
            },
            dataType: 'json',
            async: false,
            success: function (data) {
                $("#codigoEntidad_2").val(data.codigo_entidad);
                $("#codigoEspecialidad_2").val(data.codigo_especialidad);
                $("#codigoDespacho_2").val(data.despacho);
            }
        });

    });

    // RADICADO 3
    $('#departamento-id-3').change(function () {
        /* OBTENGO EL CODIGO DEL DEPARTAMENTO */
        $.ajax({
            url: '../departamentos/datadepartamento',
            type: 'post',
            data: {
                id: $(this).val()
            },
            dataType: 'json',
            success: function (data) {
                $("#codigoDepartamento_3").val(data.codigo_departamento);
            }
        });
    });

    $('#ciudad-id-3').change(function () {
        /* OBTENGO EL CODIGO DEL DEPARTAMENTO */
        $.ajax({
            url: '../ciudades/dataciudad',
            type: 'post',
            data: {
                id: $(this).val()
            },
            dataType: 'json',
            success: function (data) {
                $("#codigoCiudad_3").val(data.codigo_ciudad);
            }
        });
    });

    $('#jurisdiccion-competent-id-3').change(function () {

        if ($("#departamento-id-3").val() != "" && $("#ciudad-id-3").val() != "" && $(this).val() != "") {
            let nombre = $("#departamento-id-3 option:selected").text() + ", " +
                    $("#ciudad-id-3 option:selected").text() + ", " +
                    $("#jurisdiccion-competent-id-3 option:selected").text();
            $("#juzgado-3").val(nombre);
        } else {
            $("#juzgado-3").val("");
        }

        /* OBTENGO TODA LA INFO DE LA JURISDICCION NECESARIA PARA CREAR EL RADICADO */
        $.ajax({
            url: '../jurisdicciones-competentes/datajurisdiccion',
            type: 'post',
            data: {
                id: $(this).val()
            },
            dataType: 'json',
            async: false,
            success: function (data) {
                $("#codigoEntidad_3").val(data.codigo_entidad);
                $("#codigoEspecialidad_3").val(data.codigo_especialidad);
                $("#codigoDespacho_3").val(data.despacho);
            }
        });

    });

    /* MOSTRAR CREACION DE ACUERDOS DE PAGO SOLO SI ESTA SELECCIONADO */
    if ($('#procesos-prejur_acuerdo_pago').val() === 'SI') {
        $(".divAcuerdoPago").show();
    }

    $('#procesos-prejur_acuerdo_pago').change(function () {
        if ($(this).val() === 'SI') {
            $(".divAcuerdoPago").show("slow");
        } else {
            $(".divAcuerdoPago").hide("slow");
        }
    });


    /* CREAR EL RADICADO */
    $('#departamento-id, #ciudad-id, #jurisdiccion-competent-id, #jur_anio_radicado, #jur_consecutivo_proceso, #jur_instancia_radicado').change(function () {
        console.info("entreee");
        let codigoDepartamento = $("#codigoDepartamento").val().toString();
        let codigoCiudad = $("#codigoCiudad").val().toString();
        let codigoEntidad = $("#codigoEntidad").val().toString();
        let codigoEspecialidad = $("#codigoEspecialidad").val().toString();
        let codigoDespacho = $("#codigoDespacho").val().toString();
        let anio = $("#jur_anio_radicado").val().toString();
        let consecutivo = $("#jur_consecutivo_proceso").val().toString();
        let instancia = $("#jur_instancia_radicado").val().toString();
        if (codigoCiudad != "" && codigoCiudad != "" && codigoEntidad != "" &&
                codigoEspecialidad != "" && codigoDespacho != "" &&
                anio != "" && consecutivo != "" && instancia != "") {
            console.info("entreee2");
            $("#radicado").val(codigoDepartamento + codigoCiudad + codigoEntidad + codigoEspecialidad + codigoDespacho + anio + consecutivo + instancia);
        }

    });

    /* CREAR EL RADICADO 2 */
    $('#departamento-id-2, #ciudad-id-2, #jurisdiccion-competent-id-2, #jur_anio_radicado_2, #jur_consecutivo_proceso_2, #jur_instancia_radicado_2').change(function () {
        let codigoDepartamento = $("#codigoDepartamento_2").val().toString();
        let codigoCiudad = $("#codigoCiudad_2").val().toString();
        let codigoEntidad = $("#codigoEntidad_2").val().toString();
        let codigoEspecialidad = $("#codigoEspecialidad_2").val().toString();
        let codigoDespacho = $("#codigoDespacho_2").val().toString();
        let anio = $("#jur_anio_radicado_2").val().toString();
        let consecutivo = $("#jur_consecutivo_proceso_2").val().toString();
        let instancia = $("#jur_instancia_radicado_2").val().toString();
        if (codigoCiudad != "" && codigoCiudad != "" && codigoEntidad != "" &&
                codigoEspecialidad != "" && codigoDespacho != "" &&
                anio != "" && consecutivo != "" && instancia != "") {
            $("#radicado-2").val(codigoDepartamento + codigoCiudad + codigoEntidad + codigoEspecialidad + codigoDespacho + anio + consecutivo + instancia);
        }

    });

    /* CREAR EL RADICADO 3 */
    $('#departamento-id-3, #ciudad-id-3, #jurisdiccion-competent-id-3, #jur_anio_radicado_3, #jur_consecutivo_proceso_3, #jur_instancia_radicado_3').change(function () {
        let codigoDepartamento = $("#codigoDepartamento_3").val().toString();
        let codigoCiudad = $("#codigoCiudad_3").val().toString();
        let codigoEntidad = $("#codigoEntidad_3").val().toString();
        let codigoEspecialidad = $("#codigoEspecialidad_3").val().toString();
        let codigoDespacho = $("#codigoDespacho_3").val().toString();
        let anio = $("#jur_anio_radicado_3").val().toString();
        let consecutivo = $("#jur_consecutivo_proceso_3").val().toString();
        let instancia = $("#jur_instancia_radicado_3").val().toString();
        if (codigoCiudad != "" && codigoCiudad != "" && codigoEntidad != "" &&
                codigoEspecialidad != "" && codigoDespacho != "" &&
                anio != "" && consecutivo != "" && instancia != "") {
            $("#radicado-3").val(codigoDepartamento + codigoCiudad + codigoEntidad + codigoEspecialidad + codigoDespacho + anio + consecutivo + instancia);
        }

    });

    /* VACIAR RADICADO RAPIDAMENTE */
    $(".vaciarRadicado").click(function () {
        let numRad = "";
        let numRad_ = "";
        if ($(this).data("radicado-numero") != "1") {
            numRad = "-" + $(this).data("radicado-numero");
            numRad_ = "_" + $(this).data("radicado-numero");
        }
        $("#departamento-id" + numRad).val("");
        $("#ciudad-id" + numRad).val("");
        $("#jurisdiccion-competent-id" + numRad).val("");
        $("#juzgado" + numRad).val("");
        $("#jur_anio_radicado" + numRad_).val("");
        $("#jur_consecutivo_proceso" + numRad_).val("");
        $("#jur_instancia_radicado" + numRad_).val("");
        $("#radicado" + numRad).val("");
        $("#codigoDepartamento" + numRad_).val("");
        $("#codigoCiudad" + numRad_).val("");
        $("#codigoEntidad" + numRad_).val("");
        $("#codigoEspecialidad" + numRad_).val("");
        $("#codigoDespacho" + numRad_).val("");
    });

    /* SI ES UN EDIT DEBO LLENAR LOS CAMPOS OCULTOS */
    if ($('#departamento-id').val() != '' && $('#ciudad-id').val() != '' &&
            $('#jurisdiccion-competent-id').val() != '' && $('#juzgado').val() != '' &&
            $('#jur_anio_radicado').val() != '' && $('#jur_consecutivo_proceso').val() != ''
            && $('#jur_instancia_radicado').val() != '' && $('#radicado').val() != '') {

        $('#codigoDepartamento').val($('#departamento-id').val());
        $('#codigoCiudad').val($('#ciudad-id').val());
        //$('#jurisdiccion-competent-id').trigger("change");
    }
    if ($('#departamento-id-2').val() != '' && $('#ciudad-id-2').val() != '' &&
            $('#jurisdiccion-competent-id-2').val() != '' && $('#juzgado-2').val() != '' &&
            $('#jur_anio_radicado_2').val() != '' && $('#jur_consecutivo_proceso_2').val() != ''
            && $('#jur_instancia_radicado_2').val() != '' && $('#radicado-2').val() != '') {

        $('#codigoDepartamento_2').val($('#departamento-id-2').val());
        $('#codigoCiudad_2').val($('#ciudad-id-2').val());
        //$('#jurisdiccion-competent-id-2').trigger("change");
    }
    if ($('#departamento-id-3').val() != '' && $('#ciudad-id-3').val() != '' &&
            $('#jurisdiccion-competent-id-3').val() != '' && $('#juzgado-3').val() != '' &&
            $('#jur_anio_radicado_3').val() != '' && $('#jur_consecutivo_proceso_3').val() != ''
            && $('#jur_instancia_radicado_3').val() != '' && $('#radicado-3').val() != '') {

        $('#codigoDepartamento_3').val($('#departamento-id-3').val());
        $('#codigoCiudad_3').val($('#ciudad-id-3').val());
        //$('#jurisdiccion-competent-id-3').trigger("change");
    }


    /*SI ETAPA PROCESAL ES IMCUMPLIMIENTO DE ACUERDO ENTONCES LAS JURISDICCIONES ESTARAN QUEMADAS*/

    $("#tipo-proceso-id").change(function () {

        if ($("#tipo-proceso-id option:selected").text() == 'CONCILIACIÓN EXTRAJUDICIAL'
                || $("#tipo-proceso-id option:selected").text().trim() == 'INSOLVENCIA'
                || $("#tipo-proceso-id option:selected").text().trim() == 'INSOLVENCIA PERSONA NATURAL'
                || $("#tipo-proceso-id option:selected").text().trim() == 'INSOLVENCIA LEY 1116') {

            console.info("etre");
            $('#jur_anio_radicado').attr('disabled', true);
            $('#jur_consecutivo_proceso').attr('readonly', true);
            $('#jur_instancia_radicado').attr('disabled', true);
            $('#radicado').attr('readonly', false);

            $('#jur_anio_radicado_2').attr('disabled', true);
            $('#jur_consecutivo_proceso_2').attr('readonly', true);
            $('#jur_instancia_radicado_2').attr('disabled', true);
            $('#radicado-2').attr('readonly', false);

            $('#jur_anio_radicado_3').attr('disabled', true);
            $('#jur_consecutivo_proceso_3').attr('readonly', true);
            $('#jur_instancia_radicado_3').attr('disabled', true);
            $('#radicado-3').attr('readonly', false);

            $(".field-jur_jurisdiccion_competent_caso_especial_id").show();
            $(".field-jur_jurisdiccion_competent_caso_especial_id_2").show();
            $(".field-jur_jurisdiccion_competent_caso_especial_id_3").show();
            $(".field-jurisdiccion-competent-id").hide();
            $(".field-jurisdiccion-competent-id-2").hide();
            $(".field-jurisdiccion-competent-id-3").hide();

            $("#jurisdiccion-competent-id").val("");
            $("#jurisdiccion-competent-id_2").val("");
            $("#jurisdiccion-competent-id_3").val("");
            $("#juzgado").val("");
            $("#juzgado-2").val("");
            $("#juzgado-3").val("");

        } else {

            $('#jur_anio_radicado').attr('disabled', false);
            $('#jur_consecutivo_proceso').attr('readonly', false);
            $('#jur_instancia_radicado').attr('disabled', false);
            $('#radicado').attr('readonly', true);

            $('#jur_anio_radicado_2').attr('disabled', false);
            $('#jur_consecutivo_proceso_2').attr('readonly', false);
            $('#jur_instancia_radicado_2').attr('disabled', false);
            $('#radicado-2').attr('readonly', true);

            $('#jur_anio_radicado_3').attr('disabled', false);
            $('#jur_consecutivo_proceso_3').attr('readonly', false);
            $('#jur_instancia_radicado_3').attr('disabled', false);
            $('#radicado-3').attr('readonly', true);

            $(".field-jur_jurisdiccion_competent_caso_especial_id").hide();
            $(".field-jur_jurisdiccion_competent_caso_especial_id_2").hide();
            $(".field-jur_jurisdiccion_competent_caso_especial_id_3").hide();
            $(".field-jurisdiccion-competent-id").show();
            $(".field-jurisdiccion-competent-id-2").show();
            $(".field-jurisdiccion-competent-id-3").show();

            $("#jur_jurisdiccion_competent_caso_especial_id").val("");
            $("#jur_jurisdiccion_competent_caso_especial_id_2").val("");
            $("#jur_jurisdiccion_competent_caso_especial_id_3").val("");

        }
    });

    $("#tipo-proceso-id").trigger("change");

    //AUTO GUARDAR EL FORMULARIO CADA 5 MINUTOS
    setInterval(function () {

        var isUpdateForm = $("#isUpdateForm").val();
        if (isUpdateForm === "si") {
            $('body').append('<div id="autoSave">¡Guardado automático!</div>');
            var formData = $("#dynamic-form").serialize() + '&typeSave=autoSave';
            $.ajax({
                type: "POST",
                url: $("#dynamic-form").attr("action"),
                data: formData,
                success: function (response) {
                    $("#autoSave").remove();
                }
            });
        }
    }, 300000);

    /**
     * SI EN ENVIAR CARTA, LLAMADA O VISITA SE PONE SI ENTONCES PONER LA FECHA DE HOY
     */
    $("#procesos-prejur_carta_enviada, #procesos-prejur_llamada_realizada, #procesos-prejur_visita_domiciliaria").change(function () {

        let val = $(this).val();
        let id = $(this).attr("id");
        var fecha = new Date();        
        var year = fecha.getFullYear();
        var month = ("0" + (fecha.getMonth() + 1)).slice(-2);
        var day = ("0" + fecha.getDate()).slice(-2);
        var fechaFormateada = year + "-" + month + "-" + day;

        if (val == "SI" && id == "procesos-prejur_carta_enviada") {
            $("#procesos-prejur_fecha_carta").val(fechaFormateada);
        }
        if (val == "SI" && id == "procesos-prejur_llamada_realizada") {
            $("#procesos-prejur_fecha_llamada").val(fechaFormateada);
        }
        if (val == "SI" && id == "procesos-prejur_visita_domiciliaria") {
            $("#procesos-prejur_fecha_visita").val(fechaFormateada);
        }
    });

});

