<?php

include __DIR__ . '/../../../Modules/AdminPanel/Helpers/functions.php';
include __DIR__ . '/../../../Modules/Service/Helpers/functions.php';

if (!function_exists('offer_price')) {

	function offer_price($product) {

		if ($product) {

			if ($product->offers and $product->offers->active == 1) {

				$sell_price = $product->sell_price;
				$offer_price = $product->offers->offer_price;
				$divi = $sell_price - $offer_price;

				$percent = round($divi / $sell_price * 100, 1);

				return ['offer_price' => $offer_price, 'percent' => $percent];
			}
		}

		return ['offer_price' => '', 'percent' => ''];

	}

}

if (!function_exists('lang')) {

	function lang() {

		return app()->getLocale();

	}
}

if (!function_exists('app_name')) {

	function app_name() {

		return 'App Name';

	}
}

if (!function_exists('checkInWishlist')) {

	function checkInWishlist($id) {

		if (user()) {

			return in_array($id, user()->wishlist()->pluck('product_id')->toArray()) ? 'color: #F8694A;box-shadow: 0px 0px 0px 1px #F8694A inset, 0px 0px 0px 0px #F86' : '';
		}

		return '';

	}
}

if (!function_exists('CartlastElement')) {

	function CartlastElement() {

		if (Cart::count() > 0) {

			return Cart::content();

		}

		return [];

	}
}

if (!function_exists('governments')) {

	function governments() {

		return \Modules\AreaModule\Entities\Government::all();

	}
}

if (!function_exists('cities')) {

	function cities() {

		return \Modules\AreaModule\Entities\City::all();

	}
}

if (!function_exists('zones')) {

	function zones() {

		return \Modules\AreaModule\Entities\Zone::all();

	}
}

if (!function_exists('checkInCart')) {

	function checkInCart($id) {

		foreach (Cart::content() as $product) {

			if ($id == $product->id) {
				return [
					"status" => true,
					"style" => "color: #FFF;
                     background-color: #30323A;
                     pointer-events:none;",
				];
			}

		}

		return [
			"status" => false,
			"style" => "",
		];

	}
}

if (!function_exists('user')) {

	function user() {

		return auth('user')->user();

	}

}
if (!function_exists('link')) {

	function our_link($string) {

		$num = strcspn($string, "=");
		return substr($string, $num);

	}

}

if (!function_exists('quick_sort')) {
	function quick_sort($my_array) {

		$loe = $gt = [];

		if (count($my_array) < 2) {
			return $my_array;
		}
		$pivot_key = key($my_array);
		$pivot = array_shift($my_array);
		foreach ($my_array as $val) {
			if ($val >= $pivot) {
				$loe[] = $val;
			} elseif ($val < $pivot) {
				$gt[] = $val;
			}
		}

		return array_merge(quick_sort($loe), array($pivot_key => $pivot), quick_sort($gt));
	}
}

if (!function_exists('active')) {
	function active($url) {

		if (\Request::segment(1) == $url) {
			return 'active';
		}

	}
}
