<?php

namespace App\Http\Controllers;

use App\Tred;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreContent;
use App\Topic;

class TopicController extends Controller
{
	public function allTopics()
    {
        return view('welcome', ['data' => Topic::all()]);
    }

    public function newTopic()
    {
        return view('content.topic');
    }

    public function addTopic(StoreContent $request)
    {
    	$topic = new Topic($request->all());
        $topic->user()->associate(auth()->user());
        $topic->save();


    	return redirect()->route('topics');
    }

    public function  deleteTopic($topic)
    {
        Topic::destroy($topic);

        return redirect()->route('topics');
    }

    public function  deleteTopicForAdmin($topic)
    {
        Topic::destroy($topic);

        return redirect()->route('admin-panel');
    }

    public function forceDeleteTopic(Topic $topic)
    {
        $topic->forceDelete();

        return redirect()->route('admin-panel');
    }

    public function restoreTopic($topic)
    {
        Topic::withTrashed()->find($topic)->restore();

        return  redirect()->route('admin-panel');
    }
}
