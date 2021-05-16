<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// javaで言うimport
use App\PhotoInfo;
class PhotoInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*
    --photoInfosの一覧表示
    return json形式のphotoInfosテーブルのデータ

    この変数$photoInfosをview側でjson形式でresponseする
    */
    public function index()
    {
        $photoInfo = PhotoInfo::all();

        return response()->json(['photoInfo' => $photoInfo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($request)
    {
        PhotoInfo::create($request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    // 登録メソッド
    {
        $photoInfo = new PhotoInfo();
        $photoInfo->fill($request->all())->save();

        /*
        PHPでの標準的は登録処理はこのようにフォームの値をrequestから各項目から1つずつデータを受け取って処理
        $photoInfo->photo_id = $request->input('photo_id');
        $photoInfo->shooting_location = $request->input('shooting_location');

        $photoInfo->save();
        */

        return redirect()->route('photoInfo.show');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
