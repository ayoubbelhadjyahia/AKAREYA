<?php

namespace App\Controller;


use App\Entity\MatierePremConst;
use App\Form\MatierePremConstType;
use App\Repository\MatierePremConstRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/matiere/prem/const')]
class MatierePremConstController extends AbstractController
{
    #[Route('/newAaadmin', name: 'app_matiere_prem_const_newAdmin', methods: ['GET', 'POST'])]
    public function newAdmin(Request $request, MatierePremConstRepository $matierePremConstRepository): Response
    {
        $matierePremConst = new MatierePremConst();
        $form = $this->createForm(MatierePremConstType::class, $matierePremConst);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $matierePremConstRepository->save($matierePremConst, true);

            return $this->redirectToRoute('app_matiere_prem_const_indexAdmin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('matiere_prem_const/newAdmin.html.twig', [
            'matiere_prem_const' => $matierePremConst,
            'form' => $form,
        ]);
    }


    #[Route('/admin', name: 'app_matiere_prem_const_indexAdmin', methods: ['GET'])]
    public function indexAdmin(MatierePremConstRepository $matierePremConstRepository): Response
    {
        return $this->render('matiere_prem_const/indexAdmin.html.twig', [
            'matiere_prem_consts' => $matierePremConstRepository->findAll(),
        ]);
    }
    #[Route('/{id}Admin', name: 'app_matiere_prem_const_showAdmin', methods: ['GET'])]
    public function showAdmin(MatierePremConst $matierePremConst): Response
    {
        return $this->render('matiere_prem_const/showAdmin.html.twig', [
            'matiere_prem_const' => $matierePremConst,
        ]);
    }

    #[Route('/{id}/editAdmin', name: 'app_matiere_prem_const_editAdmin', methods: ['GET', 'POST'])]
    public function editAdmin(Request $request, MatierePremConst $matierePremConst, MatierePremConstRepository $matierePremConstRepository): Response
    {
        $form = $this->createForm(MatierePremConstType::class, $matierePremConst);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $matierePremConstRepository->save($matierePremConst, true);

            return $this->redirectToRoute('app_matiere_prem_const_indexAdmin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('matiere_prem_const/editAdmin.html.twig', [
            'matiere_prem_const' => $matierePremConst,
            'form' => $form,
        ]);
    }
    #[Route('/{id}Admin', name: 'app_matiere_prem_const_deleteAdmin', methods: ['POST'])]
    public function deleteAdmin(Request $request, MatierePremConst $matierePremConst, MatierePremConstRepository $matierePremConstRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$matierePremConst->getId(), $request->request->get('_token'))) {
            $matierePremConstRepository->remove($matierePremConst, true);
        }

        return $this->redirectToRoute('app_matiere_prem_const_indexAdmin', [], Response::HTTP_SEE_OTHER);
    }













    #[Route('/', name: 'app_matiere_prem_const_index', methods: ['GET'])]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()->getRepository(MatierePremConst::class)->findAll();
        $MatierePremConst = $paginator->paginate(
            $donnees, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/);
        return $this->render('matiere_prem_const/index.html.twig', [
            'MatierePremConst' => $MatierePremConst,
        ]);
    }

    #[Route('/new', name: 'app_matiere_prem_const_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MatierePremConstRepository $matierePremConstRepository): Response
    {
        $matierePremConst = new MatierePremConst();
        $form = $this->createForm(MatierePremConstType::class, $matierePremConst);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $matierePremConstRepository->save($matierePremConst, true);

            return $this->redirectToRoute('app_matiere_prem_const_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('matiere_prem_const/new.html.twig', [
            'matiere_prem_const' => $matierePremConst,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_matiere_prem_const_show', methods: ['GET'])]
    public function show(MatierePremConst $matierePremConst): Response
    {
        return $this->render('matiere_prem_const/show.html.twig', [
            'matiere_prem_const' => $matierePremConst,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_matiere_prem_const_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MatierePremConst $matierePremConst, MatierePremConstRepository $matierePremConstRepository): Response
    {
        $form = $this->createForm(MatierePremConstType::class, $matierePremConst);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $matierePremConstRepository->save($matierePremConst, true);

            return $this->redirectToRoute('app_matiere_prem_const_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('matiere_prem_const/edit.html.twig', [
            'matiere_prem_const' => $matierePremConst,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_matiere_prem_const_delete', methods: ['POST'])]
    public function delete(Request $request, MatierePremConst $matierePremConst, MatierePremConstRepository $matierePremConstRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$matierePremConst->getId(), $request->request->get('_token'))) {
            $matierePremConstRepository->remove($matierePremConst, true);
        }

        return $this->redirectToRoute('app_matiere_prem_const_index', [], Response::HTTP_SEE_OTHER);
    }


}
