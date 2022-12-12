<?php

namespace App\Controller;

use App\Repository\AlbumRepository;
use App\Repository\ReviewRepository;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ViewReviewsController extends AbstractController
{
    public function viewReviews(ManagerRegistry $doctrine, UserRepository $userRepository,
    AlbumRepository $albumRepository, ReviewRepository $reviewRepository) : Response
    {
        //"DateTimeImmutable" variable for latest update of website
        $dateTime = new DateTimeImmutable();

        return $this->render('ViewReviewsController/layout.html.twig', ['heading' =>
            'Music Review: Reviews', 'subheading' => 'Browse existing reviews', 'datetime'
            => $dateTime->format('r'), 'reviews' => $reviewRepository->findAll(),
            'albums' => $albumRepository->findAll(), 'users' => $userRepository->findAll()]);
    }
}