<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ObjectCategory;
use App\Models\Position;
use App\Models\PositionType;
use App\Models\Route;
use App\Models\RoutePosition;
use App\Models\Task;
use App\Models\User;
use DateTime;
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
                'icon_path'=>'/images/BCA/hospital.png',
                'color' => 'red',
                'cesium_icon' => 'hospital'
            ],
            [
                'name'=> 'Công An',
                'icon_path'=>'/images/BCA/ca.png',
                'color'=>'yellow',
                'cesium_icon' => 'star'
            ],
            [
                'name'=> 'Khách sạn',
                'icon_path'=>'/images/BCA/hotel.png',
                'color'=>'green',
                'cesium_icon' => 'town'

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
                'parent_id'=>null,
                'slug' => 'building'
            ], [
                'name'=> 'Cầu',
                'description'=>'',
                'parent_id'=>null,
                'slug' => 'bridge'
            ], [
                'name'=> 'Cây cối',
                'description'=>'',
                'parent_id'=>null,
                'slug' => 'plant'
            ], [
                'name'=> 'Đèn đường',
                'description'=>'',
                'parent_id'=>null,
                'slug' => 'streetLight'
            ], [
                'name'=> 'Tàu thuyền',
                'description'=>'',
                'parent_id'=>null,
                'slug' => 'ship'
            ], [
                'name'=> 'Phương tiện giao thông',
                'description'=>'',
                'parent_id'=>null,
                'slug' => 'vehicle'
            ], [
                'name'=> 'Hàng hóa',
                'description'=>'',
                'parent_id'=>null,
                'slug' => 'goods'
            ], [
                'name'=> 'Hầm',
                'description'=>'',
                'parent_id'=>null,
                'slug' => 'tunnel'
            ], [
                'name'=> 'Công trình xây dựng',
                'description'=>'',
                'parent_id'=>null,
                'slug' => 'construction'
            ], [
                'name'=> 'Đường đi',
                'description'=>'',
                'parent_id'=>null,
                'slug' => 'road'
            ], [
                'name'=> 'Đường ống nước',
                'description'=>'',
                'parent_id'=>null,
                'slug' => 'waterPipe'
            ], [
                'name'=> 'Cơ sở tín ngưỡng',
                'description'=>'',
                'parent_id'=>null,
                'slug' => 'religion'
            ], [
                'name'=> 'Bãi đỗ xe',
                'description'=>'',
                'parent_id'=>null,
                'slug' => 'carPark'
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
                'position' => [
                    'latitude' => 21.04151448231076,
                    'longitude' => 105.83817703559123,
                    'height' => 0,
                ]
            ],
            [
                'name' => 'Nguyễn Văn B',
                'email' => 'bnv1@gmail.com',
                'position' => [
                    'latitude' => 21.034191976561832,
                    'longitude' => 105.8348127,
                    'height' => 0,
                ]
            ],
            [
                'name' => 'Nguyễn Văn C',
                'email' => 'cnv1@gmail.com',
                'position' => [
                    'latitude' => 21.030927,
                    'longitude' => 105.827887,
                    'height' => 0,
                ]
            ],
            [
                'name' => 'Nguyễn Văn D',
                'email' => 'dnv1@gmail.com',
                'position' => [
                    'latitude' => 21.031373,
                    'longitude' => 105.816414,
                    'height' => 0,
                ]
            ],
            [
                'name' => 'Nguyễn Văn E',
                'email' => 'env1@gmail.com',
                'position' => [
                    'latitude' => 21.017383,
                    'longitude' => 105.807402,
                    'height' => 0,
                ]
            ],
            [
                'name' => 'Nguyễn Văn F',
                'email' => 'fnv1@gmail.com',
                'position' => [
                    'latitude' => 21.003672,
                    'longitude' => 105.792474,
                    'height' => 0,
                ]
            ],
            [
                'name' => 'Nguyễn Văn G',
                'email' => 'gnv1@gmail.com',
                'position' => [
                    'latitude' => 21.034709,
                    'longitude' => 105.836593,
                    'height' => 0,
                ]
            ],
        ];
        foreach ($data as $item) {
           User::create([
               'name' => $item['name'],
               'email' => $item['email'],
               'phone' => '0868 XXX XXX',
               'password' => bcrypt('123456'),
               'function' => 'Chiến sĩ',
               'birthday' => new DateTime('1979-01-01'),
               'avatar_path' => '/images/BCA/police.jpg',
               'position_id' => Position::create([
                   'latitude' => $item["position"]['latitude'],
                   'longitude' => $item["position"]['longitude'],
                   'height' =>  $item["position"]['height'],
               ])->id,
               'status' => 'active',
               'code' => 'K12 '.rand(12,50)
           ]);
        }
    }


    /**
     * @throws \Exception
     */
    private function createTask():void{
        $tasks = [
            [
                "name" => "Bảo vệ xe mục tiêu",
                "description" => "Bảo vệ xe mục tiêu",
                "type" => "protect",
                "start_date" => "2024-04-15",
                "end_date" => "2024-04-16",
                "status" => "Đang thực hiện",
            ],
            [
                "name" => "Trinh sát mục tiêu",
                "description" => "Trinh sát các mục tiêu",
                "type" => "reconnaissance",
                "start_date" => "2024-04-15",
                "end_date" => "2024-04-16",
                "status" => "Đang thực hiện",
            ],

        ];

        foreach ($tasks as $task){
            Task::create([
                "name"=> $task["name"],
                "description"=> $task["description"],
                "type"=> $task["type"],
                "start_date"=>  new DateTime($task["start_date"]),
                "end_date"=> new DateTime($task["end_date"]),
                "status"=> $task["status"],
            ]);
        }
    }
    private function createRoute():void
    {
        $routes = [
            [
                "name" => "Phủ thủ tướng -> Khách sạn Marriott",
                "start_address" => "Phủ thủ tướng",
                "end_address" => "Khách sạn Marriott",
                "description" => "Đường đi từ Phủ thủ tướng đến khách sạn Marriott",
                "status" =>  "inprocess",
                "task_id" => 1,
                "points" => [
                    105.835053, 21.041054, 105.835078, 21.041261, 105.835036, 21.041497, 105.835073, 21.04185,
                    105.835871, 21.041753, 105.836203, 21.041628, 105.835675, 21.039096, 105.837032, 21.038845,
                    105.8364, 21.035697, 105.83639, 21.03548, 105.836748, 21.035169, 105.836705, 21.035076,
                    105.836731, 21.034988, 105.836782, 21.034941, 105.836863, 21.034924, 105.836609, 21.033661,
                    105.834626, 21.034044, 105.83372, 21.034259, 105.83362, 21.034207, 105.833557, 21.033509,
                    105.833556, 21.033303, 105.833421, 21.032938, 105.831744, 21.032958, 105.831332, 21.032938,
                    105.830191, 21.03281, 105.828878, 21.032544, 105.824949, 21.031789, 105.823453, 21.031584,
                    105.82261, 21.031472, 105.821632, 21.031307, 105.819946, 21.031063, 105.818253, 21.030835,
                    105.816226, 21.030575, 105.815085, 21.030875, 105.81341, 21.031366, 105.813081, 21.031456,
                    105.812731, 21.0302, 105.812275, 21.028248, 105.811744, 21.026112, 105.811617, 21.025851,
                    105.811747, 21.026141, 105.811191, 21.025138, 105.809771, 21.022835, 105.808106, 21.019932,
                    105.806562, 21.01721, 105.806463, 21.017017, 105.804394, 21.015043, 105.802944, 21.01378,
                    105.802643, 21.013599, 105.80048, 21.011552, 105.795843, 21.007914, 105.795632, 21.007772,
                    105.795137, 21.007412, 105.795124, 21.007329, 105.793719, 21.006285, 105.790661, 21.00422,
                    105.789251, 21.003342, 105.788259, 21.002869, 105.787427, 21.002595, 105.786246, 21.002328,
                    105.784809, 21.002187, 105.784569, 21.002202, 105.784454, 21.002235, 105.784332, 21.002283,
                    105.783637, 21.00246, 105.783389, 21.002625, 105.78281, 21.002709, 105.782482, 21.003201,
                    105.782812, 21.004705, 105.782824, 21.005149, 105.78277, 21.005363, 105.782768, 21.005626,
                    105.782678, 21.005924, 105.782389, 21.006415, 105.78191, 21.006939, 105.781327, 21.007471,
                    105.781287, 21.00764, 105.781324, 21.007784, 105.781737, 21.008102, 105.782878, 21.008904,
                    105.782998, 21.008736, 105.78338, 21.00868, 105.783629, 21.008621, 105.783619, 21.008358,
                    105.783296, 21.007902, 105.783242, 21.007688
                ]

            ]
        ];
        foreach ($routes as $route){
            $routeElement = Route::create([
                "name"=> $route["name"],
                "description"=> $route["description"],
                "start_position_id" => Position::create([
                    "latitude" => $route["points"][1],
                    "longitude" => $route["points"][0],
                    "height" => 0
                ])->id,
                "end_position_id" => Position::create([
                    "latitude" => $route["points"][count($route["points"])-1],
                    "longitude" => $route["points"][count($route["points"])-2],
                    "height" => 0
                ])->id,
                "start_address" => $route["start_address"],
                "end_address" => $route["end_address"],
                "status" => $route["status"],
                "task_id" => $route["task_id"],
            ]);

            for($i=0; $i<count($route["points"]); $i+=2){
                $position = Position::create([
                    "latitude" => $route["points"][$i+1],
                    "longitude" => $route["points"][$i],
                    "height" => 0
                ]);
                RoutePosition::create([
                    "route_id" => $routeElement->id,
                    "position_id" => $position->id,
                    "index" => $i/2,
                ]);
            }
        }
    }

    /**
     * @throws \Exception
     */
    public function run(): void
    {
        $this->createPositionType();
        $this->createObjectCategory();
        $this->createUser();
        $this->createTask();
        $this->createRoute();

    }
}
