<hr/>
<div class="row filters-container">
   {!! Form::open(['route' => 'product.index','method' => 'get']) !!}

     
  <div class="filters">
   <div class="left">
        <div class="form-group">
            <label for="2">Energy Product Source</label>
        {!! Form::select('source',['all'=>'ALL','production'=>'Production','imports'=>'Imports','exports'=>'Exports','stockchange'=>'Stock Change']
                ,app('request')->input('source'),['id'=>'2' ,'class' => 'form-control'])!!}
        </div>
        <div class="form-group">
            <label for="1">Energy Product Name</label>
        {!! Form::select('product',['all'=>'ALL','biomass'=>'Biomass','coal'=>'Coal','electricity'=>'Electricity','lpgas'=>'LPGas','petroleum'=>'Petroleum','renewable'=>'Renewable']
                ,app('request')->input('product') ,['id'=>'1' ,'class' => 'form-control'])!!}
        </div>
        <div class="form-group">
            <label for="to">From Date</label>
        {!!Form::date('from', app('request')->input('from'),['class' => 'form-control'])!!}
        </div>
        <div class="form-group">
            <label for="from">To Date</label>
        {!!Form::date('to', app('request')->input('to'),['class' => 'form-control'])!!}
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