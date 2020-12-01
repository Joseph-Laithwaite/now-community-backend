<?php

namespace App\Repositories;

use App\Models\Independent;
use App\Repositories\BaseRepository;

/**
 * Class IndependentRepository
 * @package App\Repositories
 * @version November 2, 2020, 10:55 pm UTC
*/

class IndependentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'slug',
        'business_structure',
        'email',
        'profile_picture',
        'cover_photo',
        'about_us'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Independent::class;
    }
}
