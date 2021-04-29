<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $vendor_id = User::inRandomOrder()->where('role',1)->first();
        //Model::inRandomOrder()->select('column')->where('column','value')->first();

        $randomTypeNum = rand(0,1);        //Gives a number between 0,1 or 2
        $type="";                                       //prouct type and pages/ play length
        $pageslength;
        if($randomTypeNum==0)                                   
        { $type="book"; $pageslength = rand(50,1000); }
        else
        { $type = "cd"; $pageslength = rand(1,30);}

        $price = rand(500,10000)/rand(1,450);                   //product price
        $price = number_format($price, 2, '.', '');

        return [
            'firstname' => $this->faker->firstName,
            'type' =>$type,
            'mainname' => $this->faker->lastName,
            'title' => $this->faker->text(20) , 
            'price' => $price,
            'pageslength' => $pageslength,
            'user_id'=>$vendor_id
        ];
    }
}
