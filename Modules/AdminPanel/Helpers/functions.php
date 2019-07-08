<?php
/**
 * Created by PhpStorm.
 * User: mego
 * Date: 7/6/2019
 * Time: 1:21 PM
 */

if (!function_exists('active_menu')) {

	function active_menu($key) {

		if (!is_array($key)) {

			if (preg_match('/' . $key . '/i', Request::segment(2)) && Request::segment(2) != 'order-status-types') {
				return 'active';
			} elseif ((Request::segment(2) == 'voucher' || Request::segment(2) == 'order-status-types' || Request::segment(2) == 'suppliers') && $key == 'config') {
				return 'active';
			}
		} elseif (is_array($key) && in_array(Request::segment(2), $key)) {
			return 'active';

		}

	}

}

if (!function_exists('admin_design')) {

	function admin_design($url) {

		$url = trim($url, '/');

		return asset('assets/adminpanel/' . $url);

	}

}

if (!function_exists('admin_url')) {

	function admin_url($url) {

		return url('/admin/' . $url);

	}

}

if (!function_exists('admin')) {

	function admin() {

		return auth('admin')->user();

	}

}