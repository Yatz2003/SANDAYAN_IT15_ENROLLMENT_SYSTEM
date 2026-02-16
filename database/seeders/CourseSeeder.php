<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            ['course_code' => 'PHY101', 'course_name' => 'Physics I', 'capacity' => 40],
            ['course_code' => 'CALC101', 'course_name' => 'Calculus I', 'capacity' => 35],
            ['course_code' => 'CALC102', 'course_name' => 'Calculus II', 'capacity' => 35],
            ['course_code' => 'CCE101', 'course_name' => 'Computer Science Fundamentals', 'capacity' => 30],
            ['course_code' => 'ATOZ124', 'course_name' => 'Data Structures and Algorithms', 'capacity' => 28],
            ['course_code' => 'NCGC456', 'course_name' => 'Database Management Systems', 'capacity' => 25],
            ['course_code' => 'ENG101', 'course_name' => 'English Composition', 'capacity' => 32],
            ['course_code' => 'CHEM101', 'course_name' => 'Chemistry Principles', 'capacity' => 38],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}

