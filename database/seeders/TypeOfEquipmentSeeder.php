<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeOfEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'ครุภัณฑ์สำนักงาน',
            'สิ่งก่อสร้าง ใช้คอนกรีตเสริมเหล็ก',
            'ครุภัณฑ์โฆษณาและเผยแพร่',
            'ครุภัณฑ์ไฟฟ้าและวิทยุ',
            'ครุภัณฑ์การเกษตร (เครื่องมือและอุปกรณ์)',
            'ครุภัณฑ์การเกษตร (เครื่องจักรกล)',
            'ครุภัณฑ์โรงงาน (เครื่องมือและอุปกรณ์)',
            'ครุภัณฑ์สำรวจ',
            'ครุภัณฑ์วิทยาศาสตร์และการแพทย์',
            'ครุภัณฑ์คอมพิวเตอร์',
            'ครุภัณฑ์การศึกษา',
            'ครุภัณฑ์งานบ้านงานครัว',
            'ครุภัณฑ์กีฬา/กายภาพ',
            'ครุภัณฑ์ยานพาหนะและขนส่ง',
            'ครุภัณฑ์ดนตรี/นาฏศิลป์',
            'ครุภัณฑ์สนาม'
        ];

        foreach ($types as $type) {

            DB::table('type_of_equipment')->insert([
                'name_type_of_equipment' => $type,
            ]);
        }
    }
}
