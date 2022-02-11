<?php

namespace App\Controller;

use App\Entity\Gallery;
use App\Form\GalleryType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
   /**
    * @Route("/", name="homepage")
    */
   public function index(Request $request, ManagerRegistry $doctrine): Response
   {
      $gallery = new Gallery();

      $gallery->setUpdatedAt(new \DateTimeImmutable());

      $em = $doctrine->getManager();

      $form = $this->createForm(GalleryType::class, $gallery);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
         $em->persist($gallery);
         $em->flush();

         return $this->redirectToRoute('homepage');
      }

      return $this->render('homepage.html.twig', [
         'form' => $form->createView(),
         'galleries' => $doctrine->getRepository(Gallery::class)->findAll()
      ]);
   }
}