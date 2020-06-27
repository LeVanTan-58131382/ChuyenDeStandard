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

                ['id'=>	10,
                'name'=>'Trương Hồng Ngọc',
                'email'=>'hongngoc@gmail.com',
                'password'=>Hash::make('ngocth'),
                'phone'=> '03245614575',
                'gender'=> 0],

                ['id'=>	11,
                'name'=>'Nguyễn Hồng Thảo',
                'email'=>'hongthao@gmail.com',
                'password'=>Hash::make('thaonh'),
                'phone'=> '03252545651',
                'gender'=> 0],

                ['id'=>	12,
                'name'=>'Nguyễn Lê Thành Tiến',
                'email'=>'thanhtien@gmail.com',
                'password'=>Hash::make('tiennlt'),
                'phone'=> '03221145657',
                'gender'=> 0],

                ['id'=>	13,
                'name'=>'Nguyễn Thanh Trúc',
                'email'=>'thanh truc@gmail.com',
                'password'=>Hash::make('trucnt'),
                'phone'=> '03357845756',
                'gender'=> 0],

                ['id'=>	14,
                'name'=>'Nguyễn thị Uyên Trang',
                'email'=>'uyentrang@gmail.com',
                'password'=>Hash::make('trangntu'),
                'phone'=> '03669542455',
                'gender'=> 0],

                ['id'=>	15,
                'name'=>'Lê Đức Thắng',
                'email'=>'ducthang@gmail.com',
                'password'=>Hash::make('thangld'),
                'phone'=> '03856563351',
                'gender'=> 1],

                ['id'=>	16,
                'name'=>'Võ Thị Uyên Trúc',
                'email'=>'uyentruc@gmail.com',
                'password'=>Hash::make('trucvtu'),
                'phone'=> '03225547589',
                'gender'=> 0],

                ['id'=>	17,
                'name'=>'Nguyễn Văn Khánh',
                'email'=>'vankhanh@gmail.com',
                'password'=>Hash::make('khanhnv'),
                'phone'=> '03445625235',
                'gender'=> 1],

                ['id'=>	18,
                'name'=>'Trần Thị Hồng Thảo',
                'email'=>'hongthao@gmail.com',
                'password'=>Hash::make('thaotth'),
                'phone'=> '03252545651',
                'gender'=> 0],

                ['id'=>	19,
                'name'=>'Vũ Thành Đạt',
                'email'=>'thanhdat@gmail.com',
                'password'=>Hash::make('datvt'),
                'phone'=> '03576558451',
                'gender'=> 1],

                ['id'=>	20,
                'name'=>'Phan Văn Đức',
                'email'=>'vanduc@gmail.com',
                'password'=>Hash::make('ducpv'),
                'phone'=> '03212135478',
                'gender'=> 1],

                ['id'=>	21,
                'name'=>'Nguyễn Tấn Thành',
                'email'=>'tanthanh@gmail.com',
                'password'=>Hash::make('thanhnt'),
                'phone'=> '03256545471',
                'gender'=> 1],

                ['id'=>	22,
                'name'=>'Triệu Việt Anh',
                'email'=>'vietanh@gmail.com',
                'password'=>Hash::make('anhtv'),
                'phone'=> '03356969651',
                'gender'=> 1],

                ['id'=>	23,
                'name'=>'Trần Thái Tuấn',
                'email'=>'thaituan@gmail.com',
                'password'=>Hash::make('tuantt'),
                'phone'=> '03574575899',
                'gender'=> 1],

                ['id'=>	24,
                'name'=>'Phan Đức Thái',
                'email'=>'ducthai@gmail.com',
                'password'=>Hash::make('thaipd'),
                'phone'=> '03554754113',
                'gender'=> 1],

                ['id'=>	25,
                'name'=>'Triệu Quang Phục',
                'email'=>'quangphuc@gmail.com',
                'password'=>Hash::make('phuctq'),
                'phone'=> '03245784754',
                'gender'=> 1],

                ['id'=>	26,
                'name'=>'Trương Thái Quý',
                'email'=>'thaiquy@gmail.com',
                'password'=>Hash::make('thaitq'),
                'phone'=> '03566452457',
                'gender'=> 1],

                ['id'=>	27,
                'name'=>'Trương Thị Thanh Nhàn',
                'email'=>'thanhnhan@gmail.com',
                'password'=>Hash::make('nhanttt'),
                'phone'=> '03214124566',
                'gender'=> 0],

                ['id'=>	28,
                'name'=>'Trương Linh Đan',
                'email'=>'linhdan@gmail.com',
                'password'=>Hash::make('dantl'),
                'phone'=> '03546525251',
                'gender'=> 0],

                ['id'=>	29,
                'name'=>'Vũ Văn Việt',
                'email'=>'vanviet@gmail.com',
                'password'=>Hash::make('vietvv'),
                'phone'=> '03255858456',
                'gender'=> 1],

                ['id'=>	30,
                'name'=>'Trương Thái Quý',
                'email'=>'thaiquy@gmail.com',
                'password'=>Hash::make('quytt'),
                'phone'=> '03566452457',
                'gender'=> 1],

                ['id'=>	31,
                'name'=>'Lê Thị Diễm Quỳnh',
                'email'=>'diemquynh@gmail.com',
                'password'=>Hash::make('quynhltd'),
                'phone'=> '03254787410',
                'gender'=> 0],

                ['id'=>	32,
                'name'=>'Lê Tuấn Tú',
                'email'=>'tuantu@gmail.com',
                'password'=>Hash::make('tuanlt'),
                'phone'=> '03214585412',
                'gender'=> 1],

                ['id'=>	33,
                'name'=>'Thái Quỳnh Anh',
                'email'=>'quynhanh@gmail.com',
                'password'=>Hash::make('anhtq'),
                'phone'=> '032541658564',
                'gender'=> 0],

                ['id'=>	34,
                'name'=>'Trần Thanh Phương',
                'email'=>'thanhphuong@gmail.com',
                'password'=>Hash::make('phuongtt'),
                'phone'=> '02144557412',
                'gender'=> 1],

                ['id'=>	35,
                'name'=>'Võ Văn Hậu',
                'email'=>'vanhau@gmail.com',
                'password'=>Hash::make('hauvv'),
                'phone'=> '03256585852',
                'gender'=> 1],

                ['id'=>	36,
                'name'=>'Lê Thái Thịnh',
                'email'=>'thaithinh@gmail.com',
                'password'=>Hash::make('thinhlt'),
                'phone'=> '03211002355',
                'gender'=> 1],

                ['id'=>	37,
                'name'=>'Trần Thị Duyên',
                'email'=>'duyen@gmail.com',
                'password'=>Hash::make('duyentt'),
                'phone'=> '03263659851',
                'gender'=> 0],

                ['id'=>	38,
                'name'=>'Nguyễn Xuân Tú',
                'email'=>'xuantu@gmail.com',
                'password'=>Hash::make('tunx'),
                'phone'=> '03254547851',
                'gender'=> 1],

                ['id'=>	39,
                'name'=>'Nguyễn Hoàng Anh',
                'email'=>'hoanganh@gmail.com',
                'password'=>Hash::make('anhnh'),
                'phone'=> '03451214547',
                'gender'=> 1],

                ['id'=>	40,
                'name'=>'Trần Đăng Khoa',
                'email'=>'dangkhoa@gmail.com',
                'password'=>Hash::make('khoatd'),
                'phone'=> '03254121452',
                'gender'=> 1],

                ['id'=>	41,
                'name'=>'Lê Xuân Thi',
                'email'=>'xuanthi@gmail.com',
                'password'=>Hash::make('thilx'),
                'phone'=> '03214578965',
                'gender'=> 1],

                ['id'=>	42,
                'name'=>'Nguyễn Thanh Lâm',
                'email'=>'thanhlam@gmail.com',
                'password'=>Hash::make('lamnt'),
                'phone'=> '03256584751',
                'gender'=> 1],

                ['id'=>	43,
                'name'=>'Lê Thị Tuyết Nhung',
                'email'=>'tuyetnhung@gmail.com',
                'password'=>Hash::make('nhungltt'),
                'phone'=> '03256547851',
                'gender'=> 0],

                ['id'=>	44,
                'name'=>'Trần Thanh Nhã',
                'email'=>'thanhnha@gmail.com',
                'password'=>Hash::make('nhatt'),
                'phone'=> '03121453652',
                'gender'=> 0],

                ['id'=>	45,
                'name'=>'Nguyễn Văn Tài',
                'email'=>'vantai@gmail.com',
                'password'=>Hash::make('tainv'),
                'phone'=> '03255874411',
                'gender'=> 1],

                ['id'=>	46,
                'name'=>'Lê Thành Nhân',
                'email'=>'thanhnhan@gmail.com',
                'password'=>Hash::make('nhanlt'),
                'phone'=> '03254565852',
                'gender'=> 1],

                ['id'=>	47,
                'name'=>'Nguyễn Thị Ly',
                'email'=>'lyly@gmail.com',
                'password'=>Hash::make('lynt'),
                'phone'=> '03210101425',
                'gender'=> 0],

                ['id'=>	48,
                'name'=>'Nguyễn Văn Dung',
                'email'=>'vandung@gmail.com',
                'password'=>Hash::make('dungnv'),
                'phone'=> '03245748513',
                'gender'=> 1],

                ['id'=>	49,
                'name'=>'Lê Thị Thu ',
                'email'=>'lethu@gmail.com',
                'password'=>Hash::make('thult'),
                'phone'=> '03254125466',
                'gender'=> 0],

                ['id'=>	50,
                'name'=>'Trần Ngọc Hoài Như',
                'email'=>'hoainhu@gmail.com',
                'password'=>Hash::make('nhutnh'),
                'phone'=> '03256541214',
                'gender'=> 0],

                ['id'=>	51,
                'name'=>'Lương Quỳnh Như',
                'email'=>'quynhnhu@gmail.com',
                'password'=>Hash::make('nhulq'),
                'phone'=> '02145478523',
                'gender'=> 0],

                ['id'=>	52,
                'name'=>'Lê Thanh Thủy',
                'email'=>'thanhthuy@gmail.com',
                'password'=>Hash::make('thuylt'),
                'phone'=> '03363625895',
                'gender'=> 0],

                ['id'=>	53,
                'name'=>'Trần Hoài Thương',
                'email'=>'hoaithuong@gmail.com',
                'password'=>Hash::make('thương'),
                'phone'=> '03254141542',
                'gender'=> 0],

                ['id'=>	54,
                'name'=>'Lê Nguyên Vũ',
                'email'=>'nguyenvu@gmail.com',
                'password'=>Hash::make('vuln'),
                'phone'=> '03214545621',
                'gender'=> 1],

                ['id'=>	55,
                'name'=>'Lê Tấn Kiên',
                'email'=>'tankien@gmail.com',
                'password'=>Hash::make('kienlt'),
                'phone'=> '03214124142',
                'gender'=> 1],

                ['id'=>	56,
                'name'=>'Lê Hồng Phúc',
                'email'=>'hongphuc@gmail.com',
                'password'=>Hash::make('phuclh'),
                'phone'=> '03254145256',
                'gender'=> 1],

                ['id'=>	57,
                'name'=>'Nguyễn Bá Phú',
                'email'=>'baphu@gmail.com',
                'password'=>Hash::make('phunb'),
                'phone'=> '03255879961',
                'gender'=> 1],

                ['id'=>	58,
                'name'=>'Lê Thị Thu Sương',
                'email'=>'thusuong@gmail.com',
                'password'=>Hash::make('suongltt'),
                'phone'=> '03251001014',
                'gender'=> 0],

                ['id'=>	59,
                'name'=>'Trần Hoàng Minh',
                'email'=>'hoangminh@gmail.com',
                'password'=>Hash::make('minhth'),
                'phone'=> '03556254752',
                'gender'=> 1],

                ['id'=>	60,
                'name'=>'Lê Hoài Anh',
                'email'=>'hoaianh@gmail.com',
                'password'=>Hash::make('anhlh'),
                'phone'=> '03214578965',
                'gender'=> 0],

                ['id'=>	61,
                'name'=>'Lê Thành Nguyên',
                'email'=>'thanhnguyen@gmail.com',
                'password'=>Hash::make('nguyenlt'),
                'phone'=> '03254785121',
                'gender'=> 1],

                ['id'=>	62,
                'name'=>'Lê Anh Kha',
                'email'=>'anhkha@gmail.com',
                'password'=>Hash::make('khala'),
                'phone'=> '03255852258',
                'gender'=> 1],

                ['id'=>	63,
                'name'=>'Nguyễn Thành Danh',
                'email'=>'thanhdanh@gmail.com',
                'password'=>Hash::make('danhnt'),
                'phone'=> '03256574581',
                'gender'=> 1],

                ['id'=>	64,
                'name'=>'Lê Bá Nhiên',
                'email'=>'banhien@gmail.com',
                'password'=>Hash::make('nhienlb'),
                'phone'=> '03256236236',
                'gender'=> 1],

                ['id'=>	65,
                'name'=>'Trần Xung Phong',
                'email'=>'xungphong@gmail.com',
                'password'=>Hash::make('phongtx'),
                'phone'=> '03254785121',
                'gender'=> 1],

                ['id'=>	66,
                'name'=>'Lương Văn Bích',
                'email'=>'vanbich@gmail.com',
                'password'=>Hash::make('bichlv'),
                'phone'=> '03254758965',
                'gender'=> 1],

                ['id'=>	67,
                'name'=>'Nguyễn Hữu Phước',
                'email'=>'huuphuoc@gmail.com',
                'password'=>Hash::make('phuocnh'),
                'phone'=> '03256556214',
                'gender'=> 1],

                ['id'=>	68,
                'name'=>'Lê Thái Thành',
                'email'=>'thaithanh@gmail.com',
                'password'=>Hash::make('thanhlt'),
                'phone'=> '03254789652',
                'gender'=> 1],

                ['id'=>	69,
                'name'=>'Bùi Văn Cường',
                'email'=>'cuongbui@gmail.com',
                'password'=>Hash::make('cuongbv'),
                'phone'=> '03251425142',
                'gender'=> 1],

                ['id'=>	70,
                'name'=>'Trần Hoài Nam',
                'email'=>'hoainam@gmail.com',
                'password'=>Hash::make('namth'),
                'phone'=> '03254785121',
                'gender'=> 1],

                ['id'=>	71,
                'name'=>'Ngô Thành Trung',
                'email'=>'thanhtrung@gmail.com',
                'password'=>Hash::make('trungnt'),
                'phone'=> '03251414742',
                'gender'=> 1],

                ['id'=>	72,
                'name'=>'Trần Thanh Hương',
                'email'=>'thanhhuong@gmail.com',
                'password'=>Hash::make('huongtt'),
                'phone'=> '03225654547',
                'gender'=> 0],

                ['id'=>	73,
                'name'=>'Lý Hưng Thịnh',
                'email'=>'hungthinh@gmail.com',
                'password'=>Hash::make('thinhlh'),
                'phone'=> '03586956852',
                'gender'=> 1],

                ['id'=>	74,
                'name'=>'Nguyễn Thanh Xuân',
                'email'=>'thanhxuan@gmail.com',
                'password'=>Hash::make('xuannt'),
                'phone'=> '03254785121',
                'gender'=> 1],

                ['id'=>	75,
                'name'=>'Hồ Bình Minh',
                'email'=>'binhminh@gmail.com',
                'password'=>Hash::make('minhhb'),
                'phone'=> '03256555852',
                'gender'=> 1],

                ['id'=>	76,
                'name'=>'Lê Anh Phương',
                'email'=>'anhphuong@gmail.com',
                'password'=>Hash::make('phuongla'),
                'phone'=> '03565522145',
                'gender'=> 1],

                ['id'=>	77,
                'name'=>'Nguyễn Thị Thanh Ngà',
                'email'=>'thanhnga@gmail.com',
                'password'=>Hash::make('ngantt'),
                'phone'=> '03252585850',
                'gender'=> 0],

                ['id'=>	78,
                'name'=>'Vũ Trung Trực',
                'email'=>'trungtruc@gmail.com',
                'password'=>Hash::make('trucvt'),
                'phone'=> '03565623310',
                'gender'=> 1],

                ['id'=>	79,
                'name'=>'Lê Hải Dương',
                'email'=>'haiduong@gmail.com',
                'password'=>Hash::make('duonglh'),
                'phone'=> '03257403696',
                'gender'=> 1],

                ['id'=>	80,
                'name'=>'Lê Xuân Diệu',
                'email'=>'xuandieu@gmail.com',
                'password'=>Hash::make('dieulx'),
                'phone'=> '03250101242',
                'gender'=> 1],

                ['id'=>	81,
                'name'=>'Trần Tài Danh',
                'email'=>'taidanh@gmail.com',
                'password'=>Hash::make('danhtt'),
                'phone'=> '03254785121',
                'gender'=> 1],

                ['id'=>	82,
                'name'=>'Trần Hải',
                'email'=>'tranhai@gmail.com',
                'password'=>Hash::make('hait'),
                'phone'=> '03695623586',
                'gender'=> 1],

                ['id'=>	83,
                'name'=>'Lý Quang Phục',
                'email'=>'quangphuc@gmail.com',
                'password'=>Hash::make('phuclq'),
                'phone'=> '03251425253',
                'gender'=> 1],

                ['id'=>	84,
                'name'=>'Lê Hữu Dũng',
                'email'=>'huudung@gmail.com',
                'password'=>Hash::make('dunglh'),
                'phone'=> '03257533691',
                'gender'=> 1],

                ['id'=>	85,
                'name'=>'Lương Quang Toàn',
                'email'=>'quangtoan@gmail.com',
                'password'=>Hash::make('toanlq'),
                'phone'=> '03254124753',
                'gender'=> 1],

                ['id'=>	86,
                'name'=>'Lê Quang Đăng',
                'email'=>'quangdang@gmail.com',
                'password'=>Hash::make('danglq'),
                'phone'=> '03255897856',
                'gender'=> 1],

                ['id'=>	87,
                'name'=>'Nguyễn Văn Toản',
                'email'=>'vantoan@gmail.com',
                'password'=>Hash::make('toannv'),
                'phone'=> '03256545758',
                'gender'=> 1],

                ['id'=>	88,
                'name'=>'Trần Thạch Thảo',
                'email'=>'thao@gmail.com',
                'password'=>Hash::make('thaott'),
                'phone'=> '0325414743',
                'gender'=> 0],

                ['id'=>	89,
                'name'=>'Nguyễn Quốc Huy',
                'email'=>'quochuy@gmail.com',
                'password'=>Hash::make('huynq'),
                'phone'=> '0325786951',
                'gender'=> 1],

                ['id'=>	90,
                'name'=>'Nguyễn Huy Hùng',
                'email'=>'huyhung@gmail.com',
                'password'=>Hash::make('hungnh'),
                'phone'=> '03256128936',
                'gender'=> 1],

                ['id'=>	91,
                'name'=>'Nguyễn Hoàng Quý',
                'email'=>'hoangquy@gmail.com',
                'password'=>Hash::make('quynh'),
                'phone'=> '03256457812',
                'gender'=> 1],

                ['id'=>	92,
                'name'=>'Lê Thị Thanh Hoa',
                'email'=>'thanhhoa@gmail.com',
                'password'=>Hash::make('hoaltt'),
                'phone'=> '03258582594',
                'gender'=> 0],

                ['id'=>	93,
                'name'=>'Lý Quốc Trường',
                'email'=>'quoctruong@gmail.com',
                'password'=>Hash::make('truonglq'),
                'phone'=> '03652147896',
                'gender'=> 1],

                ['id'=>	94,
                'name'=>'Nguyễn Thảo Đan',
                'email'=>'thaodan@gmail.com',
                'password'=>Hash::make('dannt'),
                'phone'=> '03256971358',
                'gender'=> 0],

                ['id'=>	95,
                'name'=>'Lương Thiên Bình',
                'email'=>'thienbinh@gmail.com',
                'password'=>Hash::make('binhlt'),
                'phone'=> '03369562365',
                'gender'=> 1],

                ['id'=>	96,
                'name'=>'Trần Chí Trung',
                'email'=>'chitrung@gmail.com',
                'password'=>Hash::make('trungtc'),
                'phone'=> '03256128936',
                'gender'=> 1],

                ['id'=>	97,
                'name'=>'Nguyễn Quốc Chính',
                'email'=>'quocchinh@gmail.com',
                'password'=>Hash::make('chinhnq'),
                'phone'=> '03256896521',
                'gender'=> 1],

                ['id'=>	98,
                'name'=>'Lê Thành Công',
                'email'=>'thanhcong@gmail.com',
                'password'=>Hash::make('conglt'),
                'phone'=> '03256969632',
                'gender'=> 1],

                ['id'=>	99,
                'name'=>'Nguyễn Minh Hưng',
                'email'=>'minhhung@gmail.com',
                'password'=>Hash::make('hungnm'),
                'phone'=> '03256969369',
                'gender'=> 1],

                ['id'=>	100,
                'name'=>'Trần Nguyên Dung',
                'email'=>'nguyendung@gmail.com',
                'password'=>Hash::make('dungtn'),
                'phone'=> '03256985412',
                'gender'=> 1],
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
            ['id' => 6,  'customer_id' => 6,'block' => 1, 'floor' => 1, 'apartment' => 6, 'acreage' => 90, 'hired' => 1],
            ['id' => 7,  'customer_id' => 7,'block' => 1, 'floor' => 1, 'apartment' => 7, 'acreage' => 90, 'hired' => 1],
            ['id' => 8,  'customer_id' => 8,'block' => 1, 'floor' => 1, 'apartment' => 8, 'acreage' => 90, 'hired' => 1],
            ['id' => 9,  'customer_id' => 9,'block' => 1, 'floor' => 1, 'apartment' => 9, 'acreage' => 90, 'hired' => 1],
            ['id' => 10, 'customer_id' => 10, 'block' => 1, 'floor' => 1, 'apartment' => 10, 'acreage' => 85, 'hired' => 1],
            ['id' => 11, 'customer_id' => 11, 'block' => 1, 'floor' => 1, 'apartment' => 11, 'acreage' => 85, 'hired' => 1],
            ['id' => 12, 'customer_id' => 12, 'block' => 1, 'floor' => 1, 'apartment' => 12, 'acreage' => 85, 'hired' => 1],
            ['id' => 13, 'customer_id' => 13, 'block' => 1, 'floor' => 1, 'apartment' => 13, 'acreage' => 85, 'hired' => 1],
            ['id' => 14, 'customer_id' => 14, 'block' => 1, 'floor' => 1, 'apartment' => 14, 'acreage' => 85, 'hired' => 1],
            ['id' => 15, 'customer_id' => 15, 'block' => 1, 'floor' => 1, 'apartment' => 15, 'acreage' => 85, 'hired' => 1],
            ['id' => 16,  'customer_id' => 16,'block' => 1, 'floor' => 1, 'apartment' => 16, 'acreage' => 80, 'hired' => 1],
            ['id' => 17,  'customer_id' => 17,'block' => 1, 'floor' => 1, 'apartment' => 17, 'acreage' => 80, 'hired' => 1],
            ['id' => 18,  'customer_id' => 18,'block' => 1, 'floor' => 1, 'apartment' => 18, 'acreage' => 80, 'hired' => 1],
            ['id' => 19,  'customer_id' => 19,'block' => 1, 'floor' => 1, 'apartment' => 19, 'acreage' => 80, 'hired' => 1],
            ['id' => 20,  'customer_id' => 20,'block' => 1, 'floor' => 1, 'apartment' => 20, 'acreage' => 80, 'hired' => 1],
            ['id' => 21,  'customer_id' => 21,'block' => 1, 'floor' => 2, 'apartment' => 1, 'acreage' => 90, 'hired' => 1],
            ['id' => 22,  'customer_id' => 22,'block' => 1, 'floor' => 2, 'apartment' => 2, 'acreage' => 90, 'hired' => 1],
            ['id' => 23,  'customer_id' => 23,'block' => 1, 'floor' => 2, 'apartment' => 3, 'acreage' => 90, 'hired' => 1],
            ['id' => 24,  'customer_id' => 24,'block' => 1, 'floor' => 2, 'apartment' => 4, 'acreage' => 90, 'hired' => 1],
            ['id' => 25, 'customer_id' => 25, 'block' => 1, 'floor' => 2, 'apartment' => 5, 'acreage' => 85, 'hired' => 1],
            ['id' => 26, 'customer_id' => 26, 'block' => 1, 'floor' => 2, 'apartment' => 6, 'acreage' => 85, 'hired' => 1],
            ['id' => 27, 'customer_id' => 27, 'block' => 1, 'floor' => 2, 'apartment' => 7, 'acreage' => 85, 'hired' => 1],
            ['id' => 28, 'customer_id' => 28, 'block' => 1, 'floor' => 2, 'apartment' => 8, 'acreage' => 85, 'hired' => 1],
            ['id' => 29, 'customer_id' => 29, 'block' => 1, 'floor' => 2, 'apartment' => 9, 'acreage' => 85, 'hired' => 1],
            ['id' => 30, 'customer_id' => 30, 'block' => 1, 'floor' => 2, 'apartment' => 10, 'acreage' => 85, 'hired' => 1],
            ['id' => 31,  'customer_id' => 31,'block' => 1, 'floor' => 3, 'apartment' => 1, 'acreage' => 80, 'hired' => 1],
            ['id' => 32,  'customer_id' => 32,'block' => 1, 'floor' => 3, 'apartment' => 2, 'acreage' => 80, 'hired' => 1],
            ['id' => 33,  'customer_id' => 33,'block' => 1, 'floor' => 3, 'apartment' => 3, 'acreage' => 80, 'hired' => 1],
            ['id' => 34,  'customer_id' => 34,'block' => 1, 'floor' => 3, 'apartment' => 4, 'acreage' => 80, 'hired' => 1],
            ['id' => 35,  'customer_id' => 35,'block' => 1, 'floor' => 3, 'apartment' => 5, 'acreage' => 80, 'hired' => 1],
            ['id' => 36,  'customer_id' => 36,'block' => 1, 'floor' => 3, 'apartment' => 6, 'acreage' => 90, 'hired' => 1],
            ['id' => 37,  'customer_id' => 37,'block' => 1, 'floor' => 3, 'apartment' => 7, 'acreage' => 90, 'hired' => 1],
            ['id' => 38,  'customer_id' => 38,'block' => 1, 'floor' => 3, 'apartment' => 8, 'acreage' => 90, 'hired' => 1],
            ['id' => 39,  'customer_id' => 39,'block' => 1, 'floor' => 3, 'apartment' => 9, 'acreage' => 90, 'hired' => 1],
            ['id' => 40, 'customer_id' => 40, 'block' => 1, 'floor' => 3, 'apartment' => 10, 'acreage' => 85, 'hired' => 1],

            ['id' => 41, 'customer_id' => 41, 'block' => 2, 'floor' => 1, 'apartment' => 1, 'acreage' => 85, 'hired' => 1],
            ['id' => 42, 'customer_id' => 42, 'block' => 2, 'floor' => 1, 'apartment' => 2, 'acreage' => 85, 'hired' => 1],
            ['id' => 43, 'customer_id' => 43, 'block' => 2, 'floor' => 1, 'apartment' => 3, 'acreage' => 85, 'hired' => 1],
            ['id' => 44, 'customer_id' => 44, 'block' => 2, 'floor' => 1, 'apartment' => 4, 'acreage' => 85, 'hired' => 1],
            ['id' => 45, 'customer_id' => 45, 'block' => 2, 'floor' => 1, 'apartment' => 5, 'acreage' => 85, 'hired' => 1],
            ['id' => 46,  'customer_id' => 46,'block' => 2, 'floor' => 1, 'apartment' => 6, 'acreage' => 80, 'hired' => 1],
            ['id' => 47,  'customer_id' => 47,'block' => 2, 'floor' => 1, 'apartment' => 7, 'acreage' => 80, 'hired' => 1],
            ['id' => 48,  'customer_id' => 48,'block' => 2, 'floor' => 1, 'apartment' => 8, 'acreage' => 80, 'hired' => 1],
            ['id' => 49,  'customer_id' => 49,'block' => 2, 'floor' => 1, 'apartment' => 9, 'acreage' => 80, 'hired' => 1],
            ['id' => 50,  'customer_id' => 50,'block' => 2, 'floor' => 1, 'apartment' => 10, 'acreage' => 80, 'hired' => 1],
            ['id' => 51,  'customer_id' => 51,'block' => 2, 'floor' => 1, 'apartment' => 11, 'acreage' => 90, 'hired' => 1],
            ['id' => 52,  'customer_id' => 52,'block' => 2, 'floor' => 1, 'apartment' => 12, 'acreage' => 90, 'hired' => 1],
            ['id' => 53,  'customer_id' => 53,'block' => 2, 'floor' => 1, 'apartment' => 13, 'acreage' => 90, 'hired' => 1],
            ['id' => 54,  'customer_id' => 54,'block' => 2, 'floor' => 1, 'apartment' => 14, 'acreage' => 90, 'hired' => 1],
            ['id' => 55, 'customer_id' => 55, 'block' => 2, 'floor' => 1, 'apartment' => 15, 'acreage' => 85, 'hired' => 1],
            ['id' => 56, 'customer_id' => 56, 'block' => 2, 'floor' => 2, 'apartment' => 1, 'acreage' => 85, 'hired' => 1],
            ['id' => 57, 'customer_id' => 57, 'block' => 2, 'floor' => 2, 'apartment' => 2, 'acreage' => 85, 'hired' => 1],
            ['id' => 58, 'customer_id' => 58, 'block' => 2, 'floor' => 2, 'apartment' => 3, 'acreage' => 85, 'hired' => 1],
            ['id' => 59, 'customer_id' => 59, 'block' => 2, 'floor' => 2, 'apartment' => 4, 'acreage' => 85, 'hired' => 1],
            ['id' => 60, 'customer_id' => 60, 'block' => 2, 'floor' => 2, 'apartment' => 5, 'acreage' => 85, 'hired' => 1],
            ['id' => 61,  'customer_id' => 61,'block' => 2, 'floor' => 2, 'apartment' => 6, 'acreage' => 80, 'hired' => 1],
            ['id' => 62,  'customer_id' => 62,'block' => 2, 'floor' => 2, 'apartment' => 7, 'acreage' => 80, 'hired' => 1],
            ['id' => 63,  'customer_id' => 63,'block' => 2, 'floor' => 2, 'apartment' => 8, 'acreage' => 80, 'hired' => 1],
            ['id' => 64,  'customer_id' => 64,'block' => 2, 'floor' => 2, 'apartment' => 9, 'acreage' => 80, 'hired' => 1],
            ['id' => 65,  'customer_id' => 65,'block' => 2, 'floor' => 2, 'apartment' => 10, 'acreage' => 80, 'hired' => 1],
            ['id' => 66,  'customer_id' => 66,'block' => 2, 'floor' => 2, 'apartment' => 11, 'acreage' => 90, 'hired' => 1],
            ['id' => 67,  'customer_id' => 67,'block' => 2, 'floor' => 2, 'apartment' => 12, 'acreage' => 90, 'hired' => 1],
            ['id' => 68,  'customer_id' => 68,'block' => 2, 'floor' => 2, 'apartment' => 13, 'acreage' => 90, 'hired' => 1],
            ['id' => 69,  'customer_id' => 69,'block' => 2, 'floor' => 2, 'apartment' => 14, 'acreage' => 90, 'hired' => 1],
            ['id' => 70, 'customer_id' => 70, 'block' => 2, 'floor' => 2, 'apartment' => 15, 'acreage' => 85, 'hired' => 1],

            ['id' => 71, 'customer_id' => 71, 'block' => 3, 'floor' => 1, 'apartment' => 1, 'acreage' => 85, 'hired' => 1],
            ['id' => 72, 'customer_id' => 72, 'block' => 3, 'floor' => 1, 'apartment' => 2, 'acreage' => 85, 'hired' => 1],
            ['id' => 73, 'customer_id' => 73, 'block' => 3, 'floor' => 1, 'apartment' => 3, 'acreage' => 85, 'hired' => 1],
            ['id' => 74, 'customer_id' => 74, 'block' => 3, 'floor' => 1, 'apartment' => 4, 'acreage' => 85, 'hired' => 1],
            ['id' => 75, 'customer_id' => 75, 'block' => 3, 'floor' => 1, 'apartment' => 5, 'acreage' => 85, 'hired' => 1],
            ['id' => 76,  'customer_id' => 76,'block' => 3, 'floor' => 1, 'apartment' => 6, 'acreage' => 80, 'hired' => 1],
            ['id' => 77,  'customer_id' => 77,'block' => 3, 'floor' => 1, 'apartment' => 7, 'acreage' => 80, 'hired' => 1],
            ['id' => 78,  'customer_id' => 78,'block' => 3, 'floor' => 1, 'apartment' => 8, 'acreage' => 80, 'hired' => 1],
            ['id' => 79,  'customer_id' => 79,'block' => 3, 'floor' => 1, 'apartment' => 9, 'acreage' => 80, 'hired' => 1],
            ['id' => 80,  'customer_id' => 80,'block' => 3, 'floor' => 1, 'apartment' => 10, 'acreage' => 80, 'hired' => 1],
            ['id' => 81,  'customer_id' => 81,'block' => 3, 'floor' => 1, 'apartment' => 11, 'acreage' => 90, 'hired' => 1],
            ['id' => 82,  'customer_id' => 82,'block' => 3, 'floor' => 1, 'apartment' => 12, 'acreage' => 90, 'hired' => 1],
            ['id' => 83,  'customer_id' => 83,'block' => 3, 'floor' => 1, 'apartment' => 13, 'acreage' => 90, 'hired' => 1],
            ['id' => 84,  'customer_id' => 84,'block' => 3, 'floor' => 1, 'apartment' => 14, 'acreage' => 90, 'hired' => 1],
            ['id' => 85, 'customer_id' => 85, 'block' => 3, 'floor' => 1, 'apartment' => 15, 'acreage' => 85, 'hired' => 1],
            ['id' => 86, 'customer_id' => 86, 'block' => 3, 'floor' => 2, 'apartment' => 1, 'acreage' => 85, 'hired' => 1],
            ['id' => 87, 'customer_id' => 87, 'block' => 3, 'floor' => 2, 'apartment' => 2, 'acreage' => 85, 'hired' => 1],
            ['id' => 88, 'customer_id' => 88, 'block' => 3, 'floor' => 2, 'apartment' => 3, 'acreage' => 85, 'hired' => 1],
            ['id' => 89, 'customer_id' => 89, 'block' => 3, 'floor' => 2, 'apartment' => 4, 'acreage' => 85, 'hired' => 1],
            ['id' => 90, 'customer_id' => 90, 'block' => 3, 'floor' => 2, 'apartment' => 5, 'acreage' => 85, 'hired' => 1],
            ['id' => 91,  'customer_id' => 91,'block' => 3, 'floor' => 2, 'apartment' => 6, 'acreage' => 80, 'hired' => 1],
            ['id' => 92,  'customer_id' => 92,'block' => 3, 'floor' => 2, 'apartment' => 7, 'acreage' => 80, 'hired' => 1],
            ['id' => 93,  'customer_id' => 93,'block' => 3, 'floor' => 2, 'apartment' => 8, 'acreage' => 80, 'hired' => 1],
            ['id' => 94,  'customer_id' => 94,'block' => 3, 'floor' => 2, 'apartment' => 9, 'acreage' => 80, 'hired' => 1],
            ['id' => 95,  'customer_id' => 95,'block' => 3, 'floor' => 2, 'apartment' => 10, 'acreage' => 80, 'hired' => 1],
            ['id' => 96,  'customer_id' => 96,'block' => 3, 'floor' => 2, 'apartment' => 11, 'acreage' => 90, 'hired' => 1],
            ['id' => 97,  'customer_id' => 97,'block' => 3, 'floor' => 2, 'apartment' => 12, 'acreage' => 90, 'hired' => 1],
            ['id' => 98,  'customer_id' => 98,'block' => 3, 'floor' => 2, 'apartment' => 13, 'acreage' => 90, 'hired' => 1],
            ['id' => 99,  'customer_id' => 99,'block' => 3, 'floor' => 2, 'apartment' => 14, 'acreage' => 90, 'hired' => 1],
            ['id' => 100, 'customer_id' => 100, 'block' => 3, 'floor' => 2, 'apartment' => 15, 'acreage' => 85, 'hired' => 1],
            ['id' => 101, 'customer_id' => null, 'block' => 3, 'floor' => 2, 'apartment' => 16, 'acreage' => 85, 'hired' => 0],
            ['id' => 102, 'customer_id' => null, 'block' => 3, 'floor' => 2, 'apartment' => 17, 'acreage' => 85, 'hired' => 0],
            ['id' => 103, 'customer_id' => null, 'block' => 3, 'floor' => 2, 'apartment' => 18, 'acreage' => 85, 'hired' => 0],
            ['id' => 104, 'customer_id' => null, 'block' => 3, 'floor' => 2, 'apartment' => 19, 'acreage' => 85, 'hired' => 0],
            ['id' => 105, 'customer_id' => null, 'block' => 3, 'floor' => 2, 'apartment' => 20, 'acreage' => 85, 'hired' => 0],
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

            ['id' => 18, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 9, 'vehicle_id' => 1],
            ['id' => 19, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 9, 'vehicle_id' => 2],
            ['id' => 20, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 10, 'vehicle_id' => 1],
            ['id' => 21, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 10, 'vehicle_id' => 3],
            ['id' => 22, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 11, 'vehicle_id' => 1],
            ['id' => 23, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 11, 'vehicle_id' => 2],
            ['id' => 24, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 12, 'vehicle_id' => 1],
            ['id' => 25, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 12, 'vehicle_id' => 2],
            ['id' => 26, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 13, 'vehicle_id' => 1],
            ['id' => 27, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 13, 'vehicle_id' => 3],
            ['id' => 28, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 13, 'vehicle_id' => 2],
            ['id' => 29, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 14, 'vehicle_id' => 1],
            ['id' => 30, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 14, 'vehicle_id' => 2],
            ['id' => 31, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 14, 'vehicle_id' => 3],
            ['id' => 32, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 15, 'vehicle_id' => 1],
            ['id' => 33, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 15, 'vehicle_id' => 2],
            ['id' => 34, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 15, 'vehicle_id' => 3],

            ['id' => 35, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 16, 'vehicle_id' => 1],
            ['id' => 36, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 16, 'vehicle_id' => 2],
            ['id' => 37, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 17, 'vehicle_id' => 1],
            ['id' => 38, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 17, 'vehicle_id' => 3],
            ['id' => 39, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 18, 'vehicle_id' => 1],
            ['id' => 40, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 18, 'vehicle_id' => 2],
            ['id' => 41, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 19, 'vehicle_id' => 1],
            ['id' => 42, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 19, 'vehicle_id' => 2],
            ['id' => 43, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 20, 'vehicle_id' => 1],
            ['id' => 44, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 20, 'vehicle_id' => 3],
            ['id' => 45, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 20, 'vehicle_id' => 2],
            ['id' => 46, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 21, 'vehicle_id' => 1],
            ['id' => 47, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 21, 'vehicle_id' => 2],
            ['id' => 48, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 21, 'vehicle_id' => 3],
            ['id' => 49, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 22, 'vehicle_id' => 1],
            ['id' => 50, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 22, 'vehicle_id' => 2],
            ['id' => 51, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 22, 'vehicle_id' => 3],

            ['id' => 52, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 23, 'vehicle_id' => 1],
            ['id' => 53, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 23, 'vehicle_id' => 2],
            ['id' => 54, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 24, 'vehicle_id' => 1],
            ['id' => 55, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 24, 'vehicle_id' => 3],
            ['id' => 56, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 25, 'vehicle_id' => 1],
            ['id' => 57, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 25, 'vehicle_id' => 2],
            ['id' => 58, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 26, 'vehicle_id' => 1],
            ['id' => 59, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 26, 'vehicle_id' => 2],
            ['id' => 60, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 27, 'vehicle_id' => 1],
            ['id' => 61, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 27, 'vehicle_id' => 3],
            ['id' => 62, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 27, 'vehicle_id' => 2],
            ['id' => 63, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 28, 'vehicle_id' => 1],
            ['id' => 64, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 28, 'vehicle_id' => 2],
            ['id' => 65, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 28, 'vehicle_id' => 3],
            ['id' => 66, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 29, 'vehicle_id' => 1],
            ['id' => 67, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 29, 'vehicle_id' => 2],
            ['id' => 68, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 29, 'vehicle_id' => 3],

            ['id' => 69, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 30, 'vehicle_id' => 1],
            ['id' => 70, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 30, 'vehicle_id' => 2],
            ['id' => 71, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 31, 'vehicle_id' => 1],
            ['id' => 72, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 31, 'vehicle_id' => 3],
            ['id' => 73, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 32, 'vehicle_id' => 1],
            ['id' => 74, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 32, 'vehicle_id' => 2],
            ['id' => 75, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 33, 'vehicle_id' => 1],
            ['id' => 76, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 33, 'vehicle_id' => 2],
            ['id' => 77, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 34, 'vehicle_id' => 1],
            ['id' => 78, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 34, 'vehicle_id' => 3],
            ['id' => 79, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 34, 'vehicle_id' => 2],
            ['id' => 80, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 35, 'vehicle_id' => 1],
            ['id' => 81, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 35, 'vehicle_id' => 2],
            ['id' => 82, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 35, 'vehicle_id' => 3],
            ['id' => 83, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 36, 'vehicle_id' => 1],
            ['id' => 84, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 36, 'vehicle_id' => 2],
            ['id' => 85, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 36, 'vehicle_id' => 3],

            ['id' => 86, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 37, 'vehicle_id' => 1],
            ['id' => 87, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 37, 'vehicle_id' => 2],
            ['id' => 88, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 38, 'vehicle_id' => 1],
            ['id' => 89, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 38, 'vehicle_id' => 3],
            ['id' => 90, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 39, 'vehicle_id' => 1],
            ['id' => 91, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 39, 'vehicle_id' => 2],
            ['id' => 92, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 40, 'vehicle_id' => 1],
            ['id' => 93, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 40, 'vehicle_id' => 2],
            ['id' => 94, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 41, 'vehicle_id' => 1],
            ['id' => 95, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 41, 'vehicle_id' => 3],
            ['id' => 96, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 41, 'vehicle_id' => 2],
            ['id' => 97, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 42, 'vehicle_id' => 1],
            ['id' => 98, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 42, 'vehicle_id' => 2],
            ['id' => 99, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 42, 'vehicle_id' => 3],
            ['id' => 100, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 43, 'vehicle_id' => 1],
            ['id' => 101, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 43, 'vehicle_id' => 2],
            ['id' => 102, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 43, 'vehicle_id' => 3],

            ['id' => 103, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 44, 'vehicle_id' => 1],
            ['id' => 104, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 44, 'vehicle_id' => 2],
            ['id' => 105, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 45, 'vehicle_id' => 1],
            ['id' => 106, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 45, 'vehicle_id' => 3],
            ['id' => 107, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 46, 'vehicle_id' => 1],
            ['id' => 108, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 46, 'vehicle_id' => 2],
            ['id' => 109, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 47, 'vehicle_id' => 1],
            ['id' => 110, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 47, 'vehicle_id' => 2],
            ['id' => 111, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 48, 'vehicle_id' => 1],
            ['id' => 112, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 48, 'vehicle_id' => 3],
            ['id' => 113, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 48, 'vehicle_id' => 2],
            ['id' => 114, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 49, 'vehicle_id' => 1],
            ['id' => 115, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 49, 'vehicle_id' => 2],
            ['id' => 116, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 49, 'vehicle_id' => 3],
            ['id' => 117, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 50, 'vehicle_id' => 1],
            ['id' => 118, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 50, 'vehicle_id' => 2],
            ['id' => 119, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 50, 'vehicle_id' => 3],

            ['id' => 120, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 51, 'vehicle_id' => 1],
            ['id' => 121, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 51, 'vehicle_id' => 2],
            ['id' => 122, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 52, 'vehicle_id' => 1],
            ['id' => 123, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 52, 'vehicle_id' => 3],
            ['id' => 124, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 53, 'vehicle_id' => 1],
            ['id' => 125, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 53, 'vehicle_id' => 2],
            ['id' => 126, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 54, 'vehicle_id' => 1],
            ['id' => 127, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 54, 'vehicle_id' => 2],
            ['id' => 128, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 55, 'vehicle_id' => 1],
            ['id' => 129, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 55, 'vehicle_id' => 3],
            ['id' => 130, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 55, 'vehicle_id' => 2],
            ['id' => 131, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 56, 'vehicle_id' => 1],
            ['id' => 132, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 56, 'vehicle_id' => 2],
            ['id' => 133, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 56, 'vehicle_id' => 3],
            ['id' => 134, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 57, 'vehicle_id' => 1],
            ['id' => 135, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 57, 'vehicle_id' => 2],
            ['id' => 136, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 57, 'vehicle_id' => 3],

            ['id' => 137, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 58, 'vehicle_id' => 1],
            ['id' => 138, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 58, 'vehicle_id' => 2],
            ['id' => 139, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 59, 'vehicle_id' => 1],
            ['id' => 140, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 59, 'vehicle_id' => 3],
            ['id' => 141, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 60, 'vehicle_id' => 1],
            ['id' => 142, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 60, 'vehicle_id' => 2],
            ['id' => 143, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 61, 'vehicle_id' => 1],
            ['id' => 144, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 61, 'vehicle_id' => 2],
            ['id' => 145, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 62, 'vehicle_id' => 1],
            ['id' => 146, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 62, 'vehicle_id' => 3],
            ['id' => 147, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 62, 'vehicle_id' => 2],
            ['id' => 148, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 63, 'vehicle_id' => 1],
            ['id' => 149, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 63, 'vehicle_id' => 2],
            ['id' => 150, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 63, 'vehicle_id' => 3],
            ['id' => 151, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 64, 'vehicle_id' => 1],
            ['id' => 152, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 64, 'vehicle_id' => 2],
            ['id' => 153, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 64, 'vehicle_id' => 3],

            ['id' => 154, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 65, 'vehicle_id' => 1],
            ['id' => 155, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 65, 'vehicle_id' => 2],
            ['id' => 156, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 66, 'vehicle_id' => 1],
            ['id' => 157, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 66, 'vehicle_id' => 3],
            ['id' => 158, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 67, 'vehicle_id' => 1],
            ['id' => 159, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 67, 'vehicle_id' => 2],
            ['id' => 160, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 68, 'vehicle_id' => 1],
            ['id' => 161, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 68, 'vehicle_id' => 2],
            ['id' => 162, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 69, 'vehicle_id' => 1],
            ['id' => 163, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 69, 'vehicle_id' => 3],
            ['id' => 164, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 69, 'vehicle_id' => 2],
            ['id' => 165, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 70, 'vehicle_id' => 1],
            ['id' => 166, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 70, 'vehicle_id' => 2],
            ['id' => 167, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 70, 'vehicle_id' => 3],
            ['id' => 168, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 71, 'vehicle_id' => 1],
            ['id' => 169, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 71, 'vehicle_id' => 2],
            ['id' => 170, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 71, 'vehicle_id' => 3],
            
            ['id' => 171, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 72, 'vehicle_id' => 1],
            ['id' => 172, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 73, 'vehicle_id' => 2],
            ['id' => 173, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 74, 'vehicle_id' => 1],
            ['id' => 174, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 75, 'vehicle_id' => 3],
            ['id' => 175, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 76, 'vehicle_id' => 1],
            ['id' => 176, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 77, 'vehicle_id' => 2],
            ['id' => 177, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 78, 'vehicle_id' => 1],
            ['id' => 178, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 79, 'vehicle_id' => 2],
            ['id' => 179, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 80, 'vehicle_id' => 1],
            ['id' => 180, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 81, 'vehicle_id' => 3],
            ['id' => 181, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 82, 'vehicle_id' => 2],
            ['id' => 182, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 83, 'vehicle_id' => 1],
            ['id' => 183, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 84, 'vehicle_id' => 2],
            ['id' => 184, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 85, 'vehicle_id' => 3],
            ['id' => 185, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 86, 'vehicle_id' => 1],
            ['id' => 186, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 87, 'vehicle_id' => 2],
            ['id' => 187, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 88, 'vehicle_id' => 3],

            ['id' => 188, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 89, 'vehicle_id' => 1],
            ['id' => 189, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 90, 'vehicle_id' => 2],
            ['id' => 190, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 91, 'vehicle_id' => 1],
            ['id' => 191, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 92, 'vehicle_id' => 3],
            ['id' => 192, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 92, 'vehicle_id' => 1],
            ['id' => 193, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 93, 'vehicle_id' => 2],
            ['id' => 194, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 94, 'vehicle_id' => 1],
            ['id' => 195, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 95, 'vehicle_id' => 2],
            ['id' => 196, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 96, 'vehicle_id' => 1],
            ['id' => 197, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 97, 'vehicle_id' => 3],
            ['id' => 198, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 98, 'vehicle_id' => 2],
            ['id' => 199, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 98, 'vehicle_id' => 1],
            ['id' => 200, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 99, 'vehicle_id' => 2],
            ['id' => 201, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 99, 'vehicle_id' => 3],
            ['id' => 202, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 100, 'vehicle_id' => 1],
            ['id' => 203, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 2, 'using' => 1, 'customer_id' => 100, 'vehicle_id' => 2],
            ['id' => 204, 'month_start_use' => 5, 'year_use' => 2020, 'amount' => 1, 'using' => 1, 'customer_id' => 100, 'vehicle_id' => 3],



        ]);

        // DB::table('statisticals')->insert([
        //     ['id' => 1, 'month' => 5, 'living_expenses_type_id' => 1, 'total_price' => 0 ],
        //     ['id' => 2, 'month' => 5, 'living_expenses_type_id' => 2, 'total_price' => 0 ],
        //     ['id' => 3, 'month' => 5, 'living_expenses_type_id' => 3, 'total_price' => 0 ],
        // ]);  
    }
    
}
