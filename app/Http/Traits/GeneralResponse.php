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
}
