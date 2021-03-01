<?php
namespace App\Repositories;

use App\Models\News;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\NewsContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class NewsRepository
 *
 * @package \App\Repositories
 */
class NewsRepository extends BaseRepository implements NewsContract
{
    use UploadAble;

    /**
     * NewsRepository constructor.
     * @param News $model
     */
    public function __construct(News $model)
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
    public function listNewss(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findNewsById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return News|mixed
     */
    public function createNews(array $params)
    {
        try {
            $collection = collect($params);
            
            $news = new News;
            $news->title = $collection['title'];
            $news->slug = '';
            $news->description = $collection['description'];

            $news_image = $collection['image'];
            $imageName = time().".".$news_image->getClientOriginalName();
            $news_image->move("news/",$imageName);
            $uploadedImage = $imageName;
            $news->image = $uploadedImage;

            $news->status = $collection->has('status') ? 1 : 0;
            $news->save();

            return $news;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateNews(array $params)
    {
        $collection = collect($params);

        $news = $this->findNewsById($params['id']);
        
        $news->title = $collection['title'];
        $news->description = $collection['description'];

        if(isset($collection['image'])){
            $news_image = $collection['image'];
            $imageName = time().".".$news_image->getClientOriginalName();
            $news_image->move("news/",$imageName);
            $uploadedImage = $imageName;
            $news->image = $uploadedImage;
        }

        $news->status = $collection->has('status') ? 1 : 0;
        $news->save();

        return $news;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteNews($id)
    {
        $news = $this->findNewsById($id);

        $news->delete();

        return $news;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateNewsStatus(array $params){
        $news = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $news->status = $collection['check_status'];
        $news->save();

        return $news;
    }
}