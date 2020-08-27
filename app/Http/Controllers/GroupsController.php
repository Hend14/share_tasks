<?php

namespace App\Http\Controllers;

use App\User;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GroupsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $groups = Group::all();

        // dd($groups);
        return view('groups.index', compact('user', 'groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return view('groups.create', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group = new Group;
        $group->name = $request->name;
        $group->create_user_id = $request->user()->id;
        $group->group_img = $request->group_img;

          //ファイルが選択されていればs3へアップロード,post_imgカラムにパスを保存
          if ($request->hasFile('group_img')) {
            // MEMO: リサイズ処理（GD, Imagemagick）
            // Service層を導入してImageServiceクラスの関数に移す
            // 入力：$request->file('post_img')、返り値：S3上の画像パス
            $group->group_img = Storage::disk(config('filesystems.default'))->putFile('/group_img', $request->file('group_img'), 'public');
        } else {
            $request->group_img = null;
        }

        // dd(Storage::disk(config('s3'))->url($post->post_img));
        // dd($group);
        $group->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        $users = $group->users();

        // dd($users);

        return view('groups.show', compact('users', 'group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        if (Auth::id() === $group->user_id) {
            $group->delete();
        }

        return redirect('/groups');
    }
}