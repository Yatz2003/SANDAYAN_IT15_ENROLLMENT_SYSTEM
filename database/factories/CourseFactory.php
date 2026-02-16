<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    private $courses = [
        ['code' => 'PHY101', 'name' => 'Physics I'],
        ['code' => 'CALC101', 'name' => 'Calculus I'],
        ['code' => 'CALC102', 'name' => 'Calculus II'],
        ['code' => 'CCE101', 'name' => 'Computer Science Fundamentals'],
        ['code' => 'ATOZ124', 'name' => 'Data Structures and Algorithms'],
        ['code' => 'NCGC456', 'name' => 'Database Management Systems'],
        ['code' => 'ENG101', 'name' => 'English Composition'],
        ['code' => 'CHEM101', 'name' => 'Chemistry Principles'],
    ];

    public function definition()
    {
        $course = $this->faker->randomElement($this->courses);
        return [
            'course_code' => $course['code'],
            'course_name' => $course['name'],
            'capacity' => $this->faker->numberBetween(20, 50),
        ];
    }
}
