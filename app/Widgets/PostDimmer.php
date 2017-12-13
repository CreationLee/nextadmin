<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Facades\AdminFacades;

class PostDimmer extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = AdminFacades::model('Post')->count();
        $string = $count == 1? 'Post' : 'Posts';

        return view('admin.dimmer', array_merge($this->config, [
            'icon'   => 'voyager-group',
            'title'  => "{$count} {$string}",
            'text'   => "You have {$count} {$string} in your database. Click on button below to view all pages.",
            'button' => [
                'text' => 'View all pages',
                'link' => route('admin.posts.index'),
            ],
            'image' => asset('assets/images/widget-backgrounds/03.png'),
        ]));
    }
}
