<?php

namespace Modules\TripModule\Repository;

use File;
use Modules\CommonModule\Helper\BaseHelper;
use Modules\TripModule\Entities\Trip;
use Modules\TripModule\Entities\TripPhotos;


class TripPhotosRepository
{
    use BaseHelper;

  /**
   * Find All images By trip_id.
   *
   * @return void
   */
  public function findAll($trip_id)
  {
    $trip = Trip::where('id', $trip_id)->with('photos')->first();

    return $trip;
  }

  /**
   * Save Current Uploaded image on the Trip page.
   *
   * @return void
   */
  public function save($trip, $pics)
  {
    $trip_photos_many = $this->prepareData($pics, 'photo'); //* 'photo' IS COL NAME IN DB.

    $trip->photos()->createMany($trip_photos_many); // using relation: Photo Album Inserted.
  }

  /**
   * Delete Images.
   *
   * @return void
   */
  public function delete($trip)
  {
    # Delete Photo Albums from /Images/trips.
    if ($trip->photos->all()) {
      $file_path = [];
      foreach ($trip->photos->all() as $photo) {
        $file_path[] = public_path() . '/images/trips/' . $photo->photo;
      }

      File::delete($file_path);
    }
  }

  public function deletePic($id)
  {
    $pic = TripPhotos::where('id', $id)->first();
    $file_path = public_path() . '/images/trips/' . $pic->photo;
    File::delete($file_path);

    return TripPhotos::destroy($pic->id);
  }
}
