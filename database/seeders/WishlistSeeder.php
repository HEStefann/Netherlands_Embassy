<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wishlist;
use Illuminate\Support\Facades\File;

class WishlistSeeder extends Seeder
{
    public function run()
    {
        $json = File::get(database_path('data/wishlist.json'));
        $wishlists = json_decode($json, true);

        foreach ($wishlists as $wishlistData) {
            Wishlist::create($wishlistData);
        }
    }
}
