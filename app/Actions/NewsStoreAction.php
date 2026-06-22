<?php

namespace App\Actions;

use App\Models\News;

class NewsStoreAction
{
    public function execute(array $data): News
    {
        $image = null;

        if (!empty($data['image'])) {
            $image = $data['image']->store('news', 'public');
        }

       return News::create([
    'news_category_id' => $data['news_category_id'],
    'title'            => $data['title'],
    'description'      => $data['description'],
    'status'           => $data['status'],
    'image'            => $image,
]);
    }
}



