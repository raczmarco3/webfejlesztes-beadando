<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\GenreRepository;
use App\Entity\Genre;
use App\Dto\GenreResponseDto;
use App\Converter\JsonConverter;
use App\Repository\MovieRepository;

class GenreService
{
    private $genreRepository;

    public function __construct($registry)
    {
        $this->genreRepository = new GenreRepository($registry);
    }

    public function addNewGenre($genreRequestDto): JsonResponse
    {
        $genre = new Genre();
        $genre->setName($genreRequestDto->getName());
        $countOfGenre = $this->genreRepository->genreCount($genreRequestDto->getName());

        if($countOfGenre >= 1)
        {
            return new JsonResponse(["msg" => "This Genre already exists!"], 403);
        }

        $this->genreRepository->save($genre, true);
        return new JsonResponse(["msg" => "Genre created!"], 201);
    }

    public function getGenre($serializer, $id): JsonResponse
    {
        $genre = $this->genreRepository->find($id);

        if(!$genre) {
            return new JsonResponse(["msg" => "Genre Not Found!"], 404);
        }

        $genreResonseDto = new GenreResponseDto($genre->getId(), $genre->getName());
        return JsonConverter::jsonResponse($serializer, $genreResonseDto);
    }

    public function getAllGenre($serializer): JsonResponse
    {
        $genres_ = $this->genreRepository->findAll();

        if(!$genres_) {
            return new JsonResponse(["msg" => "No Genre found!"], 404);
        }

        $genres = [];
        foreach($genres_ as $genre)
        {
            $genreResponseDto = new GenreResponseDto($genre->getId(), $genre->getName());
            array_push($genres, $genreResponseDto);
        }
        
        return JsonConverter::jsonResponse($serializer, $genres);
    }

    public function editGenre($registry, $id, $genreRequestDto): JsonResponse
    {
        $entityManager = $registry->getManager();
        $genre = $this->genreRepository->find($id);

        if(!$genre) {
            return new JsonResponse(["msg" => "Genre Not Found!"], 404);
        }

        $countOfGenre = $this->genreRepository->genreCount($genreRequestDto->getName());
        if($countOfGenre >= 1)
        {
            return new JsonResponse(["msg" => "This Genre already exists!"], 403);
        }

        $genre->setName($genreRequestDto->getName());
        $entityManager->flush();

        return new JsonResponse(["msg" => "Genre edited successfully!"]);
    }

    public function deleteGenre($registry, $id): JsonResponse
    {
        $genre = $this->genreRepository->find($id);

        if(!$genre) {
            return new JsonResponse(["msg" => "Genre Not Found!"], 404);
        }

        $movieRepository = new MovieRepository($registry);
        $movies = $movieRepository->findBy(["genre" => $genre]);

        if(!empty($movies)) {
            return new JsonResponse(["msg" => "You can't remove a Genre that has Movie attached!"], 403);
        }

        $this->genreRepository->remove($genre, true);
        return new JsonResponse(["msg" => "Delete successful!"]);
    }
}