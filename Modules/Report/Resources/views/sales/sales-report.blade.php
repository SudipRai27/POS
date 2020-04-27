@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.1/lity.css">
@stop
@section('content')
<h4><b>Sales History</b></h4>
<p style="color:red;">Search Between 2 date range</p>
<div class="row">
  <div class="col-xs-12">
    <div class="box"> 
      <div class="box-body">
        <div class="row">
          <div class="col-sm-6">
            <input type="text" name="daterange"  id = "date_range" class="form-control" />
          </div>
           <div class="col-sm-6">
            <button class="btn btn-primary"  id="search">Go</button>
          </div>
        </div>        
          <div id="search-results">
          </div>
      </div>
    </div>
  </div>
</div>  
@endsection
@section('custom-js')

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.1/lity.min.js"></script>
<script>
$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'right'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
</script>
<script type="text/javascript">
    $(document).ready(function() {

      $('#search').on('click', function() {
          var date_range  = $('#date_range').val();
          $('#search-results').html('Loading');
          $.ajax({
            data : {'date_range' : date_range}, 
            url: '{{route('get-search-results-from-date-for-sales')}}',
            method : 'GET'

          }).done(function(data){
            $('#search-results').html(data);
          })

      });

    });
</script>
@endsection
