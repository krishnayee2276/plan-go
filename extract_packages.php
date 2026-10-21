<?php
// Script to extract package data from plan-go.in and prepare for import

$packages = [
    'rajasthan' => [
        'name' => 'Rajasthan',
        'category' => 'domestic',
        'description' => 'Rajasthan is a state of vibrant folk dance and music, gigantic forts and palaces, spicy food, colourful and large turbans, extensive golden sand desert, camels and rich handicraft.',
        'duration' => '7 Days / 6 Nights',
        'stay_type' => '5 Star Hotel',
        'cuisine' => 'Rajasthani / Continental',
        'car_rental' => 'SUV Included',
        'price_inr' => 45000,
        'price_usd' => 550,
        'images' => ['rajasthan.jpg', 'rajasthan1.jpg', 'rajasthan2.jpg'],
        'itinerary' => [
            'DAY 1: ARRIVAL AT JAIPUR THE JOYOUS TOUR BEGINS',
            'DAY 2: JAIPUR: SIGHTSEEING TOUR',
            'DAY 3: TRANSFER FROM JAIPUR TO BIKANER – THE MAGICAL CITY',
            'DAY 4: DAY TO EXPLORE JAISALMER FORTS AND HISTORICAL STRUCTURES',
            'DAY 5: EXPLORE THE BEAUTIFUL THAR DESERT',
            'DAY 6: ARRIVAL IN THE BLUE CITY JODHPUR AND FOR FOR LOCAL SIGHTSEEING',
            'DAY 7: DEPARTURE : GOOD BYE, RAJASTHAN'
        ]
    ],
    'goa21' => [
        'name' => 'Goa',
        'category' => 'domestic',
        'description' => 'A kaleidoscopic blend of Indian and Portuguese cultures, sweetened with sun, sea, sand, seafood, susegad and spirituality, Goa is India\'s pocket-sized paradise.',
        'duration' => '6 Days / 5 Nights',
        'stay_type' => '5 Star Hotel',
        'cuisine' => 'Goan / Continental',
        'car_rental' => 'SUV Included',
        'price_inr' => 35000,
        'price_usd' => 425,
        'images' => ['goa1.jpg', 'goa2-1.jpg', 'goa3-1.jpg'],
        'itinerary' => [
            'DAY 1: ARRIVAL AT GOA AND GET TRANSFER TO HOTEL',
            'DAY 2: VISIT THE LOVELY NORTH GOA',
            'DAY 3: HAVE A GREAT TIME IN SOUTH GOA',
            'DAY 4: GO FOR AN ISLAND TOUR',
            'DAY 5: ENJOY DUDHSAGAR WATERFALLS AND SPICE PLANTATIONS',
            'DAY 6: DEPARTURE FROM GOA WITH WONDERFUL MEMORIES'
        ]
    ]
];

// Add more packages here...

echo "Package extraction data prepared:\n";
echo json_encode($packages, JSON_PRETTY_PRINT);
?>





