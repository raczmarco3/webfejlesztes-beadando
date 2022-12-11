<?php

namespace App\Converter;

use Symfony\Component\HttpFoundation\JsonResponse;

Class JsonConverter
{
    public static function jsonResponse($serializer, $data, $groupName = false)
    {
        $response = new JsonResponse();

        if($groupName) {
            $jsonContent = $serializer->serialize($data, 'json', ['groups' => $groupName]);
        } else {
            $jsonContent = $serializer->serialize($data, 'json');
        }  
        
        $response->setContent($jsonContent);
        return $response;        
    }
}