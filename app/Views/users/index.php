<?php require_once APPROOT . "/Views/inc/header.php" ?>


<div class="hero has-text-black has-background-white-bis">
    <div class="hero-body">

        <?php //var_dump($data);?>

        <?php $count_itens = 0; //gambs?>

        <div class="tile is-ancestor">
        
            

            <div class="tile is-parent is-vertical">
                <?php foreach ($data["users"] as $user):?>
                    
                    <?php if($count_itens >= 2): //checks if it already has 2 divs for one parent?>
                        
                        </div>
                        <div class="tile is-parent is-vertical">

                    <?php 
                        $count_itens = 0; //closes the div and starts new parent
                        
                        else:
                        
                            $count_itens += 1;
                        
                        endif;
                    ?>
                    
                    <div class="tile is-child is-8 notification is-primary box">
                        <div class="content">

                            <figure class="image is-128x128">
                                <img src="https://bulma.io/images/placeholders/640x480.png">
                            </figure>
                            <p class="title"><?php echo $user->nome;?></p>
                            <div class="content">
                                <?php echo $user->email;?>
                                
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>

    </div>

    <nav class="pagination is-centered" role="navigation" aria-label="pagination">
    <ul class="pagination-list">
        
        <?php 
        
        $interval = get_page_interval($data["page"], $data["total_pages"]);
        
        //var_dump($interval);

        foreach ($interval as $page):
            
        ?>

        <li><a class="pagination-link" aria-label="Goto page <?php echo $page;?>" href="<?php echo URLROOT;?>/Users/index/<?php echo $page;?>"><?php echo $page;?></a></li>


        <?php endforeach;?>


        <!--<li><span class="pagination-ellipsis">&hellip;</span></li>
        <li><a class="pagination-link" aria-label="Goto page 45">45</a></li>
        <li><a class="pagination-link is-current" aria-label="Page 46" aria-current="page">46</a></li>
        <li><a class="pagination-link" aria-label="Goto page 47">47</a></li>
        <li><span class="pagination-ellipsis">&hellip;</span></li>
        
        <li><a class="pagination-link" aria-label="Goto page 86">86</a></li>-->
    </ul>
    </nav>
</div>

<?php require_once APPROOT . "/Views/inc/footer.php" ?>