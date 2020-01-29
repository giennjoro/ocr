<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OcrController extends Controller
{
    public function ocr(){
        dd(\OCR::scan('uploads/1.jpg'));
    }
}
