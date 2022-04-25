<?php

include_once 'functionsDashbord.php';


function getShortStay($pdo)
{
    $sqlQuery = "select id,First_Name,Last_Name,Email,Age,Contact_Num,City,Postal_Code,Province,Visit_Short_Stay,Comments, Date_Message from contact_us where Visit_Short_Stay is not null";
    $pdoStmt = $pdo->prepare($sqlQuery);
    $pdoStmt->execute();
    $result = $pdoStmt->fetchAll();
    $pdo = null;
    return $result;
}
function delete($pdo, $id)
{
    $sql = "Delete From contact_us where id = :Id";
    $pdoStmt = $pdo->prepare($sql);
    try {
        $pdoStmt->execute([':Id' => $id]);
    } catch (\Throwable $th) {
        throw $th;
    }
}

function getInvestor($pdo)
{
    $sqlQuery = "select id,First_Name,Last_Name,Email,Age,Contact_Num,City,Postal_Code,Province,Investor,Invest_Amount, Comments, Date_Message from contact_us where Investor is not null";
    $pdoStmt = $pdo->prepare($sqlQuery);
    $pdoStmt->execute();
    $result = $pdoStmt->fetchAll();
    $pdo = null;
    return $result;
}

function getRenter($pdo)
{
    $sqlQuery = "select id,First_Name,Last_Name,Email,Age,Contact_Num,City,Postal_Code,Province,Move_Cohousing, RentAmount, Comments, Date_Message from contact_us where Move_Cohousing is not null";
    $pdoStmt = $pdo->prepare($sqlQuery);
    $pdoStmt->execute();
    $result = $pdoStmt->fetchAll();
    $pdo = null;
    return $result;
}

function modalMessage($idMessage, $message, $Fname, $Lname)
{


    print <<<ME
                                            <div class="modal fade" id="$idMessage" tabindex="-1" aria-labelledby="exampleModalLabel$idMessage" aria-hidden="true"><div class="modal-dialog modal-lg"><div class="modal-content">
                                            <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel$idMessage">Message</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
        

                                                        <div class="mb-3">
                                                            <label for="message-text$idMessage" class="col-form-label">Message from $Fname $Lname:</label>
                                                         <textarea disabled style="height: 200px" class="form-control bg-light" id="message-text$idMessage">$message</textarea>
                                                         </div>
        
                                                     </div>
                                                     <div class="modal-footer">
                                                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                      </div>
                                                    </div>
                                                 </div>
                                                </div>



                                            ME;
}

/**
 * @param $data
 * @return void
 */
function extracted($data)
{
    echo '<td hidden = "hidden">';
    echo '<p>' . $data["id"] . '</p >';
    echo '</td >';

    // echo "<tr>";
    echo "<td class='border-bottom-0'>";
    echo '<div class="d-flex px-2 py-1">';
    echo '<div class="d-flex flex-column justify-content-center">';
    echo '<h6 class="mb-0 text-sm">' . $data['First_Name'] . " " . $data["Last_Name"] . '</h6>';
    echo "</div>";
    echo "</div>";
    echo "</td>";

    echo "<td class='border-bottom-0'>";
    echo '<p class="text-xs font-weight-bold mb-0">' . $data["Email"] . '</p >';
    echo '</td >';

    echo "<td class='border-bottom-0'>";
    echo '<p class="text-xs font-weight-bold mb-0 text-center">' . $data["Age"] . '</p >';
    echo '</td >';

    echo "<td class='border-bottom-0'>";
    echo '<p class="text-xs font-weight-bold mb-0 text-center">' . $data["Contact_Num"] . '</p >';
    echo '</td >';

    echo "<td class='border-bottom-0'>";
    echo '<p class="text-xs font-weight-bold mb-0 text-center">' . $data["City"] . '</p >';
    echo '</td >';

    echo "<td class='border-bottom-0'>";
    echo '<p class="text-xs font-weight-bold mb-0 text-center">' . $data["Postal_Code"] . '</p >';
    echo '</td >';

    echo "<td class='border-bottom-0'>";
    echo '<p class="text-xs font-weight-bold mb-0 text-center">' . $data["Province"] . '</p >';
    echo '</td >';

    // echo '<td>';
}

function deleteButton($id,$page){

    print <<<AM
            <td class="border-bottom-0">
            <button type="button" class="btn btn-danger text-xs mb-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop$id">Delete</button>


            <div class="modal fade" id="staticBackdrop$id" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel$id" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-danger">
                 <h5 class="modal-title text-white" id="staticBackdropLabel$id"><svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                 
                 <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                   <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                 </symbol>
               </svg><svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>Alert</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    This item will be deleted immediately. You can't undo this action
                </div>
                <div class="modal-footer">
                <form action="$page.php" method="post">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                    <button name="delete" class="btn btn-danger "  value="$id" >Delete</button>
                </form>
                </div>
                </div>
                </div>
                </div></td>

    AM;

}
