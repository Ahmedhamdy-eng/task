<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\CompanyKey;
use App\Traits\SmsTrait;
use App\Traits\GeneralTrait;
use App\Models\User;
use JWTAuth;
use App\Constants\Constants;
use Twilio\Rest\Client;
use App\Http\Resources\UserResource;
use DB;
class AuthController extends Controller
{
    use GeneralTrait;
    use SmsTrait;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
       
        $credentials = [
            'name'     => $request->name,
            'phone'    => $request->phone,
            'password' => $request->password,
            'verify'   => Constants::IS_VERIFY,
        ];

        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
   
        return $this->respondWithToken($token);
       
    }    

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register( Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name'     => 'required|string|max:100',
            'phone'    => ['required','unique:users','numeric','digits:11', new CompanyKey],
            'password' => 'required|min:8|confirmed',
        ]);

        #Validation Fails..
        if ($validator->fails())
            return $this->returnValidation($validator);

        try {

            DB::beginTransaction();

            $user = User::create($request->all());

            $this->sendSms($user);

            $token = JWTAuth::fromUser($user);

            DB::commit();
            return $this->respondWithToken($token);

        }catch(Exception $ex){
            DB::rollBack();
            return $this->returnError('Some Thing Went Wrong!') ;
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserData(Request $request)
    {
        $user = $request->user(); 

        if(!$user->verify)
        return $this->returnError('You Cannot Access This User Now Verify It First'); 

        return $this->returnSingleData('userDate', new UserResource($user), 'success');
    }

    /**
    * verify user
    *
    * @param  [string] code
    * @return [string] message
    */
    public function verify(Request $request)
    {
        #Validation
        $validator = \Validator::make($request->all(), [
            'code'    => 'required|string|digits:6',
        ]);


        if ($validator->fails())
            return $this->returnValidation($validator);

        $user = $request->user();
       
     
        if( $this->checkCode($user, request('code')) )
            return $this->returnError('this verification code Is Not Valid');

      
        $user->update(['verify' => 1, 'verification_code' => null]);

        return $this->returnSuccess('Verified Successfully');
    }
    /**
    * check user Code 
    *
    * @return [array] user
    * @param  [string] code
    */
    private function checkCode($user, $code)
    {
        return $user->verification_code != $code ? true : false;
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return $this->returnSingleData('access_token', $token);
    }

    /**
     * Generate the Verification Token.
     *
     * @param  string $token
     *
     * @return int rand
     */
    protected function verificationCode()
    {
        return rand ( 100000 , 999999 );
    }

    /**
     * Generate the Verification Token.
     *
     * @param  string $token
     *
     * @return string code
     */
    protected function updateVerificationCode($user)
    {
       $code = $this->verificationCode();
       $user->update(['verification_code' =>  $code]);

       return $code;
    }   

     /**
     * Generate the Verification Token.
     *
     * @param  array $user
     *
     * @return void
     */
    protected function sendSms($user)
    {
       $code = $this->updateVerificationCode($user);
       fireSmsMessage($user);
    }


}
