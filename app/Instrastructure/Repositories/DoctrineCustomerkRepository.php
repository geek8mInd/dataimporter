<?php
namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\CustomerRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineCustomerRepository extends EntityRepository implements CustomerRepository
{
    /**
     * Get all Customers
     *
     * @param string $orderField
     * @param string $order
     *
     * @return \App\Domain\Entities\Customer[]
     */
    public function all($orderField = 'id', $order = 'ASC')
    {
        return $this->findBy([], [$orderField => $order]);
    }
}