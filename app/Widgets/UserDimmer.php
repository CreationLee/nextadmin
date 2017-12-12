<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Facades\AdminFacades;

class UserDimmer extends AbstractWidget
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
        $count = AdminFacades::model('User')->count();
        $string = $count == 1? 'User' : 'Users';

        return view('admin.dimmer', array_merge($this->config, [
            'icon'   => 'voyager-group',
            'title'  => "{$count} {$string}",
            'text'   => "You have {$count} {$string} in your database. Click on button below to view all pages.",
            'button' => [
                'text' => 'View all pages',

            ],
            'image' => asset('assets/images/widget-backgrounds/02.png'),
        ]));
    }
}
