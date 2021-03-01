<?php
namespace App\Repositories;

use App\Models\Seniority;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\SeniorityContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class SeniorityRepository
 *
 * @package \App\Repositories
 */
class SeniorityRepository extends BaseRepository implements SeniorityContract
{
    use UploadAble;

    /**
     * SeniorityRepository constructor.
     * @param Seniority $model
     */
    public function __construct(Seniority $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listSeniorities(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findSeniorityById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Seniority|mixed
     */
    public function createSeniority(array $params)
    {
        try {
            $collection = collect($params);
            
            $seniority = new Seniority;
            $seniority->title = $collection['title'];
            $seniority->status = $collection->has('status') ? 1 : 0;
            $seniority->save();

            return $seniority;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSeniority(array $params)
    {
        $collection = collect($params);

        $seniority = $this->findSeniorityById($params['id']);
        
        $seniority->title = $collection['title'];
        $seniority->status = $collection->has('status') ? 1 : 0;
        $seniority->save();

        return $seniority;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteSeniority($id)
    {
        $seniority = $this->findSeniorityById($id);

        $seniority->delete();

        return $seniority;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSeniorityStatus(array $params){
        $seniority = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $seniority->status = $collection['check_status'];
        $seniority->save();

        return $seniority;
    }
}