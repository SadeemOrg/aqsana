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

        $imagePath = 'storage/' . $news->image;

        $filetype = exif_imagetype($imagePath);
        dd(   $filetype);
        if ($filetype == 2) {
           $im = imagecreatefromjpeg($imagePath);
        } elseif ($filetype == 3) {
           $im = imagecreatefrompng($imagePath);
        } elseif ($filetype == 1) {
           $im = imagecreatefromgif($imagePath);
        } elseif ($filetype == 18) {
           $im = imagecreatefromwebp($imagePath);
        }
        //Create an image object.
        // $im = imagecreatefromjpeg($imagePath);

        //The path that we want to save our webp file to.
        $newImagePath = str_replace("jpg", "webp", $imagePath);

        //Quality of the new webp image. 1-100.
        //Reduce this to decrease the file size.
        $quality = 1;

         $save= str_replace("storage/", "", $newImagePath);
        //  dd( $save);
        //Create the webp image.
        imagewebp($im, $newImagePath, $quality);
        news::where('id', $news->id)->update(['image' => $save]);
    }

    /**
     * Handle the News "updated" event.
     *
     * @param  \App\Models\News  $news
     * @return void
     */
    public function updated(News $news)
    {

        $imagePath = 'storage/' . $news->image;

        $filetype = exif_imagetype($imagePath);
        // dd( $filetype);
        if ($filetype == 2) {
           $im = imagecreatefromjpeg($imagePath);
           $newImagePath = str_replace("jpeg", "webp", $imagePath);
           $newImagePath = str_replace("jpg", "webp", $imagePath);
        } elseif ($filetype == 3) {
           $im = imagecreatefrompng($imagePath);
           $newImagePath = str_replace("png", "webp", $imagePath);

        } elseif ($filetype == 1) {
           $im = imagecreatefromgif($imagePath);
           $newImagePath = str_replace("gif", "webp", $imagePath);

        } elseif ($filetype == 18) {
           $im = imagecreatefromwebp($imagePath);
           $newImagePath = str_replace("webp", "webp", $imagePath);

        }
        //Create an image object.
        // $im = imagecreatefromjpeg($imagePath);

        //The path that we want to save our webp file to.
        // $newImagePath = str_replace("jpg", "webp", $imagePath);

        //Quality of the new webp image. 1-100.
        //Reduce this to decrease the file size.
        $quality = 1;

         $save= str_replace("storage/", "", $newImagePath);
        //  dd( $save);
        //Create the webp image.
        imagewebp($im, $newImagePath, $quality);
        news::where('id', $news->id)->update(['image' => $save]);

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
