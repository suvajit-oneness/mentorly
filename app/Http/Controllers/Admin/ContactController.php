<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class ContactController extends BaseController
{
    public function index() {
        $contacts = ContactUs::where('type', 1)->get();
        return view('admin.all-contact',compact('contacts'));
    }

    public function delete($id){
        $deleteContact = ContactUs::find($id)->delete();
        if (!$deleteContact) {
            return $this->responseRedirectBack('Error occurred while deleting contact.', 'error', true, true);
        }
        return $this->responseRedirect('admin.contact.index', 'Contact deleted successfully' ,'success',false, false);
    }

    public function trashed() {
        $contacts = ContactUs::where('type', 1)->onlyTrashed()->get();
        // dd($contacts);
        return view('admin.all-contact',compact('contacts'));
    }
}
