<?php if (!defined('ABSPATH')) exit;?>
<pre style="padding:10px; border:1px solid #e5e5e5;background:#FFF;">
    <?php echo "To use this plugin contents you should add shortcode in .php file where you want to see the result. \n For example: in loop-single.php copy code &lt;?php do_shortcode('[custom_content \"1\"]'); ?&gt; or &lt;?php do_shortcode('[custom_content \"2\"]'); ?&gt;";?>
</pre>
<h2>
    Custom post bottom
    <a href="?page=custom-content-index&option=add" class="add-new-h2">Add New</a>
</h2>
<table class="wp-list-table widefat fixed posts">
    <thead>
       <th width="60">ID</th>
       <th>Title</th>
       <th>Post id</th>
       <th>Status</th>
       <th>Edit</th>
       <th>Remove</th>
    </thead>
    <tbody>
      <?php foreach($result as $item): $pg = ($item->page_id > 0) ? array($item->page_id,'Using for single post') : array('All','Using for all posts');?>
        <tr>
            <td><?php echo $item->id;?></td>
            <td><?php echo $pg[1];?></td>
            <td><?php echo $pg[0];?></td>
            <td><?php echo ($item->status > 0) ? "<a href='?page=custom-content-index&option=status&status=0&id=".$item->id."'>inactive</a>" : "<a href='?page=custom-content-index&option=status&status=1&id=".$item->id."'>active</a>";?></td>
            <td><a href="?page=custom-content-index&option=edit&edit=<?php echo $item->id;?>">edit</a></td>
            <td><a href="?page=custom-content-index&option=remove&id=<?php echo $item->id;?>">remove</a></td>
        </tr>
     <?php endforeach;?>
    </tbody>
</table>