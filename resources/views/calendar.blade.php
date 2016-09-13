@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"> <h2>Calendar</h2></div>
        <div class="panel-body">
            <section class="content">
                <div class="row">
                    <div class="col-md-3">
                        <div class="box-solid">
                            <div class="box-header with-border">
                                <h4 class="box-title">Events</h4>
                            </div>
                            <div class="box-body">
                                <div id="external-events">
                                    <div class="external-event bg-green">Event 1</div>
                                    <div class="external-event bg-yellow">Event 2</div>
                                    <div class="external-event bg-aqua">Event 3</div>
                                    <div class="external-event bg-light-blue">Event 4</div>
                                    <div class="checkbox">
                                        <label for="drop-remove">
                                            <input type="checkbox" id="drop-remove">
                                            Delete the assignment
                                        </label>
                                    </div>  
                                </div>
                            </div>
                        </div>

                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Create event</h3>
                            </div>
                            <div class="box-body">
                                <div class="btn-group" style="width: 100%; margin-botton: 10px;">
                                    <ul class="fc-color-picker" id="color-chooser">
                                        <li><a href="#" class="text-aqua"><i class="fa fa-square"></i></a></li>
                                        <li><a href="#" class="text-blue"><i class="fa fa-square"></i></a></li>
                                        <li><a href="#" class="text-light-blue"><i class="fa fa-square"></i></a></li>
                                        <li><a href="#" class="text-teal"><i class="fa fa-square"></i></a></li>
                                        <li><a href="#" class="text-yellow"><i class="fa fa-square"></i></a></li>
                                        <li><a href="#" class="text-orange"><i class="fa fa-square"></i></a></li>
                                        <li><a href="#" class="text-green"><i class="fa fa-square"></i></a></li>
                                        <li><a href="#" class="text-lime"><i class="fa fa-square"></i></a></li>
                                        <li><a href="#" class="text-red"><i class="fa fa-square"></i></a></li>
                                        <li><a href="#" class="text-purple"><i class="fa fa-square"></i></a></li>
                                        <li><a href="#" class="text-fuchsia"><i class="fa fa-square"></i></a></li>
                                        <li><a href="#" class="text-muted"><i class="fa fa-square"></i></a></li>
                                        <li><a href="#" class="text-navy"><i class="fa fa-square"></i></a></li>
                                        
                                    </ul>
                                </div>

                                <div class="input-group">
                                    <input type="text" id="new-event" class="form-control" placeholder="Title of event">
                                    <div class="input-group-btn">
                                        <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Add</button>
                                    </div>

                                </div><br><br>

                                {!! Form::open(['route'=> ['storeEvent'], 'method'=> 'POST', 'id'=>'form-calendario']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="box box-primary">
                            <div class="box-body no-padding">
                                <div class="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

   $(function () {

        /* initialize the external events
         -----------------------------------------------------------------*/
        function ini_events(ele) {
          ele.each(function () {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
              title: $.trim($(this).text()) // use the element's text as the event title
            };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            /*// make the event draggable using jQuery UI
            $(this).draggable({
              zIndex: 1070,
              revert: true , // will cause the event to go back to its
              revertDuration: 0  //  original position after the drag
            });*/

          });
        }
        ini_events($('#external-events div.external-event'));

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
            right: 'month,agendaWeek,agendaDay'
          },
          buttonText: {
            today: 'today',
            month: 'month',
            week: 'week',
            day: 'day'
          },
         
          //Random default events
         
          editable: true,
          droppable: true, // this allows things to be dropped onto the calendar !!!
          drop: function (date, allDay) { // this function is called when something is dropped

            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject');

            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);

            // assign it the date that was reported
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;
            copiedEventObject.backgroundColor = $(this).css("background-color");
            

            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
           // $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
              // if so, remove the element from the "Draggable Events" list
              $(this).remove();
            }
            var title= copiedEventObject.title;
            var start = copiedEventObject.start.format("YYYY-MM-DO HH:mm");
            var baxk= copiedEventObject.backgroundColor;

            crsfToken = document.getElementsByName('_token')[0].value;
            $.ajax({
                url:'storeEvent',
                data: 'title=' + title+'&start='+'&allday='+allDay+'&background='+back,
                type: 'POST',
                header:{
                    "X-CSRF-TOKEN": crsfToken
                },
                success: function(events){
                    console.log('Event was created');
                    $('#calendar').fullcalendar('refetchEvents');
                },
                error: function(json){
                    console.log('There is an error creating the event');
                }
            });
          }
        });

     /* ADDING EVENTS */
    var currColor = "#f56954"; //Red by default
    //Color chooser button
    var colorChooser = $("#color-chooser-btn");
    $("#color-chooser > li > a").click(function(e) {
        e.preventDefault();
        //Save color
        currColor = $(this).css("color");
        $('#add-new-event').css({'background-color': currColor, 'border-color': currColor});
    });

     $("#add-new-event").click(function(e) {
        e.preventDefault();
        //Get value and make sure it is not null
        var val = $("#new-event").val();
        if (val.length == 0) {
            return;
        }

         //Create event
        var event = $("<div />");
        event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
        event.html(val);
        $('#external-events').prepend(event);

        //Add draggable funtionality
        ini_events(event);

        //Remove event from text input
        $("#new-event").val("");
    });
});


    </script>


@endsection
