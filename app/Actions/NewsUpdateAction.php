<?php

namespace App\Actions;

use App\Models\News;

class NewsUpdateAction
{
    public function execute(News $news, array $data): News
    {
        if (isset($data['image']) && $data['image']) {
            $data['image'] = $data['image']->store('news', 'public');
        } else {
            $data['image'] = $news->image;
        }

        $news->update([
            'news_category_id' => $data['news_category_id'],
            'title'            => $data['title'],
            'description'      => $data['description'],
            'status'           => $data['status'],
            'image'            => $data['image'],
        ]);

        return $news;
    }
}