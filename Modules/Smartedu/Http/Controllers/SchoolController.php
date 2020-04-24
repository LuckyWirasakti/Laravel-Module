<?php

namespace Modules\Smartedu\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Modules\Smartedu\Entities\Level;
use Modules\Smartedu\Entities\School;
use Modules\Smartedu\Entities\Regency;
use Modules\Smartedu\Entities\Province;
use Modules\Smartedu\Http\Requests\ImportRequest;
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
        School::create([
            'name' => $request->name,
            'province_id' => $request->province_id,
            'regency_id' => $request->regency_id,
            'level_id' => $request->level_id,
            'username' => $request->username,
            'visible' => $request->password,
            'password' => Hash::make($request->password),
            'name' => $request->name,
        ]);

        return $this->index();
    }

    public function import(ImportRequest $request)
    {
        School::create([
            'name' => $request->name,
            'province_id' => Province::firstOrCreate([
                'name' => $request->province->name
            ])->id,
            'regency_id' => Regency::firstOrCreate([
                'name' => $request->province->name,
                'province_id' => Province::firstOrCreate([
                    'name' => $request->province->name
                ])->id
            ])->id,
            'level_id' => Level::firstOrCreate([
                'name' => $request->level->name
            ])->id,
            'username' => $request->username,
            'visible' => $request->password,
            'password' => Hash::make($request->password),
            'name' => $request->name,
        ]);
        return $this->index();
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name'           => 'required',
            'level_id'       => 'required',
            'regency_id'     => 'required',
            'province_id'    => 'required',
        ]);

        $school = School::where('id', $id)
        ->update([
            'name'          => $request->name,
            'level_id'      => $request->level_id,
            'regency_id'    => $request->regency_id,
            'province_id'   => $request->province_id,
        ]);
        return response()->json(['success' => 'Berhasil Update'], 200);
    }

}
