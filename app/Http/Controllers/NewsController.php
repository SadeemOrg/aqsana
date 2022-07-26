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


        $news =   News::orderBy('created_at', 'desc')->paginate(15);
        return response($news, 200);

    }


    /**
     * show  News by id
     *
     *@urlParam id int required
     */
    public function show($id)
    {

        $new = News::find($id);
        if (is_null($new)) {
            return $this->sendError('News not found!');
        }
        return $this->sendResponse($new, 'News retireved Successfully!');
    }



}
