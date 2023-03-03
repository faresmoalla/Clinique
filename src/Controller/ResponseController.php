<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ResponseType;
use App\Repository\ReclamationRepository;
use App\Repository\ResponseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResponseController extends AbstractController
{
    #[Route('/response', name: 'app_response')]
    public function index(): Response
    {
        return $this->render('response/index.html.twig', [
            'controller_name' => 'ResponseController',
        ]);
    }
    #[Route("/{id}/ajouterresponse/",name:"ajouterresponse")]

    public function ajouterresponse( Reclamation $reclamation,EntityManagerInterface $em,Request $request ,ResponseRepository $responseRepository,ReclamationRepository $reclamationRepo){
        //$reclamation = $reclamationRepo->findOneBy(["id" => $request->get("id")]);

        $response= new \App\Entity\Response();
        $form2= $this->createForm(ResponseType::class,$response);
        $form2->add('Ajouter',SubmitType::class);
        $form2->handleRequest($request);
        $response->setReclamation($reclamation);
        if($form2->isSubmitted() && $form2->isValid()){
            $em->persist($response);
            $em->flush();

            return $this->redirectToRoute("afficherreclamationuser");
        }
        return $this->render("reclamation/ajouterresponse.html.twig",array("form2"=>$form2->createView()));

    }

    #[Route("/{id}/modifierresponse", name:"modifierresponse")]

    public function editresponse(Request $request, \App\Entity\Response $response): Response
    {
        $form = $this->createForm(ResponseType::class, $response);
        $form->add('Confirmer',SubmitType::class);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {


            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('afficherreclamation');
        }

        return $this->render('reclamation/Modifresponse.html.twig', [
            'reclamationmodif' => $response,
            'form' => $form->createView(),
        ]);
    }

    #[Route("/supprimerresponse/{id}",name:"supprimerresponse")]

    public function supprimerresponse($id,EntityManagerInterface $em ,ResponseRepository $repository){
        $rec=$repository->find($id);
        $em->remove($rec);
        $em->flush();

        return $this->redirectToRoute('afficherreclamationuser');
    }





}
