<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\UserContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\User;use Hash;use Session;

class UserController extends BaseController
{
    /**
     * @var UserContract
     */
    protected $userRepository;


    /**
     * PageController constructor.
     * @param UserContract $userRepository
     */
    public function __construct(UserContract $userRepository)
    {
        $this->userRepository = $userRepository;
        
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $user = $this->userRepository->listUsers();

        $this->setPageTitle('User', 'List of all User');
        return view('admin.user.index', compact('user'));
    }

    public function create(Request $req)
    {
        return view('admin.user.create');
    }

    public function saveNewUser(Request $req)
    {
        $req->validate([
            'name' => 'required|max:200|string',
            'email' => 'required|email|string|unique:mentors',
            'mobile' => 'required|numeric|digits:10',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $mentor = new User;
        $mentor->name = $req->name;
        $mentor->email = $req->email;
        $mentor->mobile = $req->mobile;
        $mentor->password = Hash::make($req->password);
        $mentor->status = 1;
        $mentor->is_verified = 1;
        $mentor->save();
        Session::flash('message', 'User added successfully!');
        return redirect(route('admin.user.index'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $user = $this->userRepository->deleteUser($id);

        if (!$user) {
            return $this->responseRedirectBack('Error occurred while deleting user.', 'error', true, true);
        }
        return $this->responseRedirect('admin.user.index', 'User deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $user = $this->userRepository->updateUserStatus($params);

        if ($user) {
            return response()->json(array('message'=>'User status successfully updated'));
        }
    }
}
