<?php require_once APPROOT . "/Views/inc/header.php" ?>


<div class="hero has-text-black has-background-white-bis">
    <div class="hero-body">

    <div class="container">

        <section class="articles">
        <?php foreach ($data["posts"] as $post):?>

        <div class="card article">

            <div class="card-content">

                <p class="title article-title has-text-centered">
                    <?php echo $post->titulo;?>
                </p>

                <p class="content article-body">
                    <?php echo $post->descricao;?>
                </p>
            
            </div>

            <footer class="card-footer has-text-centered">
            
                <span class="card-footer-item">
                    <a href="<?php echo URLROOT;?>/posts/show/<?php echo $post->idPostagem;?>" class="">
                        Ler mais ...
                    </a>
                </span>

            </footer>

            <footer class="card-footer">
            
                <span class="card-footer-item">
                    <a href="">
                    
                        Compartilhe no ...

                    </a>
                </span>

                <span class="card-footer-item">
                    <a href="">
                    
                        Siga nosso ...

                    </a>
                </span>
            
            </footer>

        </div>

        <br>

        <?php endforeach;?>

        <?php //var_dump($data);?>

        </section>
        
        </div>

    </div>

    <nav class="pagination is-centered" role="navigation" aria-label="pagination">
    <ul class="pagination-list">
        
        <?php 
        
        $interval = get_page_interval($data["page"], $data["total_pages"]);
        
        //var_dump($interval);

        foreach ($interval as $page):
            
        ?>

        <li><a class="pagination-link" aria-label="Goto page <?php echo $page;?>" href="<?php echo URLROOT;?>/posts/index/<?php echo $page;?>"><?php echo $page;?></a></li>


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