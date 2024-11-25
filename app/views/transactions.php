<?php

require_once '../models/models.php';

// print_r($transactionsArray);


?>

<html>
    <head>
        <title>Transactions</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
	    <?php
	    foreach($transactionsArray as $item){
		echo '<tr>';    
	    	echo "<td>{$item['Date']}</td>";
	    	echo "<td>{$item['Check #']}</td>";
	    	echo "<td>{$item['Description']}</td>";
	    	echo "<td>{$item['Amount']}</td>";
		echo '</tr>';    
	    }
	    ?> 
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
		    <td>
			<?php echo $transactionsIncome?>
		    </td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
		    <td>
			<?php echo $transactionsExpense?>
		   </td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
		    <td>
			<?php echo $transactionsExpense + $transactionsIncome?>
		   </td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
