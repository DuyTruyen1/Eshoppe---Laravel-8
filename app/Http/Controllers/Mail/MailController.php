<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Mail\MailNotify;
use Exception;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index(){
        $data = [
            'subject' => 'Cambo Tutorial Mail',
            'body' => 'Hello This is my email delivery'
        ];
        try{
            Mail::to('truyenmap420@gmail.com')->send(new MailNotify($data));
            return response()->json(['Great check your mail box']);
        }catch(Exception $th){
            return response()->json(['sorry']);
        }
    }
}
