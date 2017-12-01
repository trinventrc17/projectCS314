<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../bower_components/jquery.countdown/dist/jquery.countdown.js"></script>
</head>


<body>

<div class="countdown">
  Limited Time Only!
  <span id="clock"></span>
</div>


<script type="text/javascript">


$('#clock').countdown('2017/11/29 20:34:56')
.on('update.countdown', function(event) {
  var format = '%H:%M:%S';
  if(event.offset.totalDays > 0) {
    format = '%-d day%!d ' + format;
  }
  if(event.offset.weeks > 0) {
    format = '%-w week%!w ' + format;
  }
  $(this).html(event.strftime(format));
})
.on('finish.countdown', function(event) {
  $(this).html('This offer has expired!')
    .parent().addClass('disabled');

})
	
</script>

</body>

</html>