<?php include("include/header.php");
require_once("include/conn.php"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<input type="text" placeholder="Product name..." id="search_text" name="search_text">
<div id="result"></div>

<script>
    $(document).ready(function(){
        $('#search_text').keyup(function(){
            var txt = $(this).val();
            if(txt != ''){
                $.ajax({
                    url:"fetch.php",
                    method:"post",
                    data:{search:txt},
                    dataType:"text",
                    success:function(data){
                        $('#result').html(data);
                    }
                });
            } else {
                $('#result').html('');
            }
        });
    });
</script>
