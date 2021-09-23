<?php

namespace App\Controller;

use App\Entity\Prof;
use App\Entity\Eleve;
use App\Entity\Classe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EcoleController extends AbstractController
{
    /**
     * @Route("/liste_ajout", name="liste_ajout")
     */
    public function afficherAjout(): Response
    {
        return $this->render('liste_ajout.html.twig');
    }

    /**
     * @Route("liste_all", name="liste_all")
     */
    public function afficherListe(): Response
    {
        return $this->render('liste_all.html.twig');
    }



    /**
     * @Route("/liste_prof", name="liste_prof")
     */
    public function liste_prof(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Prof::class);

        $professeur = $repository->findAll();

        return $this->render('liste_prof.html.twig', ['professeur' => $professeur]);
    }

    /**
     * @Route("/liste_eleve", name="liste_eleve")
     */
    public function liste_eleve(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Eleve::class);

        $eleve = $repository->findAll();

        return $this->render('liste_eleve.html.twig', ['eleve' => $eleve]);
    }



    /**
     * @Route("/add", name="ajout_classe")
     */
    public function ajoutClasse(Request $request, EntityManagerInterface $entityManager)
    {
        $classe = new Classe;


        $formulaire = $this->createFormBuilder($classe)
            ->add('nom', TextType::class, [
                'invalid_message' => 'merci de renseignez votre classe'
            ])
            ->add('niveau', TextType::class)
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer'
            ])->getForm();

        $formulaire->handleRequest($request);


        if ($formulaire->isSubmitted() && $formulaire->isValid()) {

            $entityManager->persist($classe);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        } else {
            return $this->render('formulaire/form_class.html.twig', [
                'type' => 'Ajouter classe',
                'formView' => $formulaire->createView()
            ]);
        }
    }

    /**
     * @Route("/add_prof", name="ajout_prof")
     */
    public function ajoutProf(Request $request, EntityManagerInterface $entityManager)
    {
        $prof = new Prof;


        $formulaire = $this->createFormBuilder($prof)
            ->add('nom', TextType::class, [
                'invalid_message' => 'merci de renseignez votre professeur'
            ])
            ->add('prenom', TextType::class)
            ->add('date_de_naissance', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer'
            ])->getForm();

        $formulaire->handleRequest($request);


        if ($formulaire->isSubmitted() && $formulaire->isValid()) {

            $entityManager->persist($prof);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        } else {
            return $this->render('formulaire/form_prof.html.twig', [
                'type' => 'Ajouter prof',
                'formView' => $formulaire->createView()
            ]);
        }
    }

    /**
     * @Route("/add_eleve", name="ajout_eleve")
     */
    public function ajoutEleve(Request $request, EntityManagerInterface $entityManager)
    {
        $eleve = new Eleve;


        $formulaire = $this->createFormBuilder($eleve)
            ->add('nom', TextType::class, [
                'invalid_message' => 'merci de renseignez l\'élève a jouter'
            ])
            ->add('prenom', TextType::class)
            ->add('date_de_naissance', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer'
            ])->getForm();

        $formulaire->handleRequest($request);


        if ($formulaire->isSubmitted() && $formulaire->isValid()) {

            $entityManager->persist($eleve);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        } else {
            return $this->render('formulaire/form_eleve.html.twig', [
                'type' => 'Ajouter un eleve',
                'formView' => $formulaire->createView()
            ]);
        }
    }
}
