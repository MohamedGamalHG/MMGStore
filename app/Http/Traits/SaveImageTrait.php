<?php


namespace App\Http\Traits;


use App\Models\Image;

trait SaveImageTrait
{
    function save_images($photo,$folder,$product_id){
        if($photo){
            foreach ($photo as $photos){
//                $file_name = $photo->getClientOrigianlName();
//                //$file_name = $photo->getClientOrigianlExtension();
//                $file_path = $folder;
                $photos->storeAs($folder.$product_id,$photos->getClientOriginalName(),'public');
                $photos->move(public_path($folder.$product_id),$photos->getClientOriginalName());

                $img = new Image();
                $img->name = $photos->getClientOriginalName();
                $img->product_id = $product_id;
                $img->save();
            }
            return true;
        }
        else
            return  false;
    }
}
