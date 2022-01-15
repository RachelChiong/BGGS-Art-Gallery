
<style>
.glyphicon-sort {
    float: right;
}

.orderBtn {
    float: right;
    background: none;
    border: none;
}

.actionBtn {
    margin-top: 10%;
    margin-bottom: 7%;
}

    .atr td {
        font-size: 20px;
    }
#aInput {
    font-size: 16px;
    height: 38px;
} 
*/
</style>
<?php 
session_start();
$aInput = $_GET['aInput'];

// Get the page number of the page the user wants displayed
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

// Get the number of results the user wants displayed in the table (non-functional in prototype)
if (isset($_GET['resultsdisp'])) {
    $_SESSION['resultsdisp'] = $_GET['resultsdisp'];
    $resultsdisp = $_SESSION['resultsdisp'];
} else {
    $resultsdisp = 7;
}

// Get field which the table will be ordered by
if(isset($_GET['selOrder'])) {
    $selOrder = $_GET['selOrder'];
} else {
    $selOrder = 'ID';
}

$no_of_records_per_page = $resultsdisp;
// The OFFSET clause specifies the number of rows to skip before starting to return rows from the query.
$offset = ($pageno - 1) * $no_of_records_per_page;

// If there is no search query, the default table with all results are shown. 
if($aInput == NULL) {
    $resultsql = "SELECT COUNT(*) FROM temptable";
$res_data_sql = "SELECT * FROM temptable ORDER BY $selOrder LIMIT $offset, $no_of_records_per_page";
} else {
    $resultsql =  "SELECT COUNT(*) FROM temptable WHERE Location LIKE '%".$searchQuery."%' OR
    Media LIKE '%".$searchQuery."%' OR
    Artist_Name LIKE '%".$searchQuery."%' OR
    Title LIKE '%".$searchQuery."%'";

    $res_data_sql = "SELECT * FROM temptable WHERE 
    Location LIKE '%".$searchQuery."%' OR
    Media LIKE '%".$searchQuery."%' OR
    Artist_Name LIKE '%".$searchQuery."%' OR
    Title LIKE '%".$searchQuery."%' ORDER BY $selOrder LIMIT $offset, $no_of_records_per_page";
}
// If administrator has entered a search query, retreive the processed search query from the dashboard
$result = mysqli_query($conn, $resultsql);

// Find the number of records that match the search query
$total_rows = mysqli_fetch_array($result)[0];

// Find the number of pages required to display the search results, when the number of records per page is as the user selected
$total_pages = ceil($total_rows / $no_of_records_per_page);

// Search query executed on the temporary table using the escaped string search query

$searchtable = mysqli_query($conn, $res_data_sql) or trigger_error(mysqli_error($conn));
echo '<p>'.$total_rows.' results found </p>';
/// Construct the table
echo '<table class="table">';
echo '<tr class="tb_head">';
// Table headers contain buttons for 'sorting' according to their respective fields. This is done using a form 'get' method. 
echo '<form action="'.$_SERVER['PHP_SELF'].'" method="GET">'; ?>
    <th>ID
    <!-- Each button is assigned the value of the row alias -->
        <button  aria-label="Order By ID Button" alt="Order by ID" data-toggle="tooltip" Title="Sort by ID" class="orderBtn" type="submit" name="SelOrder" value="ID">
            <span alt="Order by ID button" class="glyphicon glyphicon-sort-by-order"></span>
        </button>
    </th>
    <th>Title
      <button aria-label="Order By Title Button" alt="Order by Title" data-toggle="tooltip" Title="Sort by Title" class="orderBtn" type="submit" name="selOrder" value="Title">
            <span alt="Order by Title button" class="glyphicon glyphicon-sort-by-alphabet"></span>
        </button>
    </th>
    <th>Artist
        <button aria-label="Order By Artist Button" alt="Order by Artist button" data-toggle="tooltip" Title="Sort by Artist" class="orderBtn" type="submit" name="selOrder" value="Artist_Name">
            <span alt="Order by Artist button" class="glyphicon glyphicon-sort-by-alphabet"></span>
        </button>
    </th>
    <th>Media
        <button aria-label="Order By Media Button" alt="Order by Media" data-toggle="tooltip" Title="Sort by Media" class="orderBtn" type="submit" name="selOrder" value="Media">
            <span alt="Order by Media button" class="glyphicon glyphicon-sort-by-alphabet"></span>
        </button>
    </th>
    <th>Location
        <button aria-label="Order By Location Button" alt="Order by Location" data-toggle="tooltip" Title="Sort by Location" class="orderBtn" type="submit" name="selOrder" value="Location">
            <span class="glyphicon glyphicon-sort-by-alphabet"></span>
        </button>
    </th>
    <th align="center">Image</th>
    <th>Actions</th>
  <!-- Return the table being filtered -->
  <input name="table" value="<?php echo $_GET['table'] ?>" hidden/>
  <?php
  if(isset($_SESSION['aInput'])){
  echo '
  <input name="aInput" value="'.$_SESSION['aInput'].'" hidden/>'; } echo'
  </form>'; 
    // Check whether the search query returned any records
    if (mysqli_num_rows($searchtable) > 0) {
        // fetch associative rows in search table
        while($row = mysqli_fetch_assoc($searchtable)) { ?>
            <tbody id="gal_table"><tr class="atr"><td><strong><?php echo $row['ID'] ?></strong></td>
            
            <td><?php echo $row['Title'] ?></td>
            <td><?php echo $row['Artist_Name'] ?></td>
            <td><?php echo $row['Media'] ?></td>
            <td><?php echo $row['Location'] ?></td>
            <td><img alt="<?php echo $row['Title'] ?> image" class="ret_img"src="data:image/jpeg;base64,<?php echo base64_encode( $row['Image']) ?>"></td>
            <!-- CRUD actions user can take for each record -->
            <td style='text-align: center;'>
        <a href='crud/read.php?table=Artworks&a_id=<?php echo $row['ID'] ?>' title='View Record' data-toggle='tooltip'><span>
        <img alt="read" src="img/scroll.png" width="24px">
        </span></a>
        <a href='crud/update.php?table=Artworks&a_id=<?php echo $row['ID'] ?>' title='Update Record' data-toggle='tooltip'><span>
        <img alt="edit" src="img/edit-button.png" width="24px">
        </span></a>
        <a href='crud/delete.php?table=Artworks&a_id=<?php echo $row['ID'] ?>' title='Delete Record' data-toggle='tooltip'><span>
        <img alt="delete" src="img/delete.png" width="24px">
        </span></a>
    </td></tr>
            <?php
        }  
} else /* If no records are found with the search query */ {
    echo "0 Results Found";
}

/// Distinguish where the table ends. 
echo '</tbody></table>';

?>

</body>
</html>