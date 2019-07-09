<?php

namespace Modules\TripModule\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\TripModule\Repository\TripRepository;
use Modules\TripModule\Repository\TripProgramRepository;

class TripProgramController extends Controller
{
    protected $programRepo, $tripRepo;

    public function __construct(TripProgramRepository $programRepo, TripRepository $tripRepo)
    {
        $this->programRepo = $programRepo;
        $this->tripRepo = $tripRepo;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create($id)
    {
        $trip = $this->tripRepo->find($id);

        return view('tripmodule::Program.create', ['trip' => $trip]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $this->programRepo->save($data);

        return redirect()->back()->with('success', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $program = $this->programRepo->find($id);

        return view('tripmodule::Program.edit', ['program' => $program]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token', '_method', 'ar', 'en');
        $trip_id = $request->trip_id;

        $activeLangCode = \LanguageHelper::getDynamicLangCode();
        $data_trans = $request->only($activeLangCode);


        $this->programRepo->update($id, $data, $data_trans);

        return redirect('admin-panel/trip-program/' . $trip_id)->with('updated', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->programRepo->delete($id);
        return redirect()->back();
    }
}
