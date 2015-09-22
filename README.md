Exceeded
========

Utility to detect the repetitions of a tag after a given number
of instances in a row.

It's meant to put a css class to the exceeded elements so you can
manipulate them.

    <div>
    <?php

        $exceeded = new Exceeded();
        $exceeded   ->maxDefault(5)  // define max repetitions for unknown tags
                    ->maxTotal(100)  // define max for all tags together
                    ->max(array(     // define max repetitions for each tag
                            'events' => 6,
                            'news' => 6,
                            'experiences' => 3,
                            'tips' => 3,
                          ))
                    ->whenExceeded(" exceeded ")  // what to print when exceeded
                    ->whenNotExceeded("");        // what to print when not exceeded
    ?>

      <?php foreach($items as $item): ?>
      <div class="item item-<?php echo $item->getType() ?> <?php echo $exceeded->add($item->getType()) ?>">
        <!-- Item contents here -->
      </div>
      <?php endforeach; ?>
    </div>

    <style>
    .item { /* Styles for item */ }
    .item.exceeded { display: none; }  /* exceeded items are initially hidden */
                                      /* but you can toggle them if you want */
    </style>
