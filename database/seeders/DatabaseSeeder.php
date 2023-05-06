<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\Concerns\Has;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123')
        ]);

        Recipe::create([
            'date' => '2023-04-25',
            'breakfast' => 'Milk + oats + half a cucumber + half a carrot',
            'lunch' => 'Chicken + cornmeal steamed bun + cabbage tofu soup + cold broccoli fungus',
            'dinner' => 'Yogurt + Homemade Veggie Pot + Half Loaf of Bread',
            'user_id' => 1
        ]);
        Recipe::create([
            'date' => '2023-04-26',
            'breakfast' => '2 eggs + 1 apple + millet porridge',
            'lunch' => 'Yogurt + Homemade Fat Reduction Meal (Purple Rice + 3 Broccoli + Tomato + Tomato + Cucumber + Fungus + Onion + Green Pepper)',
            'dinner' => 'Tomato and Egg Soup + Vegetable Bun',
            'user_id' => 1
        ]);
        Recipe::create([
            'date' => '2023-04-27',
            'breakfast' => 'Milk + half a piece of cornmeal steamed bread + banana',
            'lunch' => 'Homemade nutritious noodle soup (ramen + diced chicken + tomato + cabbage + lettuce) + 1 cucumber or carrot',
            'dinner' => 'White radish soup + tomato + fried green beans + small bowl of rice',
            'user_id' => 1
        ]);

        User::factory()
            ->count(6)
            ->hasRecipes(3)
            ->create();
    }
}
