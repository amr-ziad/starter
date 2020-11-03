<?php

namespace App\Listeners;

use App\Events\VideoViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TncreaseCounte
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(VideoViewer $event)
    {
        //اذا كان اليوزر شاهد الفيديو ومسجل في السيشن لا تزيد المشاهدات
        if(!session()->has('Video is Vistied'))
        {
            $this->updateviewer($event->video);
        }
        else{
            return false;
        }
        //
    }

    function updateviewer($video)
    {
        $video->viewer=$video->viewer+1; //i++
         $video->save();
        session()->put('Video is Vistied',$video->id);
    }
}
