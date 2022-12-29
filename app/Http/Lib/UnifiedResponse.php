<?php
namespace App\Http\Lib;
use Illuminate\Http\Response;

Trait UnifiedResponse{
    protected function Response($statusCode = Response::HTTP_OK , $title, $message, $data = []) {
        $jsonResponse = [
            'title' => $title,
            'message' => $message
        ];
        if (!empty($data)) {
            $jsonResponse['data'] = $data;
        }
        return response()->json($jsonResponse, $statusCode);
    }
}