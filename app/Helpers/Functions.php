<?php

use Illuminate\Support\Facades\Validator;

function send_response($status,$message='',$data=null,$code=200){
    $res = [
        'status' => $status,
        'message' => $message,
        'data' => $data
    ];

    return response()->json($res,$code);
}

// function valid($request,$fields=[]){
//     $all =[
//         'title' => "'title' => 'required|unique:posts|max:255'",
//         'content' => "'content' => 'required'",
//         'image' => 'this is image',
//     ];

//     $data=[];
//     foreach($fields as $field){
//         array_push($data,$all[$field]);
//     }

//    return  $validator = Validator::make($request->all(), [
//         $data[0]
//     ]);

//     if ($validator->fails()) 
//         return send_response(false,'validation error!',$validator->errors());
// }