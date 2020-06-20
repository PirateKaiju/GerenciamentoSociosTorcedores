<?php require_once APPROOT . "/Views/inc/header.php" ?>

<div class="hero is-primary has-background-white-bis has-text-grey-dark">
    <div class="hero-body">
        <h1 class="title has-text-black">Jogos</h1>
        <h3 class="subtitle has-text-black">Descrição....</h3>

        <div class="container">

            <table class="table is-fullwidth is-striped">
                <thead>
                    <tr>
                        <th>Jogo</th>
                        <th>Data</th>
                        <th>Detalhes da partida</th>
                    </tr>
                </thead>

                <tbody>

                <?php foreach ($data["games"] as $game): ?>

                <tr>
                    <td><?php echo $game->timeCasa . " X ". $game->timeAdv;?></td>
                    <td>Dia <?php echo $game->dataJogo; ?></td>
                    <td><a href="<?php echo URLROOT; ?>/games/show/<?php echo $game->idJogo;?>">Mais Detalhes</a></td>
                </tr>

                <?php endforeach;?>

                </tbody>
            </table>

            <!--<section class="articles">

                <?php //foreach ($data["games"] as $game): ?>

                <div class="card article">

                    <div class="card-content">

                    <p class="title article-title has-text-centered">
                        <?php echo $post->titulo;?>
                    </p>

                    <p class="content article-body">
                        <?php echo $post->descricao;?>
                    </p>
            
                </div>

                </div>

                <?php //endforeach;?>
            </section>-->
        </div>

        <?php //var_dump($data);?>

    </div>

    <nav class="pagination is-centered" role="navigation" aria-label="pagination">
    <ul class="pagination-list">
        
        <?php 
        
        $interval = get_page_interval($data["page"], $data["total_pages"]);
        
        //var_dump($interval);

        foreach ($interval as $page):
            
        ?>

        <li><a class="pagination-link" aria-label="Goto page <?php echo $page;?>" href="<?php echo URLROOT;?>/games/index/<?php echo $page;?>"><?php echo $page;?></a></li>


        <?php endforeach;?>


        <!--<li><span class="pagination-ellipsis">&hellip;</span></li>
        <li><a class="pagination-link" aria-label="Goto page 45">45</a></li>
        <li><a class="pagination-link is-current" aria-label="Page 46" aria-current="page">46</a></li>
        <li><a class="pagination-link" aria-label="Goto page 47">47</a></li>
        <li><span class="pagination-ellipsis">&hellip;</span></li>
        
        <li><a class="pagination-link" aria-label="Goto page 86">86</a></li>-->
    </ul>

</div>

<?php require_once APPROOT . "/Views/inc/footer.php" ?>