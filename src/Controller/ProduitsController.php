<?php

namespace App\Controller;


use App\Entity\Produits;
use App\Form\GpsType;
use App\Form\ProduitsType;
use App\Repository\ProduitsRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/produitss')]
class ProduitsController extends AbstractController
{
    #[Route('/adminPDF', name: 'AdminPDF', methods: ['GET'])]
    public function PDF(ProduitsRepository $produitsRepository): Response
    {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($pdfOptions);
        $context = stream_context_create([
            'ssl'=>[
                'verify_peer'=>FALSE,
                'verify_peer_name'=>FALSE,
                'allow_self_signed'=>TRUE,
            ]
        ]);

        // Instantiate Dompdf with our options
        $dompdf->setHttpContext($context);
        $dossier=$produitsRepository->findAll();


        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('produits/pdf.html.twig', [
            'produits' =>$dossier ,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        define("DOMPDF_ENABLE_REMOTE", false);
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("Dossier.pdf", [
            "Attachment" => true
        ]);
        return $this->indexAdmin();
    }






    #[Route('/', name: 'app_produits_index', methods: ['GET'])]
    public function index(ProduitsRepository $produitsRepository): Response
    {


        return $this->render('produits/index.html.twig', [
            'produits' => $produitsRepository->findAll(),
        ]);
    }


    #[Route('/indexclient', name: 'app_produits_indexclient', methods: ['GET'])]
    public function indexclient(ProduitsRepository $produitsRepository): Response
    {


        return $this->render('produits/indexclient.html.twig', [
            'produits' => $produitsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_produits_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProduitsRepository $produitsRepository, FlashyNotifier $flashy): Response
    {
        $produit = new Produits();
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produitsRepository->save($produit, true);
            $flashy->success('Produit ajouté avec succés!', 'http://your-awesome-link.com');

            return $this->redirectToRoute('app_produits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produits/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/newclient', name: 'app_produits_new_client', methods: ['GET', 'POST'])]

    /*public function add($id, Request $request)
    {
        $session = $request->getSession();
        $panier = $session->get('panier', []);
        if (!empty($panier[$id])) {
            $panier[$id]++;
        }
        else {
            panier[$id] = 1;
        }
        $session->set('panier', $panier);
        dd($session->get('panier’'));*/
    public function newclient(Request $request, ProduitsRepository $produitsRepository, FlashyNotifier $flashy): Response
    {
        $produit = new Produits();
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produitsRepository->save($produit, true);
            $flashy->success('Produit ajouté avec succés!', 'http://your-awesome-link.com');

            return $this->redirectToRoute('app_produits_indexclient', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produits/newclient.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produits_show', methods: ['GET'])]
    public function show(Produits $produit): Response
    {
        return $this->render('produits/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_produits_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produits $produit, ProduitsRepository $produitsRepository,FlashyNotifier $flashy): Response
    {
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produitsRepository->save($produit, true);
            $flashy->info('Produit modifié avec succés!');


            return $this->redirectToRoute('app_produits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produits/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produits_delete', methods: ['POST'])]
    public function delete(Request $request, Produits $produit, ProduitsRepository $produitsRepository,FlashyNotifier $flashy): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $produitsRepository->remove($produit, true);
            $flashy->error('Produit supprimé avec succés!');
        }

        return $this->redirectToRoute('app_produits_index', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/gps' ,name: 'app_gps', methods: ['GET', 'POST'])]
    public function gps(Request $request): Response
    {
        $form = $this->createForm(GpsType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search=$form['gps']->getData();

            return $this->redirectToRoute('app_gps', ["search=>$search"], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produits/index.html.twig', [

            'form' => $form,
        ]);
    }


}
