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
use DB;

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
        $school_id = $this->request['data']['school_id'];
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
		$pool = '123456789ABCDEFGHJKLMNPRSTUVWXYZ';
        $passRand = substr(str_shuffle(str_repeat($pool, 5)), 0, 6);
            Participant::firstOrCreate([
                'name' => $data['name'],
                'nisn' => $data['nisn'],
                'password' => Hash::make($passRand),
                'visible' => $passRand,
                'major_id' => Major::where('name', $data['major'])->where('school_id', $school_id)->first()->id,
                'room_id' => DB::table('rooms')->select('rooms.id as id_room', 'majors.name as majoor_name')->join('masters', 'masters.id', '=', 'rooms.master_id')->join('majors', 'majors.id', '=', 'masters.major_id')->where('rooms.school_id', $school_id)->where('majors.name', 'LIKE', '%' .$data['major']. '%')->first()->id_room,
                'group_id' => Group::where('name', $data['group'])->where('school_id', $school_id)->first()->id,
                'school_id' => $school_id
            ]);
        }
    }
}
