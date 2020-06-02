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
                ['id'=>	1,
                'name'=>'Lê Văn Tân',
                'email'=>'levantan@gmail.com',
                'password'=>Hash::make('123456789'),
                'phone'=> '0355796956',
                'gender'=> 1],

                ['id'=>	2,
                'name'=>'Lê Văn Tiến',
                'email'=>'levantien@gmail.com',
                'password'=>Hash::make('123456789'),
                'phone'=> '0355796956',
                'gender'=> 1],

                ['id'=>	3,
                'name'=>'Nguyen Thi Hien',
                'email'=>'hiennguyen@gmail.com',
                'password'=>Hash::make('123456789'),
                'phone'=> '0355796956',
                'gender'=> 0],
                
    ]); 

        // $role_customer = new Role();
        // $role_customer->name = 'customer';
        // $role_customer->description = 'A customer User';
        // $role_customer->save();

        // $role_manager = new Role();
        // $role_manager->name = 'admin';
        // $role_manager->description = 'A admin User';
        // $role_manager->save();

        // $role_customer = Role::where('name', 'customer')->first();
        // $role_manager  = Role::where('name', 'admin')->first();

        // $manager = new User();
        // $manager->id = 1;
        // $manager->name = 'Admin';
        // $manager->email = 'admin@gmail.com';
        // $manager->password = Hash::make('123456789');
        // $manager->phone = '0355796956';
        // $manager->save();
        // $manager->roles()->attach($role_manager);

        // $customer = new User();
        // $customer->name = 'Lê Văn Tân';
        // $customer->email = 'levantan@gmail.com';
        // $customer->password = Hash::make('123456789');
        // $customer->phone = '0355796956';
        // $customer->save();
        // $customer->roles()->attach($role_customer);

        // $customer = new User();
        // $customer->name = 'Lê Văn Tiến';
        // $customer->email = 'letien@gmail.com';
        // $customer->password = Hash::make('123456789');
        // $customer->phone = '0355796956';
        // $customer->save();
        // $customer->roles()->attach($role_customer);

        // $customer = new User();
        // $customer->name = 'Nguyễn Thị Hiền';
        // $customer->email = 'hiennguyen@gmail.com';
        // $customer->password = Hash::make('123456789');
        // $customer->phone = '0355796956';
        // $customer->save();
        // $customer->roles()->attach($role_customer);

        // $customer = new User();
        // $customer->name = 'Lê Thanh Hoài';
        // $customer->email = 'hoaithanh@gmail.com';
        // $customer->password = Hash::make('123456789');
        // $customer->phone = '0355796956';
        // $customer->save();
        // $customer->roles()->attach($role_customer);

        // $customer = new User();
        // $customer->name = 'Nguyễn Khắc Cường';
        // $customer->email = 'cuongnguyen@gmail.com';
        // $customer->password = Hash::make('123456789');
        // $customer->phone = '0355796956';
        // $customer->save();
        // $customer->roles()->attach($role_customer);

        // $customer = new User();
        // $customer->name = 'Trần Đăng Khoa';
        // $customer->email = 'khoatran@gmail.com';
        // $customer->password = Hash::make('123456789');
        // $customer->phone = '0355796956';
        // $customer->save();
        // $customer->roles()->attach($role_customer);

        // $customer = new User();
        // $customer->name = 'Nguyễn Thảo Ngân';
        // $customer->email = 'nganthao@gmail.com';
        // $customer->password = Hash::make('123456789');
        // $customer->phone = '0355796956';
        // $customer->save();
        // $customer->roles()->attach($role_customer);

        // $customer = new User();
        // $customer->name = 'Nguyễn Văn Linh';
        // $customer->email = 'linhnguyen@gmail.com';
        // $customer->password = Hash::make('123456789');
        // $customer->phone = '0355796956';
        // $customer->save();
        // $customer->roles()->attach($role_customer);

       

        // $this->call(UserSeeder::class);
        DB::table('apartment_addresses')->insert([
            ['id' => 1,  'customer_id' => 1,'block' => 1, 'floor' => 1, 'apartment' => 1, 'hired' => 1],
            ['id' => 2,  'customer_id' => 2,'block' => 1, 'floor' => 1, 'apartment' => 2, 'hired' => 1],
            ['id' => 3,  'customer_id' => 3,'block' => 1, 'floor' => 1, 'apartment' => 3, 'hired' => 1],
            ['id' => 4,  'customer_id' => null,'block' => 1, 'floor' => 1, 'apartment' => 4, 'hired' => 1],
            ['id' => 5,  'customer_id' => null,'block' => 1, 'floor' => 1, 'apartment' => 5, 'hired' => 1],
            ['id' => 6,  'customer_id' => null,'block' => 1, 'floor' => 2, 'apartment' => 1, 'hired' => 1],
            ['id' => 7,  'customer_id' => null,'block' => 1, 'floor' => 2, 'apartment' => 2, 'hired' => 1],
            ['id' => 8,  'customer_id' => null,'block' => 1, 'floor' => 2, 'apartment' => 3, 'hired' => 1],
            ['id' => 9,  'customer_id' => null,'block' => 1, 'floor' => 2, 'apartment' => 4, 'hired' => 0],
            ['id' => 10, 'customer_id' => null, 'block' => 1, 'floor' => 2, 'apartment' => 5, 'hired' => 0],
            ['id' => 11, 'customer_id' => null, 'block' => 2, 'floor' => 1, 'apartment' => 1, 'hired' => 0],
            ['id' => 12, 'customer_id' => null, 'block' => 2, 'floor' => 1, 'apartment' => 2, 'hired' => 0],
            ['id' => 13, 'customer_id' => null, 'block' => 2, 'floor' => 1, 'apartment' => 3, 'hired' => 0],
            ['id' => 14, 'customer_id' => null, 'block' => 2, 'floor' => 1, 'apartment' => 4, 'hired' => 0],
            ['id' => 15, 'customer_id' => null, 'block' => 2, 'floor' => 1, 'apartment' => 5, 'hired' => 0],
        ]);

         

        // DB::table('living_expenses_types')->insert([
        //     ['id' => 1, 'name' => 'Điện'],
        //     ['id' => 2, 'name' => 'Nước'],
        //     ['id' => 3, 'name' => 'Gửi xe'],
        // ]); 
        
        // DB::table('price_regulations')->insert([
        //     ['id' => 1, 'name' => 'QĐ phí điện Sinh hoạt 1', 'living_expenses_type_id' => 1, 'month_start_of_use' =>1],
        //     ['id' => 2, 'name' => 'QĐ phí điện Sinh hoạt 2', 'living_expenses_type_id' => 1, 'month_start_of_use' =>2],

        //     ['id' => 3, 'name' => 'QĐ phí nước Sinh hoạt 1', 'living_expenses_type_id' => 2, 'month_start_of_use' =>1],
        //     ['id' => 4, 'name' => 'Quy định phí nước Sinh hoạt 2', 'living_expenses_type_id' => 2, 'month_start_of_use' =>2],
            
        //     ['id' => 5, 'name' => 'QĐ phí gửi xe 1', 'living_expenses_type_id' => 3, 'month_start_of_use' =>1],
        //     ['id' => 6, 'name' => 'QĐ phí gửi xe 2', 'living_expenses_type_id' => 3, 'month_start_of_use' =>2],
            
        // ]); 

        // DB::table('usage_norm_investors')->insert([
        //     ['id' => 1, 'name' => 'Phí tiêu thụ điện mức 1', 'level' => 1, 'living_expenses_type_id' => 1, 'price_regulation_id' => 1, 'usage_index_from' => 1, 'usage_index_to' => 50, 'price' => 1388],
        //     ['id' => 2, 'name' => 'Phí tiêu thụ điện mức 2', 'level' => 2, 'living_expenses_type_id' => 1, 'price_regulation_id' => 1, 'usage_index_from' => 51, 'usage_index_to' => 100, 'price' => 1433],
        //     ['id' => 3, 'name' => 'Phí tiêu thụ điện mức 3', 'level' => 3, 'living_expenses_type_id' => 1, 'price_regulation_id' => 1, 'usage_index_from' => 101, 'usage_index_to' => 200, 'price' => 1660],
        //     ['id' => 4, 'name' => 'Phí tiêu thụ điện mức 4', 'level' => 4, 'living_expenses_type_id' => 1, 'price_regulation_id' => 1, 'usage_index_from' => 201, 'usage_index_to' => 300, 'price' => 2082],
        //     ['id' => 5, 'name' => 'Phí tiêu thụ điện mức 5', 'level' => 5, 'living_expenses_type_id' => 1, 'price_regulation_id' => 1, 'usage_index_from' => 301, 'usage_index_to' => 400, 'price' => 2324],
        //     ['id' => 6, 'name' => 'Phí tiêu thụ điện mức 6', 'level' => 6, 'living_expenses_type_id' => 1, 'price_regulation_id' => 1, 'usage_index_from' => 401, 'usage_index_to' => 1000, 'price' => 2399],

        //     ['id' => 7, 'name' => 'Phí tiêu thụ điện mức 1', 'level' => 1, 'living_expenses_type_id' => 1, 'price_regulation_id' => 2, 'usage_index_from' => 1, 'usage_index_to' => 50, 'price' => 2388],
        //     ['id' => 8, 'name' => 'Phí tiêu thụ điện mức 2', 'level' => 2, 'living_expenses_type_id' => 1, 'price_regulation_id' => 2, 'usage_index_from' => 51, 'usage_index_to' => 100, 'price' => 2433],
        //     ['id' => 9, 'name' => 'Phí tiêu thụ điện mức 3', 'level' => 3, 'living_expenses_type_id' => 1, 'price_regulation_id' => 2, 'usage_index_from' => 101, 'usage_index_to' => 200, 'price' => 2660],
        //     ['id' => 10, 'name' => 'Phí tiêu thụ điện mức 4', 'level' => 4, 'living_expenses_type_id' => 1, 'price_regulation_id' => 2, 'usage_index_from' => 201, 'usage_index_to' => 300, 'price' => 3082],
        //     ['id' => 11, 'name' => 'Phí tiêu thụ điện mức 5', 'level' => 5, 'living_expenses_type_id' => 1, 'price_regulation_id' => 2, 'usage_index_from' => 301, 'usage_index_to' => 400, 'price' => 3324],
        //     ['id' => 12, 'name' => 'Phí tiêu thụ điện mức 6', 'level' => 6, 'living_expenses_type_id' => 1, 'price_regulation_id' => 2, 'usage_index_from' => 401, 'usage_index_to' => 1000, 'price' => 3399],
           
        //     ['id' => 13, 'name' => 'Phí tiêu thụ nước mức 1', 'level' => 1, 'living_expenses_type_id' => 2, 'price_regulation_id' => 3, 'usage_index_from' => 1, 'usage_index_to' => 20, 'price' => 5930],
        //     ['id' => 14, 'name' => 'Phí tiêu thụ nước mức 2', 'level' => 2, 'living_expenses_type_id' => 2, 'price_regulation_id' => 3, 'usage_index_from' => 21, 'usage_index_to' => 30, 'price' => 7313],
        //     ['id' => 15, 'name' => 'Phí tiêu thụ nước mức 3', 'level' => 3, 'living_expenses_type_id' => 2, 'price_regulation_id' => 3, 'usage_index_from' => 31, 'usage_index_to' => 1000, 'price' => 13377],

        //     ['id' => 16, 'name' => 'Phí tiêu thụ nước mức 1', 'level' => 1, 'living_expenses_type_id' => 2, 'price_regulation_id' => 4, 'usage_index_from' => 1, 'usage_index_to' => 20, 'price' => 6930],
        //     ['id' => 17, 'name' => 'Phí tiêu thụ nước mức 2', 'level' => 2, 'living_expenses_type_id' => 2, 'price_regulation_id' => 4, 'usage_index_from' => 21, 'usage_index_to' => 30, 'price' => 8313],
        //     ['id' => 18, 'name' => 'Phí tiêu thụ nước mức 3', 'level' => 3, 'living_expenses_type_id' => 2, 'price_regulation_id' => 4, 'usage_index_from' => 31, 'usage_index_to' => 1000, 'price' => 14377],
           
        // ]);

        // DB::table('vehicle_types')->insert([
        //     ['id' => 1, 'name' => 'Xe ô tô'],
        //     ['id' => 2, 'name' => 'Xe mô tô'],
        //     ['id' => 3, 'name' => 'Xe đạp'],
        // ]);

        // DB::table('vehicle_prices')->insert([
        //     ['id' => 1, 'name' => 'Phí phương tiện Xe ô tô 1', 'vehicle_type_id' => 1, 'price_regulation_id' => 5, 'price' => 1250000],
        //     ['id' => 2, 'name' => 'Phí phương tiện Xe mô tô 1', 'vehicle_type_id' => 2, 'price_regulation_id' => 5, 'price' => 45000],
        //     ['id' => 3, 'name' => 'Phí phương tiện Xe đạp 1', 'vehicle_type_id' => 3, 'price_regulation_id' => 5, 'price' => 30000],

        //     ['id' => 4, 'name' => 'Phí phương tiện Xe ô tô 2', 'vehicle_type_id' => 1, 'price_regulation_id' => 6, 'price' => 1350000],
        //     ['id' => 5, 'name' => 'Phí phương tiện Xe mô tô 2', 'vehicle_type_id' => 2, 'price_regulation_id' => 6, 'price' => 55000],
        //     ['id' => 6, 'name' => 'Phí phương tiện Xe đạp 2', 'vehicle_type_id' => 3, 'price_regulation_id' => 6, 'price' => 40000],
        // ]);


        // DB::table('statisticals')->insert([
        //     ['id' => 1, 'month' => 5, 'living_expenses_type_id' => 1, 'total_price' => 0 ],
        //     ['id' => 2, 'month' => 5, 'living_expenses_type_id' => 2, 'total_price' => 0 ],
        //     ['id' => 3, 'month' => 5, 'living_expenses_type_id' => 3, 'total_price' => 0 ],
        // ]);  
    }
    
}
