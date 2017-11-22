<?php

namespace AppBundle\Manager;

class ArticleManager
{

    public function setPublish(Article $article)
    {
        return $article->setPublish(1);
    }

}
