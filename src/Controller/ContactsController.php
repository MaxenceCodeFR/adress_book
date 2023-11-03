<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contacts', name: 'contacts_')]
class ContactsController extends AbstractController
{
    #[Route('/personnals', name: 'personnals')]
    public function index(ContactRepository $contacts): Response
    {
        $user = $this->getUser();

        $contacts = $contacts->findBy(['user' => $user, 'category' => 1]);


        return $this->render('groups/personnals.html.twig', compact('contacts'));
    }

    #[Route('/professionnals', name: 'professionnals')]
    public function professionals(ContactRepository $contacts): Response
    {
        $user = $this->getUser();

        $contacts = $contacts->findBy(['user' => $user, 'category' => 2]);

        return $this->render('groups/professionnals.html.twig', compact('contacts'));
    }
}
