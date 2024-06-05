<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileImageUpdateRequest;
use App\Models\User;
use App\Services\FileStoreService;
use App\Services\JsonResponseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class ProfileController extends Controller
{
    //

    public function pic_update(ProfileImageUpdateRequest $request)
    {

        try {
            
            if ($request->hasFile('pic')) {
                $file = public_path('images/users/' . auth()->user()->image);


                $filename = FileStoreService::ImageStore($request->pic, 'images/users');
                $img = User::whereId(auth()->user()->id)->update([
                    'image' => $filename
                ]);
                if ($img > 0) {
                    DB::commit();
                    File::exists($file)
                        ? File::delete($file)
                        : '';
                    return JsonResponseService::getJsonSuccess('Profile Pic  Updated Successfully');
                }
                DB::rollBack();
                return JsonResponseService::getJsonFailed('Failed to update Profile Pic ');
            }
        } catch (Exception $exception) {
            DB::rollBack();
            return  JsonResponseService::getJsonException($exception);
        }
    }


    
}
