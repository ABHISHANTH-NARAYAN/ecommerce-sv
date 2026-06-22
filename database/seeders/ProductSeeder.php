<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Color;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [

            ['Parle-G Biscuits', 'Popular glucose biscuits'],
            ['Monaco Biscuits', 'Light salted biscuits'],
            ['Krackjack', 'Sweet and salty biscuits'],
            ['Hide & Seek', 'Chocolate chip cookies'],
            ['Good Day Cashew', 'Butter cookies with cashew'],
            ['Bourbon Biscuit', 'Chocolate cream biscuit'],
            ['Marie Gold', 'Tea time biscuit'],
            ['50-50 Biscuit', 'Sweet and salty snack biscuit'],
            ['Tiger Biscuit', 'Energy biscuit'],
            ['Dark Fantasy', 'Chocolate filled cookies'],

            ['Maggi Noodles', 'Instant noodles'],
            ['Yippee Noodles', 'Long noodles'],
            ['Top Ramen', 'Instant noodles pack'],

            ['Dairy Milk', 'Milk chocolate'],
            ['KitKat', 'Wafer chocolate'],
            ['Munch', 'Crunchy chocolate wafer'],
            ['Perk', 'Chocolate coated wafer'],
            ['5 Star', 'Caramel chocolate'],
            ['Snickers', 'Peanut chocolate bar'],

            ['Sprite', 'Lemon soft drink'],
            ['Coca Cola', 'Soft drink'],
            ['Pepsi', 'Carbonated beverage'],
            ['Fanta', 'Orange flavored drink'],
            ['Maaza', 'Mango drink'],
            ['7UP', 'Lemon beverage'],

            ['Tata Salt', 'Iodized salt'],
            ['Aashirvaad Atta', 'Whole wheat flour'],
            ['Fortune Oil', 'Cooking oil'],
            ['India Gate Rice', 'Premium basmati rice'],
            ['Sugar Pack', 'Refined sugar'],

            ['Colgate Toothpaste', 'Dental care'],
            ['Closeup Toothpaste', 'Fresh breath toothpaste'],
            ['Dove Soap', 'Moisturizing soap'],
            ['Lux Soap', 'Beauty soap'],
            ['Lifebuoy Soap', 'Health soap'],
            ['Clinic Plus Shampoo', 'Hair care shampoo'],
            ['Sunsilk Shampoo', 'Smooth hair shampoo'],

            ['Dettol Liquid', 'Antiseptic liquid'],
            ['Harpic Cleaner', 'Toilet cleaner'],
            ['Lizol Floor Cleaner', 'Floor cleaning liquid'],

            ['Amul Butter', 'Pure butter'],
            ['Amul Cheese', 'Processed cheese'],
            ['Milk Powder', 'Instant milk powder'],

            ['Red Label Tea', 'Premium tea'],
            ['Bru Coffee', 'Instant coffee'],
            ['Nescafe Coffee', 'Coffee powder'],

            ['Bingo Chips', 'Potato chips'],
            ['Lays Chips', 'Crispy potato chips'],
            ['Kurkure', 'Masala snack'],
            ['Haldirams Mixture', 'Indian snack mix'],
        ];

        foreach ($products as $product) {

            $newProduct = Product::create([
                'brand_id'    => rand(1, 5),
                'name'        => $product[0],

                // ✅ PRICE ADDED (RANDOM REALISTIC RANGE)
                'price'       => rand(10, 500),

                'description' => $product[1],
                'status'      => rand(1, 10) > 2 ? 'Available' : 'Out of Stock',
                'stock'       => rand(0, 500),
                'image'       => null,
                'featured'    => rand(0, 1),
            ]);

            // Attach random colors (1 to 3 colors)
            $colorIds = Color::inRandomOrder()
                ->limit(rand(1, 3))
                ->pluck('id')
                ->toArray();

            $newProduct->colors()->attach($colorIds);
        }
    }
}