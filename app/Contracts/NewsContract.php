<?php

namespace App\Contracts;

/**
 * Interface NewsContract
 * @package App\Contracts
 */
interface NewsContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listNewss(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findNewsById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createNews(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateNews(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteNews($id);
}