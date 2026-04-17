<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            'IT',
            'HR',
            'Finance',
            'Engineering',
            'Design',
            'Marketing',
            'Support',
        ];

        foreach ($departments as $name) {
            Department::firstOrCreate([
                'name' => $name,
            ], [
                'category' => null,
                'active' => true,
            ]);
        }
    }
}
