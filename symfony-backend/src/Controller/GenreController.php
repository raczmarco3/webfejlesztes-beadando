<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Service\GenreService;
use App\Dto\GenreRequestDto;


class GenreController extends AbstractController
{
    /**
     * @Route("/api/genre", methods={"POST"})
     */
    public function addNewGenre(Request $request, ManagerRegistry $registry): JsonResponse
    {   
        if(empty($request->getContent())) {
            return new JsonResponse(["msg" => "HTTP body is empty!"], 406);
        }
        
        $data = json_decode($request->getContent(), true);

        if(empty($data["name"])) {
            return new JsonResponse(["msg" => "'name' field must not be empty!"], 403);
        }

        $genreRequestDo = new GenreRequestDto($data["name"]);

        $genreService = new GenreService($registry);        
        return $genreService->addNewGenre($genreRequestDo);
    }

    /**
     * @Route("/api/genre/{id}", methods={"GET"})
     */
    public function getGenre(ManagerRegistry $registry, SerializerInterface $serializer, $id): JsonResponse
    {
        $genreService = new GenreService($registry);
        return $genreService->getGenre($serializer, $id);
    }

    /**
     * @Route("/api/genres/", methods={"GET"})
     */
    public function getAllGenre(ManagerRegistry $registry, SerializerInterface $serializer): JsonResponse
    {
        $genreService = new GenreService($registry);
        return $genreService->getAllGenre($serializer);
    }

    /**
     * @Route("/api/genre/{id}", methods={"PUT"})
     */
    public function editGenre(Request $request, ManagerRegistry $registry, $id)
    {
        if(empty($request->getContent())) {
            return new JsonResponse(["msg" => "HTTP body is empty!"], 406);
        }
        
        $data = json_decode($request->getContent(), true);

        if(empty($data["id"])) {
            return new JsonResponse(["msg" => "'id' field must not be empty!"], 403);
        } else if(!is_numeric($data["id"])) {
            return new JsonResponse(["msg" => "'id' field must be a number!"], 403);
        } else if($data["id"] != $id) {
            return new JsonResponse(["msg" => "You don't have permission to edit this Genre!"], 403);
        } else if(empty($data["name"])) {
            return new JsonResponse(["msg" => "'name' field must not be empty!"], 403);
        }

        $genreRequestDo = new GenreRequestDto($data["name"]);
        
        $genreService = new GenreService($registry);        
        return $genreService->editGenre($registry, $id, $genreRequestDo);
    }

    /**
     * @Route("/api/genre/{id}", methods={"DELETE"})
     */
    public function deleteGenre(ManagerRegistry $registry, $id)
    {
        $genreService = new GenreService($registry);
        return $genreService->deleteGenre($registry, $id);
    }
}