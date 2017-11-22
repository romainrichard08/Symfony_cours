<?php

namespace AppBundle\Repository;

class ArticleRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByTag($tag, $isRemoved = false)
	{
		$query = $this->createQueryBuilder('a')
			->join('a.tags', 't')
			->where('t.slug = :tag')
			->setParameter('tag', $tag)
			->andWhere('a.removed = :isRemoved')
			->setParameter('isRemoved', $isRemoved)
			->orderBy('a.title', 'ASC')
			->getQuery();

			return $query->getResult();
	}
}
