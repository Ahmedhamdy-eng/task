<?php

namespace App\Traits;

trait GeneralTrait
{

    public function getCurrentLang()
    {
        return app()->getLocale();
    }

    public function returnError($msg, $errNum = 200)
    {
        return response()->json([
            'status' => false,
            'errNum' => $errNum,
            'msg' => $msg,
        ],$errNum);
    }


    public function returnErrorAuth($msg, $errNum = 200)
    {
        return response()->json([
            'status' => false,
            'errNum' => $errNum,
            'msg'    => $msg,
            'data'   => null
        ],200);
    }


    public function returnSuccess($msg = "", $errNum = 200)
    {
        return [
            'status' => true,
            'errNum' => $errNum,
            'msg' => $msg,
            'data' => null
        ];
    }


    public function returnData($keys, $values, $msg = "")
    {
        $data=[];

        for($i=0; $i<count($keys); $i++) {

            $data[$keys[$i]]= $values[$i];
        }
        
        return response()->json([
        'status' => true,
        'msg' => $msg,
        'errNum' => 200,
        'data' => $data
        ]);
    } 

    public function returnSingleData($key, $value)
    {
       
        return response()->json([
        'status' => true,
        'errNum' => 200,
        $key =>  $value,
        ]);
    } 

    public function returnValidation($validator, $code = 200)
    {
        return $this->returnError( $validator->errors()->first(), $code);
    }


}    