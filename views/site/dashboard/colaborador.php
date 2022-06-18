<?php
/* @var $this yii\web\View */

use app\assets\CalendarAsset;

CalendarAsset::register($this);


/**
 * PROCESOS DEL COLABORADOR CON TODAS SUS TAREAS
 */
$tareas = app\models\Tareas::find()
        ->where([
            'user_id' => \Yii::$app->user->getId(),
            'estado' => 0
        ])
        ->orderBy(['fecha_esperada' => SORT_ASC])
        ->all();

$tareasCalendario = [];
if (!empty($tareas)) {
    foreach ($tareas as $tarea) {
        $tareasCalendario[] = [
            "title" => $tarea->descripcion,
            "start" => $tarea->fecha_esperada,
            "backgroundColor" => "#1c3655",
            "borderColor" => "#1c3655",
            "allDay" => false,
            "tarea" => [
                "id" => $tarea->id,
                "proceso_id" => $tarea->proceso_id,
                "fecha_esperada" => $tarea->fecha_esperada,
                "descripcion" => $tarea->descripcion,
                "verProceso" => yii\helpers\Html::a('<span class="flaticon-edit" > Editar proceso</span>', yii\helpers\Url::to(['procesos/update', 'id' => $tarea->proceso_id]))
            ]
        ];
    }
}
$jsonTareas = json_encode($tareasCalendario);

/**
 * CALENDARIO
 */
$script = <<< JS
    $(function () {

        /* initialize the external events
         -----------------------------------------------------------------*/
        function init_events(ele) {
            ele.each(function () {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });

            });
        }

        init_events($('#external-events div.external-event'));

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date();
        var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month'
            },           
            //Random default events
            events: {$jsonTareas},
            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar !!!
            drop: function (date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                copiedEventObject.backgroundColor = $(this).css('background-color');
                copiedEventObject.borderColor = $(this).css('border-color');

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }

            },
            eventClick:  function(arg) {   
                $("#tareaModal #modalBody #title").html(arg.tarea.descripcion);
                $("#tareaModal #modalBody span.descripcionTarea").html("<br />fecha esperada: " + arg.tarea.fecha_esperada + "<br />Estado: Pendiente <br /> " + arg.tarea.verProceso);
                $('#tareaModal').modal();
            },
        });        
    });
JS;
$this->registerJs($script);
?>
<div id="tareaModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Detalle tarea</h4>
            </div>
            <div id="modalBody" class="modal-body">
                <h4 id="title" class="modal-title"></h4>
                <span class="descripcionTarea"></span>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body">
            <div id="calendar"></div> 
        </div>
    </div>
</div>