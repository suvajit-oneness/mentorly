<?php
namespace App\Repositories;

use App\Models\Industry;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\IndustryContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class IndustryRepository
 *
 * @package \App\Repositories
 */
class IndustryRepository extends BaseRepository implements IndustryContract
{
    use UploadAble;

    /**
     * IndustryRepository constructor.
     * @param Industry $model
     */
    public function __construct(Industry $model)
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
    public function listIndustries(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findIndustryById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Industry|mixed
     */
    public function createIndustry(array $params)
    {
        try {
            $collection = collect($params);
            
            $industry = new Industry;
            $industry->title = $collection['title'];
            $industry->status = $collection->has('status') ? 1 : 0;
            $industry->save();

            return $industry;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateIndustry(array $params)
    {
        $collection = collect($params);

        $industry = $this->findIndustryById($params['id']);
        
        $industry->title = $collection['title'];
        $industry->status = $collection->has('status') ? 1 : 0;
        $industry->save();

        return $industry;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteIndustry($id)
    {
        $industry = $this->findIndustryById($id);

        $industry->delete();

        return $industry;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateIndustryStatus(array $params){
        $industry = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $industry->status = $collection['check_status'];
        $industry->save();

        return $industry;
    }
}