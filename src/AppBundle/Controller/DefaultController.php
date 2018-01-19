<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Newsletter;
use AppBundle\Entity\Rubrique;
use AppBundle\Entity\SubRubric;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    private function articlesIndex()
    {
        return $this->getDoctrine()
            ->getRepository(Article::class)
            ->articlesIndex();
    }

    private function searchArcticles($search)
    {
        return $this->getDoctrine()
            ->getRepository(Article::class)
            ->searchArticle($search);
    }

    /**
     * @Route("/", name="index")
     */
    public function indexAction(\Swift_Mailer $mailer)
    {
        return $this->render('default/index.html.twig', array(
            'articlesRightMenu' => $this->articleRightMenu(),
            'categoriesLeftMenu' => $this->categorieLeftMenu(),
            'sousRubriqueLeftMenu' => $this->sousRubriqueLeftMenu(),
            'articlesIndex' => $this->articlesIndex(),
        ));
    }

    /**
     * @Route("/mentions", name="mentions" )
     */
    public function mentionsAction ()
    {
        return $this->render('default/mentions.html.twig', array(
            'articlesRightMenu' => $this->articleRightMenu(),
            'categoriesLeftMenu' => $this->categorieLeftMenu(),
            'sousRubriqueLeftMenu' => $this->sousRubriqueLeftMenu(),
            'ariclesIndex' => $this->articlesIndex()
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

    public function searchAction(Request $request)
    {
        $search = $request->query->get('search');
        return $this->render('default/search.html.twig', array(
            'articlesRightMenu' => $this->articleRightMenu(),
            'categoriesLeftMenu' => $this->categorieLeftMenu(),
            'sousRubriqueLeftMenu' => $this->sousRubriqueLeftMenu(),
            'articleSearched' => $this->searchArcticles($search),
        ));
    }

    /**
     * @Route("/subscribe", name="subscribe")
     */
    public function subscribeAction(Request $request, \Swift_Mailer $mailer)
    {
        $email = htmlspecialchars($request->request->get(('newsLetterMail')));

        $findIfEmailExists = $this->getDoctrine()
            ->getRepository(Newsletter::class)
            ->findBy(['email' => $email]);

        if(count($findIfEmailExists) === 0)
        {
            $message = (new \Swift_Message('Inscription A La Newsletter d\'Axelle Magazine'))
                ->setFrom('tira.nicolas@gmail.com')
                ->setTo($email)
                ->setBody(
                    $this->renderView(
                        'Emails/newsletter.html.twig'
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);

            $em = $this->getDoctrine()->getManager();
            $mail = new Newsletter();
            $mail->setEmail($email);
            $em->persist($mail);
            $em->flush();
        }

        return $this->redirectToRoute('index');
    }
}
