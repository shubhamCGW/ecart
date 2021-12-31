<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class EcartSeeder extends Seeder
{
    /** Products Fruit Images */
    public const BASE_PRODUCT_IMAGE_APPLE = 'public/images/fruits/apple.png';
    public const BASE_PRODUCT_IMAGE_BANANA = 'public/images/fruits/banana.png';
    public const BASE_PRODUCT_IMAGE_GRAPES = 'public/images/fruits/grapes.png';
    public const BASE_PRODUCT_IMAGE_MANGO = 'public/images/fruits/mango.png';
    public const BASE_PRODUCT_IMAGE_ORANGES = 'public/images/fruits/orange.png';

    /** Products COOKING Oils public/Images **/

    public const BASE_PRODUCT_IMAGE_PALM = 'public/images/oil/palm.png';
    public const BASE_PRODUCT_IMAGE_ALMOND = 'public/images/oil/almond.png';
    public const BASE_PRODUCT_IMAGE_SOYA = 'public/images/oil/soya.png';
    public const BASE_PRODUCT_IMAGE_COCONUT = 'public/images/oil/coconut.png';
    public const BASE_PRODUCT_IMAGE_OLIVE = 'public/images/oil/olive.png';

    /** Categories */

    public const BASE_FRESH_FRUIT = 'public/images/categories_images/fruit.png';
    public const BASE_COOKING_OIL = 'public/images/categories_images/oil.png';
    public const BASE_BEVERAGE = 'public/images/categories_images/beverages.png';
    public const BASE_BAKERY = 'public/images/categories_images/bakery.png';
    public const BASE_DAIRY = 'public/images/categories_images/dairy.png';


    /** Banner */
    public const BASE_BANNER_1 = 'public/images/banner/B8.jpg';
    public const BASE_BANNER_2 = 'public/images/banner/B3.jpg';
    public const BASE_BANNER_3 = 'public/images/banner/B4.jpg';
    public const BASE_BANNER_4 = 'public/images/banner/B6.jpg';
    public const BASE_BANNER_5 = 'public/images/banner/B1.jpg';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $user_id = User::insertGetId(['name'=> 'demo User',
    'email' =>'demo@email.com',
    'phone' => '+917878787878',
    'password'=> bcrypt('12345678'),
    'status' => 'active',
    'created_at' => now()
]);

        $cat_id1 = Category::insertGetId([
            'name' => 'Fresh Fruits & Vegetables',
            'image' =>  self::BASE_FRESH_FRUIT,
            'created_at' => now()
        ]);

        $cat_id2 = Category::insertGetId([
            'name' => 'Cooking Oils',
            'image' =>  self::BASE_COOKING_OIL,
            'created_at' => now()
        ]);

        $cat_id3 = Category::insertGetId([
            'name' => 'Dairy & Eggs',
            'image' =>  self::BASE_DAIRY,
            'created_at' => now()
        ]);

        $cat_id4 = Category::insertGetId([
            'name' => 'Bakery',
            'image' =>   self::BASE_BAKERY,
            'created_at' => now()
        ]);

        $cat_id5 = Category::insertGetId([
            'name' => 'Beverages',
            'image' =>   self::BASE_BEVERAGE,
            'created_at' => now()
        ]);

        /** PROD OF CATEGORY 1  */
        $product_id1 = Product::insertGetId([
            'name' => 'Apple',
            'price' => '15',
            'sub_desc' => 'per piece',
            'description' => 'An apple is an edible fruit produced by an apple tree.' .
            ' Apple trees are cultivated worldwide and are the most widely grown species' .
            ' in the genus. The tree originated in Central Asia,' .
            ' where its wild ancestor,',
            'image'=>  self::BASE_PRODUCT_IMAGE_APPLE,
            'category_id' => $cat_id1,
            'created_at' => now()
        ]);

        Product::insert([
            'name' => 'Banana',
            'price' => '30',
            'sub_desc' => 'per dozen',
            'description' => 'A banana is an elongated,'.
            'edible fruit – botanically a berry –'.
            ' produced by several kinds'.
            'of large herbaceous flowering plants in the genus.'
            .' In some countries,bananas used'.
            ' for cooking may be called "plantains"'.
            ',distinguishing them from dessert bananas.',
            'image'=>   self::BASE_PRODUCT_IMAGE_BANANA,
            'category_id' => $cat_id1,
            'created_at' => now()
        ]);
        Product::insert([
            'name' => 'Oranges',
            'price' => '40',
            'sub_desc' => 'per kg',
            'description' => 'Oranges are round, orange-colored '.
            'citrus fruits that grow on trees.'.
            ' They originally came from China,'.
            ' but today these nutritious powerhouses'.
            ' are grown in warm climates around the world.'.
            'Types of Oranges'.
            'There are many different varieties of oranges.'.
            ' Some are sweet, and some are sour.'.
            'Every type of orange has more than 100%'.
            ' of your recommended daily amount of vitamin C. ',
            'image'=>   self::BASE_PRODUCT_IMAGE_ORANGES,
            'category_id' => $cat_id1,
            'created_at' => now()
        ]);
        Product::insert([
            'name' => 'Mango',
            'price' => '110',
            'sub_desc' => 'per kg',
            'description' => 'They are a great source of magnesium and potassium,'.
            ' both of which are connected to lower blood pressure and a regular pulse.'.
            ' Furthermore, mangos are the source of a compound known as ,'.
            ' which early studies suggest may be able to reduce inflammation of the heart.'.
            ' Mangos can help stabilize your digestive system.',
            'image'=>   self::BASE_PRODUCT_IMAGE_MANGO,
            'category_id' => $cat_id1,
            'created_at' => now()
        ]);
        Product::insert([
            'name' => 'Grapes',
            'price' => '80',
            'sub_desc' => 'per kg',
            'description' => 'Heart Help. Grapes are a good source of potassium,'.
            ' a mineral that helps balance fluids in your body.'.
            ' Potassium can help bring down high blood pressure '.
            'and lower your risk of heart disease and stroke.',
            'image'=>   self::BASE_PRODUCT_IMAGE_GRAPES,
            'category_id' => $cat_id1,
            'created_at' => now()
        ]);

        /** PROD OF CATEGORY 2  */
        Product::insert([
            'name' => 'Olive Oil',
            'price' => '250',
            'sub_desc' => 'per liter',
            'description' => 'Heart Help. Grapes are a good source of potassium,'.
            ' a mineral that helps balance fluids in your body.'.
            ' Potassium can help bring down high blood pressure'.
            ' and lower your risk of heart disease and stroke.',
            'image'=>   self::BASE_PRODUCT_IMAGE_OLIVE,
            'category_id' => $cat_id2,
            'created_at' => now()
        ]);

        Banner::insert([
            'image'=>  self::BASE_BANNER_1,
        ]);
        Banner::insert([
            'image'=>   self::BASE_BANNER_2,
        ]);
        Banner::insert([
            'image'=>   self::BASE_BANNER_3,
        ]);
        Banner::insert([
            'image'=>   self::BASE_BANNER_4,
        ]);
        Banner::insert([
            'image'=>   self::BASE_BANNER_5,
        ]);

        Cart::insert(['product_id' => $product_id1 ,'user_id'=> $user_id,
                        'price' => '10', 'quantity' => '5' ,
                        'amount' =>'50'
    ]);
    }


}
