
 <div class="container">
    <h3></h3>
    <?php echo anchor('post/create', 'AddPost', ['class'=> 'btn btn-primary']);?>
    <table class="table ">
    <thead>
        <tr>
        <th scope="col">Title</th>
        
        <th scope="col">Publish Date</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php if(count($posts)):?>
        <?php foreach($posts as $post):?>
         
            <tr>
            <td> <?php echo $post->title;?></td>
            
            <td> <?php echo $post->published_date;?></td>
            <td>
                <?php echo anchor("user/view_post/{$post ->id}", 'View', ['class'=> 'btn btn-primary btn-sm']);?>
                
            </td>
            </tr>
        <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td>No records found</td>
            </tr>   
    <?php endif; ?>
        
        
    </tbody>
    </table>
</div>

</body>
</html>