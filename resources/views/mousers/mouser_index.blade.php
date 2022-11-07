<!-- resources/views/index.blade.php -->
 
@extends('layouts.template')


    @section('title', 'Mouser')
    
    
    @section('content')


        <div class="bg-light m-2 p-2">
            <h2 class="p-2 text-muted"> Index  </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Mouser</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                </ol>
            </nav>

            <div class="container-md">

                <h4 class="text-warning">Description</h4>
                <p>The Search API service allows us to utilise Mouser's product data, availability, and pricing in our applications.</p>
                
                <ul>
                    <li>Search by Keyword Method</li>
                    <li>Search by Part Number Method</li>
                    <li>Up to 50 results returned per call</li>
                    <li>Up to 30 calls per minute</li>
                    <li>Up to 1,000 calls per day</li>
                </ul>
                <hr>

                <h4 class="text-warning">Request parameters</h4>
                <table class="table table-striped table-hover table-bordered border-warning">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Term</th>
                            <th scope="col">Explanation</th>
                            <th scope="col">Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>keyword</td>
                            <td>Used for keyword part search</td>
                            <td>string</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Records</td>
                            <td>Used to specify how many records the method should return.</td>
                            <td>integer($int32)</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>startingRecord</td>
                            <td>Indicates where in the total recordset the return set should begin</td>
                            <td>integer($int32)</td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>searchOptions</td>
                            <td>Optionel. Refers to options supported by the search engine.Available options: None | Rohs | InStock | RohsAndInStock</td>
                            <td>string</td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td>searchWithYourSignUpLanguage</td>
                            <td>Optional. If not provided, the default is false. Used when searching for keywords in the language specified when you signed up for Search API. Can use string representation: true.</td>
                            <td>string</td>
                        </tr>
                    </tbody>
                </table>
           </div>
    
  
        </div>

    @endsection
