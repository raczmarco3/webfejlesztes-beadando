<?php

namespace App\Controller;

use App\Dto\ActorRequestDto;
use App\Service\ActorService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;

class ActorController extends AbstractController
{
    /**
     * @Route("/api/actor", methods={"POST"})
     */
    public function addNewActor(Request $request, ManagerRegistry $registry): JsonResponse
    {
        if(empty($request->getContent())) {
            return new JsonResponse(["msg" => "HTTP body is empty!"], 406);
        }

        $data = json_decode($request->getContent(), true);

        if(empty($data["name"])) {
            return new JsonResponse(["msg" => "'name' field must not be empty!"], 403);
        } else if(empty($data["birthDate"])) {
            return new JsonResponse(["msg" => "'birthDate' field must not be empty!"], 403);
        } else if(empty($data["birthPlace"])) {
            return new JsonResponse(["msg" => "'birthPlace' field must not be empty!"], 403);
        } else if(\DateTime::createFromFormat('Y-m-d', $data["birthDate"]) === false) {
            return new JsonResponse(["msg" => "Wrong 'birthDate' format! Correct format is: YYYY-DD-MM"], 403);
        }
                
        $actorRequestDto = new ActorRequestDto($data["name"], $data["birthDate"], $data["birthPlace"]);

        $actorService = new ActorService($registry);
        return $actorService->addNewActor($registry, $actorRequestDto);
    }

    /**
     * @Route("/api/actor/{id}", methods={"GET"})
     */
    public function getActor(ManagerRegistry $registry, SerializerInterface $serializer, $id): JsonResponse
    {
        $actorService = new ActorService($registry);
        return $actorService->getActor($serializer, $id);
    }

    /**
     * @Route("/api/actors", methods={"GET"})
     */
    public function getAllActor(ManagerRegistry $registry, SerializerInterface $serializer)
    {
        $actorService = new ActorService($registry);
        return $actorService->getAllActor($serializer);
    }

    /**
     * @Route("/api/actor/{id}", methods={"PUT"})
     */
    public function editActor(Request $request, ManagerRegistry $registry, $id)
    {
        if(empty($request->getContent())) {
            return new JsonResponse(["msg" => "HTTP body is empty!"], 406);
        }

        $data = json_decode($request->getContent(), true);

        if(empty($data["id"])) {
            return new JsonResponse(["msg" => "'id' field must not be empty!"], 403);
        } else if(!is_numeric($data["id"])) {
            return new JsonResponse(["msg" => "'id' field must be a number!"]);
        } else if($data["id"] != $id) {
            return new JsonResponse(["msg" => "You don't have permission to edit this Actor!"], 403);
        } else if(empty($data["name"])) {
            return new JsonResponse(["msg" => "'name' field must not be empty!"], 403);
        } else if(empty($data["birthDate"])) {
            return new JsonResponse(["msg" => "'birthDate' field must not be empty!"], 403);
        } else if(empty($data["birthPlace"])) {
            return new JsonResponse(["msg" => "'birthPlace' field must not be empty!"], 403);
        } else if(\DateTime::createFromFormat('Y-m-d', $data["birthDate"]) === false) {
            return new JsonResponse(["msg" => "Wrong 'birthDate' format! Correct format is: YYYY-DD-MM"], 403);
        }
        
        $actorRequestDto = new ActorRequestDto($data["name"], $data["birthDate"], $data["birthPlace"]);
        $actorService = new ActorService($registry);

        return $actorService->editActor($registry, $id, $actorRequestDto);
    }

    /**
     * @Route("/api/actor/{id}", methods={"DELETE"})
     */
    public function deleteActor(ManagerRegistry $registry, $id): JsonResponse
    {
        $actorService = new ActorService($registry);
        return $actorService->deleteActor($registry, $id);
    }
}