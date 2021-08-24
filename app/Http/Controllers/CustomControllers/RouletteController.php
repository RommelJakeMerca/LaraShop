<?php

namespace App\Http\Controllers\CustomControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RewardsModel;
use App\Models\ClientUser;
use DateTime;
use DateInterval;
use Auth;
use Session;

class RouletteController extends Controller
{
    public function insertRewards(Request $request) {
        date_default_timezone_set('Asia/Manila');
        $customerId = Auth::id();
        $rewardTitle = 'Daily Roulette Spin';
        // $rewardsData = RewardsModel::where('user_id', $customerId)->orderBy('created_at', 'desc')->limit(1)->get();
        $rewardsData = RewardsModel::where(['user_id' => $customerId, 'title' => $rewardTitle])->orderBy('created_at', 'desc')->limit(1)->get();
        // $currentUser = ClientUser::where('id', $customerId)->first();
        if(count($rewardsData) == 0) {
            $rewardInfos = new RewardsModel;
            $rewardInfos->user_id = $customerId;
            $rewardInfos->title = $request['roulettetitle'];
            $rewardInfos->reward_points = $request['rewardpoints'];
            $rewardInfos->expiration_points = $request['rewardpoints'];
            $rewardInfos->spin_button = 'disabled';
            $rewardInfos->spin_color = '#808080';
            $rewardInfos->update_time = new DateTime();
            $rewardInfos->created_at = new DateTime();
            $rewardInfos->original_date = new DateTime();
            // $rewardInfos->created_at = $rewardInfos->created_at->add(new DateInterval('PT300S'));
            $rewardInfos->created_at = $rewardInfos->created_at->add(new DateInterval('P1D'));
            $rewardInfos->expiration_date = $rewardInfos->original_date->add(new DateInterval('P3M'));
            $rewardInfos->save();
            return response()->json($rewardInfos);
        } 

        foreach ($rewardsData  as $rewardData) {
            if($rewardData->user_id >= 1) {
                if($rewardData->update_time >= $rewardData->created_at) {
                    date_default_timezone_set('Asia/Manila');
                    $rewardInfos = new RewardsModel;
                    $rewardInfos->user_id = $customerId;
                    $rewardInfos->title = $request['roulettetitle'];
                    $rewardInfos->reward_points = $request['rewardpoints'];
                    $rewardInfos->expiration_points = $request['rewardpoints'];
                    $rewardInfos->spin_button = 'disabled';
                    $rewardInfos->spin_color = '#808080';
                    $rewardInfos->update_time = new DateTime();
                    $rewardInfos->created_at = new DateTime();
                    $rewardInfos->original_date = new DateTime();
                    // $rewardInfos->created_at = $rewardInfos->created_at->add(new DateInterval('PT300S'));
                    $rewardInfos->created_at = $rewardInfos->created_at->add(new DateInterval('P1D'));
                    $rewardInfos->expiration_date = $rewardInfos->original_date->add(new DateInterval('P3M'));
                    $rewardInfos->save();
                    return response()->json($rewardInfos);
                }
            } 
        }   
    }

    public function updateDate() {
        date_default_timezone_set('Asia/Manila');
        $customerId = Auth::id();
        $rewardTitle = 'Daily Roulette Spin';
        // $rewardsData = RewardsModel::where('user_id', $customerId)->orderBy('created_at', 'desc')->limit(1)->get();
        $rewardsData = RewardsModel::where(['user_id' => $customerId, 'title' => $rewardTitle])->orderBy('created_at', 'desc')->limit(1)->get();
        foreach ($rewardsData  as $rewardData) {
            $updateTimeDate = new DateTime($rewardData->update_time);
            $createAtDate = new DateTime($rewardData->created_at);
            $interval = $updateTimeDate->diff($createAtDate);
            $formatCountdown = $interval->format('%H:%I:%S');
            $rewardData->countdown_timer = new DateTime($formatCountdown);
            // dd($rewardData->countdown_timer);
            if($rewardData->update_time < $rewardData->created_at) {
                // $rewardUpdates= RewardsModel::where('user_id', $customerId)->get()->last();
                $rewardUpdates= RewardsModel::where(['user_id' => $customerId, 'title' => $rewardTitle])->get()->last();
                $rewardUpdates->update_time = new DateTime();
                $rewardUpdates->countdown_timer =  $rewardData->countdown_timer;
                $rewardUpdates->save();
                return response()->json($rewardUpdates);
            }

            if($rewardData->update_time > $rewardData->created_at) {
                // $rewardUpdates = RewardsModel::where('user_id', $customerId)->get()->last();
                $rewardUpdates= RewardsModel::where(['user_id' => $customerId, 'title' => $rewardTitle])->get()->last();
                $rewardUpdates->spin_button = 'enabled';
                $rewardUpdates->spin_color = '#0E67B9';
                $rewardUpdates->countdown_timer = new DateTime('00:00:00');
                $rewardUpdates->save();
                return response()->json($rewardUpdates);
            }
        }
    }
}
