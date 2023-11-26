<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsletterController extends AbstractController
{
    #[Route('/newsletter/subscribe', name: 'newsletter_subscribe', methods:[Request::METHOD_GET, Request::METHOD_POST])]
    public function subscribe(Request $request, EntityManagerInterface $em): Response
    {
        $newsletterEmail = new Newsletter();
        $form =$this ->createForm(NewsletterType::class, $newsletterEmail);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $newsletterEmail->setSubscribed(true); 
            $subscribedDate = new \DateTime();
            $newsletterEmail->setSubscribedDate($subscribedDate);
            $em->persist($newsletterEmail);
            $em->flush();

            // $emailNotification->confirmSubsciption($newsletterEmail);
            $this->addFlash('success', 'Votre email a été enregistré, merci');
            return $this->redirectToRoute('home');
        }

        return $this->renderForm('newsletter/index.html.twig', [
            'newsletter_form' => $form,
        ]);
    }
}
