<?php

namespace App\Controller;

use App\Entity\Colis;
use App\Form\ColisType;
use App\Repository\ColisRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class ColisController extends AbstractController
{
    /**
     * @Route("/colis", name="colis_index", methods={"GET"})
     */
    public function index(ColisRepository $colisRepository): Response
    {
        return $this->render('colis/index.html.twig', [
            'coliss' => $colisRepository->findAll(),
        ]);
    }

    /**
     * @Route("/colis/new", name="colis_new", methods={"GET","POST"})
     */
    public function new(Request $request, ManagerRegistry $doctrine): Response
    {
        $colis = new Colis();
        $form = $this->createForm(ColisType::class, $colis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($colis);
            $entityManager->flush();
            $this->addFlash('info', 'Le Colis a été ajoutée');

            return $this->redirectToRoute('colis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('colis/new.html.twig', [
            'colis' => $colis,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/colis/{id}", name="colis_show", methods={"GET"})
     */
    public function show(Colis $colis): Response
    {
        return $this->render('colis/show.html.twig', [
            'colis' => $colis,
        ]);
    }

    /**
     * @Route("/colis/{id}/edit", name="colis_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Colis $colis, ManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(ColisType::class, $colis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->$doctrine->getManager()->flush();
            $this->addFlash('info', 'e colis a été modifiée');

            return $this->redirectToRoute('colis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('colis/edit.html.twig', [
            'colis' => $colis,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/colis/delete/{id}", name="colis_delete", methods={"POST"})
     */
    public function delete(Request $request, Colis $colis, ManagerRegistry $doctrine): Response
    {
        if ($this->isCsrfTokenValid('delete' . $colis->getId(), $request->request->get('_token'))) {
            $entityManager = $doctrine->getManager();
            $entityManager->remove($colis);
            $entityManager->flush();
        }

        return $this->redirectToRoute('$colis_index', [], Response::HTTP_SEE_OTHER);
    }

}
