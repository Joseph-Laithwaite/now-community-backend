<?php

namespace App\Http\Controllers\API;

// use App\Http\Requests\API\CreateImageAPIRequest;
// use App\Http\Requests\API\UpdateImageAPIRequest;
use App\Models\Image;
// use App\Repositories\ImageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\AuthController;

/**
 * Class ImageController
 * @package App\Http\Controllers\API
 */

class ImageAPIController extends AppBaseController
{
      public function store (Request $request) {
        // dd(Auth()->user()->id);
        if ($request->file('image')) {
             // Let's do everything here
            if ($request->file('image')->isValid()) {
                $validated = $request->validate([
                    'name' => 'required|string|max:40',
                    'description' => 'string|max:200|nullable',
                    'size' => 'required|integer',
                    'type' => 'required|string|max:20',
                    'user_id' => 'exists:users,id',
                    'image' => 'required|mimes:jpeg,png|max:1014',
                    'imageable_type' => 'required|string|max:50',
                    'imageable_id' => 'required|integer'
                ]);

                $type = substr($validated['imageable_type'], 11);
                $extension = $request->image->extension();
                $request->image->storeAs('/public/'.$type.'/'.$validated['imageable_id'], $validated['name'].".".$extension);
                // $request->image->storeAs('/public', $validated['name'].".".$extension);
                $url = Storage::url($type.'/'.$validated['imageable_id'].'/'.$validated['name'].".".$extension);
                $file = Image::create([
                   'name' => $validated['name'],
                   'description' => $validated['description'],
                    'size' => $validated['size'],
                    'type' => $validated['type'],
                    'user_id' => Auth()->user()->id,
                    'url' => $url,
                    'imageable_type' => $validated['imageable_type'],
                    'imageable_id' => $validated['imageable_id']
                ]);

                return $this->sendResponse(Image::find($file->id), 'Image stored successfully');
            }
        }
        return $this->sendError('Could not upload image',500);
    }

    public function index () {
        $images = Image::all();
        if (!$images) {
            return $this->sendError('No images found');
        }else{
            return $this->sendSuccess($images);            
        }
    }

    public function indexUserImages ($user_id) {
        $images = Image::where('user_id','=',$user_id)->get();
        if (sizeof($images) == 0) {
            return $this->sendError('No images found');
        }else{
            return $this->sendSuccess($images);            
        }
    }

    public function indexIndependentImages ($independent_id) {
        $images = Image::where('imageable_id','=',$independent_id)->where('imageable_type','=','App\Models\Independent')->get();
        if (sizeof($images) == 0) {
            return $this->sendError('No images found');
        }else{
            return $this->sendSuccess($images);            
        }
    }

    public function update(int $image_id, Request $request){
      $image = Image::find($image_id);
      if(is_null($image)){
          return $this->sendError('Image Not Found, can\'t be update');
        }else{
          $validated = $request->validate([
              'name' => 'required|string|max:40',
              'description' => 'string|max:200|nullable',
              'size' => 'required|integer',
              'type' => 'required|string|max:20',
              // 'user_id' => 'exists:users,id',
              'image' => 'required|mimes:jpeg,png|max:1014',
              'imageable_type' => 'required|string|max:50',
              'imageable_id' => 'required|integer'
          ]);
          $type = substr($validated['imageable_type'], 11);
          $extension = $request->image->extension();
          $request->image->storeAs('/public/'.$type.'/'.$validated['imageable_id'], $validated['name'].".".$extension);
          // $request->image->storeAs('/public', $validated['name'].".".$extension);
          $url = Storage::url($type.'/'.$validated['imageable_id'].'/'.$validated['name'].".".$extension);
        //   $url = $url->validate('required|string');
          $image->name = $validated['name'];
          $image->description = $validated['description'];
          $image->size = $validated['size'];
          $image->type = $validated['type'];
          // $image->user_id = $validated['user_id'];
          $image->url = $url;
          $image->imageable_type = $validated['imageable_type'];
          $image->imageable_id = $validated['imageable_id'];
          $image->save();
      }
    }

    public function show ($image_id) {
        $image = Image::find($image_id);
        if (!$image) {
            return $this->sendError('Image not found');
        }else{
            return $this->sendSuccess($image);            
        }
    }

    /**
     * Remove the specified Image from storage.
     * DELETE /images/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Image $image */
        $image = $this->imageRepository->find($id);

        if (empty($image)) {
            return $this->sendError('Image not found');
        }

        $image->delete();

        return $this->sendSuccess('Image deleted successfully');
    }
}
