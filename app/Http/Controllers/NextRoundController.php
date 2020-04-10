<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participant;
use App\Match;
use DB;

class NextRoundController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index(Request $request)
    {
        $arr_match = Match::where('winner',null)->count();
        $lastmatch = Match::max('match');
        $min_match = Match::where('winner',null)->min('match');

        foreach ($request->match as  $key=>$value)
        {
            $resultArray = explode('|',$request->winner[$key]);
            $winner = $resultArray[0];
            $loser = $resultArray[1];
            Match::where('match',$value)->update(['winner'=>$winner]);
            Match::where('match',$value)->update(['loser'=>$loser]);
        }
        $pairs = $this->pairRecord((int)$arr_match, (int)$lastmatch, (int)$min_match);
        asort($pairs);

        if (array_key_exists("final",$pairs)){
            return view('placementfinal', compact('pairs'));
            // dd($pairs['final']);
        }else{
            return view('placement', compact('pairs'));
        }
    }

    public function pairRecord($x, $b, $min) 
    { 
        $t = $x/2;
        $i = 1;
        $m = 0;

        if ($t == 1)
            $round = "Final";
        elseif ($t == 2)
            $round = "SemiFinal";
        else
            $round = "Round"." of ".$x;

        if ($t>1)
            for ($y = 1; $y <= $x; $y++) {

                $winner1 = Match::where('match',$min)->first();
                $y++;
                $min++;
                $winner2 = Match::where('match',$min)->first();
                $min++;
                            
                $pair = [
                    'participant1' =>   $winner1->winner,
                    'participant2' =>   $winner2->winner,
                ];

                $match = ++$b;

                $data = [
                    'match' => $match,
                    'participant'  =>   $pair,
                    'round' => $round,
                ];
            
                Match::create($data);
                $dataArray[] = $data;
            }
        elseif ($t==1)
            for ($y = 1; $y <= $x; $y++) {

                $player1 = Match::where('match',$min)->first();
                $y++;
                $min++;
                $player2 = Match::where('match',$min)->first();
                $min++;
                            
                $pair1 = [
                    'participant1' =>   $player1->winner,
                    'participant2' =>   $player2->winner,
                ];

                $pair2 = [
                    'participant1' =>   $player1->loser,
                    'participant2' =>   $player2->loser,
                ];

                $match = ++$b;

                $data1 = [
                    'match' => $match,
                    'participant'  =>   $pair1,
                    'round' => $round,
                ];

                $data2 = [
                    'match' => $match+1,
                    'participant'  =>   $pair2,
                    'round' => "Consolation",
                ];
            
                Match::create($data1);
                Match::create($data2);
                $dataArray['final'] = $data1;
                $dataArray['consolation'] = $data2;
            }
        else
            $dataArray = [];
        return $dataArray;
        
    } 

    public function match($x)
    {
        $z = $x/2;
        $oddeven = $y % 2;
        if ($oddeven != 0){
            $match = $i;
        }else{
            $match = $z-$m;
        }
        return $match;
    }

}
