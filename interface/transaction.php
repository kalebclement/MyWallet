<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
include "connection.php";
include "getvar.php";
?>
<body style="background: url(image/transaction.svg);">
    <style>
        #table_transact table {
            font-family: 'Segoe UI';
            border-collapse: collapse;
            width: 100%;
        }
        #table_transact td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        #table_transact tr:nth-child(odd) {
            background-color: #c0873cb0;
        }
        #table_transact tr:nth-child(even) {
            background-color: #791919a9;
        }
    </style>
    <?php include "navigation.php"; ?>
    <div id="content">
        <div id="transaction">
            <h1 class="h1">Transaction!</h1>
            <small id="accname">Name : <?php echo $accname?></small>
            <p>Here is your transaction history.</p>
            <div id="table_transact">
                <table>
                    <thead style="background-color: rgba(0, 0, 0, 0.993);">
                        <tr>
                            <th>ID</th>
                            <th>Time</th>
                            <th>TYPE</th>
                            <th>Recipient ID</th>
                            <th>Amount</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "CALL `show_transaction`('$phone')";
                        $result = $link->query($query) or die(mysqli_error($link));
                        if($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()){
                                echo (
                                    "<tr>".
                                        "<td>".$row['order_id']."</td>".
                                        "<td>".$row['order_time']."</td>".
                                        "<td>".$row['type_id']."</td>".
                                        "<td>".$row['order_recipient']."</td>".
                                        "<td>".$row['order_amount']."</td>".
                                        "<td>".$row['order_balance']."</td>".
                                    "</tr>"
                                );
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>            
    </div>
</body>
</html>