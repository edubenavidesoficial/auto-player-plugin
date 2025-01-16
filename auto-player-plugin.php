<?php
/*
Plugin Name: Auto Player for Movies
Description: Agrega automáticamente un reproductor a las películas al publicarlas.
Version: 1.0
Author: Tu Nombre
*/

function add_movie_player($post_id) {
    // Verifica si el post es de tipo "películas" (puede que sea "movies" en inglés)
    if (get_post_type($post_id) !== 'movies') {
        return;
    }

    // Verifica si el post es publicado por primera vez
    if (get_post_status($post_id) !== 'publish') {
        return;
    }

    // Código del reproductor (personaliza este HTML)
    $player_code = '<div class="movie-player">
        <iframe src="https://example.com/reproductor?id=' . $post_id . '" width="100%" height="500" frameborder="0" allowfullscreen></iframe>
    </div>';

    // Agrega el reproductor al contenido de la película
    $current_content = get_post_field('post_content', $post_id);
    $new_content = $current_content . $player_code;

    // Actualiza el contenido del post
    wp_update_post([
        'ID' => $post_id,
        'post_content' => $new_content,
    ]);
}
add_action('publish_movies', 'add_movie_player');
