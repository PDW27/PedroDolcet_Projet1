<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Form\EmployeType;
use App\Repository\EmployeRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{

    #[Route("/" , name:"home_accueil")]
    public function home( EmployeRepository $employe ):Response{
        $employes = $employe->findAll();
        return $this->render("home/index.html.twig", [ "employes" => $employes ]);
    }

    #[Route("/new-employe", name:"employe_new_employe")]
    public function new_employe(Request $request , ManagerRegistry $doctrine):Response{
        
        $employe = new Employe();

        $form = $this->createForm(EmployeType::class,$employe); 

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $doctrine->getManager();
            $entityManager->persist($employe);
            $entityManager->flush();
            $this->addFlash("message" , "l'employe est enregistré en base de données");
            return $this->redirectToRoute("employe_new_employe");
        }
        return $this->render("employe/new-employe.html.twig", ["form" => $form->createView()]);
    }

    #[Route("/employe", name:"employe_index")]
    public function employe(ManagerRegistry $doctrine):Response{

        $employes = $doctrine->getRepository(Employe::class)->findAll();

        return $this->render("employe/index.html.twig" , ["employes" => $employes]);
    }

    #[Route("/employe/suppr/{id}" , name:"employe_suppr")]
    public function employe_suppr($id, ManagerRegistry $doctrine){

        $employe = $doctrine->getManager()->getRepository(Employe::class)->find($id);
        if($employe !== null){ 
            $this->addFlash("message" , "l'employe' numéro " . $employe->getId() . " a bien été suprimée");
            $em = $doctrine->getManager();
            $em->remove($employe);
            $em->flush();
        } else {
            $this->addFlash("erreur" , "l'employe' numéro" . $id . "n'existe pas");
        }
        return $this->redirectToRoute("employe_index");

    }

    #[Route("/employe/update/{id}" , name:"employe_update")]
    public function employe_update($id , ManagerRegistry $doctrine , Request $request){
        $employe = $doctrine->getManager()->getRepository(Employe::class)->find($id);
        if($employe === null){
            $this->addFlash("erreur" , "l'employe numero " . $id . " n'existe pas");
            return $this->redirectToRoute("employe_index");
        }
        $form = $this->createForm(EmployeType::class, $employe);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em->persist($employe);
            $em->flush();
            $this->addFlash("message" , "la'employe a bien été mise à jour");
            return $this->redirectToRoute("employe_index");
        }

        return $this->render("employe/new-employe.html.twig", ["form" =>$form->createView() , "id" => $employe->getId()]);
    }

}