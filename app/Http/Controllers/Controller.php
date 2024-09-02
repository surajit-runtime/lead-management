<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function calculateDateDifference($givenDate)
    {
        // Parse the given date using Carbon
        $givenDate = Carbon::parse($givenDate);
    
        // Get the current date
        $currentDate = Carbon::now();
    
        // Calculate the difference in days
        $differenceInDays = $currentDate->diffInDays($givenDate);
    
        return $differenceInDays+1;
    }

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }
    public function insertLog($description,$status){
    
        $log_insert = DB::table('tbl_log')->insert([
            'user_id'      => session('userdata')->id, // Access user ID from the session
            'description'  => $description,
            'status'       => $status,
            'ip_address'   => session()->get('ip_address', $this->getIp()), // Use the retrieved IP address
            'time'         => now(), // Use Carbon's now() function directly
        ]);
       
   
   
}
public function insertLog1($description,$status,$ipadress){
    
    $log_insert = DB::table('tbl_log')->insert([
        'user_id'      => 0, // Access user ID from the session
        'description'  => $description,
        'status'       => $status,
        'ip_address'   => $ipadress, // Use the retrieved IP address
        'time'         => now(), // Use Carbon's now() function directly
    ]);
   


}

}
