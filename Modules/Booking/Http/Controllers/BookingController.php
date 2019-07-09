<?php

namespace Modules\BookingModule\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\TripModule\Repository\TripRepository;
use Modules\BookingModule\Repository\BookingRepository;
use Yajra\DataTables\Facades\DataTables;

class BookingController extends Controller
{

    private $bookingRepo, $tripRepo;

    public function __construct(BookingRepository $bookingRepo, TripRepository $tripRepo) {
        $this->bookingRepo = $bookingRepo;
        $this->tripRepo = $tripRepo;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $booking_list = $this->bookingRepo->findAll();
        return view('bookingmodule::index', ['bookinglist' => $booking_list]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('bookingmodule::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $this->bookingRepo->save($data);
        // return redirect('admin-panel/admins')->with('success','Successfully add');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $book = $this->bookingRepo->find($id);

        return view('bookingmodule::show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $book = $this->bookingRepo->find($id);

        return view('bookingmodule::edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        $this->bookingRepo->update($id, $data);

        return redirect('admin-panel/booking/'.$id)->with('success','Successfully edit');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $book = $this->bookingRepo->find($id);
        $this->bookingRepo->delete($book);

        return redirect()->back();
    }

    public function dataTables()
    {
        $booking_list = $this->bookingRepo->findAll();

        return DataTables::of($booking_list)
            ->addColumn('id', function($row) {
                return  $row->id;
            })
            ->addColumn('trip_id', function($row) {
                return  $row->trip_id;
            })
            ->addColumn('name', function($row) {
                return  $row->name;
            })
            ->addColumn('mobile', function($row) {
                return  $row->mobile;
            })
            ->addColumn('departure_date', function($row) {
                return  $row->departure_date;
            })
            ->addColumn('arrival_date', function($row) {
                return  $row->arrival_date;
            })
            ->addColumn('operations', function($row) {
                $delete_tag ='<a href="'. url('admin-panel/booking/delete', $row->id) .'" class="btn btn btn-danger" onclick="return confirm(\'Are you sure, You want to delete this Data?\')"><i class="glyphicon glyphicon-trash"></i></a>';
                $edit_tag ='<a href="'. url("admin-panel/booking/".$row->id."/edit") .'" type="button" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
                $show_tag = '<a href="'. url("admin-panel/booking/" . $row->id) .'" type="button" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>';

                return $show_tag . ' &nbsp; ' .$edit_tag.' &nbsp; '.$delete_tag;
            })
            ->rawColumns(['delete' => 'delete','operations' => 'operations'])
            ->make(true);
    }
}
