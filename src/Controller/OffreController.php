<?php

namespace App\Controller;

use App\Entity\Offre;

use App\Service\PdfService;
use App\Form\Offre1Type;
use App\Repository\OffreRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
#[Route('/offre')]
class OffreController extends AbstractController
{
    #[Route('/{id}', name: 'app_offre_delete_admin', methods: ['POST'])]
    public function deleteadmin(Request $request, Offre $offre, OffreRepository $offreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offre->getId(), $request->request->get('_token'))) {
            $offreRepository->remove($offre, true);
        }
        return $this->redirectToRoute('app_offre_admin_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/pdf/offres', name: 'offre.pdf',  methods: ['GET', 'POST'])]
    public function pdfmaker( OffreRepository $off , Offre $amal=null,PdfService $pdf ){
        $html= $this->render('offre/pdf.html.twig', [
            'offres' => $off->findAll(),]);
        $pdf->showPdfFile($html);
    }

    #[Route('/new', name: 'app_offre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, OffreRepository $offreRepository): Response
    {
        $offre = new Offre();
        $form = $this->createForm(Offre1Type::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $offreRepository->save($offre, true);

            return $this->redirectToRoute('app_offre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('offre/new.html.twig', [
            'offre' => $offre,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_offre_delete', methods: ['POST'])]
public function delete(Request $request, Offre $offre, OffreRepository $offreRepository): Response
    {  if ($this->isCsrfTokenValid('delete'.$offre->getId(), $request->request->get('_token'))) {
        $offreRepository->remove($offre, true);
    }
    return $this->redirectToRoute('app_offre_index', [], Response::HTTP_SEE_OTHER);
}






    #[Route('/alloffresadmin', name: 'app_offre_admin_index', methods: ['GET'])]
    public function indexadmin(OffreRepository $offreRepository): Response
    {
        return $this->render('offre/indexadmin.html.twig', [
            'offres' => $offreRepository->findAll(),
        ]);
    }












    #[Route('/alloffres', name: 'app_offre_index', methods: ['GET'])]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()->getRepository(Offre::class)->findAll();
        $offre= $paginator->paginate(
            $donnees, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/);
        return $this->render('offre/index.html.twig', [
            'offres' => $offre,
        ]);

    }




    #[Route('/{id}', name: 'app_offre_show', methods: ['GET'])]
    public function show(Offre $offre): Response
    {
        return $this->render('offre/show.html.twig', [
            'offre' => $offre,
        ]);
    }





    #[Route('/{id}/edit', name: 'app_offre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Offre $offre, OffreRepository $offreRepository): Response
    {
        $form = $this->createForm(Offre1Type::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $offreRepository->save($offre, true);

            return $this->redirectToRoute('app_offre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('offre/edit.html.twig', [
            'offre' => $offre,
            'form' => $form,
        ]);
    }



    }
