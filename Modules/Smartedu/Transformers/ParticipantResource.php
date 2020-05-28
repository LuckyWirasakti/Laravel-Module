<?php

namespace Modules\Smartedu\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ParticipantResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'nisn' => $this->nisn,
            'password' => $this->visible,
            'user_email' => $this->email,
            'user_phone' => $this->phone,
            'user_tempat_lahir' => $this->tempat_lahir,
            'user_tanggal_lahir' => $this->tanggal_lahir,
            'user_orangtua' => $this->nama_orang_tua,
            'user_phone_orangtua' => $this->phone_orang_tua,
            'user_foto' => $this->foto,
            'group' => [
                'id' => $this->group->id,
                'name' => $this->group->name
            ],
            'major' => [
                'id' => $this->major->id,
                'name' => $this->major->name
            ],
            'room' => [
                'id' => $this->room->id,
                'name' => $this->room->name
            ],
            'school' => [
                'id' => $this->school->id,
                'name' => $this->school->name
            ],
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans()
        ];
    }
}