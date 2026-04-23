<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Seed the products table with thrift catalog entries.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Vintage leather biker jacket',
                'slug' => 'vintage-leather-biker-jacket',
                'description' => 'Heavy vintage biker jacket with clean silhouette and deep patina.',
                'condition' => 'Very Good',
                'size' => 'M',
                'category' => 'Outerwear',
                'price' => 185,
                'stock' => 1,
                'status' => 'available',
                'primary_image_path' => 'resources/images/Vintage leather jacket.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Leather jacket back view',
                'slug' => 'leather-jacket-back-view',
                'description' => 'Back-panel detail piece with structured shoulder cut.',
                'condition' => 'Like New',
                'size' => 'L',
                'category' => 'Outerwear',
                'price' => 210,
                'stock' => 1,
                'status' => 'available',
                'primary_image_path' => 'resources/images/Vintage leather jacket back view.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Chunky knit sweater',
                'slug' => 'chunky-knit-sweater',
                'description' => 'Cold-season knitwear with a soft hand feel and rich texture.',
                'condition' => 'Very Good',
                'size' => 'M',
                'category' => 'Layering',
                'price' => 120,
                'stock' => 1,
                'status' => 'available',
                'primary_image_path' => 'resources/images/Chunky Knit Sweater.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Faded denim jacket',
                'slug' => 'faded-denim-jacket',
                'description' => 'Natural washed tone with vintage fading around seams.',
                'condition' => 'Very Good',
                'size' => 'M',
                'category' => 'Outerwear',
                'price' => 138,
                'stock' => 1,
                'status' => 'available',
                'primary_image_path' => 'resources/images/Faded Denim Jacket.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Classic white cotton shirt',
                'slug' => 'classic-white-cotton-shirt',
                'description' => 'Minimal white shirt for timeless everyday pairing.',
                'condition' => 'Like New',
                'size' => 'S',
                'category' => 'Tops',
                'price' => 72,
                'stock' => 1,
                'status' => 'available',
                'primary_image_path' => 'resources/images/vintage white cotton button down shirt hanging on minimalist black wire hanger against plain wall.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Band tee',
                'slug' => 'band-tee',
                'description' => 'Vintage printed tee with soft fabric and faded character.',
                'condition' => 'Very Good',
                'size' => 'M',
                'category' => 'Tops',
                'price' => 58,
                'stock' => 1,
                'status' => 'available',
                'primary_image_path' => 'resources/images/Vintage Band Tee.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Cargo pants',
                'slug' => 'cargo-pants',
                'description' => 'Utility pants with roomy fit and clean military-inspired lines.',
                'condition' => 'Very Good',
                'size' => 'M',
                'category' => 'Bottoms',
                'price' => 84,
                'stock' => 1,
                'status' => 'available',
                'primary_image_path' => 'resources/images/Cargo Pants.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Silk floral midi skirt',
                'slug' => 'silk-floral-midi-skirt',
                'description' => 'Flowing midi skirt with an archival floral motif.',
                'condition' => 'Like New',
                'size' => 'S',
                'category' => 'Bottoms',
                'price' => 110,
                'stock' => 1,
                'status' => 'available',
                'primary_image_path' => 'resources/images/Silk Floral Midi Skirt.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Vintage leather loafers',
                'slug' => 'vintage-leather-loafers',
                'description' => 'Classic leather loafers with polished upper and slim profile.',
                'condition' => 'Very Good',
                'size' => 'L',
                'category' => 'Footwear',
                'price' => 145,
                'stock' => 1,
                'status' => 'available',
                'primary_image_path' => 'resources/images/image 3.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Archive tote bag',
                'slug' => 'archive-tote-bag',
                'description' => 'Textured tote for everyday carry with archival mood.',
                'condition' => 'Very Good',
                'size' => 'L',
                'category' => 'Accessories',
                'price' => 95,
                'stock' => 1,
                'status' => 'available',
                'primary_image_path' => 'resources/images/Image.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Vintage denim jacket',
                'slug' => 'vintage-denim-jacket',
                'description' => '1990s cut with rugged denim character and structured form.',
                'condition' => 'Like New',
                'size' => 'M',
                'category' => 'Outerwear',
                'price' => 150,
                'stock' => 1,
                'status' => 'available',
                'primary_image_path' => 'resources/images/Vintage denim.jpg',
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::query()->updateOrCreate(
                ['slug' => $product['slug']],
                $product
            );
        }
    }
}
