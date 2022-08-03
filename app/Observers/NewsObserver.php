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
        if( $news->image){
            $imagePath = 'storage/' . $news->image;

            $filetype = exif_imagetype($imagePath);
            // dd($filetype);
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

            $save = str_replace("storage/", "", $newImagePath);
            //  dd( $save);
            //Create the webp image.
            imagewebp($im, $newImagePath, $quality);
            news::where('id', $news->id)->update(['image' => $save]);
        }
        $photos = $news->pictures;
$json_photos = json_decode($photos, true);
if (!empty($json_photos)) {
    foreach ($json_photos as $key => $json_photo) {
        $photo = $json_photo['url'];
        $path = substr($photo, 1);


        $filetype = exif_imagetype($path);
            // dd( $filetype);
            if ($filetype == 2) {
                $im = imagecreatefromjpeg($path);
                $newImagePath = str_replace("jpeg", "webp", $path);
                $newImagePath = str_replace("jpg", "webp", $path);
            } elseif ($filetype == 3) {
                $im = imagecreatefrompng($path);
                $newImagePath = str_replace("png", "webp", $path);
            } elseif ($filetype == 1) {
                $im = imagecreatefromgif($path);
                $newImagePath = str_replace("gif", "webp", $path);
            } elseif ($filetype == 18) {
                $im = imagecreatefromwebp($path);
                $newImagePath = str_replace("webp", "webp", $path);
            }
            $quality = 1;

                $save = str_replace("storage", '/storage', $newImagePath);
                // dd($save);
                //  dd( $save);
                // Create the webp image.
                imagewebp($im, $newImagePath, $quality);

                $json_photos[$key]["url"]= $save;


    }
    // dd( $json_photos);
    $json_photos = json_encode($json_photos, true);
    $json_photos = json_encode($json_photos, true);
    // dd( $json_photos);
    news::where('id', $news->id)->update(['pictures' => $json_photos]);

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

if( $news->image){
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

            $save = str_replace("storage/", "", $newImagePath);

            //  dd( $save);
            //Create the webp image.
            imagewebp($im, $newImagePath, $quality);
            news::where('id', $news->id)->update(['image' => $save]);

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
