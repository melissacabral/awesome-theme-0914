<?php
//turn on sleeping features
add_theme_support('post-thumbnails');

//add any additional image sizes you need
//				(name, width, height, crop?)
add_image_size( 'featured-img', 200, 155, true );
add_image_size( 'slider-banner', 1300, 300, true );

//no close PHP