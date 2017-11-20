<?php
$date = get_field( 'date', $post->ID );
$date = new DateTime( $date );
$date = $date->format( 'j.m' );
?>

<?php if ( strtotime( $today ) <= strtotime( get_field( 'date', $post->ID ) ) ) { ?>
    <div class="item" itemscope itemtype="http://schema.org/Event">

        <span class="date" itemprop="startDate" content="<?= get_field( 'date', $post->ID ); ?>">
            <?= $date; ?>
        </span>

        <span class="time"><?= get_field( 'time', $post->ID ); ?> | </span>

        <span class="artist" itemprop="performer">
            <?php
            $artists       = get_field( 'assigned_artist', $post->ID );
            $artists_names = array();
            foreach ( $artists as $artist ) {
                $artists_names[] = get_the_title( $artist );
            }
            echo implode( ", ", $artists_names ) . ' - ';
            ?>
        </span>

        <span class="venue" itemprop="location" itemscope itemtype="http://schema.org/Place"><?= get_field( 'venue', $post->ID ); ?></span>

        <span class="desc" itemprop="name">, <?= get_the_title( $post->ID ); ?></span>

        <span class="tix"><a itemprop="url" target="_blank" href="<?= get_field( 'link', $post->ID ); ?>">כרטיסים</a></span>
    </div>
<?php } ?>