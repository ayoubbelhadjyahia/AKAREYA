<?php

namespace App\Controller;

use App\Entity\OutilDeco;
use App\Form\OutilDecoType;
use App\Repository\OutilDecoRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/outil/deco')]
class OutilDecoController extends AbstractController
{
    #[Route('/adminnew', name: 'app_outil_deco_newAdmin', methods: ['GET', 'POST'])]
    public function newAdmin(Request $request, OutilDecoRepository $outilDecoRepository): Response
    {
        $outilDeco = new OutilDeco();
        $form = $this->createForm(OutilDecoType::class, $outilDeco);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $outilDecoRepository->save($outilDeco, true);

            return $this->redirectToRoute('app_outil_deco_indexAdmin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('outil_deco/newAdmin.html.twig', [
            'outil_deco' => $outilDeco,
            'form' => $form,
        ]);
    }
    #[Route('/admin', name: 'app_outil_deco_indexAdmin', methods: ['GET'])]
    public function indexAdmin(OutilDecoRepository $outilDecoRepository): Response
    {
        return $this->render('outil_deco/indexAdmin.html.twig', [
            'outil_decos' => $outilDecoRepository->findAll(),
        ]);
    }
    #[Route('/admin{id}', name: 'app_outil_deco_showAdmin', methods: ['GET'])]
    public function showAdmin(OutilDeco $outilDeco): Response
    {
        return $this->render('outil_deco/showAdmin.html.twig', [
            'outil_deco' => $outilDeco,
        ]);
    }

    #[Route('/admin{id}/edit', name: 'app_outil_deco_editAdmin', methods: ['GET', 'POST'])]
    public function editAdmin(Request $request, OutilDeco $outilDeco, OutilDecoRepository $outilDecoRepository): Response
    {
        $form = $this->createForm(OutilDecoType::class, $outilDeco);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $outilDecoRepository->save($outilDeco, true);

            return $this->redirectToRoute('app_outil_deco_indexAdmin', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('outil_deco/editAdmin.html.twig', [
            'outil_deco' => $outilDeco,
            'form' => $form,
        ]);
    }
    #[Route('/admin{id}', name: 'app_outil_deco_deleteAdmin', methods: ['POST'])]
    public function deleteAdmin(Request $request, OutilDeco $outilDeco, OutilDecoRepository $outilDecoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$outilDeco->getId(), $request->request->get('_token'))) {
            $outilDecoRepository->remove($outilDeco, true);
        }

        return $this->redirectToRoute('app_outil_deco_indexAdmin', [], Response::HTTP_SEE_OTHER);
    }









    #[Route('/', name: 'app_outil_deco_index', methods: ['GET'])]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()->getRepository(OutilDeco::class)->findAll();
        $outil_decos= $paginator->paginate(
            $donnees, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/);
        return $this->render('outil_deco/index.html.twig', [
            'outil_decos' =>   $outil_decos,
        ]);
    }






    #[Route('/new', name: 'app_outil_deco_new', methods: ['GET', 'POST'])]
    public function new(Request $request, OutilDecoRepository $outilDecoRepository): Response
    {
        $outilDeco = new OutilDeco();
        $form = $this->createForm(OutilDecoType::class, $outilDeco);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $outilDecoRepository->save($outilDeco, true);

            return $this->redirectToRoute('app_outil_deco_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('outil_deco/new.html.twig', [
            'outil_deco' => $outilDeco,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_outil_deco_show', methods: ['GET'])]
    public function show(OutilDeco $outilDeco): Response
    {
        return $this->render('outil_deco/show.html.twig', [
            'outil_deco' => $outilDeco,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_outil_deco_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, OutilDeco $outilDeco, OutilDecoRepository $outilDecoRepository): Response
    {
        $form = $this->createForm(OutilDecoType::class, $outilDeco);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $outilDecoRepository->save($outilDeco, true);

            return $this->redirectToRoute('app_outil_deco_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('outil_deco/edit.html.twig', [
            'outil_deco' => $outilDeco,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_outil_deco_delete', methods: ['POST'])]
    public function delete(Request $request, OutilDeco $outilDeco, OutilDecoRepository $outilDecoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$outilDeco->getId(), $request->request->get('_token'))) {
            $outilDecoRepository->remove($outilDeco, true);
        }

        return $this->redirectToRoute('app_outil_deco_index', [], Response::HTTP_SEE_OTHER);
    }
}
