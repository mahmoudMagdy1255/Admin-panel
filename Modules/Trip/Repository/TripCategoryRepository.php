<?php

namespace Modules\TripModule\Repository;

use Modules\TripModule\Entities\TripCategory;


class TripCategoryRepository
{
    public function findAll()
    {
        return TripCategory::with(['child', 'translations', 'child.translations'])->get();
    }

    public function findAllParent()
    {
        $parents = TripCategory::with(['child', 'translations', 'child.translations'])->where('parent_id', null)->get();

        return $parents;
    }

    public function findAllChild()
    {
        $child = TripCategory::with(['translations'])->where('parent_id', '!=', null)->get();

        return $child;
    }

    public function find($id)
    {
        return TripCategory::where('id', $id)->first();
    }

    public function store($data)
    {
        return TripCategory::create($data);
    }

    public function update($id, $data, $data_trans)
    {
        $trip = $this->find($id);
        $trip->update($data);

        foreach (\LanguageHelper::getLang() as $lang) {

            if ($trip->hasTranslation('' . $lang->lang)) {
            } else {
                $trip->translateOrNew('' . $lang->lang);
            }
            if (isset($data_trans[$lang->lang]['title'])) {
                $trip->translate('' . $lang->lang)->title = $data_trans[$lang->lang]['title'];
            }
            if (isset($data_trans[$lang->lang]['description'])) {
                $trip->translate('' . $lang->lang)->description = $data_trans[$lang->lang]['description'];
            }
            if (isset($data_trans[$lang->lang]['meta_title'])) {
                $trip->translate('' . $lang->lang)->meta_title = $data_trans[$lang->lang]['meta_title'];
                $trip->translate('' . $lang->lang)->meta_desc = $data_trans[$lang->lang]['meta_desc'];
                $trip->translate('' . $lang->lang)->slug = $data_trans[$lang->lang]['slug'];
                $trip->translate('' . $lang->lang)->meta_keywords = $data_trans[$lang->lang]['meta_keywords'];
            }

            $trip->save();
        }
        return $trip;
    }

    public function delete($id)
    {
        //! Make Sure of it.
        return TripCategory::destroy($id);
    }
}
