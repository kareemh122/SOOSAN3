<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function homepage()
    {
        $featuredProducts = Product::where('is_featured', 1)->get();

        $breakerLinesData = [
            'SQ_LINE' => [
                'name' => __('homepage.breaker_sq_line_name'),
                'subtitle' => __('homepage.breaker_sq_line_subtitle'),
                'description' => __('homepage.breaker_sq_line_description'),
                'features' => [
                    __('homepage.breaker_sq_line_feature1'),
                    __('homepage.breaker_sq_line_feature2'),
                    __('homepage.breaker_sq_line_feature3'),
                    __('homepage.breaker_sq_line_feature4'),
                ],
                'applications' => [
                    __('homepage.breaker_sq_line_app1'),
                    __('homepage.breaker_sq_line_app2'),
                    __('homepage.breaker_sq_line_app3'),
                ],
                'image' => asset('dist/img/breakers/sq-line.png'),
            ],
            'SB_LINE' => [
                'name' => __('homepage.breaker_sb_line_name'),
                'subtitle' => __('homepage.breaker_sb_line_subtitle'),
                'description' => __('homepage.breaker_sb_line_description'),
                'features' => [
                    __('homepage.breaker_sb_line_feature1'),
                    __('homepage.breaker_sb_line_feature2'),
                    __('homepage.breaker_sb_line_feature3'),
                    __('homepage.breaker_sb_line_feature4'),
                ],
                'applications' => [
                    __('homepage.breaker_sb_line_app1'),
                    __('homepage.breaker_sb_line_app2'),
                    __('homepage.breaker_sb_line_app3'),
                ],
                'image' => asset('dist/img/breakers/sb-line.png'),
            ],
            'TOP_LINE' => [
                'name' => __('homepage.breaker_top_line_name'),
                'subtitle' => __('homepage.breaker_top_line_subtitle'),
                'description' => __('homepage.breaker_top_line_description'),
                'features' => [
                    __('homepage.breaker_top_line_feature1'),
                    __('homepage.breaker_top_line_feature2'),
                    __('homepage.breaker_top_line_feature3'),
                    __('homepage.breaker_top_line_feature4'),
                ],
                'applications' => [
                    __('homepage.breaker_top_line_app1'),
                    __('homepage.breaker_top_line_app2'),
                    __('homepage.breaker_top_line_app3'),
                ],
                'image' => asset('dist/img/breakers/top-line.png'),
            ],
        ];

        $breakerTranslations = [
            'key_features' => __('homepage.breaker_card_key_features'),
            'applications' => __('homepage.breaker_card_applications'),
            'explore_more' => __('homepage.breaker_card_explore_more'),
        ];

        $serialLookupRoute = route('serial-lookup.index');

        return view('public.homepage', compact('featuredProducts', 'breakerLinesData', 'breakerTranslations', 'serialLookupRoute'));
    }

    public function about()
    {
        return view('public.about');
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function privacy()
    {
        return view('public.privacy');
    }

    public function terms()
    {
        return view('public.terms');
    }

    public function support()
    {
        return view('public.support');
    }
}
