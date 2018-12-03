{{-- Filter By: Allows you to filter the entire page, total-to-date, transactions, and the chart. --}}
<div class="panel panel-default side-border-primary" id="filterBy">
    <div class="panel-body text-center">
        <h5>Filter By</h5>
        <form action="" method="get">
            <div class="form-group">
                    <select name="timeframe" onchange="this.form.submit()" class="form-control">
                        <option value="mtd" {{ Request::get('timeframe') == 'mtd' ? 'selected' : ''}}>Month To Date</option>
                        <option value="week" {{ Request::get('timeframe') == 'week' ? 'selected' : ''}}>Last 7 Days</option>
                        <option value="this-year" {{ Request::get('timeframe') == 'this-year' ? 'selected' : '' }}>{{ date('Y') }}</option>
                        <option value="day" {{ Request::get('timeframe') == 'day' ? 'selected' : ''}}>Today</option>
                    </select>
            </div>
        </form>

        <form action="" method="get" class="">
            <div class="form-group">
                <label for="datetimepicker1">Start Date</label>
                 <div class='input-group date' id='datetimepicker1'>
                     <input type='text' class="form-control" name="startdate" value="{{ old('startdate') ? old('startdate') : '' }}" {{ Request::get('datepicker') == 'startdate' }}>
                     <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                    </span>
                </div>
                <label for="datetimepicker2">End Date</label>
            <div class='input-group date' id='datetimepicker2'>
                 <input type='text' class="form-control" name="enddate" value="{{ old('enddate') ? old('enddate') : '' }}" {{ Request::get('datepicker') == 'enddate' }}>
                 <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>
            </div>
        </div>
            <input type="submit" class="btn btn-success" value="Submit">
        </form>

    </div>
</div> {{-- end of panel --}}
<script type="text/javascript">
$(function () {
    $('#datetimepicker1').datetimepicker({format: 'L', maxDate: moment()});
});
</script> 
<script type="text/javascript">
$(function () {
    $('#datetimepicker2').datetimepicker({format: 'L', maxDate: moment()});
});
</script>
