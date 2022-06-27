<?php

namespace App\Controller;

use App\Entity\Argo;
use App\Form\ArgoType;
use App\Repository\ArgoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LeController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ArgoRepository $repoArgo, Request $request, EntityManagerInterface $manager): Response
    {

        $cellules = $repoArgo->findAll();

        $argo = new Argo;
        $formArgo = $this->createForm(ArgoType::class, $argo);
        $formArgo->handleRequest($request);

        if($formArgo->isSubmitted() && $formArgo->isValid())
        {
            $nom = $argo->getNom();
            $manager->persist($argo);
            $manager->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('index.html.twig', [
            'formArgo' => $formArgo->createView(),
            'cellules' => $cellules,
        ]);
    }
}
