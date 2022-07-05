<?php

namespace App\Observers;

use App\Models\News;

class NewsObserver
{
    /**
     * Handle the News "created" event.
     *
     * @param  \App\Models\News  $news
     * @return void
     */
    public function created(News $news)
    {


        //picture
        $path = 'storage/' . $news->image;
        $mime = mime_content_type($path);

        $filetype = exif_imagetype($path);
        if ($filetype == 2) {
            $image = imagecreatefromjpeg($path);
        } elseif ($filetype == 3) {
            $image = imagecreatefrompng($path);
        } elseif ($filetype == 1) {
            $image = imagecreatefromgif($path);
        }
        imagejpeg($image, $path, 20);
        // photos

        $photos = $news->pictures;
        $json_photos = json_decode($photos, true);
        if (!empty($json_photos)) {
            foreach ($json_photos as $key => $json_photo) {
                $photo = $json_photo['url'];
                $path = substr($photo, 1);
                $filetype = exif_imagetype($path);
                if ($filetype == 2) {
                    $image = imagecreatefromjpeg($path);
                } elseif ($filetype == 3) {
                    $image = imagecreatefrompng($path);
                } elseif ($filetype == 1) {
                    $image = imagecreatefromgif($path);
                }
                imagejpeg($image, $path, 20);
            }
        }
    }

    /**
     * Handle the News "updated" event.
     *
     * @param  \App\Models\News  $news
     * @return void
     */
    public function updated(News $news)
    {


        //picture
        $path = 'storage/' . $news->image;
        $mime = mime_content_type($path);

        $filetype = exif_imagetype($path);
        if ($filetype == 2) {
            $image = imagecreatefromjpeg($path);
        } elseif ($filetype == 3) {
            $image = imagecreatefrompng($path);
        } elseif ($filetype == 1) {
            $image = imagecreatefromgif($path);
        }
        elseif ($filetype == 18) {
            $image = imagecreatefromwebp($path);
        }
        imagejpeg($image, $path, 20);
        // photos

        $photos = $news->pictures;
        $json_photos = json_decode($photos, true);
        if (!empty($json_photos)) {
            foreach ($json_photos as $key => $json_photo) {
                $photo = $json_photo['url'];
                $path = substr($photo, 1);
                $filetype = exif_imagetype($path);
                if ($filetype == 2) {
                    $image = imagecreatefromjpeg($path);
                } elseif ($filetype == 3) {
                    $image = imagecreatefrompng($path);
                } elseif ($filetype == 1) {
                    $image = imagecreatefromgif($path);
                }
                elseif ($filetype == 18) {
                    $image = imagecreatefromwebp($path);
                }
                imagejpeg($image, $path, 20);
            }
        }
    }

    /**
     * Handle the News "deleted" event.
     *
     * @param  \App\Models\News  $news
     * @return void
     */
    public function deleted(News $news)
    {
        //
    }

    /**
     * Handle the News "restored" event.
     *
     * @param  \App\Models\News  $news
     * @return void
     */
    public function restored(News $news)
    {
        //
    }

    /**
     * Handle the News "force deleted" event.
     *
     * @param  \App\Models\News  $news
     * @return void
     */
    public function forceDeleted(News $news)
    {
        //
    }
}
