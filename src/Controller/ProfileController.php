<?php

namespace App\Controller;

use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends AbstractController
{
    public function profile(Request $request, ManagerRegistry $doctrine) : Response
    {
        //"DateTimeImmutable" variable for latest update of website
        $dateTime = new DateTimeImmutable();
        $entityManager = $doctrine->getManager();
        $user = $entityManager->getRepository(User::class)->findAll();

        return $this->render('ProfileController/layout.html.twig', ['heading' =>
        'Music Review: Profile', 'subheading' => 'View and edit your profile', 'datetime'
        => $dateTime->format('r')]);
    }
}