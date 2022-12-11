<?php

namespace App\Controller;

use App\Dto\MovieRequestDto;
use App\Service\MovieService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class MovieController extends AbstractController
{
    /**
     * @Route("/api/movie", methods={"POST"})
     */
    public function addNewMovie(Request $request, ManagerRegistry $registry): JsonResponse
    {
        if(empty($request->getContent())) {
            return new JsonResponse(["msg" => "HTTP body is empty!"], 406);
        }
        
        $data = json_decode($request->getContent(), true);

        if(empty($data["title"])) {
            return new JsonResponse(["msg" => "'title' field must not be empty!"], 422);
        } else if(empty($data["genreId"])) {
            return new JsonResponse(["msg" => "'genreId' field must not be empty!"], 422);
        } else if(empty($data["length"])) {
            return new JsonResponse(["msg" => "'length' field must not be empty!"], 422);
        } else if(empty($data["releaseYear"])) {
            return new JsonResponse(["msg" => "'releaseYear' field must not be empty!"], 422);
        } else if(!$this->checkReleaseYear($data["releaseYear"])) {
            return new JsonResponse(["msg" => "Invalid release year!"], 422);
        } else if(!is_numeric($data["length"])) {
            return new JsonResponse(["msg" => "length must be a number!"], 422);
        } else if(!is_numeric($data["genreId"])) {
            return new JsonResponse(["msg" => "genreId must be a number!"], 422);
        }

        $movieRequestDto = new MovieRequestDto($data["title"], $data["genreId"], $data["length"], $data["releaseYear"]);

        $movieService = new MovieService($registry);
        return $movieService->addNewMovie($registry, $movieRequestDto);
    }

    /**
     * @Route("/api/movie/{id}", methods={"GET"})
     */
    public function getMovie(ManagerRegistry $registry, SerializerInterface $serializer, $id): JsonResponse
    {
        $movieService = new MovieService($registry);
        return $movieService->getMovie($serializer, $id);
    }

    /**
     * @Route("/api/movies", methods={"GET"})
     */
    public function getAllMovie(ManagerRegistry $registry, SerializerInterface $serializer): JsonResponse
    {
        $movieService = new MovieService($registry);
        return $movieService->getAllMovie($serializer);
    }

    /**
     * @Route("/api/movie/{id}", methods={"PUT"})
     */
    public function editMovie(Request $request, ManagerRegistry $registry, $id): JsonResponse
    {
        if(empty($request->getContent())) {
            return new JsonResponse(["msg" => "HTTP body is empty!"], 406);
        }        
        
        $data = json_decode($request->getContent(), true);

        if(empty($data["id"])) {
            return new JsonResponse(["msg" => "'id' field must not be empty!"], 422);
        } else if(!is_numeric($data["id"])) {
            return new JsonResponse(["msg" => "'id' field must be a number!"], 422);
        } else if($data["id"] != $id) {
            return new JsonResponse(["msg" => "You don't have permission to edit this Movie!"], 403);
        } else if(empty($data["title"])) {
            return new JsonResponse(["msg" => "'title' field must not be empty!"], 422);
        } else if(empty($data["genreId"])) {
            return new JsonResponse(["msg" => "'genreId' field must not be empty!"], 422);
        } else if(empty($data["length"])) {
            return new JsonResponse(["msg" => "'length' field must not be empty!"], 422);
        } else if(empty($data["releaseYear"])) {
            return new JsonResponse(["msg" => "'releaseYear' field must not be empty!"], 422);
        } else if(!$this->checkReleaseYear($data["releaseYear"])) {
            return new JsonResponse(["msg" => "Invalid release year!"], 422);
        } else if(!is_numeric($data["length"])) {
            return new JsonResponse(["msg" => "length must be a number!"], 422);
        } else if(!is_numeric($data["genreId"])) {
            return new JsonResponse(["msg" => "genreId must be a number!"], 422);
        }

        $movieRequestDto = new MovieRequestDto($data["title"], $data["genreId"], $data["length"], $data["releaseYear"]);

        $movieService = new MovieService($registry);
        return $movieService->editMovie($registry, $id, $movieRequestDto);
    }    

    /**
     * @Route("/api/movie/{id}", methods={"DELETE"})
     */
    public function deleteMovie(ManagerRegistry $registry, $id): JsonResponse
    {
        $movieService = new MovieService($registry);
        return $movieService->deleteMovie($registry, $id);
    }

    public function checkReleaseYear($releaseYear)
    {
        if($releaseYear<1900 || $releaseYear>9999) {
            return false;
        }
        return true;
    }
}