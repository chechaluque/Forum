<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
<script src="/js/app.js"></script>
<script src="/js/sweetalert.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>





	@if(notify()->ready())
	<script>
		swal({
			 title: "{!! notify()->message() !!}",
			 type: "{!!  notify()->type() !!}", 
			 @if(notify()->option('timer'))
			 	timer: "{{ notify()->option('timer') }}",
			 	showConfirmButton: false,
			 @endif  
			 html: true,   
			 });
	</script>	
	@endif

