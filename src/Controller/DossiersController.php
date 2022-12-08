<?php

namespace App\Controller;

use App\Entity\Dossiers;
use App\Form\DossiersType;
use App\Repository\DossiersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use MercurySeries\FlashyBundle\FlashyNotifier;




#[Route('/dossierss')]
class DossiersController extends AbstractController
{
    #[Route('/mail', name:'mail', methods:['POST'])]
    public function reservation(Request $request,\Swift_Mailer $mailer): Response
    {
        $email= $request->request->get('email');
        $body=$request->request->get('body');
        $message = (new \Swift_Message('AKAREYA'))
            ->setFrom('ayoub.belhadjyahia@esprit.tn')
            ->setTo($email)
            ->setBody(
                $body);
        $mailer->send($message);
        return new Response("true");
    }





    #[Route('/', name: 'app_dossiers_index', methods: ['GET'])]
    public function index(DossiersRepository $dossiersRepository): Response
    {
        return $this->render('dossiers/index.html.twig', [
            'dossiers' => $dossiersRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_dossiers_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DossiersRepository $dossiersRepository,FlashyNotifier $flashy): Response
    {
        $dossier = new Dossiers();
        $form = $this->createForm(DossiersType::class, $dossier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dossiersRepository->save($dossier, true);
            $flashy->success('Dossier ajouté avec succés!');

            return $this->redirectToRoute('app_dossiers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dossiers/new.html.twig', [
            'dossier' => $dossier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dossiers_show', methods: ['GET'])]
    public function show(Dossiers $dossier): Response
    {
        return $this->render('dossiers/show.html.twig', [
            'dossier' => $dossier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dossiers_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Dossiers $dossier, DossiersRepository $dossiersRepository,FlashyNotifier $flashy): Response
    {
        $form = $this->createForm(DossiersType::class, $dossier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dossiersRepository->save($dossier, true);
            $flashy->info('Dossier modifié avec succés!');



            return $this->redirectToRoute('app_dossiers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dossiers/edit.html.twig', [
            'dossier' => $dossier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dossiers_delete', methods: ['POST'])]
    public function delete(Request $request, Dossiers $dossier, DossiersRepository $dossiersRepository,FlashyNotifier $flashy): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dossier->getId(), $request->request->get('_token'))) {
            $dossiersRepository->remove($dossier, true);
            $flashy->error('Dossier supprimé avec succés!');
        }

        return $this->redirectToRoute('app_dossiers_index', [], Response::HTTP_SEE_OTHER);
    }
}


