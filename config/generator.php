<?php

return [
    /**
     * If any input file(image) as default will used options below.
     */
    'image' => [
        /**
         * Path for store the image.
         *
         * avaiable options:
         * 1. public
         * 2. storage
         */
        'path' => 'storage',

        /**
         * Will used if image is nullable and default value is null.
         */
        'default' => 'https://via.placeholder.com/350?text=No+Image+Avaiable',

        /**
         * Crop the uploaded image using intervention image.
         */
        'crop' => true,

        /**
         * When set to true the uploaded image aspect ratio will still original.
         */
        'aspect_ratio' => true,

        /**
         * Crop image size.
         */
        'width' => 500,
        'height' => 500,
    ],

    'format' => [
        /**
         * Will used to first year on select, if any column type year.
         */
        'first_year' => 1900,

        /**
         * If any date column type will cast and display used this format, but for input date still will used Y-m-d format.
         *
         * another most common format:
         * - M d Y
         * - d F Y
         * - Y m d
         */
        'date' => 'd/m/Y',

        /**
         * If any input type month will cast and display used this format.
         */
        'month' => 'm/Y',

        /**
         * If any input type time will cast and display used this format.
         */
        'time' => 'H:i',

        /**
         * If any datetime column type or datetime-local on input, will cast and display used this format.
         */
        'datetime' => 'd/m/Y H:i',

        /**
         * Limit string on index view for any column type text or longtext.
         */
        'limit_text' => 100,
    ],

    /**
     * It will used for generator to manage and showing menus on sidebar views.
     *
     * Example:
     * [
     *   'header' => 'Main',
     *
     *   // All permissions in menus[] and submenus[]
     *   'permissions' => ['test view'],
     *
     *   menus' => [
     *       [
     *          'title' => 'Main Data',
     *          'icon' => '<i class="bi bi-collection-fill"></i>',
     *          'route' => null,
     *
     *          // permission always null when isset submenus
     *          'permission' => null,
     *
     *          // All permissions on submenus[] and will empty[] when submenus equals to []
     *          'permissions' => ['test view'],
     *
     *          'submenus' => [
     *                 [
     *                     'title' => 'Tests',
     *                     'route' => '/tests',
     *                     'permission' => 'test view'
     *                  ]
     *               ],
     *           ],
     *       ],
     *  ],
     *
     * This code below always changes when you use a generator and maybe you must lint or format the code.
     */
    'sidebars' => [
        [
            'header' => 'Faskes',
            'permissions' => [
                'jenis faske view',
                'faske view'
            ],
            'menus' => [
                [
                    'title' => 'Data Faskes',
                    'icon' => '<i class="bi bi-bank"></i>',
                    'route' => null,
                    'permission' => null,
                    'permissions' => [
                        'jenis faske view',
                        'faske view'
                    ],
                    'submenus' => [
                        [
                            'title' => 'List Faskes',
                            'route' => '/faskes',
                            'permission' => 'faske view'
                        ],
                        [
                            'title' => 'Jenis Faskes',
                            'route' => '/jenis-faskes',
                            'permission' => 'jenis faske view'
                        ]
                    ]
                ]
            ]
        ],
        [
            'header' => 'Inventaris',
            'permissions' => [
                'room view',
                'brand view',
                'type view'
            ],
            'menus' => [
                [
                    'title' => 'Inventaris Alat',
                    'icon' => '<i class="bi bi-tools"></i>',
                    'route' => null,
                    'permission' => null,
                    'permissions' => [
                        'room view',
                        'brand view',
                        'type view'
                    ],
                    'submenus' => [
                        [
                            'title' => 'Jenis Alat',
                            'route' => '/types',
                            'permission' => 'type view'
                        ],
                        [
                            'title' => 'Ruangan',
                            'route' => '/rooms',
                            'permission' => 'room view'
                        ],
                        [
                            'title' => 'Merek',
                            'route' => '/brands',
                            'permission' => 'brand view'
                        ]

                    ]
                ]
            ]
        ],
        [
            'header' => 'Pelaksana Teknis',
            'permissions' => [
                'pelaksana teknis view'
            ],
            'menus' => [
                [
                    'title' => 'Pelaksana Teknis',
                    'icon' => '<i class="bi bi-people"></i>',
                    'route' => '/pelaksana-teknis',
                    'permission' => 'pelaksana teknis view',
                    'permissions' => [],
                    'submenus' => []
                ]
            ]
        ],
        [
            'header' => 'Wilayah',
            'permissions' => [
                'province view',
                'kabkot view',
                'kecamatan view',
                'kelurahan view'
            ],
            'menus' => [
                [
                    'title' => 'Data Wilayah',
                    'icon' => '<i class="bi bi-map"></i>',
                    'route' => null,
                    'permission' => null,
                    'permissions' => [
                        'province view',
                        'kabkot view',
                        'kecamatan view',
                        'kelurahan view'
                    ],
                    'submenus' => [
                        [
                            'title' => 'Provinsi',
                            'route' => '/provinces',
                            'permission' => 'province view'
                        ],
                        [
                            'title' => 'Kabupaten/Kota',
                            'route' => '/kabkots',
                            'permission' => 'kabkot view'
                        ],
                        [
                            'title' => 'Kecamatan',
                            'route' => '/kecamatans',
                            'permission' => 'kecamatan view'
                        ],
                        [
                            'title' => 'Kelurahan',
                            'route' => '/kelurahans',
                            'permission' => 'kelurahan view'
                        ]
                    ]
                ]
            ]
        ],
        [
            'header' => 'Banner Managements',
            'permissions' => [
                'banner management view'
            ],
            'menus' => [
                [
                    'title' => 'Banner Management',
                    'icon' => '<i class="bi bi-image"></i>',
                    'route' => '/banner-managements',
                    'permission' => 'banner management view',
                    'permissions' => [],
                    'submenus' => []
                ]
            ]
        ],
        [
            'header' => 'Metode Kerjas',
            'permissions' => [
                'metode kerja view'
            ],
            'menus' => [
                [
                    'title' => 'Metode Kerja',
                    'icon' => '<i class="bi bi-info-circle"></i>',
                    'route' => '/metode-kerjas',
                    'permission' => 'metode kerja view',
                    'permissions' => [],
                    'submenus' => []
                ]
            ]
        ],
        [
            'header' => 'Kontak Masukans',
            'permissions' => [
                'kontak masukan view'
            ],
            'menus' => [
                [
                    'title' => 'Kontak Masukan',
                    'icon' => '<i class="bi bi-envelope"></i>',
                    'route' => '/kontak-masukans',
                    'permission' => 'kontak masukan view',
                    'permissions' => [],
                    'submenus' => []
                ]
            ]
        ],
        [
            'header' => 'Utilities',
            'permissions' => [
                'user view',
                'role & permission view'
            ],
            'menus' => [
                [
                    'title' => 'Utilities',
                    'icon' => '<i class="bi bi-gear-fill"></i>',
                    'route' => null,
                    'permission' => null,
                    'permissions' => [
                        'user view',
                        'role & permission view'
                    ],
                    'submenus' => [
                        [
                            'title' => 'Users',
                            'route' => '/users',
                            'permission' => 'user view'
                        ],
                        [
                            'title' => 'Roles & permissions',
                            'route' => '/roles',
                            'permission' => 'role & permission view'
                        ]
                    ]
                ]
            ]
        ]
    ]
];
