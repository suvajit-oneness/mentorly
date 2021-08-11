<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\MentorSlotBooked;
use App\Models\StripeTransaction;
use Illuminate\Http\Request;

class MentorSlotBookedController extends BaseController
{
    public function index()
    {
        $bookedSlots = MentorSlotBooked::get();
        return view('admin.slots.index', compact('bookedSlots'));
    }

    public function delete($id){
        $deleteSlot = MentorSlotBooked::find($id)->delete();
        if (!$deleteSlot) {
            return $this->responseRedirectBack('Error occurred while deleting booked slot.', 'error', true, true);
        }
        return $this->responseRedirect('admin.slot.index', 'Slot deleted successfully' ,'success',false, false);
    }

    public function trashed()
    {
        # code...
    }
}
