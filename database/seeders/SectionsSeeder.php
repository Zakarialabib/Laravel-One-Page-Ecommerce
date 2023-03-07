<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionsSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Section::insert([
            [
                'id'             => 1,
                'language_id'  => 1,
                'title' => 'ONEPAGE PROJECT',
                'image' => 1,
                'featured_title' => 'first section',
                'subtitle' => 'some briefing',
                'label' => '<i class="fa fa-angle-down"></i>',
                'link' => '#2',
                'description' => 'some description',
                'status' => 1,
                'bg_color' => '#fff',
                'text_color' => '#000',
                'position' => 0,
                'is_category' => 0,
                'is_product' => 0,
                'is_form' => 0,
                'page' => 1,
                'embeded_video' => 1,
                'language_id'  => 1,
            ],
            [
                'id'             => 2,
                'language_id'  => 1,
                'title' => 'ONEPAGE PROJECT',
                'image' => 1,
                'featured_title' => 'first section',
                'subtitle' => 'some briefing',
                'label' => '<i class="fa fa-angle-down"></i>',
                'link' => '#3',
                'description' => 'some description',
                'status' => 1,
                'bg_color' => '#fff',
                'text_color' => '#000',
                'position' => 0,
                'is_category' => 0,
                'is_product' => 0,
                'is_form' => 0,
                'page' => 1,
                'embeded_video' => 1,
                'language_id'  => 1,
            ],
            [
                'id'    => 3,
                'language_id'  => 1,
                'title' => 'ONEPAGE PROJECT',
                'image' => 1,
                'featured_title' => 'first section',
                'subtitle' => 'some briefing',
                'label' => '<i class="fa fa-angle-down"></i>',
                'link' => '#4',
                'description' => 'some description',
                'status' => 1,
                'bg_color' => '#fff',
                'text_color' => '#000',
                'position' => 0,
                'is_category' => 0,
                'is_product' => 0,
                'is_form' => 0,
                'page' => 1,
                'embeded_video' => 1,
                'language_id'  => 1,
            ],
            [
                'id'             => 4,
                'language_id'  => 1,
                'title' => 'ONEPAGE PROJECT',
                'image' => 1,
                'featured_title' => 'first section',
                'subtitle' => 'some briefing',
                'label' => '<i class="fa fa-angle-down"></i>',
                'link' => '#',
                'description' => 'some description',
                'status' => 1,
                'bg_color' => '#fff',
                'text_color' => '#000',
                'position' => 0,
                'is_category' => 0,
                'is_product' => 0,
                'is_form' => 0,
                'page' => 1,
                'embeded_video' => 1,
                'language_id'  => 1,
            ],
        ]);
    }
}
