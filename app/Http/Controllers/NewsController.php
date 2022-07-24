<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;

/**
 * @group   Story  management
 *
 * APIs for managing  Story
 *
 *
 */
class NewsController extends BaseController
{

    /**
     *   all News
     *
     *
     */
    public function index()
    {

        $News =   News::orderBy('created_at', 'desc')->paginate(15);
        return response($News, 200);
    }


    /**
     * show  News by id
     *
     *@urlParam id int required
     */
    public function show($id)
    {

        $New = News::find($id);
        if (is_null($New)) {
            return $this->sendError('Post not found!');
        }
        return $this->sendResponse($New, 'Post retireved Successfully!');
    }



}
