<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class location extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'สาขาวิชาวิทยาศาสตร์กายภาพ',
            'สาขาวิชาวิทยาศาสตร์ชีวภาพ',
            'หลักสูตรวิทยาการคอมพิวเตอร์และสารสนเทศ',
            'หลักสูตรคณิตศาสตร์และการจัดการข้อมูล',
            'หลักสูตรวิทยาศาสตร์สิ่งแวดล้อม',
            'กศ.บ.สาขาวิชาเคมี',
            'กศ.บ.สาขาวิชาชีววิทยา',
            'กศ.บ.สาขาวิชาคณิตศาสตร์',
            'กศ.บ.สาขาวิชาฟิสิกส์',
            'ห้องคุณภาพน้ำ',
            'สำนักงานคณะวิทยาศาสตร์และนวัตกรรมดิจิทัล',
            'อาคารปฏิบัติการเพาะเลี้ยงสัตว์น้ำ',
            'อาคารปฏิบัติการวิทยาศาสตร์สิ่งแวดล้อม',
            'อาคารปฏิบัติการพฤกษศาสตร์',
            'ศูนย์เครื่องมือกลาง',

        ];

        foreach ($types as $type) {

            DB::table('location')->insert([
                'location_site_name' => $type,
            ]);
        }
    }
}
