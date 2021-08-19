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
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->mobile = $req->mobile;
        $user->password = Hash::make($req->password);
        $user->status = 1;
        $user->is_verified = 1;
        $user->save();
        $referral = $this->generateUniqueReferral();
        $referral->userId = $user->id;
        $referral->userType = 'web';
        $referral->save();
        Session::flash('message', 'User added successfully!');
        return redirect(route('admin.user.index'));
    }

    public function editUser(Request $req,$id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit',compact('user'));
    }

    public function updateUser(Request $req,$id)
    {
        $req->validate([
            'name' => 'required|max:200|string',
            'email' => 'required|email|string|unique:users,email,'.$id,
            'mobile' => 'required|numeric|digits:10',
        ]);
        $user = User::find($id);
        $user->name = $req->name;
        $user->email = $req->email;
        $user->mobile = $req->mobile;
        $user->save();
        Session::flash('message', 'Mentee Updated successfully!');
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
