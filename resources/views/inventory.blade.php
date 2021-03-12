@extends('layouts.app')

@section('content')
<div ng-controller="invCtrl">
    <h1>My Inventory</h1>

    <p><%num_items%></p>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Product ID</th>
            <th scope="col">Product Name</th>
            <th scope="col">Sku</th>
            <th scope="col" class="text-right">Qty</th>
            <th scope="col" >Color</th>
            <th scope="col">Size</th>
            <th scope="col" class="text-right">Price</th>
            <th scope="col" class="text-right">Cost</th>
        </tr>
        <tr>
            <th><input ng-model="filterId" ng-keyup="filterIdChanged($event)" type="text" style="width:80px;" /></th>
            <th></th>
            <th><input ng-model="filterSku" ng-keyup="filterSkuChanged($event)" type="text" style="width:80px;" /></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody ng-repeat="i in inventory">
            <tr>
                <td><%i.product_id%></td>
                <td><%i.product_name%></td>
                <td><%i.sku%></td>
                <td class="text-right"><%i.quantity%></td>
                <td><%i.color%></td>
                <td><%i.size%></td>
                <td class="text-right">$<%(i.price_cents/100)%></td>
                <td class="text-right">$<%(i.cost_cents/100)%></td>
            </tr>
        </tbody>
    </table>

</div>
@endsection

@push('scripts')
    <script>
        var app = angular.module('myApp', [], function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });
        app.controller('invCtrl',['$scope','$http', function InventoryController($scope,$http){
            $scope.inventory = [];
            $scope.filterIdChanged = function(e){
                $http.get('/inventory/get?filterId=' + e.currentTarget.value).then(function(response) {
                    $scope.inventory = response.data.inventory.data;
                    $scope.num_items =  response.data.inventory.total + ' items';
                });
            };
            $scope.filterSkuChanged = function(e){
                $http.get('/inventory/get?filterSku=' + e.currentTarget.value).then(function(response) {
                    $scope.inventory = response.data.inventory.data;
                    $scope.num_items =  response.data.inventory.total + ' items';
                });
            };
            $http.get('/inventory/get').then(function(response) {
                $scope.inventory = response.data.inventory.data;
                $scope.num_items =  response.data.inventory.total + ' items';
            });
        }]);
    </script>
@endpush
