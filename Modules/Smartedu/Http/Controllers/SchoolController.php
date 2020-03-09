<?php

namespace Modules\Smartedu\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Smartedu\Entities\School;
use Modules\Smartedu\Http\Requests\SchoolRequest;
use Modules\Smartedu\Transformers\SchoolResource;

class SchoolController extends Controller
{
    public function index()
    {
        return SchoolResource::collection(School::with(['province','regency','level'])->orderBy('id', 'desc')->paginate(10));
    }

    public function store(SchoolRequest $request)
    {
        School::store($request);
        return SchoolResource::collection(School::orderBy('id', 'desc')->get());
    }
}
