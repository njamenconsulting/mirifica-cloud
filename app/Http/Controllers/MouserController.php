<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Mouser\MouserApiService;
use App\Helpers\JsonToCsvHelper;
use App\Helpers\{ArrayToCsvConverterHelper,MepaMouserDataHelper};

class MouserController extends Controller
{
    /**
     * _mouserService
     *
     * @var mouserService
     */
    private $_mouserService;
   
    function __construct()
    {
        $this->_mouserService = new MouserApiService();
    }   
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return view('mousers.mouser_index');
    }
    public function getFormKeywordSearch()
    {
        return view('mousers.form_keywordsearch');
    }
    //
    public function postFormKeywordSearch(Request $request)
    {
        $validated = $request->validate([
            'keyword' => 'required|max:255',
            'records' => 'required|integer',
            'startingRecord' => 'required|integer',
            'searchOptions' => 'required|string',
            'version' => 'required|string',
        ]);
        //dd($validated);
        $jsonData = $this->_mouserService->getPartsByKeyword($validated);
        $arraydata = json_decode($jsonData,true);

        $NumberOfResult = $arraydata['SearchResults']['NumberOfResult'];
        $nbOfRequest = $NumberOfResult/50;
       
        $result=[];
        $result[0] = $arraydata['SearchResults']['Parts'];

        for ($i=1; $i < 10; $i++) { 
  
            $jsonData = $this->_mouserService->getPartsByKeyword($validated);
            $arraydata = json_decode($jsonData,true);

            $result[$i] = $arraydata['SearchResults']['Parts'];
            $result[0] = array_merge($result[0], $result[$i] );
            $validated['startingRecord'] = $validated['startingRecord'] + 50 ;
        }

        $data=MepaMouserDataHelper::extractedDataForMepa($result[0]);

        $csv = ArrayToCsvConverterHelper::arrayToCsvConverter($data);

        return response($csv)
                    ->withHeaders([
                        'Content-Type' => 'application/csv',
                        'Content-Disposition' => 'attachment; filename='.date('Ymd_His').'-mouser-'.$validated["keyword"].'.csv',
                        'Content-Transfer-Encoding' => 'UTF-8',
                    ]);   
        //return view('mousers.mouser_index',$data);      
    }
}
