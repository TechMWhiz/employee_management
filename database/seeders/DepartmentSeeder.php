<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\SubDepartment;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            'IT' => ['Infrastructure', 'Software Development'],
            'HR' => ['Recruitment', 'Employee Relations'],
            'Finance' => ['Budgeting', 'Auditing'],
            'Engineering' => ['Research & Development', 'Quality Assurance'],
            'Design' => ['Graphic Design', 'UI/UX'],
            'Marketing' => ['Digital Marketing', 'Market Research'],
            'Support' => ['Customer Service', 'Technical Assistance'],
        ];

        foreach ($departments as $deptName => $subDepts) {
            $department = Department::firstOrCreate(
                ['name' => $deptName],
                ['category' => 'General', 'active' => true]
            );

            foreach ($subDepts as $subName) {
                SubDepartment::firstOrCreate([
                    'department_id' => $department->id,
                    'name' => $subName,
                ]);
            }
        }
    }
}
