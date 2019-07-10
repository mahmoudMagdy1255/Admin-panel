<?php

namespace Modules\TripModule\Repository;

use Modules\TripModule\Entities\TripProgram;


class TripProgramRepository
{
    # find.
    public function find($id)
    {
        return TripProgram::with('trip')->where('id', $id)->first();
    }

    # find all resources.
    public function findAll()
    {
        return TripProgram::with('trip')->get();
    }

    # save.
    public function save($data)
    {
        return TripProgram::create($data);
    }

    # update
    public function update($id, $data, $data_trans)
    {
        $program = $this->find($id);
        $program->update($data);

        foreach (\LanguageHelper::getLang() as $lang) {

            if ($program->hasTranslation('' . $lang->lang)) {
            } else {
                $program->translateOrNew('' . $lang->lang);
            }

            $program->translate('' . $lang->lang)->title = $data_trans[$lang->lang]['title'];
            $program->translate('' . $lang->lang)->description = $data_trans[$lang->lang]['description'];

            $program->save();
        }
          return $program;

    }

    # delete
    public function delete($id)
    {
        return TripProgram::destroy($id);
    }

}
