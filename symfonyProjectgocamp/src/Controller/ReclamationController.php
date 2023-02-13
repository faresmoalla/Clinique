<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
class ReclamationController extends AbstractController
{
    /**
     * @Route("/reclamation", name="app_reclamation")
     */
    public function index(): Response
    {
        return $this->render('reclamation/index.html.twig', [
            'controller_name' => 'ReclamationController',
        ]);
    }

    /**
     * @Route("/afficherreclamation",name="afficherreclamation")
     */
    public function Affiche(Request $request,ReclamationRepository $repository){
        $tablereclamation=$repository->findAll();
        return $this->render('reclamation/afficherreclamation.html.twig'
            ,['tablereclamation'=>$tablereclamation]);
    }

    /**
     * @Route("/ajouterreclamation",name="ajouterreclamation")
     */
    public function ajouterreclamation(EntityManagerInterface $em,Request $request ,ReclamationRepository $reclamationRepository){
        $reclamation= new Reclamation();
        $form= $this->createForm(ReclamationType::class,$reclamation);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $new=$form->getData();

            $em->persist($request);
            $em->flush();

            return $this->redirectToRoute("afficherreclamation");
        }
        return $this->render("reclamation/ajouterreclamation.html.twig",array("form"=>$form->createView()));

    }


    /**
     * @Route("/supprimerreclamation/{id}",name="supprimerreclamation")
     */
    public function delete($id,EntityManagerInterface $em ,ReclamationRepository $repository){
        $rec=$repository->find($id);
        $em->remove($rec);
        $em->flush();

        return $this->redirectToRoute('afficherreclamation');
    }



    /**
     * @Route("/{id}/modifierreclamation", name="modifierreclamation", methods={"GET","POST"})
     */
    public function edit(Request $request, Reclamation $reclamation): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->add('Confirmer',SubmitType::class);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imgproduit')->getData();

            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('afficherproduit');
        }

        return $this->render('reclamation/ModifReclamation.html.twig', [
            'reclamationmodif' => $reclamation,
            'form' => $form->createView(),
        ]);
    }









}
