<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
  
class MapsController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('maps.maps');
    }
}