<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * ユーザーをお気に入り登録するアクション。
     *
     * @param  $id  相手ユーザーのid
     * @return \Illuminate\Http\Response
     */
    public function store(string $id)
    {
        // 認証済みユーザー（閲覧者）が、 idのユーザーをお気に入り登録する
        \Auth::user()->favorite(intval($id));
        // 前のURLへリダイレクトさせる
        return back();
    }

    /**
     * ユーザーをお気に入りから外すアクション。
     *
     * @param  $id  相手ユーザーのid
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        // 認証済みユーザー（閲覧者）が、 idのユーザーをお気に入りを外す
        \Auth::user()->unfavorite(intval($id));
        // 前のURLへリダイレクトさせる
        return back();
    }
}
