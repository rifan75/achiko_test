<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participant;
use App\Match;
use DB;

class FinishRoundController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index(Request $request)
    {
        //dd($request->match );

        foreach ($request->match as  $key=>$value)
        {
            $resultArray = explode('|',$request->winner[$key]);
            $winner = $resultArray[0];
            $loser = $resultArray[1];
            Match::where('match',$value)->update(['winner'=>$winner]);
            Match::where('match',$value)->update(['loser'=>$loser]);
        }
        $final = Match::where('match',$request->match[0])->first(); 
        $consolation = Match::where('match',$request->match[1])->first(); 
        return view('finish', compact('final','consolation'));
    }


}
