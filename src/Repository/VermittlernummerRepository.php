<?php

namespace App\Repository;

use App\Entity\Vermittlernummer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class VermittlernummerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vermittlernummer::class);
    }

    public function getMaklerInfo($versicherung, $nummer): string
    {
        $em = $this->getEntityManager();

        $query = "SELECT m.name, REGEXP_REPLACE(v.vermittlernummer, '^0+|0+$|-+|\/+|^\d*\/|R', '') as nummer
        FROM vermittlernummer v 
        LEFT JOIN makler m on m.id = v.makler_id 
        LEFT JOIN gesellschaft g on g.id = v.gesellschaft_id 
        WHERE 1=1
        AND g.name LIKE :versicherung
        HAVING nummer = :nummer;";
        
        $statement = $em->getConnection()->prepare($query);

        $statement->bindValue('versicherung', $versicherung);
        $statement->bindValue('nummer', $nummer);

        $result = $statement->executeQuery()->fetchOne();

        return $result;
    }
}
