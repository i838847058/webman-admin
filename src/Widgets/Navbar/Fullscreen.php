<?php

namespace Shx\Admin\Widgets\Navbar;

use Shx\Admin\Admin;
use Illuminate\Contracts\Support\Renderable;

/**
 * Class FullScreen.
 *
 * @see  https://javascript.ruanyifeng.com/htmlapi/fullscreen.html
 */
class Fullscreen implements Renderable
{
    public function render()
    {
        return Admin::component('admin::components.fullscreen');
    }
}
