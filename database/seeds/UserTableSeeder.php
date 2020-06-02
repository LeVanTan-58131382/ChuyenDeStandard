<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $role_customer = Role::where('name', 'customer')->first();
       $role_manager  = Role::where('name', 'admin')->first();

       $customer = new User();
       $customer->name = 'Lê Văn Tân';
       $customer->email = 'levantan@gmail.com';
       $customer->password = Hash::make('123456789');
       $customer->phone = '0355796956';
       $customer->save();
       $customer->roles()->attach($role_customer);

       $customer = new User();
       $customer->name = 'Lê Văn Tiến';
       $customer->email = 'letien@gmail.com';
       $customer->password = Hash::make('123456789');
       $customer->phone = '0355796956';
       $customer->save();
       $customer->roles()->attach($role_customer);

       $customer = new User();
       $customer->name = 'Nguyễn Thị Hiền';
       $customer->email = 'hiennguyen@gmail.com';
       $customer->password = Hash::make('123456789');
       $customer->phone = '0355796956';
       $customer->save();
       $customer->roles()->attach($role_customer);

       $customer = new User();
       $customer->name = 'Lê Thanh Hoài';
       $customer->email = 'hoaithanh@gmail.com';
       $customer->password = Hash::make('123456789');
       $customer->phone = '0355796956';
       $customer->save();
       $customer->roles()->attach($role_customer);

       $customer = new User();
       $customer->name = 'Nguyễn Khắc Cường';
       $customer->email = 'cuongnguyen@gmail.com';
       $customer->password = Hash::make('123456789');
       $customer->phone = '0355796956';
       $customer->save();
       $customer->roles()->attach($role_customer);

       $customer = new User();
       $customer->name = 'Trần Đăng Khoa';
       $customer->email = 'khoatran@gmail.com';
       $customer->password = Hash::make('123456789');
       $customer->phone = '0355796956';
       $customer->save();
       $customer->roles()->attach($role_customer);

       $customer = new User();
       $customer->name = 'Nguyễn Thảo Ngân';
       $customer->email = 'nganthao@gmail.com';
       $customer->password = Hash::make('123456789');
       $customer->phone = '0355796956';
       $customer->save();
       $customer->roles()->attach($role_customer);

       $customer = new User();
       $customer->name = 'Nguyễn Văn Linh';
       $customer->email = 'linhnguyen@gmail.com';
       $customer->password = Hash::make('123456789');
       $customer->phone = '0355796956';
       $customer->save();
       $customer->roles()->attach($role_customer);

       $manager = new User();
       $manager->name = 'Admin';
       $manager->email = 'admin@gmail.com';
       $manager->password = Hash::make('123456789');
       $customer->phone = '0355796956';
       $manager->save();
       $manager->roles()->attach($role_manager);
    }
}

//Giải thích: Laravel hỗ trợ chúng ta đến tận chân răng 😃. Để thêm một quyền cho 1 user ta sử dụng hàm attach. Còn nếu muốn xóa đi 1 quyền nào đó thì các bạn sử dụng hàm detach($role_id) nhé, phần này quan trọng nên các bạn chú ý 2 hàm này để tự áp dụng tùy hoàn cảnh nhé
