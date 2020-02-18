@extends("layouts.app")

@section("content")
<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


{!! Form::open(['url' => 'products/create']) !!}
{!!Form::token() !!}
   <div class="form-group">
    <label for="1">Energy Product Name</label>
   {!! Form::select('product',['biomass'=>'Biomass','coal'=>'Coal','electricity'=>'Electricity','lpgas'=>'LPGas','petroleum'=>'Petroleum','renewable'=>'Renewable']
           ,null,['id'=>'1' ,'class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    <label for="2">Energy Product Source</label>
   {!! Form::select('source',['production'=>'Production','imports'=>'Imports','exports'=>'Exports','stockchange'=>'Stock Change']
           ,null,['id'=>'2' ,'class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    <label for="3">Quantiy</label>
   {!! Form::text('quantity',null,['id'=>'3' ,'class' => 'form-control'])!!}
  </div>

  <div class="form-group">
    <label for="input2">Entry Date</label>
   {!! Form::date('date', \Carbon\Carbon::now(),['id'=>'3' ,'class' => 'form-control'])!!}
  </div>
  <div class="form-group">
   {!!Form::submit('Submit',["class"=>"btn btn-primary"])!!}
  </div>
{!! Form::close() !!}
</div>
@endsection