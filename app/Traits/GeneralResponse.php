<?php

namespace App\Traits;
use Illuminate\Http\JsonResponse;

class GeneralResponse
{
  public static function responseMessage($title, $data = null,$code = 200,$paginationDetails=Null): JsonResponse | true
  {
          $responce['status'] =$title;
          $responce['code'] =$code;
          $responce['data'] = is_string($data) ? ['message' => $data] : $data;
          if($paginationDetails){
            $responce['pagination']  = $paginationDetails;
          }
          return response()->json($responce, $code);
 
  }

  public static function responseError($data = null,$code = 400): JsonResponse | true
  {
          $responce['code'] =$code;
          $responce['errors'] = is_string($data) ? ['message' => $data] : $data;
        
          return response()->json($responce, $code);
 
  }
}
