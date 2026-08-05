<?php

namespace App\Http\Controllers;

class CollectionController extends Controller
{
    /**
     * Show curated collections.
     *
     * TODO: once CollectionService exists, replace this with real data —
     * a collection is a themed group of products (not a category), e.g.
     * "New Season" or "Training Essentials".
     */
    public function index()
    {
        $collections = [
            [
                'title' => 'New Season',
                'tagline' => 'Fresh drops for the months ahead',
                'url' => '/shop?collection=new-season',
                'image' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'title' => 'Training Essentials',
                'tagline' => 'The core kit for everyday sessions',
                'url' => '/shop?collection=training-essentials',
                'image' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'title' => "Women's Performance",
                'tagline' => 'Built for high-output movement',
                'url' => '/shop?collection=womens-performance',
                'image' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'title' => 'Recovery & Off-Day',
                'tagline' => 'Comfort pieces for rest days',
                'url' => '/shop?collection=recovery',
                'image' => 'https://images.unsplash.com/photo-1509942774463-acf339cf87d5?q=80&w=1200&auto=format&fit=crop',
            ],
        ];

        return view('collections', compact('collections'));
    }
}
