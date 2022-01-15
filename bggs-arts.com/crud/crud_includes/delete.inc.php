<?php
include('config.php');

if ($_GET['table']=='artists') {
    $sql = "DELETE FROM artists WHERE artist_id='" . $_GET["artist_id"] . "'";
if (mysqli_query($link, $sql)) {
    header ('Location: ../../dashboard.php?table='.$_GET['table']);
} else {
    echo "Error deleting record: " . mysqli_error($link);
}
mysqli_close($link);
} 
else if ($_GET['table'] == 'Artworks'){
    $sql = "DELETE FROM artworks WHERE a_id='" . $_GET['a_id'] . "'";
    if (mysqli_query($link, $sql)) {
        header ('Location: ../../dashboard.php?table='.$_GET['table'].'&aInput='.'&delete=TRUE');
    } else {
        echo "Error deleting record: " . mysqli_error($link);
    }
    mysqli_close($link);
} else {
    header ('Location: ../../dashboard.php?error=sqlerr&table='.$_GET['table']);
}
?>