<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreContent;
use App\Topic;
use App\Tred;

class TredController extends Controller
{
    public function tredsAction(Topic $topic)
    {
        return view('content.treds', [
            'treds' => $topic->load('treds')->treds,
            'topicId' => $topic->id
            //запа'ятовує айді топіка щоб потім відкрити написання треду
        ]);
    }

    public function newTred(Topic $topic)
    {
        return view('content.new_tred', ['topicId' => $topic->id]);
    }

    public function addTred(Topic $topic, Request $request)
    {
    	$tred = new Tred($request->all());
    	$tred->user()->associate(auth()->user());
    	$tred->topics()->associate($topic);
    	$tred->save();

    	return redirect()->route('treds', [$topic->id]);
    }

    public function  deleteTred(Topic $topic, Tred $tred)
    {
        $tred->delete();

        return redirect()->route('treds', [$topic->id]);
    }

    public function  deleteTredForAdmin(Topic $topic, Tred $tred)
    {
        $tred->delete();

        return redirect()->route('admin-treds', [$topic->id]);
    }

    public function  forceDeleteTred(Topic $topic, Tred $tred)
    {
        $tred->forceDelete();

        return redirect()->route('admin-treds', [$topic->id]);
    }

    public function tredsActionForAdmin(Topic $topic)
    {
        return view('admin.admin_treds', [
            'treds' => $topic->load('treds')->treds,
            'topicId' => $topic->id
        ]);
    }

    public function restoreTred($tred)
    {
        Tred::withTrashed()->find($tred)->restore();

        return  redirect()->route('admin-panel');
    }
}
