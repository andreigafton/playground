<?php

namespace App\Http\Controllers;

use App\GroupResult;
use Illuminate\Http\Request;
use App\Http\Requests\ColorRequest;

class ColorController extends Controller
{
    private $colorHexes;
    private $balls;
    private $groups;

    public function store(ColorRequest $request)
    {
        $colors = $request->input('colors');

        $this->generateHexes($colors);
        $this->generateBalls($colors);

        $response['balls'] = $this->balls;

        $this->generateGroups($colors);


        $response['groups'] = $this->groups;

//        dd($response);

        GroupResult::create([
            'balls' => json_encode($response['balls']),
            'groups' =>json_encode($response['groups'])
        ]);

        return response()->json($response);

    }

    private function generateBalls($colors){
        for($i=0;$i<$colors*$colors;$i++){
            $this->balls[$i] = $this->assignRandomColorToBall();
        }
    }

    private function assignRandomColorToBall(){
        return $this->colorHexes[array_rand ( $this->colorHexes, 1 )];
    }

    private function generateHexes($colors){
        for ($i=1;$i<=$colors;$i++){
            $this->colorHexes[$i] = '#' . dechex(rand(0x000000, 0xFFFFFF));
        }
    }

    private function generateGroups($colors){
        $groupsCount = $groupCapacity = $colors;

        for($i=0;$i<$groupsCount;$i++) {
            $group = [];

            while (array_sum($group) < $groupCapacity) {
                if (count($this->balls) > 0) {
                    $ballIndex = array_rand($this->balls, 1);
                    $ball = $this->balls[$ballIndex];

                    if (count($group) < config('settings.max-per-group')) {
                        $group[$ball] = array_key_exists($ball, $group) ? $group[$ball] + 1 : 1;
                        unset($this->balls[$ballIndex]);
                    } elseif (count($group) == config('settings.max-per-group')) {
                        if (array_key_exists($ball, $group)) {
                            $group[$ball] = $group[$ball] + 1;
                            unset($this->balls[$ballIndex]);
                        } else {
                            continue;
                        }
                    } else {
                        continue;
                    }
                }


            }
            $this->groups[$i] = $group;
        }
    }

}
