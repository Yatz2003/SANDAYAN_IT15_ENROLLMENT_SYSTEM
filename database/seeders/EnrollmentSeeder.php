<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Course;

class EnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::all();
        $courses = Course::all();

        foreach ($students as $student) {
            $coursesToEnroll = $courses->random(rand(1, 3));
            foreach ($coursesToEnroll as $course) {
                if (!$student->courses()->where('course_id', $course->id)->exists()) {
                    $student->courses()->attach($course->id);
                }
            }
        }
    }
}
