<?php

namespace App\Controller;

use App\Form\PageType;

use App\Entity\PageEleve;
use App\Entity\UserEleve;
use App\Repository\PageEleveRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EleveController extends AbstractController
{

    private $security;

    public function __construct(Security $security)
    {
        // Avoid calling getUser() in the constructor: auth may not
        // be complete yet. Instead, store the entire Security object.
        $this->security = $security;
    }

    /**
     * @Route("/pages/eleve", name="pages_eleve")
     */
    public function pagesEleves(PageEleveRepository $repo){

        $pages= $repo->findBy(
            array('valide' => 1) //valide
        );

        $pagesAValider= $repo->findBy(
            array('valide' => 0) //en attente
        );

        return $this->render('eleve/pages_eleves.html.twig', [
            'pages' => $pages,
            'nbPagesNonValide' => count($pagesAValider)
        ]);
    }

    /**
     * @Route("/pages/eleve/attente", name="show_pages_eleves_attente")
     */
    public function showValiderPage(PageEleveRepository $repo){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $pages= $repo->findBy(
            array('valide' => 0) //en attente
        );

        return $this->render('eleve/valider_pages_eleves.html.twig',[
            'pages' => $pages
        ]);
    }

    /**
     * @Route("/page/eleve/{id}/validation", name="page_eleve_validation")
     */
    public function validerPage(PageEleve $page, Request $request, EntityManagerInterface $manager){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        $form=$this->createForm(PageType::class, $page, [
            'formSpe' => "EleveValidation",
            'createMode' => false
        ]);
        
        $form->handleRequest($request); // analyse de la requette

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($page);
            $manager->flush();
            return $this->redirectToRoute('pages_eleve');
        }

        return $this->render('eleve/valider_page.html.twig',[
            'formPage' => $form->createView(),
            'page' => $page
        ]);
    }


    /**
     * @Route("/page/eleve/create", name="page_create_eleve")
     * @Route("/page/eleve/{id}/edit", name="page_edit_eleve", methods="GET|POST")
     */
    public function createPageEleve(PageEleve $page=null, Request $request, EntityManagerInterface $manager){

        $userConnecte = $this->security->getUser(); //l'user connecté en ce moment
        $this->denyAccessUnlessGranted('ROLE_ELEVE');

        if(!$page){ //création de la page
            $page = new PageEleve();
        }
        else {//modification de la page
            if($userConnecte != $page->getUserEleve()->getUser()){
                //si la page n'appartient pas à l'user connecté
                $this->denyAccessUnlessGranted('ROLE_ADMIN');
            }    
        }

        $form=$this->createForm(PageType::class, $page, [
            'formSpe' => "Eleve",
            'createMode' => $page->getId() ==null
        ]);

        $form->handleRequest($request); // analyse de la requette

        if($form->isSubmitted() && $form->isValid()){
            if(!$page->getId()){ //création d'une page
                
                $userPresent = $userConnecte->getUserEleve();
                
                if($userPresent == null){ //Si l'User Eleve selon l'user n'exsite pas
                    $userEleve = new UserEleve();
                    $userConnecte->setUserEleve($userEleve);
                    $userEleve->addPage($page);

                    $manager->persist($userEleve);
                    $manager->persist($userConnecte);
                }
                else{ //si l'user Eleve n'existe pas
                    $userPresent->addPage($page);
                    $manager->persist($userPresent);
                }

                $page->setCreatedAt(new \Datetime());
            }

            else{
                $page->setUpdatedAt(new \Datetime());
            }
            
            $page->setValide(0); //en attente
            $manager->persist($page);
            $manager->flush();

            return $this->redirectToRoute('pannel_eleve');
        }

        return $this->render('blog/create_page.html.twig',[
            'formPage' => $form->createView(),
            'pageEleve' => true,
            'page' => $page
        ]);

    }


    /**
     * @Route("/page/eleve/{id}/edit", name="page_delete_eleve", methods="DELETE")
     */
    public function removePage(EntityManagerInterface $manager, PageEleve $page, Request $request){

        $userConnecte = $this->security->getUser(); //l'user connecté en ce moment

        $this->denyAccessUnlessGranted('ROLE_ELEVE');
        
        if($userConnecte != $page->getUserEleve()->getUser()){
            //si la page n'appartient pas à l'user connecté
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }    
        

        if($this->isCsrfTokenValid('deleteEleve' . $page->getId(), $request->get('_token'))){
            $manager->remove($page);
            $manager->flush();
        }
        return $this->redirectToRoute('pages_eleve');

    }


    /**
     * @Route("/page/eleve/pannel", name="pannel_eleve")
     */
    public function pannelEleve(PageEleveRepository $repo){
        $pagesNonValide= new ArrayCollection();
        $pagesValide= new ArrayCollection();
        $pagesEnAttente= new ArrayCollection();

        $this->denyAccessUnlessGranted('ROLE_ELEVE');

        $userConnecte = $this->security->getUser(); //l'user connecté en ce moment
        $userPresent = $userConnecte->getUserEleve();
        
        $pages=$repo->findBy(
            array('userEleve' => $userPresent)
        );
        
        foreach ($pages as $value) {
            if($value->getValide()==1){//valide
                $pagesValide->add($value);
            }
            else if($value->getValide()==0)//en attente
            {
                $pagesEnAttente->add($value);
            }
            else if($value->getValide()==2){//non valide
                $pagesNonValide->add($value);
            }
        }
        unset($value);

        return $this->render('eleve/pannel_eleve.html.twig',[
            'pagesValide' => $pagesValide,
            'pagesEnAttente' => $pagesEnAttente,
            'pagesNonValide' => $pagesNonValide
        ]);
    }
}