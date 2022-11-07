<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Element14\Element14ApiService;
use App\Helpers\{MepaDataElement14Helper,ArrayToCsvConverterHelper};

class Element14Controller extends Controller
{
    private $_element14Service;
    
    function __construct()
    {
        $this->_element14Service = new Element14ApiService();
    }  
    public function index()
    {
        return view('element14.element14_index');
    }
    //
    public function getFormKeywordSearch()
    {
        return view('element14.form_keywordsearch');
    }
    //    
    /**
     * postFormKeywordSearch
     *
     * @param  mixed $request
     * @return void
     */
    public function postFormKeywordSearch(Request $request)
    {
        #Post data validation
        $validated = $request->validate([
            'keyword' => 'required|max:255',
            'storeInfo' => 'required|string',
            'numberOfResults' => 'integer',
            'filters' => 'string',
            'responseGroup' => 'string',
        ]);
        $validated['startingOffset'] = 0;
        #Retrieving 25 products data from starting offset 0
        $responseJson = $this->_element14Service->keywordSearch($validated);
        $responseArray = json_decode($responseJson,true);
        
        #To store all result of product data
        $mepaData = array();
        #Initialize with first result
        $mepaData[0] = MepaDataElement14Helper::extratedDataForMepa($responseArray['keywordSearchReturn']['products']);
        #Number of results found
        $numberOfResults  = $responseArray['keywordSearchReturn']['numberOfResults'];
        #Number of results returned
        $numberOfResultsReturned = $responseArray['keywordSearchReturn']['products'];    
        #to deduce the number of loop
        $nbOfRequest = $numberOfResults/50;
        $nbOfRequest = 10;
       
        #Loop to retrieve all result returned or all products found
        for ($i=1; $i < $nbOfRequest ; $i++) { 

            $responseJson = $this->_element14Service->keywordSearch($validated);
            $responseArray = json_decode($responseJson,true); 

            if (array_key_exists("products", $responseArray['keywordSearchReturn']))
            {            
                $extractedDataForMepa[$i] = MepaDataElement14Helper::extratedDataForMepa($responseArray['keywordSearchReturn']['products']);
                #add new products data 
                $mepaData[0] = array_merge($mepaData[0],$extractedDataForMepa[$i]);
                #set starting offset
                $validated['startingOffset'] = $validated['startingOffset'] + 25;//$numberOfResultsReturned
            }
            else break;
        }

        #Convert array returned from API in csv file
        $csvContent = ArrayToCsvConverterHelper::arrayToCsvConverter($mepaData[0]);

        return response($csvContent)
                ->withHeaders([
                                'Content-Type' => 'application/csv',
                                'Content-Disposition' => 'attachment; filename='.date('Ymd_His').'-element14-'.$validated["keyword"].'.csv',
                                'Content-Transfer-Encoding' => 'UTF-8',
                            ]);

    }
}
