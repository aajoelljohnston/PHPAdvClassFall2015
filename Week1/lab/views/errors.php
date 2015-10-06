<?php if (is_array($errors) && count($errors) ) : ?>
<ul class="list-group">
    <?php foreach ($errors as $value) :?>
    <li class="list-group-item list-group-item-danger"><?php echo $value; ?></li>  
 <?php endforeach; ?>
</ul>
<?php endif; ?>
