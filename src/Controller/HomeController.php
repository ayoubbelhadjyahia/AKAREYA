<?php
namespace App\Controller;

use App\Form\AuthetificationType;
use App\Repository\AgencyRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;





#[Route('/home')]
class HomeController extends AbstractController
{
#[Route('/',  name:'home' )]
public function Home( ): Response
{


    return $this->render('HomePage.html.twig',[

    ])
        ;
}
}