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
            <td><input ng-model="filterId" ng-keyup="filterChanged($event)" type="text" style="width:80px;" /></td>
            <td><input ng-model="filterName" ng-keyup="filterChanged($event)" type="text" style="width:80px;" /></td>
            <td><input ng-model="filterSku" ng-keyup="filterChanged($event)" type="text" style="width:80px;" /></td>
            <td class="text-right"><input ng-model="filterQty" ng-keyup="filterChanged($event)" type="text" style="width:30px" /> or
                <select ng-model="filterQtyDir" ng-change="filterChanged($event)"><option>less</option><option>more</option></select></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </thead>
        <tbody ng-repeat="i in inventory">
            <tr>
                <td><a href="/inventory/<%i.id%>" target="_blank"><%i.product_id%></a></td>
                <td><a href="/inventory/<%i.id%>" target="_blank"><%i.product_name%></a></td>
                <td><a href="/inventory/<%i.id%>" target="_blank"><%i.sku%></a></td>
                <td class="text-right"><%i.quantity%></td>
                <td><%i.color%></td>
                <td><%i.size%></td>
                <td class="text-right">$<%(i.price_cents/100)%></td>
                <td class="text-right">$<%(i.cost_cents/100)%></td>
            </tr>
        </tbody>
    </table>

    <p class="text-center">
        <a href="#" ng-if="current_page>1" ng-click="paginate($event,false)">Prev</a>
        <% current_page %>
        <a href="#" ng-if="current_page<last_page" ng-click="paginate($event,true)">Next</a>
    </p>

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
            $scope.filterQtyDir = 'less';
            $scope.current_page = 1;
            $scope.last_page = 1;

            var getInventory = function(){
                var params = {
                    filterId: $scope.filterId,
                    filterName: $scope.filterName,
                    filterSku: $scope.filterSku,
                    filterQty: $scope.filterQty,
                    filterQtyDir: $scope.filterQtyDir,
                    page: $scope.current_page
                };
                $http.post('/api/inventory',params).then(function(response) {
                    $scope.inventory = response.data.inventory.data;
                    $scope.num_items =  response.data.inventory.total + ' item' + (parseInt(response.data.inventory.total)!==1 ? 's' : '');
                    $scope.last_page = response.data.inventory.last_page;
                });
            };

            $scope.paginate = function(e,up){
                e.preventDefault();
                if(up){
                    $scope.current_page++;
                }else{
                    $scope.current_page--;
                }
                getInventory();
            };

            $scope.filterChanged = function(e){
                e.preventDefault();
                getInventory();
            };

            //initial load
            getInventory();
        }]);
    </script>
@endpush
