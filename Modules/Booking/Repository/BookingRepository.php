<?php

namespace Modules\BookingModule\Repository;

use Modules\BookingModule\Entities\Booking;

class BookingRepository
{
    public function findAll()
    {
        $bookingList = Booking::all();
        return $bookingList;
    }

    public function find($id)
    {
        return Booking::where('id', $id)->first();
    }

    public function save($data)
    {
        $booking = Booking::create($data);
        return $booking;
    }

    public function update($id, $data)
    {
        $booking = $this->find($id);
        $booking->update($data);
        return $trip;
    }

    public function delete($booking)
    {
        Booking::destroy($booking->id);
    }

}
