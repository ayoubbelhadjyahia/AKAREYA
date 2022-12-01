<?php

namespace App\Controller;

use App\Entity\DossierConst;
use App\Form\DossierConstType;
use App\Repository\DossierConstRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/dossier/const')]
class DossierConstController extends AbstractController
{
    #[Route('/home/admin', name: 'gestion_immoAdmin', methods: ['GET'])]
    public function homeAdmin(DossierConstRepository $dossierConstRepository ): Response
    {
        return $this->render('dossier_const/homeAdmin.html.twig', [
            'dossier_consts' => $dossierConstRepository->findAll(),
        ]);
    }

    #[Route('/admin', name: 'app_dossier_const_indexAdmin', methods: ['GET'])]
    public function indexAdmin(DossierConstRepository $dossierConstRepository,): Response
    {

        return $this->render('dossier_const/indexAdmin.html.twig', [
            'dossier_consts' => $dossierConstRepository->findAll(),
        ]);
    }
    #[Route('/admin/{id}', name: 'app_dossier_const_showAdmin', methods: ['GET'])]
    public function showAdmin(DossierConst $dossierConst): Response
    {
        return $this->render('dossier_const/showAdmin.html.twig', [
            'dossier_const' => $dossierConst,
        ]);
    }

    #[Route('/newAdmin', name: 'app_dossier_const_newAdmin', methods: ['GET', 'POST'])]
    public function newAdmin(Request $request, DossierConstRepository $dossierConstRepository): Response
    {
        $dossierConst = new DossierConst();
        $form = $this->createForm(DossierConstType::class, $dossierConst);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dossierConstRepository->save($dossierConst, true);

            return $this->redirectToRoute('app_dossier_const_indexAdmin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dossier_const/newAdmin.html.twig', [
            'dossier_const' => $dossierConst,
            'form' => $form,
        ]);
    }
    #[Route('/{id}/editAdmin', name: 'app_dossier_const_editAdmin', methods: ['GET', 'POST'])]
    public function editAdmin(Request $request, DossierConst $dossierConst, DossierConstRepository $dossierConstRepository): Response
    {
        $form = $this->createForm(DossierConstType::class, $dossierConst);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dossierConstRepository->save($dossierConst, true);

            return $this->redirectToRoute('app_dossier_const_indexAdmin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dossier_const/editAdmin.html.twig', [
            'dossier_const' => $dossierConst,
            'form' => $form,
        ]);
    }
    #[Route('/{id}/A', name: 'app_dossier_const_deleteAdmin', methods: ['POST'])]
    public function deleteAdmin(Request $request, DossierConst $dossierConst, DossierConstRepository $dossierConstRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dossierConst->getId(), $request->request->get('_token'))) {
            $dossierConstRepository->remove($dossierConst, true);
        }

        return $this->redirectToRoute('app_dossier_const_indexAdmin', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/mail', name:'mail', methods:['POST'])]
    public function reservation(Request $request,\Swift_Mailer $mailer): Response
    {
        $email= $request->request->get('email');
        $message = (new \Swift_Message('une nouvelle reservation'))
            ->setFrom('ayoub.belhadjyahia@esprit.tn')
            ->setTo($email)
            ->setBody(
                'consulter notre site AKAREYA');
        $mailer->send($message);
        return new Response("true");
    }











    #[Route('/home', name: 'gestion_immo', methods: ['GET'])]
    public function home(DossierConstRepository $dossierConstRepository ): Response
    {
        return $this->render('dossier_const/home.html.twig', [
            'dossier_consts' => $dossierConstRepository->findAll(),
        ]);
    }

    #[Route('/', name: 'app_dossier_const_index', methods: ['GET'])]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()->getRepository(DossierConst::class)->findbyid(1);
        $dossierConst= $paginator->paginate(
            $donnees, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/);
        return $this->render('dossier_const/index.html.twig', [
            'dossier_consts' => $dossierConst,
        ]);
    }




    #[Route('/new', name: 'app_dossier_const_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DossierConstRepository $dossierConstRepository): Response
    {
        $dossierConst = new DossierConst();
        $form = $this->createForm(DossierConstType::class, $dossierConst);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dossierConstRepository->save($dossierConst, true);

            return $this->redirectToRoute('app_dossier_const_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dossier_const/new.html.twig', [
            'dossier_const' => $dossierConst,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dossier_const_show', methods: ['GET'])]
    public function show(DossierConst $dossierConst): Response
    {
        return $this->render('dossier_const/show.html.twig', [
            'dossier_const' => $dossierConst,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dossier_const_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DossierConst $dossierConst, DossierConstRepository $dossierConstRepository): Response
    {
        $form = $this->createForm(DossierConstType::class, $dossierConst);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dossierConstRepository->save($dossierConst, true);

            return $this->redirectToRoute('app_dossier_const_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dossier_const/edit.html.twig', [
            'dossier_const' => $dossierConst,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dossier_const_delete', methods: ['POST'])]
    public function delete(Request $request, DossierConst $dossierConst, DossierConstRepository $dossierConstRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dossierConst->getId(), $request->request->get('_token'))) {
            $dossierConstRepository->remove($dossierConst, true);
        }

        return $this->redirectToRoute('app_dossier_const_index', [], Response::HTTP_SEE_OTHER);
    }
}
