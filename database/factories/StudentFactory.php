<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        $firstName = $this->faker->firstName;
        $lastName = $this->faker->lastName;
        $studentNumber = $this->faker->unique()->numberBetween(100000, 999999);
        $firstInitial = strtolower(substr($firstName, 0, 1));
        $lastNameLower = strtolower($lastName);
        return [
            'student_number' => $studentNumber,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $firstInitial . '.' . $lastNameLower . '.' . $studentNumber . '.tc@umindanao.edu.ph',
            'password' => bcrypt('password'),
        ];
    }
}
