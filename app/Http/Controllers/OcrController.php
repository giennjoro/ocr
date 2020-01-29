<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OcrController extends Controller
{
    public function landing(){
        return view('landing');
    }
    public function ocr(Request $request){
        $text = \OCR::scan($request->image);

        return view('result')->with('text', $text);
    }
}
