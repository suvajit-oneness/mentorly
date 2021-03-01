<?php
namespace App\Repositories;

use App\Models\Banner;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\BannerContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class BannerRepository
 *
 * @package \App\Repositories
 */
class BannerRepository extends BaseRepository implements BannerContract
{
    use UploadAble;

    /**
     * BannerRepository constructor.
     * @param Banner $model
     */
    public function __construct(Banner $model)
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
    public function listBanners(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findBannerById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Banner|mixed
     */
    public function createBanner(array $params)
    {
        try {
            $collection = collect($params);
            
            $banner = new Banner;
            $banner->title = $collection['title'];
            $banner->link = $collection['link'];

            $banner_image = $collection['image'];
            $imageName = time().".".$banner_image->getClientOriginalName();
            $banner_image->move("banners/",$imageName);
            $uploadedImage = $imageName;
            $banner->image = $uploadedImage;

            $banner->status = $collection->has('status') ? 1 : 0;
            $banner->save();

            return $banner;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBanner(array $params)
    {
        $collection = collect($params);

        $banner = $this->findBannerById($params['id']);
        
        $banner->title = $collection['title'];
        $banner->link = $collection['link'];

        if(isset($collection['image'])){
            $banner_image = $collection['image'];
            $imageName = time().".".$banner_image->getClientOriginalName();
            $banner_image->move("banners/",$imageName);
            $uploadedImage = $imageName;
            $banner->image = $uploadedImage;
        }

        $banner->status = $collection->has('status') ? 1 : 0;
        $banner->save();

        return $banner;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteBanner($id)
    {
        $banner = $this->findBannerById($id);

        $banner->delete();

        return $banner;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBannerStatus(array $params){
        $banner = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $banner->status = $collection['check_status'];
        $banner->save();

        return $banner;
    }
}