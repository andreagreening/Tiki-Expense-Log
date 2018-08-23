<div class="panel panel-default dashboard-collapse-button side-border-primary" id="addCategoryPanel2">
                <div class="panel-heading text-center" data-target="#{{ $addCategoryId }}" role="button" data-toggle="collapse" aira-expanded="false" aria-controls="{{ $addCategoryId }}">
                    <i class="fa fa-plus-circle fa-3x"></i> 
                        <br>  Add a Category
                </div>
                <div class="panel-body text-center collapse" id="{{ $addCategoryId }}">
                    <form method="POST"  action="{{ route('category.store', $team) }}" >
                        {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('title')? 'has-error' : "" }}">
                        <label class="control-label" for="title">
                            Title
                        </label>
                        <input type="text" name="title" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="pid">Select a Parent Category</label>
                        <select name="pid" class="form-control">
                            <option value=""></option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>

                    </div>
                    <input type="submit" class="btn btn-success">
                    </form>

                </div>
            </div> {{-- end of panel --}}