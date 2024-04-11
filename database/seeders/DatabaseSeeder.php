<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ObjectCategory;
use App\Models\Position;
use App\Models\PositionType;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    private function createPositionType():void
    {
        $data = [
            [
                'name'=> 'Y Tế',
                'icon_path'=>'/images/BCA/hospital.png'
            ],
            [
                'name'=> 'Công An',
                'icon_path'=>'/images/BCA/ca.png'
            ],
            [
                'name'=> 'Khách sạn',
                'icon_path'=>'/images/BCA/hotel.png'
            ],
        ];
        foreach ($data as $item) {
            PositionType::create($item);
        }
    }
    private function createObjectCategory():void
    {
        $data = [
            [
                'name'=> 'Tòa nhà',
                'description'=>'',
                'parent_id'=>null
            ], [
                'name'=> 'Cầu',
                'description'=>'',
                'parent_id'=>null
            ], [
                'name'=> 'Cây cối',
                'description'=>'',
                'parent_id'=>null
            ], [
                'name'=> 'Đèn đường',
                'description'=>'',
                'parent_id'=>null
            ], [
                'name'=> 'Tàu thuyền',
                'description'=>'',
                'parent_id'=>null
            ], [
                'name'=> 'Phương tiện giao thông',
                'description'=>'',
                'parent_id'=>null
            ], [
                'name'=> 'Hàng hóa',
                'description'=>'',
                'parent_id'=>null
            ], [
                'name'=> 'Hầm',
                'description'=>'',
                'parent_id'=>null
            ], [
                'name'=> 'Công trình xây dựng',
                'description'=>'',
                'parent_id'=>null
            ], [
                'name'=> 'Đường đi',
                'description'=>'',
                'parent_id'=>null
            ], [
                'name'=> 'Đường ống nước',
                'description'=>'',
                'parent_id'=>null
            ], [
                'name'=> 'Cơ sở tín ngưỡng',
                'description'=>'',
                'parent_id'=>null
            ], [
                'name'=> 'Bãi đỗ xe',
                'description'=>'',
                'parent_id'=>null
            ],

        ];
        foreach ($data as $item) {
            ObjectCategory::create($item);
        }

    }
    private function createUser():void
    {
        $data = [
            [
                'name' => 'Nguyễn Văn A',
                'email' => 'anv1@gmail.com',
            ],
            [
                'name' => 'Nguyễn Văn B',
                'email' => 'bnv1@gmail.com',
            ],
            [
                'name' => 'Nguyễn Văn C',
                'email' => 'cnv1@gmail.com',
            ],
            [
                'name' => 'Nguyễn Văn D',
                'email' => 'dnv1@gmail.com',
            ],
            [
                'name' => 'Nguyễn Văn E',
                'email' => 'env1@gmail.com',
            ],
            [
                'name' => 'Nguyễn Văn F',
                'email' => 'fnv1@gmail.com',
            ],
        ];
        foreach ($data as $item) {
           User::create([
               ...$item,
               'phone' => '0868 XXX XXX',
               'password' => bcrypt('123456'),
               'avatar_path' => '/images/BCA/ca.png',
               'position_id' => Position::create([
                   'latitude' => 21.028511,
                   'longitude' => 105.804817,
                   'height' => 0,
               ])->id,
               'status' => 'active'
           ]);
        }
    }
    public function run(): void
    {
        $this->createPositionType();
        $this->createObjectCategory();
        $this->createUser();

    }
}
