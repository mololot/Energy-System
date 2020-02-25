@extends("layouts.app")

@section("content")
<div class="container">
    <div class="row page-title">
        <h1>Energy Products</h1>
        <a href="{{route('products.create')}}" class="btn btn-primary mr-20">Add Product</a>
    </div>
    @include('products._yearFilter')


    <div class="card" style="width: 100%">
        <div class="card-body">
            <h5 class="card-title">Energy Commodity Account for the year {{$filterYear}}</h5>
            <div class="card-text">
                <div id="wdr-component"></div>
            </div>

        </div>


        <div class="card" style="width: 100%">
            <div class="card-body">
                <h5 class="card-title">Energy Balance for the year {{$filterYear}}</h5>
                <div class="card-text">
                    <div id="wdr-component-2"></div>
                </div>

            </div>
        </div>


        <div class="card" style="width: 100%">
            <div class="card-body">
                <h5 class="card-title">Aggregated Data </h5>
                @include('products._rawDataFilters')

                <div class="card-text">
                    <div id="wdr-component-3"></div>
                </div>

            </div>
        </div>


    </div>
</div>




@endsection

@section('page-script')

<script>
    window.__allProducts = {!! json_encode($productsAll) !!};  
  window.__energyBalance = {!! json_encode($energyBalance) !!}; 
  window.__productsFiltered = {!! json_encode($productsFiltered) !!}; 


var pivot = new WebDataRocks({
	container: "#wdr-component",
	toolbar: true,
	report: {
		dataSource: {
			data:  window.__allProducts 
    },
    options: {
        grid: {
          showGrandTotals: "columns"
        }
    },
    slice: {
        rows: [
            {
                uniqueName: "source"
            }
        ],
        columns: [
            {
                uniqueName: "name"
            }
        ],
        measures: [
            {
                uniqueName: "quantity",
                aggregation: "sum"
            }
        ]
    },
	}
});

var pivot2 = new WebDataRocks({
	container: "#wdr-component-2",
	toolbar: true,
	report: {
		dataSource: {
			data:  window.__energyBalance 
    },
    options: {
        grid: {
          showGrandTotals: "columns"
        }
    },
    slice: {
        rows: [
            {
                uniqueName: "source"
            }
        ],
        columns: [
            {
                uniqueName: "name"
            }
        ],
        measures: [
            {
                uniqueName: "convertedQty",
                aggregation: "sum"
            }
        ]
    },
     formats: [
        {
            "name": "",
            "decimalPlaces": 3,
            
        }
    ],
	}
});

var pivot = new WebDataRocks({
	container: "#wdr-component-3",
	toolbar: true,
	report: {
		dataSource: {
			data:  window.__productsFiltered
    },
     options: {
        grid: {
          showGrandTotals: "columns"
        }
    },
    slice: {
        rows: [
            {
                uniqueName: "source"
            }
        ],
        columns: [
            {
                uniqueName: "name"
            }
        ],
        measures: [
            {
                uniqueName: "quantity",
                aggregation: "sum"
            }
        ]
    },
	}
});

</script>
@endsection