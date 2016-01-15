<?php

namespace SiSu\CuentaBundle\Repository;

class UsuarioRepository extends \Doctrine\ORM\EntityRepository
{
	public function findAllOrderedByName()
	{
		return $this->getEntityManager()
		->createQuery(
				'SELECT u FROM SiSuCuentaBundle:Usuario u ORDER BY u.nombreUsuario ASC'
				)
				->getResult();
	}
}
