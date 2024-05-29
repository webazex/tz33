<?php
if(!empty($args)):
    $src = (!empty($args['src']))? $args['src'] : getPlaceholderSrc();
    ?>
<div id="banner">
    <div class="container">
        <div class="row">
            <div class="col-6 col-12-medium">

                <!-- Banner Copy -->
                <div>
                    <?php if(!empty($args['text'])): echo $args['text']; endif;?>
                </div>
                <?php
                    if(!empty($args['link']['url'])):
                        $target = (!empty($args['link']['target']))? $args['link']['target'] : '';
                        $title = (!empty($args['link']['title']))? $args['link']['title'] : __('Go on, click me!', 'tt');
                            ?>
                                <a href="<?php echo $args['link']['url'];?>" class="button-large" target="<?php echo $target;?>">
                                    <?php echo $title; ?>
                                </a>
                            <?php
                    endif;
                ?>

            </div>
            <div class="col-6 col-12-medium imp-medium">

                <!-- Banner Image -->
                <?php
                    if(!empty($args['link']['url'])):
                        $target = (!empty($args['link']['target']))? $args['link']['target'] : '';
                        $title = (!empty($args['link']['title']))? $args['link']['title'] : __('Go on, click me!', 'tt');
                        ?>
                            <a href="<?php echo $args['link']['url']; ?>" class="bordered-feature-image" target="<?php echo $target;?>">
                                <img src="<?php echo $src;?>" alt="<?php echo $title; ?>" />
                            </a>
                        <?php
                    endif;
                ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>