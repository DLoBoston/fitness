<h3>Workouts</h3>

<ul>
    <?php
        foreach ($workouts as $workout) :
            echo '<li>' . date('l, F j, Y', strtotime($workout->workout_date)) . '</li>';
        endforeach;
    ?>
</ul>
