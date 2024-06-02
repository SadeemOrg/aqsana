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
        $news = News::orderBy('created_at', 'desc')->paginate(10); // Assuming 10 items per page

        foreach ($news as $item) {
            $news_pictures = [];
            $pictures = json_decode($item->pictures, true);
            if (is_array($pictures)) {
                foreach ($pictures as $picture) {
                    $news_pictures[] = $picture['url'];
                }
                $item->news_pictures = $news_pictures;
            } else {
                $item->news_pictures = [];
            }
        }


        return $this->sendResponse($news, 'Success get projects');
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
