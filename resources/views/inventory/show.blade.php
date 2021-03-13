@extends('layouts.app')

@section('content')
    <h1>{{$inventory->product->product_name}}: {{$inventory->sku}}</h1>

    <table class="table">
        <tr>
            <td>Color:</td>
            <td>{{$inventory->color}}</td>
        </tr>
        <tr>
            <td>Size:</td>
            <td>{{$inventory->size}}</td>
        </tr>
        <tr>
            <td>Weight:</td>
            <td>{{$inventory->weight}}</td>
        </tr>
        <tr>
            <td>Length:</td>
            <td>{{$inventory->length}}</td>
        </tr>
        <tr>
            <td>Width:</td>
            <td>{{$inventory->width}}</td>
        </tr>
        <tr>
            <td>Height:</td>
            <td>{{$inventory->height}}</td>
        </tr>
        <tr>
            <td>Price:</td>
            <td>${{number_format($inventory->price_cents/100,2)}}</td>
        </tr>
        <tr>
            <td>Sale Price:</td>
            <td>${{number_format($inventory->sale_price_cents/100,2)}}</td>
        </tr>
        <tr>
            <td>Cost:</td>
            <td>${{number_format($inventory->cost_cents/100,2)}}</td>
        </tr>
    </table>
@endsection
