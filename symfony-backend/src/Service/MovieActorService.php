<?php

namespace App\Service;

use App\Converter\JsonConverter;
use App\Dto\ActorResponseDto;
use App\Dto\GenreResponseDto;
use App\Dto\MovieActorResponseDto;
use App\Dto\MovieResponseDto;
use App\Entity\MovieActor;
use App\Repository\MovieActorRepository;
use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\ActorRepository;

class MovieActorService
{
    private $movieActorRepository;

    public function __construct($registry)
    {
        $this->movieActorRepository = new MovieActorRepository($registry);
    }

    public function addNewMovieActor($registry, $movieActorRequestDto): JsonResponse
    {        
        $movieRepository = new MovieRepository($registry);
        $movie = $movieRepository->find($movieActorRequestDto->getMovieId());

        if(!$movie) {
            return new JsonResponse(["msg" => "Movie Not Found!"], 404);
        }

        $actorRepository = new ActorRepository($registry);
        $actor = $actorRepository->find($movieActorRequestDto->getActorId());

        if(!$actor) {
            return new JsonResponse(["msg" => "Actor Not Found!"], 404);
        }

        $entityManager = $registry->getManager();
        $movieActor = $entityManager->getRepository(MovieActor::class)->findOneBy(
            ["movie" => $movie,
            "actor" => $actor]
        );

        if($movieActor) {
            return new JsonResponse(["msg" => "This registry already exists!"], 403);
        }

        $movieActor = new MovieActor();
        $movieActor->setMovie($movie);
        $movieActor->setActor($actor);

        $this->movieActorRepository->save($movieActor, true);
        return new JsonResponse(["msg" => "Registry created!"], 201);
    }

    public function getMovieActor($serializer, $id)
    {
        $movieActor = $this->movieActorRepository->find($id);

        if(!$movieActor) {
            return new JsonResponse(["msg" => "Registry not found!"], 404);
        }

        $genreResponseDto = new GenreResponseDto($movieActor->getMovie()->getGenre()->getId(), $movieActor->getMovie()->getGenre()->getName());
        $movieResponseDto = new MovieResponseDto($movieActor->getMovie()->getId(), $movieActor->getMovie()->getTitle(), $genreResponseDto, 
         $movieActor->getMovie()->getLength(), $movieActor->getMovie()->getReleaseYear());

        $actorResponseDto = new ActorResponseDto($movieActor->getActor()->getId(), $movieActor->getActor()->getName(),
         $movieActor->getActor()->getBirthDate(), $movieActor->getActor()->getBirthPlace());

        $movieActorResponseDto = new MovieActorResponseDto($movieActor->getId(), $movieResponseDto, $actorResponseDto);

        return JsonConverter::jsonResponse($serializer, $movieActorResponseDto);
    }

    public function getAllMovieActor($serializer): JsonResponse
    {
        $movieActors_ = $this->movieActorRepository->findAll();

        if(!$movieActors_) {
            return new JsonResponse(["msg" => "Registry not found!"], 404);
        }

        $movieActors = [];

        foreach($movieActors_ as $movieActor)
        {
            $genreResponseDto = new GenreResponseDto($movieActor->getMovie()->getGenre()->getId(), $movieActor->getMovie()->getGenre()->getName());
            $movieResponseDto = new MovieResponseDto($movieActor->getMovie()->getId(), $movieActor->getMovie()->getTitle(), $genreResponseDto, 
            $movieActor->getMovie()->getLength(), $movieActor->getMovie()->getReleaseYear());

            $actorResponseDto = new ActorResponseDto($movieActor->getActor()->getId(), $movieActor->getActor()->getName(),
            $movieActor->getActor()->getBirthDate(), $movieActor->getActor()->getBirthPlace());

            $movieActorResponseDto = new MovieActorResponseDto($movieActor->getId(), $movieResponseDto, $actorResponseDto);
            array_push($movieActors, $movieActorResponseDto);
        }

        return JsonConverter::jsonResponse($serializer, $movieActors);
    }

    public function editMovieActor($registry, $id, $movieActorRequestDto): JsonResponse
    {
        $entityManager = $registry->getManager();
        $movieActor = $this->movieActorRepository->find($id);

        if(!$movieActor) {
            return new JsonResponse(["msg" => "Registry not found!"], 404);
        }

        $movieRepository = new MovieRepository($registry);
        $movie = $movieRepository->find($movieActorRequestDto->getMovieId());

        if(!$movie) {
            return new JsonResponse(["msg" => "Movie Not Found!"], 404);
        }

        $actorRepository = new ActorRepository($registry);
        $actor = $actorRepository->find($movieActorRequestDto->getActorId());

        if(!$actor) {
            return new JsonResponse(["msg" => "Actor Not Found!"], 404);
        }

        $entityManager = $registry->getManager();
        $movieActor_ = $entityManager->getRepository(MovieActor::class)->findOneBy(
            ["movie" => $movie,
            "actor" => $actor]
        );

        if($movieActor_) {
            return new JsonResponse(["msg" => "This registry already exists!"], 403);
        }

        $movieActor->setMovie($movie);
        $movieActor->setActor($actor);

        $entityManager->flush();
        return new JsonResponse(["msg" => "Registry edited succesfully!"], 201);
    }

    public function deleteMovieActor($id): JsonResponse
    {
        $movieActor = $this->movieActorRepository->find($id);

        if(!$movieActor) {
            return new JsonResponse(["msg" => "Registry not found!"], 404);
        }

        $this->movieActorRepository->remove($movieActor, true);
        return new JsonResponse(["msg" => "Delete successful!"]);
    }

    public function getAllMoviesForActor($registry, $serializer, $id): JsonResponse
    {
        $actorRepository = new ActorRepository($registry);
        $actor = $actorRepository->find($id);

        if(!$actor) {
            return new JsonResponse(["msg" => "Actor Not Found!"], 404);
        }

        $movieActors_ = $this->movieActorRepository->findBy(["actor" => $actor]);

        if(empty($movieActors_)) {
            return new JsonResponse(["msg" => "This Actor has no Movie!"], 404);
        }

        $movies= [];

        foreach($movieActors_ as $movieActor)
        {
            $movie = $movieActor->getMovie();
            $genreResponseDto = new GenreResponseDto($movie->getGenre()->getId(), $movie->getGenre()->getName());
            $movieResponseDto = new MovieResponseDto($movie->getId(), $movie->getTitle(), $genreResponseDto, $movie->getLength(), $movie->getReleaseYear());
            array_push($movies, $movieResponseDto);
        }

        return JsonConverter::jsonResponse($serializer, $movies);        
    }

    public function getAllActorsForMovie($registry, $serializer, $id): JsonResponse
    {
        $movieRepository = new MovieRepository($registry);
        $movie = $movieRepository->find($id);

        if(!$movie) {
            return new JsonResponse(["msg" => "Movie Not Found!"], 404);
        }

        $movieActors_ = $this->movieActorRepository->findBy(["movie" => $movie]);

        if(empty($movieActors_)) {
            return new JsonResponse(["msg" => "This Movie has no Actor!"], 404);
        }

        $actors = [];

        foreach($movieActors_ as $movieActor)
        {
            $actor = $movieActor->getActor();
            $actorResponseDto = new ActorResponseDto($actor->getId(), $actor->getName(), $actor->getBirthDate(), $actor->getBirthPlace());
            array_push($actors, $actorResponseDto);
        }

        return JsonConverter::jsonResponse($serializer, $actors);   
    }
}