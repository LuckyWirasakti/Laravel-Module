<?php

namespace Modules\School\Jobs;

use Illuminate\Bus\Queueable;
use Modules\School\Entities\Room;
use Modules\School\Entities\Group;
use Modules\School\Entities\Major;
use Modules\School\Entities\Master;
use Illuminate\Support\Facades\Hash;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Modules\School\Entities\Participant;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MasterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $request;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $school_id = $this->request['school_id'];
        for ($i=0; $i < count($this->request['data']['major']); $i++) {
            $group_id = Group::firstOrCreate([
                'name' => $this->request["data"]['group'][$i],
                'school_id' => $school_id
            ])->id;

            $major_id = Major::firstOrCreate([
                'name' => $this->request["data"]['major'][$i],
                'school_id' => $school_id
            ])->id;

            $master_id = Master::firstOrCreate([
                'group_id' => $group_id,
                'major_id' => $major_id,
                'school_id' => $school_id
            ])->id;

            Room::firstOrCreate([
                'name' => $this->request["data"]['room'][$i],
                'master_id' => $master_id,
                'school_id' => $school_id
            ]);
        }

        foreach($this->request['data']['participant'] as $data){
            Participant::firstOrCreate([
                'name' => $data['name'],
                'nisn' => $data['nisn'],
                'password' => Hash::make($data['password']),
                'visible' => $data['visible'],
                'major_id' => Major::where('name', $data['major'])->first()->id,
                'room_id' => Room::where('name', $data['room'])->first()->id,
                'group_id' => Group::where('name', $data['group'])->first()->id,
                'school_id' => $school_id
            ]);
        }
    }
}
