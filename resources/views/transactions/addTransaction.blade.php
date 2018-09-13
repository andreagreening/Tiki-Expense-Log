<div class="panel panel-default dashboard-collapse-button side-border-primary" id="addTransactionPanel">
    <div class="panel-heading text-center"  data-target="#{{ $addTransactionId }}" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="{{ $addTransactionId }}">
        <i class="fa fa-plus-circle fa-3x"></i> 
        <br>
        Add a Transaction
    </div>
    <div class="panel-body collapse" id="{{ $addTransactionId }}">
        <form method="POST" action="{{ route('transaction.store', $team) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
{{--             <div class="form-group {{ $errors->has('date')? 'has-error' : "" }}">
                <label for="datetimepicker3">Date</label>
                <div class='input-group date' id='datetimepicker3'>
                     <input type='text' class="form-control" name="date" value="{{ old('date') ? old('date') : Carbon\Carbon::now()->format('m/d/Y') }}">
                         <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                </div>
            </div>  --}}   
            <div class="form-group {{ $errors->has('date')? 'has-error' : "" }}">
                <label class="control-label" for="date">Date</label>
                <input type="text" name="date" value="{{ Carbon\Carbon::now()->format('m/d/Y') }}" class="form-control">
            </div>
            <div class="form-group {{ $errors->has('description')? 'has-error' : "" }}">
                <label class="control-label" for="description">
                    Description
                </label>
                <input type="text" name="description" class="form-control" value="{{ old('description') ? old('description') : "" }}">
            </div>
            <div class="form-group {{ $errors->has('amount')? 'has-error' : "" }}">
                <label class="control-label" for="amount">Amount</label>
                <input type="text" name="amount" class="form-control" value="{{ old('amount') ? old('amount') : "" }}">
            </div>
            <div class="form-group {{ $errors->has('category')? 'has-error' : "" }}">
                <label class="control-label" for="category">Select a Category</label>
                <select name="category_id" class="form-control">
                    <option value=""> </option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}
                            @if($category->subcategories)
                                @foreach($category->subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">-{{ $subcategory->title }}</option>
                              @endforeach
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>
            <input type="submit" class="btn btn-success" value="Submit">
        </form>
    </div>
</div> {{-- end of panel --}}

{{-- <script type="text/javascript">
$(function () {
    $('#datetimepicker3').datetimepicker({format: 'L', maxDate: moment()});
});
</script>  --}}