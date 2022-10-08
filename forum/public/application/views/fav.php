
 <div class="container">
    <h3>Favorites</h3>
    <table class="table ">
    <thead>
        <tr>
        <th scope="col">Title</th>
        <th scope="col">Add Date</th>
        <th scope="col">Action</th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
    <?php if(count($posts)):?>
        <?php foreach($posts as $post):?>
         
            <tr>
            <td> <?php echo $post->title;?></td>
            
            <td> <?php echo $post->date_published;?></td>
            <td>
                <?php echo anchor("user/view_post/{$post ->post_id}", 'View', ['class'=> 'btn btn-primary btn-sm']);?> 
            
                <?php echo anchor("user/fav_del/{$post ->id}", 'Delete', ['class'=> 'btn btn-primary btn-sm']);?> 
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