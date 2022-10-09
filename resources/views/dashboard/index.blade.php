@extends('layouts.template')
@section('content')

    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Initialisation report
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Date of initialization: </li>
                    <li class="list-group-item">Number of Trenz's product(s) retrieved: </li>
                    <li class="list-group-item">Number of PM's variation(s) retrieved: </li>
                    <li class="list-group-item">Number of new product(s) : </li>
                </ul>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Updating report
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"> Last update date: </li>
                    <li class="list-group-item"> Number total of updating variation: </li>
                    <li class="list-group-item"> Number of variations whose prices have been updated: </li>
                    <li class="list-group-item"> Number of variations whose stocks have been updated: </li>
                </ul>
                <div class="card-footer text-muted">
                    2 days ago
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Featured
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">An item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                </ul>
                <div class="card-footer text-muted">
                    2 days ago
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Featured
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">An item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                </ul>
                <div class="card-footer text-muted">
                    2 days ago
                </div>
            </div>
        </div>
    </div>

@endsection
