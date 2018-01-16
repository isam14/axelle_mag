<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
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

    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', array(
            'articlesRightMenu' => $this->articleRightMenu(),
        ));
    }

    /**
     * @Route ("/categorie/{catId}", name="categorie")
     */

    public function categorieAction($catId)
    {
        return $this->render('default/categorie.html.twig', array(
            'articlesRightMenu' => $this->articleRightMenu(),
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
        ));
    }
}
