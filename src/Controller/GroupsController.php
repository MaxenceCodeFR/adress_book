<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Group;
use App\Entity\Contact;
use App\Form\GroupType;
use App\Entity\GroupContact;
use App\Form\GroupContactType;
use App\Form\GroupCreationType;
use Doctrine\ORM\EntityManager;
use App\Repository\UserRepository;
use App\Repository\GroupRepository;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\GroupContactRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/groups', name: 'groups_')]
class GroupsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(GroupRepository $groupRepository): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        } else {
            $groups = $groupRepository->findBy(['user' => $user]);
        }

        return $this->render('groups/index.html.twig', compact('groups'));
    }

    #[Route('/ajouter', name: 'ajouter')]
    public function add(Request $request, EntityManagerInterface $em, ContactRepository $contactRepository): Response
    {
        $user = $this->getUser();


        $group = new Group();

        $groupForm = $this->createForm(GroupCreationType::class, $group);


        $groupForm->handleRequest($request);

        if ($groupForm->isSubmitted() && $groupForm->isValid()) {
            $group->setUser($user);

            $em->persist($group);
            $em->flush();
            return $this->redirectToRoute('groups_index');
        }

        return $this->render('groups/add.html.twig', [
            'groupForm' => $groupForm->createView(),
        ]);
    }


    // #[Route('/show/{id}', name: 'show')]
    // public function show(GroupRepository $groupContactRepository, Group $group): Response
    // {
    //     $groupContacts = $groupContactRepository->findAll();

    //     return $this->render('groups/show.html.twig', compact('groupContacts', 'group'));
    // }

    #[Route('/show/{id}', name: 'show')]
    public function show(Group $group, GroupRepository $groupRepository): Response
    {
        $groupContacts = $group->getContact(); // Utilisez $groupContacts au lieu de $getContact

        return $this->render('groups/show.html.twig', [
            'groupContacts' => $groupContacts, // Utilisez 'groupContacts' au lieu de 'getContact'
            'group' => $group,
        ]);
    }
}
