<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\NewsCategory;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $newsData = [

            ['Government Announces New Budget', 'Major tax reforms announced.', 'Published', 'Politics'],
            ['Election Campaign Begins', 'Political parties start campaigning.', 'Published', 'Politics'],

            ['India Wins Cricket Series', 'Historic victory in final match.', 'Published', 'Sports'],
            ['Football League Starts', 'New season begins this weekend.', 'Draft', 'Sports'],

            ['Stock Market Hits Record High', 'Investors remain optimistic.', 'Published', 'Business'],
            ['New Startup Raises Funding', 'Tech startup secures investment.', 'Published', 'Business'],

            ['AI Revolution Continues', 'Artificial Intelligence adoption grows.', 'Published', 'Technology'],
            ['New Smartphone Launched', 'Latest flagship device revealed.', 'Draft', 'Technology'],

            ['Blockbuster Movie Released', 'Movie breaks opening-day records.', 'Published', 'Entertainment'],
            ['Music Awards Announced', 'Top artists receive honors.', 'Published', 'Entertainment'],

            ['Health Tips for Summer', 'Doctors share safety advice.', 'Published', 'Health'],
            ['New Fitness Trends', 'Popular workout methods emerge.', 'Draft', 'Health'],
        ];

        foreach ($newsData as $item) {

            $category = NewsCategory::where('name', $item[3])->first();

            News::create([
                'news_category_id' => $category->id,
                'title'            => $item[0],
                'description'      => $item[1],
                'status'           => $item[2],
                'image'            => null,
            ]);
        }
    }
}