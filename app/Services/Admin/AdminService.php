<?php

namespace App\Services\Admin;

use App\Contracts\AdminContract;
use App\Models\AdPackages;
use Illuminate\Support\Facades\Hash;
use Auth;

class AdminService
{
    protected $adminRepository;

    /**
     * class AdminService constructor
     */
    public function __construct(AdminContract $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /**
     * Fetch Admin profile details
     * @param int $id
     * @return Admin|mixed
     */
    public function fetchProfile($id) {
        return $this->adminRepository->findAdminById($id);
    }

    /**
     * Fetch Admin update profile
     * @param Request $request, int $id
     * @return Admin|mixed
     */
    public function updateProfile($request, $id) {
        return $this->adminRepository->updateProfile($request, $id);
    }

    /**
     * Fetch Admin change password
     * @param Request $request, int $id
     * @return mixed
     */
    public function changePassword($request, $id) {

        $info = array();
        if ($request->has('current_password') && $request->has('new_password')) {

            if (!(Hash::check($request->current_password, Auth::user()->password))) {
                // The passwords matches
                $info['message'] = 'Your current password does not matches with the password you provided. Please try again.';
                $info['type'] = 'error';
                $info['redirect'] = '#password';
                return $info;
            }
    
            if(strcmp($request->current_password, $request->new_password) == 0){
                //Current password and new password are same
                $info['message'] = 'New Password cannot be same as your current password. Please choose a different password.';
                $info['type'] = 'error';
                $info['redirect'] = '#password';
                return $info;
            }

            if(strcmp($request->new_password, $request->new_confirm_password) != 0){
                //Current password and new password are same
                $info['message'] = 'New Password and confirm password must be same. Please try again.';
                $info['type'] = 'error';
                $info['redirect'] = '#password';
                return $info;
            }
            
            $this->adminRepository->updatePassword($request->all(), $id);

            $info['message'] = 'Password updated successfully.';
            $info['type'] = 'success';
            $info['redirect'] = '#password';
            return $info;
        }
    }
}