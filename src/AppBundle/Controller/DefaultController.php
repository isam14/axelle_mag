<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Rubrique;
use AppBundle\Entity\SubRubric;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    private function articleRightMenu()
    {
        return  $this->getDoctrine()
            ->getRepository(Article::class)
            ->articlesRightMenu();
    }

    private function sousRubriqueLeftMenu()
    {
        return  $this->getDoctrine()
            ->getRepository(SubRubric::class)
            ->subRubriqueLeftMenu();
    }

    private function categorieLeftMenu()
    {
        return  $this->getDoctrine()
            ->getRepository(Rubrique::class)
            ->findAll();
    }

    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', array(
            'articlesRightMenu' => $this->articleRightMenu(),
            'categoriesLeftMenu' => $this->categorieLeftMenu(),
            'sousRubriqueLeftMenu' => $this->sousRubriqueLeftMenu()
        ));
    }

    /**
     * @Route ("/categorie/{catId}", name="categorie")
     */

    public function categorieAction($catId)
    {
       $rubrique = $this->getDoctrine()
            ->getRepository(SubRubric::class)
            ->find($catId);
        return $this->render('default/categorie.html.twig', array(
        'articlesRightMenu' => $this->articleRightMenu(),
        'categoriesLeftMenu' => $this->categorieLeftMenu(),
        'sousRubriqueLeftMenu' => $this->sousRubriqueLeftMenu(),
        'rubrique' => $rubrique
    ));
    }

    /**
     * @Route("/article/{id}", name="article", requirements={"id"="\d+"})
     */

    public function articleAction($id)
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)->find($id);
        return $this->render('default/article.html.twig', array(
            'articlesRightMenu' => $this->articleRightMenu(),
            'categoriesLeftMenu' => $this->categorieLeftMenu(),
            'sousRubriqueLeftMenu' => $this->sousRubriqueLeftMenu(),
            'article' => $article
        ));
    }

    /**
     * @Route ("/recherche/", name="recherche")
     */

    public function searchAction()
    {
        return $this->render('default/search.html.twig', array(
            'articlesRightMenu' => $this->articleRightMenu(),
            'categoriesLeftMenu' => $this->categorieLeftMenu(),
            'sousRubriqueLeftMenu' => $this->sousRubriqueLeftMenu()
        ));
    }
}
