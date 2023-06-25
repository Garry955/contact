<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ContactController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/', methods: ['GET', 'POST', 'HEAD'], name: 'contact')]
    public function index(Request $request, ValidatorInterface $validator): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $errors = $validator->validate($contact);

            if (count($errors) > 0) {
                return $this->render('contact/index.html.twig', [
                    'errors' => $errors,
                    'form' => $form->createView()
                ]);
            } else {
                $newContact = $form->getData();

                $this->em->persist($newContact);
                $this->em->flush();

                return $this->render('contact/success.html.twig');
            }
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
