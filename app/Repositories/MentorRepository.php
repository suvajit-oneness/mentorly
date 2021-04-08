<?php
namespace App\Repositories;

use App\Models\Mentor;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\MentorContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class MentorRepository
 *
 * @package \App\Repositories
 */
class MentorRepository extends BaseRepository implements MentorContract
{
    use UploadAble;

    /**
     * MentorRepository constructor.
     * @param Mentor $model
     */
    public function __construct(Mentor $model)
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
    public function listMentors(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

     /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findMentorById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Mentor|mixed
     */
    public function createMentor(array $params)
    {
        try {
            $collection = collect($params);
            
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateMentor(array $params)
    {
        $collection = collect($params);
    }

     /**
     * @param array $params
     * @return mixed
     */
    public function updateMentorStatus(array $params){
        $mentor = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $mentor->status = $collection['check_status'];
        $mentor->save();
        return $mentor;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteMentor($id)
    {
        $mentor = $this->findOneOrFail($id);
        $mentor->delete();
        return $mentor;
    }
}