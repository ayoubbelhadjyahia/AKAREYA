<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Entity\RdvOffre;
use App\Form\RdvOffre1Type;
use App\Repository\OffreRepository;
use App\Repository\RdvOffreRepository;
use App\Service\PdfService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/rdv/offre')]
class RdvOffreController extends AbstractController
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






    #[Route('/allrdv', name: 'app_rdv_offre_admin', methods: ['GET'])]
    public function indexadmin(RdvOffreRepository $rdvOffreRepository): Response
    {
        return $this->render('rdv_offre/index_admin.html.twig', [
            'rdv_offres' => $rdvOffreRepository->findAll(),
        ]);
    }


    #[Route('/all', name: 'app_rdv_offre_index', methods: ['GET'])]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {$donnees = $this->getDoctrine()->getRepository(RdvOffre::class)->findAll();
        $offre1= $paginator->paginate(
            $donnees, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/);
        return $this->render('rdv_offre/index.html.twig', [
            'rdv_offres' => $offre1,
        ]);
    }

    #[Route('/new', name: 'app_rdv_offre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RdvOffreRepository $rdvOffreRepository): Response
    {
        $rdvOffre = new RdvOffre();
        $form = $this->createForm(RdvOffre1Type::class, $rdvOffre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rdvOffreRepository->save($rdvOffre, true);

            return $this->redirectToRoute('app_rdv_offre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rdv_offre/new.html.twig', [
            'rdv_offre' => $rdvOffre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rdv_offre_show', methods: ['GET'])]
    public function show(RdvOffre $rdvOffre): Response
    {
        return $this->render('rdv_offre/show.html.twig', [
            'rdv_offre' => $rdvOffre,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_rdv_offre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RdvOffre $rdvOffre, RdvOffreRepository $rdvOffreRepository): Response
    {
        $form = $this->createForm(RdvOffre1Type::class, $rdvOffre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rdvOffreRepository->save($rdvOffre, true);

            return $this->redirectToRoute('app_rdv_offre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rdv_offre/edit.html.twig', [
            'rdv_offre' => $rdvOffre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rdv_offre_delete', methods: ['POST'])]
    public function delete(Request $request, RdvOffre $rdvOffre, RdvOffreRepository $rdvOffreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rdvOffre->getId(), $request->request->get('_token'))) {
            $rdvOffreRepository->remove($rdvOffre, true);
        }

        return $this->redirectToRoute('app_rdv_offre_index', [], Response::HTTP_SEE_OTHER);
    }







}
