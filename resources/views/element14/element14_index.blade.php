<!-- resources/views/index.blade.php -->
 
@extends('layouts.app')


    @section('title', 'Element14')
    
    
    @section('content')
    <div class="bg-light m-2 p-2">
    <h2 class="p-2"> Element14 (Farnell) API</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Element14</a></li>
                <li class="breadcrumb-item active" aria-current="page">Home</li>
            </ol>
        </nav>

        <h4 class="text-warning">Description</h4>
        <p class="text-muted">Element14 Product Search API is available as a RESTful API that allows for the following types of searches against the element14 catalog:
            <ul>
                <li>Keyword Search</li>
                <li>Newark, / Farnell / element14 Product Number Search</li>
                <li>Manufacturer Part Number Search</li>
            </ul>
        </p>
        <hr>
        <h4 class="text-warning">Query parameter of Keyword Method</h4>
        <table class="table table-striped table-hover table-bordered border-warning">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Parameter</th>
                    <th scope="col">Description</th>
                    <th scope="col">Mandatory/Optional</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>term</td>
                    <td> Issued as field:term, for example: any:fuse, id:123456, or manuPartNum:678901</td>
                    <td>Mandatory</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>storeInfo.id</td>
                    <td>Represents the region of the data store by country.</td>
                    <td>Mandatory</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>resultsSettings.offset</td>
                    <td></td>
                    <td>mandatory for keyword search - Not used for other functions</td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>resultsSettings.numberOfResults</td>
                    <td> </td>
                    <td>mandatory for keyword search - Not used for other functions</td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>resultsSettings.refinements.filters</td>
                    <td>Can be rohsCompliant or inStock.</td>
                    <td>optional</td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <td>resultsSettings.responseGroup</td>
                    <td>Can be small, medium, large, prices, inventory, and none. Small is the default if nothing is passed.</td>
                    <td>optional</td>
                </tr>
            </tbody>
        </table>
    </div>

    @endsection
