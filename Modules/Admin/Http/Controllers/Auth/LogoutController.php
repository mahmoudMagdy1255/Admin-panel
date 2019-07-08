<?php
/**
 * Created by PhpStorm.
 * User: mego
 * Date: 7/6/2019
 * Time: 1:43 PM
 */

namespace Modules\Admin\Http\Controllers\Auth;


class LogoutController
{
    public function logout()
    {
        auth('admin')->logout();

        return redirect()->route('admin.login');
    }
}