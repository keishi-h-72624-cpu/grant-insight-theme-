<?php
// home.php (コラム一覧)
get_header(); ?>
<main class="container mx-auto px-4 py-12">
    <div class="bg-white p-8 rounded-lg shadow-sm mb-8 text-center">
        <h1 class="text-4xl font-extrabold text-slate-800"><?php single_post_title(); ?></h1>
    </div>

    <?php if (have_posts()) : ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php while (have_posts()) : the_post();
                get_template_part('template-parts/cards/grant-card-v3');
            endwhile; ?>
        </div>
        <div class="mt-12"><?php the_posts_pagination(); ?></div>
    <?php endif; ?>
</main>
<?php get_footer(); ?>