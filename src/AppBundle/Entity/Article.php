<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
// use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 */
class Article
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
     private $id;

     /**
      * @var string
      *
      * @ORM\Column(type="string")
      */
      private $title;

      /**
       * @var \AppBundle\Entity\Tag
       * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Tag", cascade={"persist"})
       */
       private $tags;

      /**
       * @var DateTime
       *
       * @ORM\Column(type="datetime")
       */
       private $createdAt;

       /**
        * @var string
        *
        * @ORM\Column(type="text")
        */
        private $content;

        /**
        * @var boolean
        *
        * @ORM\Column(type="boolean")
        */
        private $removed;

        public function __construct()
        {
             $this->createdAt = new \DateTime();
             $this->removed = false;
        }

        /**
         * @return int
         */
        public function getId()
        {
             return $this->id;
        }

        /**
         * @return string
         */
        public function getTitle()
        {
             return $this->title;
        }

        public function setTitle($title)
        {
             $this->title = $title;
             return $this;
        }

        /**
         * @return DateTime
         */
        public function getCreatedAt()
        {
             return $this->createdAt;
        }

        public function setCreatedAt($createdAt)
        {
             $this->createdAt = $createdAt;
             return $this;
        }

        /**
         * @return string
         */
        public function getContent()
        {
             return $this->content;
        }

        public function setContent($content)
        {
             $this->content = $content;
             return $this;
        }

}
