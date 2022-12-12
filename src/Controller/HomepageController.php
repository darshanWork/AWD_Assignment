<?php
//CONTROLLER FOR HOMEPAGE

namespace App\Controller;

use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomepageController extends AbstractController
{
    public function home() : Response
    {
        //"DateTimeImmutable" variable for latest update of website
        $dateTime = new DateTimeImmutable();

        return $this->render('HomepageController/layout.html.twig', ['heading' => 'Music Review: Home', 'subheading' =>
            'Welcome to Music Review - start reviewing your favourite artists!', 'datetime' => $dateTime->format('r')]);
    }
}