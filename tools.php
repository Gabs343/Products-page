<?php 
function TextDescription($string){
    $array_text = str_split($string);
    for($i = 0; $i < sizeof($array_text); $i++ ){
        echo $array_text[$i];
        echo $array_text[$i] == "." ? "<br><br>" : "";
    }
}

function mensajeC($txt) {?>
    <script>
        alert("<?php echo $txt; ?>")
    </script>
<?php }

?>