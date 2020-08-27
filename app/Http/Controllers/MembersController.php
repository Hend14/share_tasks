<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Group;
use App\User;

class MembersController extends Controller
{
    public function store(Group $group, Request $request)
    {
        Auth::user()->joinGroup($group->id);

        return back();
    }

    public function destroy(Group $group, Request $request)
    {
        Auth::user()->leaveGroup($group->id);

        return back();
    }
}
