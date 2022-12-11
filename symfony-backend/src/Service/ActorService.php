<?php

namespace App\Service;

use App\Converter\JsonConverter;
use App\Entity\Actor;
use App\Repository\ActorRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Dto\ActorResponseDto;
use App\Repository\MovieActorRepository;
use ProxyManager\Factory\RemoteObject\Adapter\JsonRpc;

class ActorService
{
    private $actorRepository;

    public function __construct($registry)
    {
        $this->actorRepository = new ActorRepository($registry);
    }

    public function addNewActor($registry, $actorRequestDto): JsonResponse
    {
        $entityManager = $registry->getManager();
        $actor = $entityManager->getRepository(Actor::class)->findOneBy(
            ["Name" => $actorRequestDto->getName()]
        );

        if($actor) {
            return new JsonResponse(["msg" => "This Actor already exists!"], 403);
        }

        $actor = new Actor();
        $actor->setName($actorRequestDto->getName());
        $actor->setBirthPlace($actorRequestDto->getBirthPlace());
        $actor->setBirthDate(date_create($actorRequestDto->getBirthDate()));
        
        $this->actorRepository->save($actor, true);
        return new JsonResponse(["msg" => "Actor created!"], 201);
    }

    public function getActor($serializer, $id): JsonResponse
    {
        $actor = $this->actorRepository->find($id);

        if(!$actor) {
            return new JsonResponse(["msg" => "Actor not found!"], 404);
        }

        $actorResponseDto = new ActorResponseDto($actor->getId(), $actor->getName(), $actor->getBirthDate(), $actor->getBirthPlace());
        return JsonConverter::jsonResponse($serializer, $actorResponseDto);
    }

    public function getAllActor($serializer): JsonResponse
    {
        $actors_ = $this->actorRepository->findAll();

        if(!$actors_) {
            return new JsonResponse(["msg" => "No Actor found!"], 404);
        }
        $actors = [];

        foreach($actors_ as $actor) 
        {
            $actorResponseDto = new ActorResponseDto($actor->getId(), $actor->getName(), $actor->getBirthDate(), $actor->getBirthPlace());
            array_push($actors, $actorResponseDto);
        }
        
        return JsonConverter::jsonResponse($serializer, $actors);
    }

    public function editActor($registry, $id, $actorRequestDto): JsonResponse
    {
        $entityManager = $registry->getManager();
        $actor = $this->actorRepository->find($id);

        if(!$actor) {
            return new JsonResponse(["msg" => "Actor not found!"], 404);
        }

        if($actorRequestDto->getName() != $actor->getName() && $entityManager->getRepository(Actor::class)
            ->findOneBy(["Name" => $actorRequestDto->getName()])) {
            return new JsonResponse(["msg" => "This Actor already exists!"], 403);
        }

        $actor->setName($actorRequestDto->getName());
        $actor->setBirthDate(date_create($actorRequestDto->getBirthDate()));
        $actor->setBirthPlace($actorRequestDto->getBirthPlace());

        $entityManager->flush();
        return new JsonResponse(["msg" => "Actor edited successfully!"]);
    }

    public function deleteActor($registry, $id): JsonResponse
    {
        $actor = $this->actorRepository->find($id);

        if(!$actor) {
            return new JsonResponse(["msg" => "Actor not found!"], 404);
        }

        $movieActorRepository = new MovieActorRepository($registry);
        $actors = $movieActorRepository->findBy(["actor" => $actor]);

        if(!empty($actors)) {
            return new JsonResponse(["msg" => "You can't remove an Actor that has Movie attached!"], 403);
        }

        $this->actorRepository->remove($actor, true);
        return new JsonResponse(["msg" => "Delete successful!"]);
    }
}