<h3>Workouts</h3>

<ul>
    <?php
        if (isset($workouts)) :
            foreach ($workouts as $workout) :
                echo '<li>' . date('l, F j, Y', strtotime($workout->workout_date)) . '</li>';
            endforeach;
        else :
            echo '<li>no workouts</li>';
        endif;
    ?>
</ul>
