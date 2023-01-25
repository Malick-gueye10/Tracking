<?php

namespace App\Controller;

use DateTime;
use App\Entity\LTA;
use App\Form\LTAType;
use App\Repository\LTARepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/lta")
 */
class LTAController extends AbstractController
{
/**
     * @Route("/", name="lta_index", methods={"GET"})
     */
    public function index(LTARepository $ltaRepository): Response
    {
        return $this->render('lta/index.html.twig', [
            'ltas' => $ltaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="lta_new", methods={"GET","POST"})
     */
    public function new(Request $request, ManagerRegistry $doctrine): Response
    {
        $lta = new LTA();
        $form = $this->createForm(LTAType::class, $lta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($lta);
            $entityManager->flush();
            $this->addFlash('info', 'Le LTA a été ajoutée');

            return $this->redirectToRoute('lta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lta/new.html.twig', [
            'lta' => $lta,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="lta_show", methods={"GET"})
     */
    public function show(LTA $lta): Response
    {
        return $this->render('lta/show.html.twig', [
            'lta' => $lta,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lta_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LTA $lta, ManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(LTAType::class, $lta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->$doctrine->getManager()->flush();
            $this->addFlash('info', 'La revue a été modifiée');

            return $this->redirectToRoute('lta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lta/edit.html.twig', [
            'lta' => $lta,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="lta_delete", methods={"POST"})
     */
    public function delete(Request $request, LTA $lta, ManagerRegistry $doctrine): Response
    {
        if ($this->isCsrfTokenValid('delete' . $lta->getId(), $request->request->get('_token'))) {
            $entityManager = $doctrine->getManager();
            $entityManager->remove($lta);
            $entityManager->flush();
        }

        return $this->redirectToRoute('$lta_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/lta/depart/{id}", name="lta_depart")
     */
    public function departLTA(LTA $lta, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $lta
            ->setState(LTA::DEPART_STATE)
            ->setDateDepart(new DateTime())
            ->setState(LTA::DEPART_STATE);
        $this->addFlash('info', 'Le colis a pris départ!');
        $entityManager->flush();

        return $this->redirectToRoute('lta_show', [
            'id'    => $lta->getId()
        ]);
    }

     /**
     * @Route("/lta/enroute/{id}", name="lta_enroute")
     */
    public function encourstLTA(LTA $lta, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $lta
            ->setState(LTA::ENROUTE_STATE)
            ->setDateDepart(new DateTime())
            ->setState(LTA::ENROUTE_STATE);
        $this->addFlash('info', 'Le colis est en cours!');
        $entityManager->flush();

        return $this->redirectToRoute('lta_show', [
            'id'    => $lta->getId()
        ]);
    }

    /**
     * @Route("/lta/enroute/{id}", name="lta_enroute")
     */
    public function arriveetLTA(LTA $lta, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $lta
            ->setState(LTA::ARRIVEE_STATE)
            ->setDateDepart(new DateTime())
            ->setState(LTA::ARRIVEE_STATE);
        $this->addFlash('info', 'Le colis est arrivée!');
        $entityManager->flush();

        return $this->redirectToRoute('lta_show', [
            'id'    => $lta->getId()
        ]);
    }

}
