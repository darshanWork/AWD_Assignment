<?php

namespace App\Controller;

use App\Entity\Album;
use App\Form\AlbumFormType;
use DateTimeImmutable;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateAlbumController extends AbstractController
{
    public function createAlbum(Request $request, ManagerRegistry $doctrine) : Response
    {
        //"DateTimeImmutable" variable for latest update of website
        $dateTime = new DateTimeImmutable();
        $album = new Album();
        $track_list = [];
        $entityManager = $doctrine->getManager();

        $albumForm = $this->createForm(AlbumFormType::class, $album);
        $albumForm->handleRequest($request);
        if($albumForm->isSubmitted() && $albumForm->isValid())
        {
            $album = $albumForm->getData();

            $entityManager->persist($album);
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('CreateAlbumController/layout.html.twig', ['heading' => 'Music Review: Create Review', 'subheading' =>
            'Add an album to review - you can review it by clicking "Add/Edit Review"',
            'datetime' => $dateTime->format('r'), 'albumForm' =>
                $albumForm->createView()]);
    }
}