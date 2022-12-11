<?php

namespace App\Controller;

use App\Dto\MovieActorRequestDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Service\MovieActorService;
use Symfony\Component\Serializer\SerializerInterface;

class MovieActorController extends AbstractController
{
    /**
     * @Route("/api/movieactor", methods={"POST"})
     */
    public function addNewMovieActor(Request $request, ManagerRegistry $registry): JsonResponse
    {
        if(empty($request->getContent())) {
            return new JsonResponse(["msg" => "HTTP body is empty!"], 406);
        }

        $data = json_decode($request->getContent(), true);

        if(empty($data["movieId"]) || !is_numeric($data["movieId"])) {
            return new JsonResponse(["msg" => "'movieId' field must be a number!"], 422);
        } else if(empty($data["actorId"]) || !is_numeric($data["actorId"])) {
            return new JsonResponse(["msg" => "'actorId' field must be a number!"], 422);
        }

        $moveActorRequestDto = new MovieActorRequestDto($data["movieId"], $data["actorId"]);
        $movieActorService = new MovieActorService($registry);

        return $movieActorService->addNewMovieActor($registry, $moveActorRequestDto);
    }

    /**
     * @Route("api/movieactor/{id}", methods={"GET"})
     */
    public function getMovieActor(ManagerRegistry $registry, SerializerInterface $serializer, $id): JsonResponse
    {
        $movieActorService = new MovieActorService($registry);
        return $movieActorService->getMovieActor($serializer, $id);
    }

    /**
     * @Route("/api/movieactors", methods={"GET"})
     */
    public function getAllMovieActor(ManagerRegistry $registry, SerializerInterface $serializer): JsonResponse
    {
        $movieActorService = new MovieActorService($registry);
        return $movieActorService->getAllMovieActor($serializer);
    }

    /**
     * @Route("/api/movieactor/{id}", methods={"PUT"})
     */
    public function editMovieActor(Request $request, ManagerRegistry $registry, $id): JsonResponse
    {
        if(empty($request->getContent())) {
            return new JsonResponse(["msg" => "HTTP body is empty!"], 406);
        }

        $data = json_decode($request->getContent(), true);

        if(empty($data["movieId"]) || !is_numeric($data["movieId"])) {
            return new JsonResponse(["msg" => "'movieId' field must be a number!"], 422);
        } else if(empty($data["actorId"]) || !is_numeric($data["actorId"])) {
            return new JsonResponse(["msg" => "'actorId' field must be a number!"], 422);
        } else if(empty($data["id"]) || !is_numeric($data["id"])) {
            return new JsonResponse(["msg" => "'id' field must be a number!"], 422);
        } else if($id != $data["id"]) {
            return new JsonResponse(["msg" => "You don't have permission to edit this registry!"], 403);
        }

        $moveActorRequestDto = new MovieActorRequestDto($data["movieId"], $data["actorId"]);
        $movieActorService = new MovieActorService($registry);

        return $movieActorService->editMovieActor($registry, $data["id"], $moveActorRequestDto);
    }

    /**
     * @Route("/api/movieactor/{id}", methods={"DELETE"})
     */
    public function deleteMovieActor(ManagerRegistry $registry, $id): JsonResponse
    {
        $movieActorService = new MovieActorService($registry);
        return $movieActorService->deleteMovieActor($id);
    }

    /**
     * @Route("/api/actor/{id}/movies", methods="GET")
     */
    public function getAllMoviesForActor(ManagerRegistry $registry, SerializerInterface $serializer, $id): JsonResponse
    {
        $movieActorService = new MovieActorService($registry);
        return $movieActorService->getAllMoviesForActor($registry, $serializer, $id);
    }

    /**
     * @Route("/api/movie/{id}/actors", methods="GET")
     */
    public function getAllActorsForMovie(ManagerRegistry $registry, SerializerInterface $serializer, $id): JsonResponse
    {
        $movieActorService = new MovieActorService($registry);
        return $movieActorService->getAllActorsForMovie($registry, $serializer, $id);
    }
}