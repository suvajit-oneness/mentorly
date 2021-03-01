<?php

namespace App\Contracts;

/**
 * Interface MentorContract
 * @package App\Contracts
 */
interface MentorContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listMentors(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findMentorById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createMentor(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateMentor(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteMentor($id);
}