<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Review;
use App\Form\EditReviewType;
use App\Form\ReviewType;
use App\Repository\AlbumRepository;
use App\Repository\ReviewRepository;
use DateTimeImmutable;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EditReviewController extends AbstractController
{
    public function editReview(ManagerRegistry $doctrine, Request $request) : Response
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

            return $this->redirectToRoute('edit-review');
        }

        //Form to edit existing review#
        $editReviewForm = $this->createForm(EditReviewType::class, $review);
        $editReviewForm->handleRequest($request);
        if($editReviewForm->isSubmitted() && $editReviewForm->isValid())
        {
            //change review text


            $entityManager->flush();
            return $this->redirectToRoute('edit-review');
        }

        $albums = $doctrine->getRepository(Album::class)->findAll();
        $reviews = $doctrine->getRepository(Review::class)->findAll();
        return $this->render('EditReviewController/layout.html.twig', ['heading' =>
            'Music Review: Edit Review', 'subheading' =>
            'Add new reviews to album or edit existing reviews', 'datetime' =>
            $dateTime->format('r'), 'reviewForm' => $reviewForm->createView(),
            'editReviewForm' => $editReviewForm->createView(), 'albums' => $albums,
            'reviews' => $reviews]);
    }
}