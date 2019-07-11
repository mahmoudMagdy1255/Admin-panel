<?php

namespace Modules\Common\Services;
use File;
use Image;
trait LocalFiles {

	public function storeFile($file, $folder, $option = false) {

		if (request()->hasFile($file)) {

			$files = request($file);

			if (is_array($files)) {

				foreach ($files as $file) {
					return $this->upload($file, $folder, $option);
				}

			} else {
				return $this->upload($files, $folder, $option);
			}

		}

	}

	private function upload($file, $folder, $option) {

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

		if ($option) {
			return [
				'image' => $image_name,
				'size' => $file->getSize(),
				'mime_type' => $file->getMimeType(),
			];
		}

		return $image_name;

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