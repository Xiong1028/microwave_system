<?php
/*
 *  Purpose: a select form for users to reset the data in the database
 *  Authors: Hui, Debora, Jihye, Xiong, Jane
 *  Date:   Feb 9, 2019
**/

require_once("../../common/templates/header.php");
require_once("../../common/utilities/dbHandler.php");
?>
<div class="container" id="resetContainer">
    <h2>Reset Microwave Data</h2>
    <p class="text-danger">
        <i class="fa fa-warning" aria-hidden="true" style="margin-right: 5px"></i>
        Warning: Microwave Data will be overridden and restored to original status.
    </p>

    <form method="post" id="resetForm" style="margin-top: 30px;">
        Path Name:
        <select name="pathSel" id="pathSel">
            <option value="">Please Select Path</option>
            <?php
            $db_conn = connect_db();
            $pathNameItems = db_select_oneCol($db_conn, 'path_general', 'path_name');
            disconnect_db($db_conn);
            foreach ($pathNameItems as $item) {
                ?>
                <option value="<?php echo $item; ?>"><?php echo $item; ?></option>
                <?php
            }
            ?>
        </select>
        <div>
            <input id="reset" type="submit" name="reset" value="reset" class="btn btn-outline-secondary"
                   style="margin-top: 20px"/>
        </div>
    </form>

    <br/><br/>
    <div id="msg"></div>
</div>

<?php

require_once("../../common/templates/footer.php");
?>
