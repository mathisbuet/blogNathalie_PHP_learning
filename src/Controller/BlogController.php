<?php

namespace App\Controller;


use App\Form\PageType;

use App\Entity\PageNathalie;



use App\Repository\PageEleveRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PageNathalieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{

    

    /**
     * @Route("/admin", name="admin")
     */
    public function admin(PageEleveRepository $repo)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $pagesEleveAValider= $repo->findBy(
            array('valide' => false)
        );

        return $this->render('blog/admin.html.twig', [
            'nbPagesEleveNonValide' => count($pagesEleveAValider)
        ]);
    }

    /**
     * @Route("/", name="blog")
     */
    public function index(PageEleveRepository $repo)
    {
   

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController'
        ]);
    }
    
    /**
     * @Route("/pages", name="pages")
     */
    public function mesPages(PageNathalieRepository $repo){

        $pages= $repo->findAll();
        
        return $this->render('blog/mes_pages.html.twig', [
            'pages' => $pages
        ]);
    }


    /**
     * @Route("/page/create", name="page_create")
     * @Route("/page/{id}/edit", name="page_edit", methods="GET|POST")
     */
    public function createPage(PageNathalie $page=null, Request $request, EntityManagerInterface $manager)
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if(!$page){
            $page = new PageNathalie();
        }
        
        $form=$this->createForm(PageType::class, $page, [
            'formSpe' => "Nathalie",
            'createMode' => $page->getId() ==null
        ]);

        $form->handleRequest($request); // analyse de la requette

        
        if($form->isSubmitted() && $form->isValid()){
            if(!$page->getId()){
                $page->setCreatedAt(new \Datetime());
            }
            else 
                $page->setUpdatedAt(new \Datetime());
            
            
            $manager->persist($page);
            $manager->flush();
            return $this->redirectToRoute('show_page', ['id' => $page->getId()]);
        }

        return $this->render('blog/create_page.html.twig',[
            'formPage' => $form->createView(),
            'pageEleve' => false,
            'page' => $page
        ]);
    }


    /**
     * @Route("/page/{id}/edit", name="page_delete", methods="DELETE")
     */
    public function removePage(EntityManagerInterface $manager, PageNathalie $page, Request $request){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if($this->isCsrfTokenValid('deleteNathalie' . $page->getId(), $request->get('_token'))){
            $manager->remove($page);
            $manager->flush();
        }
        return $this->redirectToRoute('pages');

    }


    /**
     * @Route("/page/{id}", name="show_page")
     */
    public function affichePage(PageNathalie $page){

        
        return $this->render('blog/show_page.html.twig', [
            'page' => $page
        ]);
    }   

    
}