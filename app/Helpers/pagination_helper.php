<?php

    function get_total_pages($total_items){
        return ceil($total_items / ITENS_PER_PAGE);
    }


    function get_current_start_index($page_number){

        //Offset is 0 started
        return ((($page_number - 1) * ITENS_PER_PAGE)); //Table index of first user of current page

    }

    function get_page_interval($page, $last_page){

        $page = intval($page);

        $last_page = intval($last_page);

        if($last_page > 4){

            if($page <= 2){
                return([1, 2, 3, 4, $last_page]);
            }else if($page > ($last_page - 2)){
                return([1, $last_page - 2, $last_page - 1, $last_page]);
            }

            return([1, $page - 1, $page, $page + 1, $page + 2, $last_page]);
        }

        //Less than 4 pages, return all of them
        $pages = [];

        //$page == 1 ? $page += 1 : $page;

        for($i = 1; $i <= $last_page; $i++){

            $pages[] = $i;

        }

        return $pages;

    }


?>