<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::truncate();

        $products = [
            ["name" => "Fresh Toned Milk 500ml", "price" => 25, "category" => "Dairy & Breakfast", "stock" => 100, "image" => "https://images.unsplash.com/photo-1550583724-b2692b85b150?w=300&q=80"],
            ["name" => "Farm Fresh Eggs 6 pcs", "price" => 40, "category" => "Dairy & Breakfast", "stock" => 50, "image" => "https://images.unsplash.com/photo-1506976785307-8732e854ad03?w=300&q=80"],
            ["name" => "Whole Wheat Bread", "price" => 50, "category" => "Dairy & Breakfast", "stock" => 30, "image" => "https://images.unsplash.com/photo-1509440159596-0249088772ff?w=300&q=80"],
            ["name" => "Premium Basmati Rice 1kg", "price" => 120, "category" => "Pantry Staples", "stock" => 200, "image" => "https://images.unsplash.com/photo-1586201375761-83865001e8ac?w=300&q=80"],
            ["name" => "Sunflower Refined Oil 1L", "price" => 150, "category" => "Pantry Staples", "stock" => 100, "image" => "https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=300&q=80"],
            ["name" => "Mixed Fruit Juice 1L", "price" => 99, "category" => "Beverages", "stock" => 40, "image" => "https://images.unsplash.com/photo-1622597467836-f38240662f11?w=300&q=80"],
            ["name" => "Antibacterial Soap 3x100g", "price" => 85, "category" => "Personal Care", "stock" => 60, "image" => "https://images.unsplash.com/photo-1600857062241-98e5dba7f214?w=300&q=80"],
            ["name" => "Anti-Dandruff Shampoo 400ml", "price" => 250, "category" => "Personal Care", "stock" => 25, "image" => "https://images.unsplash.com/photo-1535585209827-a15fcdbc4c2d?w=300&q=80"],
            ["name" => "Potato Chips Classic Salted", "price" => 20, "category" => "Snacks & Munchies", "stock" => 150, "image" => "https://images.unsplash.com/photo-1566478989037-e924e50cb528?w=300&q=80"],
            ["name" => "Chocolate Chip Cookies", "price" => 45, "category" => "Snacks & Munchies", "stock" => 80, "image" => "https://images.unsplash.com/photo-1499636136210-6f4ee915583e?w=300&q=80"],
            ["name" => "Fresh Apples 4 pcs", "price" => 140, "category" => "Fruits & Vegetables", "stock" => 40, "image" => "https://images.unsplash.com/photo-1560806887-1e4cd0b6faa6?w=300&q=80"],
            ["name" => "Fresh Tomatoes 1kg", "price" => 60, "category" => "Fruits & Vegetables", "stock" => 100, "image" => "https://images.unsplash.com/photo-1592924357228-91a4daadcfea?w=300&q=80"],
            ["name" => "Onions 1kg", "price" => 40, "category" => "Fruits & Vegetables", "stock" => 150, "image" => "https://images.unsplash.com/photo-1518977676601-b53f82aba655?w=300&q=80"],
            ["name" => "Cozy Fleece Blanket", "price" => 499, "category" => "Home & Living", "stock" => 10, "image" => "https://images.unsplash.com/photo-1580301762395-21ce84d00bc6?w=300&q=80"],
            ["name" => "Dishwashing Liquid 500ml", "price" => 65, "category" => "Cleaning Essentials", "stock" => 75, "image" => "https://images.unsplash.com/photo-1585421514738-01798e348b17?w=300&q=80"],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
