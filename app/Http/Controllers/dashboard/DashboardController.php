<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PmVariations;
use App\Models\TrenzProducts;

class DashboardController extends Controller
{
    private $_pmvariationModel;
    private $_trenzProductModel;

    public function __construct(PmVariations $pmvariationModel,TrenzProducts $trenzProductModel)
    {
        $this->_pmvariationModel= $pmvariationModel;
        $this->_trenzProductModel = $trenzProductModel;
    }
    public function index()
    {
        $trenzProducts = $this->_trenzProductModel->count();;
        $pmVariations = $this->_pmvariationModel->count();

  
        return view('dashboard.index')->with(['trenz'=>$trenzProducts])
                                           ->with(['pm'=>$pmVariations]);
    }
}
