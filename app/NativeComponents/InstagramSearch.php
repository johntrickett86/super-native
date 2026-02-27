<?php

namespace App\NativeComponents;

use App\NativeComponents\Concerns\HasInstagramData;
use Native\Mobile\Edge\Element;
use Native\Mobile\Edge\NativeComponent;
use Native\Mobile\Edge\Transition;

class InstagramSearch extends NativeComponent
{
    use HasInstagramData;

    public function viewPost(int $index): void
    {
        $this->navigate($this->route('instagram.post', $index))
            ->transition(Transition::SlideFromRight);
    }

    public function render(): Element
    {
        $posts = self::igPosts();

        return $this->view('instagram-search', [
            'posts' => $posts,
        ]);
    }
}
