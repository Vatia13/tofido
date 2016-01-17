<?php if (!defined('ABSPATH')) exit;?>
<pre style="padding:10px; border:1px solid #e5e5e5;background:#FFF;">
    If you`ll skip Post id or add 0, contents will be for all posts.
</pre>
<h2><?php echo $option_text;?></h2>
<?php if(!empty($message[0])):?>
    <div class="<?php echo $message[0];?>"><?php echo $message[1];?></div>
<?php endif;?>
<?php if($message[0] != 'updated'):?>
<form action="" method="post">
    <input type="hidden" name="option" value="<?php echo $_GET['option'];?>"/>
    <p>
        <label>Post id</label><br>
        <input type="text" name="page_id" value="<?php echo (!empty($_POST['page_id'])) ? $_POST['page_id'] : $result[0]->page_id;?>" >
    </p>
    <p>
        <label>First content place</label><br>
        <textarea name="content1" rows="5" cols="40"><?php echo (!empty($_POST['content1'])) ? $_POST['content1'] : $result[0]->content1;?></textarea>
    </p>
    <p>
        <label>Second content place</label><br>
        <textarea name="content2" rows="5" cols="40"><?php echo (!empty($_POST['content2'])) ? $_POST['content2'] : $result[0]->content2;?></textarea>
    </p>
    <input type="submit" value="Save" name="save" class="button">
</form>
<?php endif;?>