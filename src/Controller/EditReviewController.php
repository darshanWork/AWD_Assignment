<?php

namespace App\Controller;

use App\Entity\Review;
use App\Form\ReviewType;
use DateTimeImmutable;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EditReviewController extends AbstractController
{
    public function editReview(ManagerRegistry $doctrine, Request $request, int $id) :
    Response
    {
        //"DateTimeImmutable" variable for latest update of website
        $dateTime = new DateTimeImmutable();

        //Fetch Object
        $entityManager = $doctrine->getManager();
        $review = $entityManager->getRepository(Review::class)->find($id);
        if(!$review)
        {
            throw $this->createNotFoundException(
                'No review with id ' . $id
            );
        }

        //edit review form
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $review->setReviewText($form->get('review_text')->getData());
            $entityManager->flush();
        }

        $this->generateUrl('edit-review', ['id' => $id]);
        return $this->render('EditReviewController/layout.html.twig', ['heading' =>
            'Music Review: Edit Review', 'subheading' => 'Edit review ' . $id,
            'datetime' => $dateTime->format('r'), 'review' => $review, 'form' =>
                $form->createView()]);
    }
}