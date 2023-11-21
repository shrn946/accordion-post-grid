<?php
// Add this function to your theme's Shortcode.php file or in a custom plugin


function custom_portfolio_shortcode($atts) {
    // Shortcode attributes
    $atts = shortcode_atts(
        array(
            'category' => '', // Category slug to include
            'exclude_category' => '', // Category slug to exclude
        ),
        $atts,
        'post-grid'
    );

    // Query arguments
    $query_args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'category_name' => $atts['category'],
        'category__not_in' => explode(',', $atts['exclude_category']),
    );

    $portfolio_query = new WP_Query($query_args);

    $color_classes = array('yellow', 'orange', 'red', 'blue', 'green', 'purple'); // Add more colors if needed

    $counter = 0; // Initialize a counter

    if ($portfolio_query->have_posts()) :
        ob_start(); // Start output buffering
        ?>
    
    
    
    
    
        <div class="card-grid">
            <?php while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                $post_id = get_the_ID(); // Get the current post ID

                // Get a color class based on the counter
                $color_class = $color_classes[$counter % count($color_classes)];

                // Get the featured image URL or set a default color if no featured image
                $featured_image_url = has_post_thumbnail() ? get_the_post_thumbnail_url($post_id, 'medium') : '';

                // Increment the counter
                $counter++;
				
				
            ?>
            
            

<div class="card card-<?php echo esc_attr($color_class); ?> post-id-<?php echo esc_attr($post_id); ?>" style="position: relative;">


    <?php if (has_post_thumbnail()) : ?>
    
        <div class="featured-image" style="background: url('<?php echo esc_url(wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full')[0]); ?>') center/cover; position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
            <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5);"></div>
        </div>
    <?php else : ?>
        <div class="fallback-color" style="background-color:card-<?php echo esc_attr($color_class); ?>; position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>
    <?php endif; ?>

    <div class="card-button" style="position: relative; z-index: 1;">
        <?php
        $categories = get_the_category();
        $first_category = !empty($categories) ? $categories[0]->name : '';
        echo '<div class="first-category">' . esc_html($first_category) . '</div>';
        ?>
        <h2 class="card-text" style="color:#FFFFFF;"><?php the_title(); ?></h2>
        <div class="date-box">
            <div class="day"><?php echo date('d'); ?></div>
            <div class="date"><?php echo date('M'); ?></div>
        </div>
        <div class="card-icon"></div>
    </div>
</div>


                <div class="card-details card-<?php echo esc_attr($color_class); ?> post-id-<?php echo esc_attr($post_id); ?>">
                    <!-- corresponding details for above card/button -->
                    <div class="card-details-body">
                        <div class="card-details-description">
                       <h3> <?php the_title(); ?></h3>
       <?php
                        // Display maximum of 15 words
                        echo wp_trim_words(get_the_content(), 50);
                        ?>
                        
                        

<div class="bt" style="margin-top:10px;"><a href="<?php echo esc_url(get_permalink()); ?>" class="read-more">Read More</a> </div> 

         </div>
                        
                    </div>
                </div>

            <?php endwhile; ?>
        </div>
    <?php
    endif;

    wp_reset_postdata(); // Reset the query

   $output = ob_get_clean(); // Get the buffer contents
    return $output; // Return the output
}

// Register the shortcode for all posts
add_shortcode('post-grid', 'custom_portfolio_shortcode');

// Register the shortcode with category filtering
add_shortcode('post-grid-category', 'custom_portfolio_shortcode');?>