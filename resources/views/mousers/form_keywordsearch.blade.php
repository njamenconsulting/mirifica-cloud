<!-- resources/views/index.blade.php -->
 
@extends('layouts.template')


    @section('title', 'Mouser')
    
    
    @section('content')


        <div class="bg-light m-2 p-2">
        <h2 class="p-2 text-muted"> Keyword search</h2>
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Mouser</a></li>
       
                <li class="breadcrumb-item active" aria-current="page">Keyword Method</li>
            </ol>
            </nav>

            <form action="{{ route('mouser.keywordSearch')}} " method ="POST">
            @csrf

                <div class="row">
                    <div class="col-md-4">
                        <label for="keyword" class="form-label text-muted fw-bold"> Keyword </label>
                        <select name="keyword" class="form-select form-select-sm">
                            <option value ="" selected>Choose...</option>
                            <option value ="Circuit Protection" @if(old("keyword") =="Circuit Protection"){{"selected"}} @endif>Circuit Protection</option>
                            <option value ="Electromechanical" @if(old("keyword") =="Electromechanical"){{"selected"}} @endif>Electromechanical</option>
                            <option value ="Embedded Solutions" @if(old("keyword") =="Embedded Solutions"){{"selected"}} @endif>Embedded Solutions</option>
                            <option  value ="Enclosures" @if(old("keyword") =="Enclosures"){{"selected"}} @endif>Enclosures</option>
                            <option value ="Connectors" @if(old("keyword") =="Connectors"){{"selected"}} @endif>Connectors</option>
                            <option value ="Engineering Tools" @if(old("keyword") =="Engineering Tools"){{"selected"}} @endif>Engineering Tools</option>
                            <option value ="Industrial Automation" @if(old("keyword") =="Industrial Automation"){{"selected"}} @endif>Industrial Automation</option>
                        </select>

                        @error('keyword')
                        <div class="form-text alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="records" class="form-label  text-muted fw-bold">Records:</label>
                        <input type="number" min="10" value="50" class="@error('records') is-invalid @enderror form-control  form-control-sm" name="records">
                        @error('records')
                        <div class="form-text alert alert-danger">{{ $message }}</div>
                        @enderror                   
                    </div>
                    <div class="col-md-3">
                        <label for="startingRecord" class="form-label  text-muted fw-bold">Starting record</label>
                        <input type="number" min="0" value="0" class="@error('startingRecord') is-invalid @enderror form-control  form-control-sm" name="startingRecord">
                        @error('startingRecord')
                        <div class="form-text alert alert-danger">{{ $message }}</div>
                        @enderror                    
                    </div>

                </div>
                <div class="row mt-1">

                    <div class="col-md-4">
                        <label for="searchOptions" class="form-label  text-muted fw-bold">Search option</label>
                        <select name="searchOptions" class="form-select form-select-sm">
                            <option value ="InStock" selected>In Stock </option>
                            <option value ="None" @if(old("searchOptions") =="None"){{"selected"}} @endif> None </option>
                            <option value ="Rohs"  @if(old("searchOptions") =="Rohs"){{"selected"}} @endif> Rohs </option>
                            <option value ="InStock" @if(old("searchOptions") =="InStock"){{"selected"}} @endif> InStock </option>
                            <option value ="RohsAndInStock" @if(old("searchOptions") =="RohsAndInStock"){{"selected"}} @endif> Rohs And InStock </option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <fieldset class="row mb-2">
                            <legend class="col-form-label col-sm-4 pt-0  text-muted fw-bold">Version</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="version"  value="v1" @if(old("version") =="v1"){{"checked"}} @endif>
                                    <label class="form-check-label" for="version">
                                    Version V1
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="version"  value="v2" @if(old("version") =="v1"){{""}} @else {{"checked"}} @endif>
                                    <label class="form-check-label" for="version">
                                    Version V2
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-3">
                        <div class="row m-2">
                            <button type="submit" class="btn btn-sm btn-warning text-muted"><i class="bi bi-send-fill"></i> Submit</button>
                        </div>
                    </div>
                </div>

            </form>

        </div>
        @isset($parts)
        <div class="bg-warning m-2 p-2">
            <p class="lead"> Search Result: </p>
            <a class="btn btn-md btn-primary" href="#" role="button"> Download csv file &raquo;</a>
            <div style="overflow-x:auto">
            <table class="table  table-sm table-responsive caption-top table-bordered border-primary table-hover">
                <caption>Extracted fields for MEPA</caption>
                <thead  class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Availability</th>
                
                        <th scope="col">Description</th>
                        <th scope="col">Product image</th>
                        <th scope="col">Category</th>
                        <th scope="col">Manufacturer name</th>
                        <th scope="col">Manufacturer code</th>
                        <th scope="col">Price Breaks</th>
                        <th scope="col">Supplier code</th>
                   
                    </tr>
                </thead>
                <tbody>
                    
                    @for ($i = 0; $i < count($parts); $i++)
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td><input type="text" value="{{$parts[$i]['Availability']}}"></td>
                      
                        <td><textarea>{{$parts[$i]['Description']}}</textarea></td>
                        <td>
                            <div class="text-center">
                            <img src="{{$parts[$i]['productImage']}}" class="rounded" alt="...">
                            </div>
                            <textarea style="height:auto">{{$parts[$i]['productImage']}}</textarea>
                  
                        </td>
                        <td><textarea>{{$parts[$i]['Category']}}</textarea></td>
                        <td><textarea>{{$parts[$i]['manufacturerName']}}</textarea></td>
                        <td><textarea>{{$parts[$i]['manufacturerCode']}}</textarea></td>

                        <td>
                            @for ($j = 0; $j < count($parts[$i]['PriceBreaks']); $j++)
                            <input type="text" value="{{ $parts[$i]['PriceBreaks'][$j]['Quantity'] }}/{{ $parts[$i]['PriceBreaks'][$j]['Price']}}">

                                                   <hr> 
                            @endfor                         
                        </td>

                        <td><textarea>{{$parts[$i]['supplierCode']}}</textarea></td>
                
                    </tr>
                    @endfor
                    
                    
                </tbody>
            </table>  
            </div>    
        </div>
        @endisset
    @endsection
