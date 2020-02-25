<hr />
<div class="row filters-container">
    {!! Form::open(['route' => 'product.index','method' => 'get']) !!}


    <div class="filters">
        <div class="left">
            <div class="form-group">
                <label for="2">Select Year</label>
                <select name="year" id="year" class="form-control">
                    @foreach($availableYears as $year)
                    <option value="{{ $year }}">{{ $year}}</option>
                    @endforeach
                </select>

            </div>
        </div>
        <div class="right mr-20">
            <div class="form-group">
                {!!Form::submit('Filter',["class"=>"btn btn-secondary"])!!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>