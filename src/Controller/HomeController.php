<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ContactRepository $contact): Response
    {

        $user = $this->getUser();

        $contact->findBy(['user' => $user]);
        // dd($user);
        return $this->render('home/index.html.twig', compact('user'));
    }

    #[Route('/add', name: 'add')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $contact = new Contact();

        $contactForm = $this->createForm(ContactType::class, $contact);

        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            //Le user est recupéré dans le formulaire pour lui attribuer 
            //directement son contact
            $contact->setUser($this->getUser());
            //On recupère l'image
            $file = $contactForm->get('image')->getData();
            //On génère un nom de fichier aléatoire
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            //On set l'image dans dans l'entité
            $contact->setImage($fileName);
            //On déplace l'image dans le dossier uploads
            $file->move($this->getParameter('uploads'), $fileName);
            $em->persist($contact);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('home/add.html.twig', [
            'contactForm' => $contactForm->createView()
        ]);
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function edit(Contact $contact, Request $request, EntityManagerInterface $em): Response
    {
        $contactForm = $this->createForm(ContactType::class, $contact);

        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            //On recupère l'image déjà existante
            $currentImage = $contact->getImage();
            $file = $contactForm->get('image')->getData();

            //Si une nouvelle image est envoyée
            if ($file) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                //On set l'image dans dans l'entité
                $contact->setImage($fileName);
                //On déplace l'image dans le dossier uploads
                $file->move($this->getParameter('uploads'), $fileName);
            } elseif ($currentImage) {
                $contact->setImage($currentImage);
            }
            //On génère un nom de fichier aléatoire

            $em->persist($contact);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('home/edit.html.twig', [
            'contactForm' => $contactForm->createView()
        ]);
    }
    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Contact $contact, EntityManagerInterface $em): Response
    {
        $em->remove($contact);
        $em->flush();

        return $this->redirectToRoute('home');
    }
}
