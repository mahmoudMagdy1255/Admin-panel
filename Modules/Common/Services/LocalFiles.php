<?php

namespace Modules\Common\Services;
use File;
use Image;
trait LocalFiles {

	public function storeFile($file, $folder) {

		if (request()->hasFile($file)) {

			$file = request($file);

			$img = Image::make($file);

			// now you are able to resize the instance

			$img->resize(100, 100, function ($constraint) {
				$constraint->aspectRatio();
			});

			$img->resize(320, 240);

			$image_name = $file->getClientOriginalName();

			$image_path = public_path() . '/upload/' . $folder . '/' . $image_name;

			// finally we save the image as a new file
			$img->save($image_path);

			return $image_name;

		}

	}

	public function deleteFile($old_photo) {

		if (!str_contains($old_photo, 'default')) {
			return File::delete($old_photo);

		}

	}

	public function deleteAndStoreNewFile($old_photo, $file, $folder) {

		if (request()->hasFile($file)) {

			$this->deleteFile($old_photo);

			return $this->storeFile($file, $folder);

		}

	}

}