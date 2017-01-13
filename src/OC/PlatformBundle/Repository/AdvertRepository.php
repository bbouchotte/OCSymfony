<?php

namespace OC\PlatformBundle\Repository;

use Doctrine\ORM\QueryBuilder;
use OC\PlatformBundle\Entity\Advert;
use Doctrine\ORM\Tools\Pagination\Paginator;


/**
 * AdvertRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AdvertRepository extends \Doctrine\ORM\EntityRepository 
{ // ou extends EntityRepository si on ajoute: use \Doctrine\ORM\EntityRepository;

public function findByDays($days)
{
	$date = date('Y-m-d H:i:s', time() - ($days * 24 * 60 * 60));

	$qb = $this->createQueryBuilder('a')
	->andWhere("a.date	< :date")
	->andWhere('a.nbApplications = 0')
	->setParameter('date', $date)
	;
	$adverts = $qb->getQuery()->getResult();

	return $adverts;

}
	public function getAdverts($page, $nbPerPage) {
		$query = $this->createQueryBuilder('a')
//			->leftJoin('a.image', 'i')
//			->addSelect('i')
//			->leftJoin('a.categories', 'c')
//			->addSelect('c')
			->orderBy('a.date', 'DESC')
//			->getQuery()
		;
		
	/*	$query
			// On définit l'annonce à partir de laquelle commencer la liste
			->setFirstResult(($page-1) * $nbPerPage)
			// Ainsi que le nombre d'annonce à afficher sur une page
			->setMaxResults($nbPerPage)
		;*/
		
		// Enfin, on retourne l'objet Paginator correspondant à la requête construite
		// (n'oubliez pas le use correspondant en début de fichier)
		return $query->getQuery()->getResult();
//		return new Paginator($query, true);
	}

	public function findAllLimit($limit) {
		$qb = $this
			->createQueryBuilder('a')
			->setMaxResults($limit)
			->addOrderBy('a.date', 'desc')
		;
			$adverts = $qb->getQuery()->getResult();
			return $adverts;
	
	}

	public function getAdvertWithCategories(array $categoryNames) {
		$qb = $this
			->createQueryBuilder('a')
			->leftJoin('a.categories', 'cat', 'WITH', 'cat.name IN( :categoriesNames )')
			->setParameter('categoriesNames', array_values($categoryNames))
			->addSelect('cat')
		;
		return $qb->getQuery()->getResult();
	}

	public function myFindAll() {
		//Méthode 1 en passant par l'EntityManager 'a' est le raccourci que l'on donne à l'entité du repository.
		$queryBuilder = $this->_em->CreateQueryBuilder()
			->select('a')
			->from($this->_entityName, 'a')
		;
		// Dans un repository, $this->_entityName est le namespace de l'entité gérée
		// Ici, il vaut donc OC\PlatformBundle\Entity\Advert
		
		// Méthode 2 : en passant par le raccourci (recommandée)
		$queryBuilder = $this->createQueryBuilder('a');
		
		$query = $queryBuilder->getQuery(); // On récupère la Query à partir du QueryBuilder
		//return $query->getResult(); // On retourne les résutats à partir de la Query
		// méthode raccourcie:
		try {
			return $this
				->createQueryBuilder('a')
				->getQuery()
				->getResult()
			;
		} finally {
			return null;
		}
	}
	
	public function findLast() {
		$qb = $this->createQueryBuilder('a');
// 		$qb
// 			->select('a')
// 			->
	return $qb->getSingleResult();
	}
	
	public function myFindDQL($id) {
		$query = $this->_em
			->createQuery("select a from OCPlatformBundle:Advert a where a.id = :id")
			->setParameter('id', $id)
		;
		$advert = new Advert;
		$advert = $query->getSingleResult();
		return $advert;
	}

}
