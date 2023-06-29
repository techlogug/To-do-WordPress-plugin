
<header class="w3-display-container w3-wide bgimg w3-grayscale-min" id="home">


<div class="w3-display-middle w3-text-white w3-center">
        <?php 
            $args = array( 
                'post_type' => 'page',
                'post_status' => 'publish',
                'posts_per_page' => 1
            );
             
            $query1 = new WP_Query( $args );
        
            while ( $query1->have_posts()):
                $query1->the_post();
                $title = get_the_title();
                $content = get_the_content();
            endwhile;
        ?>
        <h1 class="w3-jumbo"><?php echo $title; ?></h1> 
        <h2><?php echo $content; ?></h2>
    </div>
</header>
