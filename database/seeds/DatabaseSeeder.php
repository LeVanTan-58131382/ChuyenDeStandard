<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
                ['id'=>	2,
                'name'=>'Lê Văn Tân',
                'email'=>'levantan@gmail.com',
                'password'=>Hash::make('tanlv'),
                'phone'=> '0355796956',
                'gender'=> 1],

                ['id'=>	3,
                'name'=>'Lê Văn Tiến',
                'email'=>'levantien@gmail.com',
                'password'=>Hash::make('tienlv'),
                'phone'=> '0327959151',
                'gender'=> 1],

                ['id'=>	4,
                'name'=>'Nguyễn Thị Hiền',
                'email'=>'hiennguyen@gmail.com',
                'password'=>Hash::make('hiennt'),
                'phone'=> '01214425889',
                'gender'=> 0],

                ['id'=>	5,
                'name'=>'Nguyễn Khắc Cường',
                'email'=>'cuongnguyen@gmail.com',
                'password'=>Hash::make('cuongnk'),
                'phone'=> '0830286224',
                'gender'=> 1],

                ['id'=>	6,
                'name'=>'Nguyễn Văn Linh',
                'email'=>'linhnguyen@gmail.com',
                'password'=>Hash::make('linhnv'),
                'phone'=> '0312145760',
                'gender'=> 1],

                ['id'=>	7,
                'name'=>'Lê Thanh Hoài',
                'email'=>'hoaile@gmail.com',
                'password'=>Hash::make('hoailt'),
                'phone'=> '0278584695',
                'gender'=> 1],

                ['id'=>	8,
                'name'=>'Võ Thị Thanh Thúy',
                'email'=>'thuyvo@gmail.com',
                'password'=>Hash::make('thuyvtt'),
                'phone'=> '0213568451',
                'gender'=> 0],

                ['id'=>	9,
                'name'=>'Võ Thị Mộng Trúc',
                'email'=>'trucvo@gmail.com',
                'password'=>Hash::make('trucvtm'),
                'phone'=> '0254896812',
                'gender'=> 0],
                
    ]); 

        $role_customer = new Role();
        $role_customer->name = 'customer';
        $role_customer->description = 'A customer User';
        $role_customer->save();

        $role_manager = new Role();
        $role_manager->name = 'admin';
        $role_manager->description = 'A admin User';
        $role_manager->save();

        $role_customer = Role::where('name', 'customer')->first();
        $role_manager  = Role::where('name', 'admin')->first();

        $manager = new User();
        $manager->id = 1;
        $manager->name = 'Admin';
        $manager->email = 'admin@gmail.com';
        $manager->password = Hash::make('123');
        $manager->save();
        $manager->roles()->attach($role_manager);

        $customer_1 = new User();
        $customer_1->id = 2;
        $customer_1->name = 'Lê Văn Tân';
        $customer_1->email = 'levantan@gmail.com';
        $customer_1->password = Hash::make('tanlv');
        $customer_1->save();
        $customer_1->roles()->attach($role_customer);

        $customer_2 = new User();
        $customer_2->id = 3;
        $customer_2->name = 'Lê Văn Tiến';
        $customer_2->email = 'letien@gmail.com';
        $customer_2->password = Hash::make('tienlv');
        $customer_2->save();
        $customer_2->roles()->attach($role_customer);

        $customer_3 = new User();
        $customer_3->id = 4;
        $customer_3->name = 'Nguyễn Thị Hiền';
        $customer_3->email = 'hiennguyen@gmail.com';
        $customer_3->password = Hash::make('hiennt');
        $customer_3->save();
        $customer_3->roles()->attach($role_customer);

        $customer_4 = new User();
        $customer_4->id = 5;
        $customer_4->name = 'Nguyễn Khắc Cường';
        $customer_4->email = 'cuongnguyen@gmail.com';
        $customer_4->password = Hash::make('cuongnk');
        $customer_4->save();
        $customer_4->roles()->attach($role_customer);

        $customer_5 = new User();
        $customer_5->id = 6;
        $customer_5->name = 'Nguyễn Văn Linh';
        $customer_5->email = 'linhnguyen@gmail.com';
        $customer_5->password = Hash::make('linhnv');
        $customer_5->save();
        $customer_5->roles()->attach($role_customer);

        $customer_6 = new User();
        $customer_6->id = 7;
        $customer_6->name = 'Lê Thanh Hoài';
        $customer_6->email = 'hoaile@gmail.com';
        $customer_6->password = Hash::make('hoailt');
        $customer_6->save();
        $customer_6->roles()->attach($role_customer);

        $customer_7 = new User();
        $customer_7->id = 8;
        $customer_7->name = 'Võ Thị Thanh Thúy';
        $customer_7->email = 'thuyvo@gmail.com';
        $customer_7->password = Hash::make('thuyvtt');
        $customer_7->save();
        $customer_7->roles()->attach($role_customer);

        $customer_8 = new User();
        $customer_8->id = 9;
        $customer_8->name = 'Võ Thị Mộng Trúc';
        $customer_8->email = 'trucvo@gmail.com';
        $customer_8->password = Hash::make('trucvtm');
        $customer_8->save();
        $customer_8->roles()->attach($role_customer);


        // $this->call(UserSeeder::class);
        DB::table('apartment_addresses')->insert([
            ['id' => 1,  'customer_id' => 1,'block' => 1, 'floor' => 1, 'apartment' => 1, 'acreage' => 80, 'hired' => 1],
            ['id' => 2,  'customer_id' => 2,'block' => 1, 'floor' => 1, 'apartment' => 2, 'acreage' => 80, 'hired' => 1],
            ['id' => 3,  'customer_id' => 3,'block' => 1, 'floor' => 1, 'apartment' => 3, 'acreage' => 80, 'hired' => 1],
            ['id' => 4,  'customer_id' => 4,'block' => 1, 'floor' => 1, 'apartment' => 4, 'acreage' => 80, 'hired' => 1],
            ['id' => 5,  'customer_id' => 5,'block' => 1, 'floor' => 1, 'apartment' => 5, 'acreage' => 80, 'hired' => 1],
            ['id' => 6,  'customer_id' => 6,'block' => 1, 'floor' => 2, 'apartment' => 1, 'acreage' => 90, 'hired' => 1],
            ['id' => 7,  'customer_id' => 7,'block' => 1, 'floor' => 2, 'apartment' => 2, 'acreage' => 90, 'hired' => 1],
            ['id' => 8,  'customer_id' => 8,'block' => 1, 'floor' => 2, 'apartment' => 3, 'acreage' => 90, 'hired' => 1],
            ['id' => 9,  'customer_id' => 9,'block' => 1, 'floor' => 2, 'apartment' => 4, 'acreage' => 90, 'hired' => 0],
            ['id' => 10, 'customer_id' => null, 'block' => 1, 'floor' => 2, 'apartment' => 5, 'acreage' => 85, 'hired' => 0],
            ['id' => 11, 'customer_id' => null, 'block' => 2, 'floor' => 1, 'apartment' => 1, 'acreage' => 85, 'hired' => 0],
            ['id' => 12, 'customer_id' => null, 'block' => 2, 'floor' => 1, 'apartment' => 2, 'acreage' => 85, 'hired' => 0],
            ['id' => 13, 'customer_id' => null, 'block' => 2, 'floor' => 1, 'apartment' => 3, 'acreage' => 85, 'hired' => 0],
            ['id' => 14, 'customer_id' => null, 'block' => 2, 'floor' => 1, 'apartment' => 4, 'acreage' => 85, 'hired' => 0],
            ['id' => 15, 'customer_id' => null, 'block' => 2, 'floor' => 1, 'apartment' => 5, 'acreage' => 85, 'hired' => 0],
        ]);

        //system_calendars
        DB::table('system_calendars')->insert([
            ['id' => 1,  'month' => 6,'year' => 2020],
            ]);

        DB::table('living_expenses_types')->insert([
            ['id' => 1, 'name' => 'Điện'],
            ['id' => 2, 'name' => 'Nước'],
            ['id' => 3, 'name' => 'Gửi xe'],
            ['id' => 4, 'name' => 'Phí quản lý vận hành'],
        ]); 
        
        DB::table('price_regulations')->insert([
            ['id' => 1, 'name' => 'QĐ phí điện Sinh hoạt 1', 'living_expenses_type_id' => 1, 'month_start_of_use' =>1],
            ['id' => 2, 'name' => 'QĐ phí điện Sinh hoạt 2', 'living_expenses_type_id' => 1, 'month_start_of_use' =>2],

            ['id' => 3, 'name' => 'QĐ phí nước Sinh hoạt 1', 'living_expenses_type_id' => 2, 'month_start_of_use' =>1],
            ['id' => 4, 'name' => 'Quy định phí nước Sinh hoạt 2', 'living_expenses_type_id' => 2, 'month_start_of_use' =>2],
            
            ['id' => 5, 'name' => 'QĐ phí gửi xe 1', 'living_expenses_type_id' => 3, 'month_start_of_use' =>1],
            ['id' => 6, 'name' => 'QĐ phí gửi xe 2', 'living_expenses_type_id' => 3, 'month_start_of_use' =>2],

            ['id' => 7, 'name' => 'QĐ phí quản lý vận hành 1', 'living_expenses_type_id' => 4, 'month_start_of_use' =>1],
            ['id' => 8, 'name' => 'QĐ phí quản lý vận hành 2', 'living_expenses_type_id' => 4, 'month_start_of_use' =>2],
            
        ]); 

        DB::table('usage_norm_investors')->insert([
            ['id' => 1, 'name' => 'Phí tiêu thụ điện mức 1', 'level' => 1, 'living_expenses_type_id' => 1, 'price_regulation_id' => 1, 'usage_index_from' => 1, 'usage_index_to' => 50, 'price' => 1388],
            ['id' => 2, 'name' => 'Phí tiêu thụ điện mức 2', 'level' => 2, 'living_expenses_type_id' => 1, 'price_regulation_id' => 1, 'usage_index_from' => 51, 'usage_index_to' => 100, 'price' => 1433],
            ['id' => 3, 'name' => 'Phí tiêu thụ điện mức 3', 'level' => 3, 'living_expenses_type_id' => 1, 'price_regulation_id' => 1, 'usage_index_from' => 101, 'usage_index_to' => 200, 'price' => 1660],
            ['id' => 4, 'name' => 'Phí tiêu thụ điện mức 4', 'level' => 4, 'living_expenses_type_id' => 1, 'price_regulation_id' => 1, 'usage_index_from' => 201, 'usage_index_to' => 300, 'price' => 2082],
            ['id' => 5, 'name' => 'Phí tiêu thụ điện mức 5', 'level' => 5, 'living_expenses_type_id' => 1, 'price_regulation_id' => 1, 'usage_index_from' => 301, 'usage_index_to' => 400, 'price' => 2324],
            ['id' => 6, 'name' => 'Phí tiêu thụ điện mức 6', 'level' => 6, 'living_expenses_type_id' => 1, 'price_regulation_id' => 1, 'usage_index_from' => 401, 'usage_index_to' => 1000, 'price' => 2399],

            ['id' => 7, 'name' => 'Phí tiêu thụ điện mức 1', 'level' => 1, 'living_expenses_type_id' => 1, 'price_regulation_id' => 2, 'usage_index_from' => 1, 'usage_index_to' => 50, 'price' => 2388],
            ['id' => 8, 'name' => 'Phí tiêu thụ điện mức 2', 'level' => 2, 'living_expenses_type_id' => 1, 'price_regulation_id' => 2, 'usage_index_from' => 51, 'usage_index_to' => 100, 'price' => 2433],
            ['id' => 9, 'name' => 'Phí tiêu thụ điện mức 3', 'level' => 3, 'living_expenses_type_id' => 1, 'price_regulation_id' => 2, 'usage_index_from' => 101, 'usage_index_to' => 200, 'price' => 2660],
            ['id' => 10, 'name' => 'Phí tiêu thụ điện mức 4', 'level' => 4, 'living_expenses_type_id' => 1, 'price_regulation_id' => 2, 'usage_index_from' => 201, 'usage_index_to' => 300, 'price' => 3082],
            ['id' => 11, 'name' => 'Phí tiêu thụ điện mức 5', 'level' => 5, 'living_expenses_type_id' => 1, 'price_regulation_id' => 2, 'usage_index_from' => 301, 'usage_index_to' => 400, 'price' => 3324],
            ['id' => 12, 'name' => 'Phí tiêu thụ điện mức 6', 'level' => 6, 'living_expenses_type_id' => 1, 'price_regulation_id' => 2, 'usage_index_from' => 401, 'usage_index_to' => 1000, 'price' => 3399],
           
            ['id' => 13, 'name' => 'Phí tiêu thụ nước mức 1', 'level' => 1, 'living_expenses_type_id' => 2, 'price_regulation_id' => 3, 'usage_index_from' => 1, 'usage_index_to' => 20, 'price' => 5930],
            ['id' => 14, 'name' => 'Phí tiêu thụ nước mức 2', 'level' => 2, 'living_expenses_type_id' => 2, 'price_regulation_id' => 3, 'usage_index_from' => 21, 'usage_index_to' => 30, 'price' => 7313],
            ['id' => 15, 'name' => 'Phí tiêu thụ nước mức 3', 'level' => 3, 'living_expenses_type_id' => 2, 'price_regulation_id' => 3, 'usage_index_from' => 31, 'usage_index_to' => 1000, 'price' => 13377],

            ['id' => 16, 'name' => 'Phí tiêu thụ nước mức 1', 'level' => 1, 'living_expenses_type_id' => 2, 'price_regulation_id' => 4, 'usage_index_from' => 1, 'usage_index_to' => 20, 'price' => 6930],
            ['id' => 17, 'name' => 'Phí tiêu thụ nước mức 2', 'level' => 2, 'living_expenses_type_id' => 2, 'price_regulation_id' => 4, 'usage_index_from' => 21, 'usage_index_to' => 30, 'price' => 8313],
            ['id' => 18, 'name' => 'Phí tiêu thụ nước mức 3', 'level' => 3, 'living_expenses_type_id' => 2, 'price_regulation_id' => 4, 'usage_index_from' => 31, 'usage_index_to' => 1000, 'price' => 14377],
           
        ]);

        DB::table('vehicles')->insert([
            ['id' => 1, 'name' => 'Xe ô tô'],
            ['id' => 2, 'name' => 'Xe mô tô'],
            ['id' => 3, 'name' => 'Xe đạp'],
        ]);

        DB::table('setting_indexs')->insert([
            ['id' => 1, 'highest_number_of_cars' => 1, 'highest_number_of_motos' => 3, 'highest_number_of_bikes' => 3]
        ]);

        // DB::table('system_calendars')->insert([
        //     ['id' => 1, 'month' => 6, 'year' => 2020],
        // ]);

        DB::table('vehicle_prices')->insert([
            ['id' => 1, 'name' => 'Phí phương tiện Xe ô tô 1', 'vehicle_type_id' => 1, 'price_regulation_id' => 5, 'price' => 1250000],
            ['id' => 2, 'name' => 'Phí phương tiện Xe mô tô 1', 'vehicle_type_id' => 2, 'price_regulation_id' => 5, 'price' => 45000],
            ['id' => 3, 'name' => 'Phí phương tiện Xe đạp 1', 'vehicle_type_id' => 3, 'price_regulation_id' => 5, 'price' => 30000],

            ['id' => 4, 'name' => 'Phí phương tiện Xe ô tô 2', 'vehicle_type_id' => 1, 'price_regulation_id' => 6, 'price' => 1350000],
            ['id' => 5, 'name' => 'Phí phương tiện Xe mô tô 2', 'vehicle_type_id' => 2, 'price_regulation_id' => 6, 'price' => 55000],
            ['id' => 6, 'name' => 'Phí phương tiện Xe đạp 2', 'vehicle_type_id' => 3, 'price_regulation_id' => 6, 'price' => 40000],
        ]);
        
        
        DB::table('operation_management_fees')->insert([
            ['id' => 1, 'name' => 'Phí quản lý vận hành 1', 'price_regulation_id' => 7, 'price' => 250000],
            ['id' => 2, 'name' => 'Phí quản lý vận hành 2', 'price_regulation_id' => 8, 'price' => 350000],
            
        ]);

        DB::table('customer_vehicle')->insert([
            ['id' => 1, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 2, 'vehicle_id' => 1],
            ['id' => 2, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 2, 'vehicle_id' => 2],
            ['id' => 3, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 3, 'vehicle_id' => 1],
            ['id' => 4, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 3, 'vehicle_id' => 3],
            ['id' => 5, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 4, 'vehicle_id' => 1],
            ['id' => 6, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 4, 'vehicle_id' => 2],
            ['id' => 7, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 5, 'vehicle_id' => 1],
            ['id' => 8, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 5, 'vehicle_id' => 2],
            ['id' => 9, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 6, 'vehicle_id' => 1],
            ['id' => 10, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 6, 'vehicle_id' => 3],
            ['id' => 11, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 6, 'vehicle_id' => 2],
            ['id' => 12, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 7, 'vehicle_id' => 1],
            ['id' => 13, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 7, 'vehicle_id' => 2],
            ['id' => 14, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 7, 'vehicle_id' => 3],
            ['id' => 15, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 8, 'vehicle_id' => 1],
            ['id' => 16, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 8, 'vehicle_id' => 2],
            ['id' => 17, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 8, 'vehicle_id' => 3],
            
        ]);

        // DB::table('statisticals')->insert([
        //     ['id' => 1, 'month' => 5, 'living_expenses_type_id' => 1, 'total_price' => 0 ],
        //     ['id' => 2, 'month' => 5, 'living_expenses_type_id' => 2, 'total_price' => 0 ],
        //     ['id' => 3, 'month' => 5, 'living_expenses_type_id' => 3, 'total_price' => 0 ],
        // ]);  
    }
    
}
