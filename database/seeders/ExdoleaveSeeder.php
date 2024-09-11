<?php

namespace Database\Seeders;

use App\Models\Annualeave;
use App\Models\Employes;
use App\Models\Exdoleave;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExdoleaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $emp = Employes::find(301);

        $annual = Annualeave::where('employes_id', $emp->id)->first();

        for ($i = 0; $i < 3; $i++) {
            $data = [
                'employes_id'   => $emp->id,
                'nik'           => $emp->nik,
                'date'          => Carbon::now(),
                'amount'        => rand(1, 4),
                'expired'       => Carbon::now()->add(rand(1, 4), 'day'),
                'note'          => "sync",
                'make_it'       => rand(10, 301)
            ];

            Exdoleave::create($data);
            $count = $annual->totalExdo + $data['amount'];

            $annual->update([
                'totalExdo' => $count
            ]);
        }
    }
}
