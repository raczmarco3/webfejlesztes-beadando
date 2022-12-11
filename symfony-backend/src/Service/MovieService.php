<?php

namespace App\Service;

use App\Converter\JsonConverter;
use App\Dto\MovieResponseDto;
use App\Entity\Movie;
use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Dto\GenreResponseDto;
use App\Repository\MovieActorRepository;

class MovieService
{
    private $movieRepository;

    public function __construct($registry)
    {
        $this->movieRepository = new MovieRepository($registry);
    }

    public function addNewMovie($registry, $movieRequestDto): JsonResponse
    {
        $entityManager = $registry->getManager();

        $movie = $entityManager->getRepository(Movie::class)->findOneBy(
            ['title' => $movieRequestDto->getTitle()]
        );

        if($movie) {
            return new JsonResponse(["msg" => "This Movie already exists!"], 403);
        }

        $genre = $this->getNewGenre($registry, $movieRequestDto->getGenreId());
        if(!$genre) {
            return new JsonResponse(["msg" => "Genre Not Found!"], 404);
        }

        $movie = new Movie();
        $movie->setGenre($genre);
        $movie->setTitle($movieRequestDto->getTitle());
        $movie->setLength($movieRequestDto->getLength());
        $movie->setReleaseYear($movieRequestDto->getReleaseYear());

        $this->movieRepository->save($movie, true);
        return new JsonResponse(["msg" => "Movie Created!"], 201);
    }

    public function getMovie($serializer, $id): JsonResponse
    {
        $movie = $this->movieRepository->find($id);
        if(!$movie) {
            return new JsonResponse(["msg" => "Movie Not Found!"], 404);
        }

        $genreResponseDto = new GenreResponseDto($movie->getGenre()->getId(), $movie->getGenre()->getName());
        $movieResponseDto = new MovieResponseDto($movie->getId(), $movie->getTitle(),
         $genreResponseDto, $movie->getLength(), $movie->getReleaseYear());

        return JsonConverter::jsonResponse($serializer, $movieResponseDto);
    }

    public function getAllMovie($serializer): JsonResponse
    {
        $movies_ = $this->movieRepository->findAll();
        if(!$movies_) {
            return new JsonResponse(["msg" => "No Movie Found!"], 404);
        }

        $movies = [];
        foreach($movies_ as $movie)
        {
            $genreResponseDto = new GenreResponseDto($movie->getGenre()->getId(), $movie->getGenre()->getName());
            $movieResponseDto = new MovieResponseDto($movie->getId(), $movie->getTitle(),
             $genreResponseDto, $movie->getLength(), $movie->GetReleaseYear());
            
            array_push($movies, $movieResponseDto);
        }
        
        return JsonConverter::jsonResponse($serializer, $movies, "movie");
    }

    public function editMovie($registry, $id, $movieRequestDto): JsonResponse
    {
        $entityManager = $registry->getManager();
        $movie = $this->movieRepository->find($id);

        if(!$movie) {
            return new JsonResponse(["msg" => "Movie Not Found!"], 404);
        } else if($movie->getTitle() != $movieRequestDto->getTitle() && 
        $entityManager->getRepository(Movie::class)->findOneBy(['title' => $movieRequestDto->getTitle()])) {
            return new JsonResponse(["msg" => "This Movie already exists!"], 403);
        }

        if($movieRequestDto->getGenreId() != $movie->getGenre()->getId())
        {
            $genre = $this->getNewGenre($registry, $movieRequestDto->getGenreId());
            if(!$genre) {
                return new JsonResponse(["msg" => "Genre Not Found!"], 404);
            }
            $movie->setGenre($genre);
        }

        $movie->setTitle($movieRequestDto->getTitle());
        $movie->setLength($movieRequestDto->getLength());
        $movie->setReleaseYear($movieRequestDto->getReleaseYear());
        $entityManager->flush();

        return new JsonResponse(["msg" => "Movie edited successfully!"]);
    }

    public function getNewGenre($registry, $genreId)
    {
        $genreRepository = new GenreRepository($registry);
        $genre = $genreRepository->find($genreId);
        if(!$genre) {
            return false;
        }
        return $genre;
    }    

    public function deleteMovie($registry, $id)
    {
        $movie = $this->movieRepository->find($id);

        if(!$movie) {
            return new JsonResponse(["msg" => "Movie Not Found!"], 404);
        }

        $movieActorRepository = new MovieActorRepository($registry);
        $movieActors = $movieActorRepository->findBy(["movie" => $movie]);

        if(!empty($movieActors)) {
            return new JsonResponse(["msg" => "You can't remove a Movie that has a registry attached!"], 403);
        }

        $this->movieRepository->remove($movie, true);
        return new JsonResponse(["msg" => "Delete successful!"]);
    }
}