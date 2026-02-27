<?php

namespace App\NativeComponents;

use App\NativeComponents\Concerns\HasListingData;
use Native\Mobile\Edge\Element;
use Native\Mobile\Edge\NativeComponent;
use Native\Mobile\Edge\Transition;

class Explore extends NativeComponent
{
    use HasListingData;

    public int $selectedCategory = -1;

    /** @var array<int, bool> */
    public array $wishlisted = [];

    public function mount(): void
    {
        nativephp_call('UI.SetBackground', json_encode(['color' => '#FFFFFF']));
    }

    public function selectCategory(int $index): void
    {
        $this->selectedCategory = $this->selectedCategory === $index ? -1 : $index;
    }

    public function toggleWishlist(int $index): void
    {
        if (isset($this->wishlisted[$index])) {
            unset($this->wishlisted[$index]);
        } else {
            $this->wishlisted[$index] = true;
        }
    }

    public function viewListing(int $index): void
    {
        $this->navigate($this->route('listing.show', $index))
            ->transition(Transition::SlideFromRight);
    }

    public function render(): Element
    {
        $allListings = self::listings();
        $categories = self::categories();

        $selectedName = '';
        if ($this->selectedCategory >= 0 && isset($categories[$this->selectedCategory])) {
            $selectedName = $categories[$this->selectedCategory]['name'];
        }

        $listings = $allListings;
        if ($selectedName !== '') {
            $listings = array_values(
                array_filter($allListings, fn (array $listing): bool => $listing['category'] === $selectedName)
            );
        }

        // Map back to original indices for navigation
        $mappedListings = [];
        foreach ($listings as $listing) {
            $originalIndex = array_search($listing['title'], array_column($allListings, 'title'));
            $listing['isWishlisted'] = isset($this->wishlisted[$originalIndex]);
            $listing['originalIndex'] = $originalIndex;
            $mappedListings[] = $listing;
        }

        return $this->view('explore', [
            'listings' => $mappedListings,
            'categories' => $categories,
        ]);
    }
}
