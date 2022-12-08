<?php

namespace App\Controller;

use App\Form\MailType;
use App\Repository\AgencyRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MailingController extends AbstractController{
    #[Route('/email')]
    public function sendEmail(\Swift_Mailer $mailer,Request $request , UserRepository $urepo , AgencyRepository $arepo ): Response
    {


        $searchForm = $this->createForm(MailType::class);

        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()&& $searchForm->isValid()) {
            $mail = $searchForm['email']->getData();
            $resultOfSearch = $urepo->findmail($mail);
            if(empty($resultOfSearch)) {
                $resultOfSearch = $arepo->findmail($mail);
            }
            if(empty($resultOfSearch)) {
                return $this->render('passwordreset.html.twig', [
                    "resetForm" => $searchForm->createView(), "error" => "•  Utilisateur ou Agence Introuvables ! "
                ]);
            }
            //$random = random_int(10000, 99999);
            $email = (new \Swift_Message('une nouvelle reservation'))
                ->setFrom('mohamedaziz.limem@esprit.tn')
                ->setTo( ''.$resultOfSearch[0]->getEmail())
                ->setSubject('Reset your account')
                ->setBody('Votre Username est : '.$resultOfSearch[0]->getUsername().'   Votre Mot de Passe est : '.$resultOfSearch[0]->getPassword());



                $mailer->send($email);

            return $this->redirectToRoute('login', [], Response::HTTP_SEE_OTHER);


        }
        return $this->render('passwordreset.html.twig',[
            "resetForm" => $searchForm->createView(),"error"=>""
        ]);
    }



}
