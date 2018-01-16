<?php

namespace AppBundle\Entity;

use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;


/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
 * @Vich\Uploadable
 */

class Article
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePost", type="datetime")
     */
    private $datePost;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

     /**
     * @Vich\UploadableField(mapping="article_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;
    /**
     * @var string
     *
     * @ORM\Column(name="video", type="string", length=255, nullable=true)
     */
    private $video;


    /**
     * @ORM\ManyToOne(targetEntity="SubRubric", inversedBy="articles")
     * @ORM\JoinColumn(name="sub_rubrique_id", referencedColumnName="id")
     */
    private $subRubrique;
    
    public function __construct(){
        $this->setDatePost(new \DateTime('now'));
    }
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Article
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Article
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

      return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set datePost
     *
     * @param \DateTime $datePost
     *
     * @return Article
     */
    public function setDatePost($datePost)
    {
        $this->datePost = $datePost;

        return $this;
    }

    /**
     * Get datePost
     *
     * @return \DateTime
     */
    public function getDatePost()
    {
        return $this->datePost;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Article
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set video
     *
     * @param string $video
     *
     * @return Article
     */
    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return string
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set rubrique
     *
     * @param \AppBundle\Entity\Rubrique $rubrique
     *
     * @return Article
     */
    public function setRubrique(\AppBundle\Entity\Rubrique $rubrique = null)
    {
        $this->rubrique = $rubrique;

        return $this;
    }

    /**
     * Get rubrique
     *
     * @return \AppBundle\Entity\Rubrique
     */
    public function getRubrique()
    {
        return $this->rubrique;
    }

    /**
     * Set subRubrique
     *
     * @param \AppBundle\Entity\SubRubric $subRubrique
     *
     * @return Article
     */
    public function setSubRubrique(\AppBundle\Entity\SubRubric $subRubrique = null)
    {
        $this->subRubrique = $subRubrique;

        return $this;
    }

    /**
     * Get subRubrique
     *
     * @return \AppBundle\Entity\SubRubric
     */
    public function getSubRubrique()
    {
        return $this->subRubrique;
    }
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }
}
