<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // choose a gender, stick to male/female for simplicity
        $gender = $this->faker->randomElement(['male', 'female']);

        // choose a first_name based upon the gender and use that also as the known_as for simplicity.
        $first_name = $this->faker->firstName($gender);

        return [
            'first_name' => $first_name,
            'last_name'  => $this->faker->lastName(),
            'known_as'   => $first_name,
            'title'      => $this->faker->title($gender),
        ];
    }
}
