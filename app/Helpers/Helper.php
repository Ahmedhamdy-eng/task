<?php
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Twilio\Rest\Client;

if (!function_exists('fireSmsMessage')) { 
   /**
   * Get Active Languages.
   *
   * @return array of Active languages
   */
    function fireSmsMessage($user)
    {
        $account_sid = 'AC2454df80b7e02627efb01ea734432620';
        $auth_token  = '00f07a107e91d5335bcf47c3fc2655ca';
        // In production, these should be environment variables. E.g.:
        // $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

        // A Twilio number you own with SMS capabilities
        $twilio_number = "+16504602669";

        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            // Where to send a text message (your cell phone?)
            '+2'.$user->phone,
            array(
                'from' => $twilio_number,
                'body' => 'Your Verification Code Is '.$user->verification_code
            )
        );
    } 
}



if (!function_exists('admin')) {
   /**
   * Get auth admin data  .
   * 
   * @return Auth admin data .
   */
    function admin()
    {
     return auth()->guard('admin')->user();
    }  //end function 
}//end if 

if (!function_exists('getUser')) {
   /**
   * Get auth user data  .
   * 
   * @return Auth user data .
   */
    function getUser()
    {
     return auth()->guard('api')->user();
    }  //end function 
}//end if

if (!function_exists('getUserById')) {
   /**
   * Get auth user data  .
   * 
   * @return Auth user data .
   */
    function getUserById($id)
    {
     return User::Where('id', $id)->first();
    }  //end function 
}//end if 


if (!function_exists('active')) { 
    /**
     * Get Active child tab in sidebar if  parameter route == current route .
     *
     * @param  $route
     * @return string active or no thing if parameter route !== Current route.
     */
      function active($route)
      {
        
           
          if(Route::is($route.'*') ){
              return 'active';
          }else{
              return '';
          }
      }//end function 
}//end if


