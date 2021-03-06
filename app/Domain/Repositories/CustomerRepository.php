<?php
namespace App\Domain\Repositories;

interface CustomerRepository
{
    /**
     * Get all Customers
     *
     * @param string $orderField
     * @param string $order
     *
     * @return \App\Domain\Entities\Customer[]
     */
    public function all($orderField = 'id', $order = 'ASC');
    /**
     * Finds an entity by its primary key / identifier.
     *
     * @param mixed    $id          The identifier.
     * @param int|null $lockMode    One of the \Doctrine\DBAL\LockMode::* constants
     *                              or NULL if no specific lock mode should be used
     *                              during the search.
     * @param int|null $lockVersion The lock version.
     *
     * @return \App\Domain\Entities\Customer
     */
    public function find($id, $lockMode = null, $lockVersion = null);
}