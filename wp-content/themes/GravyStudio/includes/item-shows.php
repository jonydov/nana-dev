<?php
$date = get_field( 'date', $post->ID );
$date = new DateTime( $date );
$date = $date->format( 'j.m' );
?>

<?php if ( strtotime( $today ) <= strtotime( get_field( 'date', $post->ID ) ) ) { ?>
    <div class="item" itemscope itemtype="http://schema.org/Event">

        <span class="date">
            <?= $date; ?>
        </span>
        <span class="time"  itemscope itemtype="http://schema.org/startDate><?= get_field( 'time', $post->ID ); ?> | </span>

        <span class="artist"  itemscope itemtype="http://schema.org/performer">
            <?php
            $artists       = get_field( 'assigned_artist', $post->ID );
            $artists_names = array();
            foreach ( $artists as $artist ) {
                $artists_names[] = get_the_title( $artist );
            }
            echo implode( ", ", $artists_names ) . ' - ';
            ?>
        </span>

        <span class="venue"  itemscope itemtype="http://schema.org/Place"><?= get_field( 'venue', $post->ID ); ?></span>

        <span class="desc">, <?= get_the_title( $post->ID ); ?></span>
        <span class="tix"><a target="_blank" href="<?= get_field( 'link', $post->ID ); ?>">כרטיסים</a></span>
    </div>
<?php } ?>