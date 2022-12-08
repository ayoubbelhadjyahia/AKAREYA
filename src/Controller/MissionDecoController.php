<?php

namespace App\Controller;

use App\Entity\MissionDeco;
use App\Form\MissionDecoType;
use App\Repository\MissionDecoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/mission/deco')]
class MissionDecoController extends AbstractController
{
    #[Route('/admin', name: 'app_mission_deco_indexAdmin', methods: ['GET'])]
    public function indexAdmin(MissionDecoRepository $missionDecoRepository): Response
    {
        return $this->render('mission_deco/indexAdmin.html.twig', [
            'mission_decos' => $missionDecoRepository->findAll(),
        ]);
    }
    #[Route('/admin{id}', name: 'app_mission_deco_showAdmin', methods: ['GET'])]
    public function showAdmin(MissionDeco $missionDeco): Response
    {
        return $this->render('mission_deco/showAdmin.html.twig', [
            'mission_deco' => $missionDeco,
        ]);
    }
    #[Route('/admin{id}/edit', name: 'app_mission_deco_editAdmin', methods: ['GET', 'POST'])]
    public function editAdmin(Request $request, MissionDeco $missionDeco, MissionDecoRepository $missionDecoRepository): Response
    {
        $form = $this->createForm(MissionDecoType::class, $missionDeco);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $missionDecoRepository->save($missionDeco, true);

            return $this->redirectToRoute('app_mission_deco_indexAdmin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mission_deco/editAdmin.html.twig', [
            'mission_deco' => $missionDeco,
            'form' => $form,
        ]);
    }
    #[Route('/newadmin', name: 'app_mission_deco_newAdmin', methods: ['GET', 'POST'])]
    public function newAdmin(Request $request, MissionDecoRepository $missionDecoRepository): Response
    {
        $missionDeco = new MissionDeco();
        $form = $this->createForm(MissionDecoType::class, $missionDeco);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $missionDecoRepository->save($missionDeco, true);

            return $this->redirectToRoute('app_mission_deco_indexAdmin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mission_deco/newAdmin.html.twig', [
            'mission_deco' => $missionDeco,
            'form' => $form,
        ]);
    }
    #[Route('/admin{id}', name: 'app_mission_deco_deleteAdmin', methods: ['POST'])]
    public function deleteAdmin(Request $request, MissionDeco $missionDeco, MissionDecoRepository $missionDecoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$missionDeco->getId(), $request->request->get('_token'))) {
            $missionDecoRepository->remove($missionDeco, true);
        }

        return $this->redirectToRoute('app_mission_deco_indexAdmin', [], Response::HTTP_SEE_OTHER);
    }







    #[Route('/', name: 'app_mission_deco_index', methods: ['GET'])]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()->getRepository(MissionDeco::class)->findAll();
        $mission_decos= $paginator->paginate(
            $donnees, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/);
        return $this->render('mission_deco/index.html.twig', [
            'mission_decos' =>   $mission_decos,
        ]);
    }

    #[Route('/new', name: 'app_mission_deco_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MissionDecoRepository $missionDecoRepository): Response
    {
        $missionDeco = new MissionDeco();
        $form = $this->createForm(MissionDecoType::class, $missionDeco);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $missionDecoRepository->save($missionDeco, true);

            return $this->redirectToRoute('app_mission_deco_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mission_deco/new.html.twig', [
            'mission_deco' => $missionDeco,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mission_deco_show', methods: ['GET'])]
    public function show(MissionDeco $missionDeco): Response
    {
        return $this->render('mission_deco/show.html.twig', [
            'mission_deco' => $missionDeco,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mission_deco_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MissionDeco $missionDeco, MissionDecoRepository $missionDecoRepository): Response
    {
        $form = $this->createForm(MissionDecoType::class, $missionDeco);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $missionDecoRepository->save($missionDeco, true);

            return $this->redirectToRoute('app_mission_deco_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mission_deco/edit.html.twig', [
            'mission_deco' => $missionDeco,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mission_deco_delete', methods: ['POST'])]
    public function delete(Request $request, MissionDeco $missionDeco, MissionDecoRepository $missionDecoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$missionDeco->getId(), $request->request->get('_token'))) {
            $missionDecoRepository->remove($missionDeco, true);
        }

        return $this->redirectToRoute('app_mission_deco_index', [], Response::HTTP_SEE_OTHER);
    }
}
