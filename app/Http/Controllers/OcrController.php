<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OcrController extends Controller
{
    public function landing(){
        return view('landing');
    }
    public function ocr(Request $request){
        dd(\OCR::scan($request->image));
    }
}
