<?php

namespace App\Contracts;

/**
 * Interface SeniorityContract
 * @package App\Contracts
 */
interface SeniorityContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listSeniorities(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findSeniorityById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createSeniority(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSeniority(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteSeniority($id);
}