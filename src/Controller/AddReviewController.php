<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Review;
use App\Entity\User;
use App\Form\ReviewType;
use App\Repository\AlbumRepository;
use App\Repository\ReviewRepository;
use DateTimeImmutable;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AddReviewController extends AbstractController
{
    public function addReview(ManagerRegistry $doctrine, Request $request) : Response
    {
        //"DateTimeImmutable" variable for latest update of website
        $dateTime = new DateTimeImmutable();
        $review = new Review();
        $entityManager = $doctrine->getManager();

        //Form to add new review
        $reviewForm = $this->createForm(ReviewType::class, $review);
        $reviewForm->handleRequest($request);
        if($reviewForm->isSubmitted() && $reviewForm->isValid())
        {
            $review = $reviewForm->getData();

            $entityManager->persist($review);
            $entityManager->flush();

            return $this->redirectToRoute('add-review');
        }

        $albums = $doctrine->getRepository(Album::class)->findAll();
        $reviews = $doctrine->getRepository(Review::class)->findAll();
        $users = $doctrine->getRepository(User::class)->findAll();
        return $this->render('AddReviewController/layout.html.twig', ['heading' =>
            'Music Review: Add Review', 'subheading' =>
            'Add new reviews to an album', 'datetime' =>
            $dateTime->format('r'), 'reviewForm' => $reviewForm->createView(),
            'albums' => $albums, 'reviews' => $reviews, 'users' => $users]);
    }
}