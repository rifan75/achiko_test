<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participant;
use App\Match;
use DB;

class KlasemenController extends Controller
{
    public function __construct()
    {
        //
    }

    public function check_participant(Request $parti)
    {
        DB::table('participant')->delete();
        DB::table('match')->delete();

        (int)$x = $parti->parti;

        if($this->isPowerOfTwo($x)) {
            $parti_num = $x;
            for ($x = 1; $x <= $parti_num; $x++) {
                $data = [
                    'number'  =>   $x,
                ];
                Participant::create($data);
            }
            
            $pairs = $this->pairRecord((int)$parti_num);
            asort($pairs);
            
            return view('placement', compact('pairs'));
        }

            $parti_num = 0; 
            return view('error');


        
    }

    public function isPowerOfTwo($x) 
    { 
        if ($x > 3)
          return $x && (!($x & ($x - 1))); 
        else
          return false;
    } 

    public function pairRecord($x) 
    { 
        $t = $x/2;
        $z = $x;
        $i = 1;
        $m = 0;

        if ($t == 2)
            $round = "SemiFinal";
        else
            $round = "Round"." of ".$x;

        for ($y = 1; $y <= $t; $y++) {
            $pair = [
                'participant1' =>   $y,
                'participant2' =>   $x--,
            ];
            
            $match = $this->match($y,$z,$i,$m);

            $oddeven = $y % 2;
            if ($oddeven != 0)
                $i++;
            else
                $m++;

            $data = [
                'match' => $match,
                'participant'  =>   $pair,
                'round' => $round,
            ];
          
            Match::create($data);
            $dataArray[] = $data;
        }

        return $dataArray;
        
    } 

    public function match($y,$x,$i,$m)
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
