<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use Illuminate\Http\Request;

class TestBlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $arr = [
            [
                "longitude" => '106.77709118108051',
                "latitude"  => '-6.142837378870265',
                "brand" => 'Infinix',
                "time"  => '2021-10-20 08:00:00',
                "user_count"    => '1'
            ],
            [
                "longitude" => '106.77709118108051',
                "latitude"  => '-6.142837378870265',
                "brand" => 'Samsung',
                "time"  => '2021-10-20 07:00:00',
                "user_count"    => '1'
            ],
            [
                "longitude" => '106.77809118108054',
                "latitude"  => '-6.142837378870266',
                "brand" => 'Xiaomi',
                "time"  => '2021-10-20 09:00:00',
                "user_count"    => '1'
            ],
            [
                "longitude" => '106.7790911810806',
                "latitude"  => '-6.142837378870266',
                "brand" => 'Xiaomi',
                "time"  => '2021-10-20 07:00:00',
                "user_count"    => '1'
            ],
            [
                "longitude" => '106.7790911810806',
                "latitude"  => '-6.142837378870266',
                "brand" => 'Oppo',
                "time"  => '2021-10-20 07:00:00',
                "user_count"    => '5'
            ],
            [
                "longitude" => '106.7790911810806',
                "latitude"  => '-6.142837378870266',
                "brand" => 'Xiaomi',
                "time"  => '2021-10-20 08:00:00',
                "user_count"    => '2'
            ],
            [
                "longitude" => '106.78109118108071',
                "latitude"  => '-6.142837378870266',
                "brand" => 'Itel',
                "time"  => '2021-10-20 08:00:00',
                "user_count"    => '8'
            ],
            [
                "longitude" => '106.78209118108074',
                "latitude"  => '-6.142837378870266',
                "brand" => 'Huawei',
                "time"  => '2021-10-20 08:00:00',
                "user_count"    => '6'
            ],
            [
                "longitude" => '106.78209118108074',
                "latitude"  => '-6.142837378870266',
                "brand" => 'Samsung',
                "time"  => '2021-10-20 08:00:00',
                "user_count"    => '1'
            ],
            [
                "longitude" => '106.78209118108074',
                "latitude"  => '-6.142837378870266',
                "brand" => 'Samsung',
                "time"  => '2021-10-20 07:00:00',
                "user_count"    => '2'
            ],
        ];
        $getDataTotalPenggunaPertitik = [];
        $getDataTotalPenggunaForPopUp = [];
        $curtime9pm = strtotime('today 9am');
        foreach ($arr as $key => $val) {
            if (date('H:i:s', strtotime($val["time"])) < date('H:i:s', $curtime9pm)) {
                $val["gabungan_time"] = implode(' to ', ["2021-10-20 07:00:00", "2021-10-20 08:00:00"]);
                $getDataTotalPenggunaForPopUp['brand'][] = $val['brand'];
                $getDataTotalPenggunaForPopUp['gabungan_time'] = $val['gabungan_time'];
                $val["gabungan_map"] = implode('|', [$val["longitude"], $val["latitude"]]);
                $val["gabungan_map_brand"] = implode('|', [$val["longitude"], $val["latitude"], $val["brand"]]);
                $val["total_user"] = $val['user_count'];
                $val["user_per_brand"] = $val['user_count'];
                $keyGetDataTotalPenggunaPertitik = array_search($val["gabungan_map"], array_column($getDataTotalPenggunaPertitik, 'gabungan_map'));
                if($keyGetDataTotalPenggunaPertitik !== false){
                    $val["total_user"] = $getDataTotalPenggunaPertitik[$keyGetDataTotalPenggunaPertitik]["total_user"]+ $val['user_count'];
                    $getDataTotalPenggunaPertitik[$keyGetDataTotalPenggunaPertitik]["total_user"] = $getDataTotalPenggunaPertitik[$keyGetDataTotalPenggunaPertitik]["total_user"]+ $val['user_count'];
                }
                $keyGetDataTotalPenggunaPerBrand = array_search($val["gabungan_map_brand"], array_column($getDataTotalPenggunaPertitik, 'gabungan_map_brand'));
                if($keyGetDataTotalPenggunaPerBrand !== false){
                    $getDataTotalPenggunaPertitik[$keyGetDataTotalPenggunaPerBrand]["user_per_brand"] = $getDataTotalPenggunaPertitik[$keyGetDataTotalPenggunaPerBrand]["user_per_brand"]+ $val['user_count'];
                } else {
                    $getDataTotalPenggunaPertitik[] = $val;
                }
            }
        }
        // dd($getDataTotalPenggunaForPopUp);
        // $keysByTotalUser = array_column($getDataTotalPenggunaPertitik, 'total_user');
        // $keysByTotalUserBrand = array_column($getDataTotalPenggunaPertitik, 'user_per_brand');
        // $keysByTotalBrand = array_column($getDataTotalPenggunaPertitik, 'brand');

        // array_multisort($keysByTotalUser, SORT_ASC,
        // $keysByTotalBrand, SORT_ASC,
        // $keysByTotalUserBrand, SORT_DESC,
        // $getDataTotalPenggunaPertitik);
        $html = "";
        $html = "<img src='https://lh6.googleusercontent.com/weffOGqkanJ9g7N9vbVVuiqJxp3QXzXke69BtPfE6ZStHq2h84kFTZGFxvc9M7uengFVQl7zEs-Ss_LvA-2JqmIRGXcU7pVf8e1DUrkdnoqVwj02XC5_-3M_LzVdLc9qKA=w1149'>";
        $html .= "<table style='border:1px solid black;'>";
            $html .= "<thead style='border:1px solid black;'>";
                $html .= "<tr>";
                    $html .= "<td>no</td>";
                    $html .= "<td>longitude</td>";
                    $html .= "<td>latitude</td>";
                    $html .= "<td>brand</td>";
                    $html .= "<td>range</td>";
                    $html .= "<td>user_count</td>";
                $html .= "</tr>";
            $html .= "</thead>";
            $no = 1;
            foreach ($arr as $val) {
                $html .= "<tr style='border:1px solid black;'>";
                    $html .= "<td>". $no++ ."</td>";
                    $html .= "<td>". $val["longitude"]."</td>";
                    $html .= "<td>". $val["latitude"]."</td>";
                    $html .= "<td>". $val["brand"]."</td>";
                    $html .= "<td>". $val["time"]."</td>";
                    $html .= "<td>". $val["user_count"]."</td>";
                $html .= "</tr>";
            }
        $html .= "</table>";
        $html .= "<br>";
        $html .= "<h3>hasil jawaban</h3>";
        $html .= "<table style='border:1px solid black;'>";
            $html .= "<thead style='border:1px solid black;'>";
                $html .= "<tr>";
                    $html .= "<td>no</td>";
                    $html .= "<td>longitude</td>";
                    $html .= "<td>latitude</td>";
                    $html .= "<td>brand</td>";
                    $html .= "<td>range</td>";
                    $html .= "<td>user_per_brand</td>";
                    $html .= "<td>total_user</td>";
                $html .= "</tr>";
            $html .= "</thead>";
            $no = 1;
            foreach ($getDataTotalPenggunaPertitik as $val) {
                $html .= "<tr style='border:1px solid black;'>";
                    $html .= "<td>". $no++ ."</td>";
                    $html .= "<td>". $val["longitude"]."</td>";
                    $html .= "<td>". $val["latitude"]."</td>";
                    $html .= "<td>". $val["brand"]."</td>";
                    $html .= "<td>". $val["gabungan_time"]."</td>";
                    $html .= "<td>". $val["user_per_brand"]."</td>";
                    $html .= "<td>". $val["total_user"]."</td>";
                $html .= "</tr>";
            }
        $html .= "</table>";
        $html .= "</br>";

        $html .= "<table style='border:1px solid black;'>";
            $html .= "<thead style='border:1px solid black;'>";
                $html .= "<tr>";
                    $html .= "<td>no</td>";
                    $html .= "<td>Brand</td>";
                    $html .= "<td>Total</td>";
                $html .= "</tr>";
            $html .= "</thead>";
            $no = 1;
            foreach (array_count_values($getDataTotalPenggunaForPopUp['brand']) as $key => $val) {
                $html .= "<tr style='border:1px solid black;'>";
                    $html .= "<td>". $no++ ."</td>";
                    $html .= "<td>". $key."</td>";
                    $html .= "<td>". $val."</td>";
                $html .= "</tr>";
            }
        $html .= "</table>";


        return $html;

    }
}
