<!-- resources/views/index.blade.php -->

@extends('layouts.template')


    @section('title', 'Element14')
    
    
    @section('content')


        <div class="bg-light m-2 p-2">
            <h3 class="p-2 text-muted"> Keyword search</h3>
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Element14</a></li>
                <li class="breadcrumb-item active" aria-current="page">keywordSearch</li>
            </ol>
            </nav>

            <form action="{{ url('element14/keywordSearch')}} " method ="POST">
            @csrf
            
                @if ($errors->any())
                <div class="form-text alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-4">
                        <label for="keyword" class="form-label text-muted fw-bold"> Keyword </label>
                        <select name="keyword" class="form-select form-select-sm">
                            <option value ="Semiconductors" selected>Choose...</option>
                            <option value ="Semiconductors">Semiconductors</option>
                            <option  value ="Test%2CMeasurement">Test & Measurement</option>
                            <option  value ="Electromechanical">Electromechanical</option>
                            <option  value ="Coaxial%2CCable">Coaxial Cable</option>
                            <option  value ="q">q</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                    <label for="storeInfo" class="form-label text-muted fw-bold"> Store identifier </label>
                        <select name="storeInfo" class="form-select form-select-sm">
                            <option value ="uk.farnell.com" selected>uk.farnell.com</option>
                            <option value ="de.farnell.com">de.farnell.com</option>
                            <option  value ="it.farnell.com">it.farnell.com</option>
                            <option  value ="uk.farnell.com">uk.farnell.com</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="numberOfResults" class="form-label  text-muted fw-bold"> Number of results to be returned </label>
                        <input type="number" min="10" max="100000" value="25" class="form-control  form-control-sm" name="numberOfResults">
                    </div>

                </div>
                <div class="row mt-1">

                    <div class="col-md-4">
                        <label for="filters" class="form-label  text-muted fw-bold"> Retrieving filter </label>
                        <select name="filters" class="form-select form-select-sm">
                            <option value ="rohsCompliant%2CinStock" selected>InStock, rohsCompliant</option>
                            <option value ="rohsCompliant"> rohsCompliant  </option>
                            <option value ="InStock"> InStock </option>
                        </select>
                    </div>
                    <div class="col-md-3">
                    <label for="responseGroup" class="form-label  text-muted fw-bold"> Filter output </label>
                        <select name="responseGroup" class="form-select form-select-sm">
                            <option value ="large" selected>large</option>
                            <option value ="none"> none </option>
                            <option value ="small"> small</option>
                            <option value ="medium"> medium </option>
                            <option value ="large"> large</option>
                            <option value ="prices"> prices </option>
                            <option value ="inventory"> inventory </option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="row m-2">
                            <button type="submit" class="btn btn-sm btn-warning text-muted"><i class="bi bi-send-fill"></i> Submit</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>

        <div class="bg-warning m-2 p-2">
            <p class="lead"> Search Result: </p>
            <a class="btn btn-md btn-primary" href="#" role="button"> Download csv file &raquo;</a>
   
        </div>


    @endsection
    @push('scripts')
       <script src="#"></script>
    @endpush