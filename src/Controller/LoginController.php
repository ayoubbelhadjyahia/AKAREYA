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





#[Route('/login')]
class LoginController extends AbstractController
{
    #[Route('/',  name:'login' , methods: ['GET', 'POST'])]
    public function UserAuth(Request $request, UserRepository $repository , AgencyRepository $repo ): Response
    {
        $session = new Session();




        $searchForm = $this->createForm(AuthetificationType::class);

        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()&& $searchForm->isValid()) {
            $username = $searchForm['username']->getData();
            $password = $searchForm['password']->getData();

            $resultOfSearch = $repository->authentification($username,$password);

            if(empty($resultOfSearch)) {
                $resultOfSearch = $repo->authentificationagency($username,$password);
            }
            if(empty($resultOfSearch)) {
                return $this->render('login.html.twig',[
                    "Form" => $searchForm->createView(),"error" => "•   Username ou Mot de Passe Incorrects ! "
                ]);

            }


            $session->set('user',$resultOfSearch[0]);
            return $this->render('user/home.html.twig',[
                "resultOfSearch" => $resultOfSearch])
                ;

        }

        return $this->render('login.html.twig',[
            "Form" => $searchForm->createView(),"error"=>"",$session->set('user',null)
        ])
            ;

    }



}