<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\role;

class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        role::create([
            'name' => 'thêm phí vận chuyển'
        ]);
        role::create([
            'name' => 'sửa phí vận chuyển'
        ]);
        role::create([
            'name' => 'xóa phí vận chuyển'
        ]);
        role::create([
            'name' => 'xem phí vận chuyển'
        ]);

        role::create([
            'name' => 'thêm sản phẩm'
        ]);
        role::create([
            'name' => 'sửa sản phẩm'
        ]);
        role::create([
            'name' => 'xóa sản phẩm'
        ]);
        role::create([
            'name' => 'xem sản phẩm'
        ]);

        role::create([
            'name' => 'thêm danh mục'
        ]);
        role::create([
            'name' => 'sửa danh mục'
        ]);
        role::create([
            'name' => 'xóa danh mục'
        ]);
        role::create([
            'name' => 'xem danh mục'
        ]);

        role::create([
            'name' => 'xem đơn hàng'
        ]);
        role::create([
            'name' => 'sửa đơn hàng'
        ]);
        role::create([
            'name' => 'xóa đơn hàng'
        ]);
        role::create([
            'name' => 'xem chi tiết đơn hàng'
        ]);

        role::create([
            'name' => 'xem thông tin khách hàng'
        ]);

        role::create([
            'name' => 'xem báo cáo thống kê'
        ]);

        role::create([
            'name' => 'Quản lý thông tin website'
        ]);

        role::create([
            'name' => 'xem nhân viên'
        ]);
        role::create([
            'name' => 'sửa nhân viên'
        ]);
        role::create([
            'name' => 'xóa nhân viên'
        ]);
        role::create([
            'name' => 'phân quyền'
        ]);
    }
}
