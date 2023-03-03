<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Form\ResponseType;

use App\Repository\ReclamationRepository;
use App\Repository\ResponseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class ReclamationController extends AbstractController
{
    #[Route('/reclamation', name: 'app_reclamation')]
    public function index(): Response
    {
        return $this->render('reclamation/index.html.twig', [
            'controller_name' => 'ReclamationController',
        ]);
    }



    #[Route("/afficherreclamation",name :"afficherreclamation")]

    public function Affiche(Request $request,ReclamationRepository $repository,ResponseRepository $responseRepository){
        $tablereclamation=$repository->findAll();
        $response = $responseRepository->findBy(["id" => $request->get("id")]);

        return $this->render('reclamation/afficherreclamation.html.twig'
            ,['tablereclamation'=>$tablereclamation,
                'response'=>$response]);
    }


    #[Route("/afficherreclamationuser",name:"afficherreclamationuser")]

    public function Affiche2(Request $request,ReclamationRepository $repository,PaginatorInterface $paginator){
        $tablereclamation=$repository->listReclamationparDate();
        $tablereclamation = $paginator->paginate(
            $tablereclamation,
            $request->query->getInt('page', 1),
            4
        );



        return $this->render('reclamation/reclamationback.html.twig'
            ,['tablereclamation'=>$tablereclamation]);
    }

    #[Route("/ajouterreclamation",name:"ajouterreclamation")]

    public function ajouterreclamation(EntityManagerInterface $em,Request $request ,ReclamationRepository $reclamationRepository){
        $reclamation= new Reclamation();
        $form= $this->createForm(ReclamationType::class,$reclamation);
        // $reclamation->setDate(new \DateTimeImmutable());
        $reclamation->setEtat("non traitée");
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $new=$form->getData();

            $em->persist($reclamation);
            $em->flush();

            return $this->redirectToRoute("afficherreclamation");
        }
        return $this->render("reclamation/ajouterreclamation.html.twig",array("form"=>$form->createView()));

    }



    #[Route("/supprimerreclamation/{id}",name:"supprimerreclamation")]

    public function delete($id,EntityManagerInterface $em ,ReclamationRepository $repository){
        $rec=$repository->find($id);
        $em->remove($rec);
        $em->flush();

        return $this->redirectToRoute('afficherreclamation');
    }

    #[Route("/supprimerreclamationback/{id}",name:"supprimerreclamationback")]

    public function delete2($id,EntityManagerInterface $em ,ReclamationRepository $repository){
        $rec=$repository->find($id);
        $em->remove($rec);
        $em->flush();

        return $this->redirectToRoute('afficherreclamationuser');
    }


    #[Route("/{id}/modifierreclamation", name:"modifierreclamation")]

    public function edit(Request $request, Reclamation $reclamation): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->add('Confirmer',SubmitType::class);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {


            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('afficherreclamation');
        }

        return $this->render('reclamation/ModifReclamation.html.twig', [
            'reclamationmodif' => $reclamation,
            'form' => $form->createView(),
        ]);
    }





    #[Route("/pdf/{id}",name:"pdf", methods: ['GET'])]
    public function pdf($id,ReclamationRepository $repository): Response{

        $reclamation=$repository->find($id);
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($pdfOptions);
        $html = $this->renderView('reclamation/pdf.html.twig', [
            'pdf' => $reclamation,

        ]);
        $dompdf->loadHtml($html);
      //  $dompdf->loadHtml('<h1>Hello, World!</h1>');

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();
        //  $dompdf->stream();
        // Output the generated PDF to Browser (force download)
       /* $dompdf->stream($reclamation->getType(), [
            "Attachment" => false
        ]);*/
        $pdfOutput = $dompdf->output();
        return new Response($pdfOutput, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="reclamation.pdf"'
        ]);

    }


    #[Route("/stat",name:"stat")]

    public function statAction(ReclamationRepository $test)
    {


        $coursss= $test->findAll();
        $nbrCours=[];
        foreach($coursss as $cours){
            $coursnom[]=$cours->getType();
            $coursprix[]=sizeof($cours->getResponses());
        }






        return $this->render('reclamation/stat.html.twig',
            [

                'coursnom'=> json_encode($coursnom),
                'coursprix'=> json_encode($coursprix),


            ]);


    }

}
