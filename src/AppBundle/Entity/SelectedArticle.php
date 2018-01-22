<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * SelectedArticle
 *
 * @ORM\Table(name="selected_article")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SelectedArticleRepository")
 */
class SelectedArticle
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom.
     *
     * @param string $nom
     *
     * @return SelectedArticle
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom.
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * One SelectedArticle has One Article.
     * @ORM\OneToOne(targetEntity="Article", mappedBy="selectedArticle")
     */
    private $article;

    /**
     * @return mixed
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param mixed $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
    }

    public function __toString()
    {
        return $this->getNom();
    }

//    /**
//     * @ORM\OneToMany(targetEntity="Article", mappedBy="SelectedArticle")
//     */
//    private $article;
//
//
//    public function __construct()
//    {
//        $this->article = new ArrayCollection();
//    }
//
//    public function getArticle()
//    {
//        return $this->article;
//    }
//
//    public function __toString()
//    {
//        return $this->article;
//        // TODO: Implement __toString() method.
//    }
}
