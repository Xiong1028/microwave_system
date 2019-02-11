<?php
/*
 *  Purpose: a select form for users to reset the data in the database
 *  Authors: Hui, Debora, Jihye, Xiong, Jane
 *  Date:   Feb 9, 2019
**/

require_once("../../common/templates/header.php");
?>
<div class="container">
    <h3>Reset Microwave Path Data</h3>
    <p class="text-danger">
        <i class="fa fa-warning" aria-hidden="true" style="margin-right: 5px"></i>
        Warning: Microwave Data will be overridden and restored to original status.
    </p>

    <form method="post" id="resetForm" style="margin-top: 30px;">
        Path Name:
        <select name="pathSel" id="pathSel">
            <option value="">Please Select Path</option>
            <option value="path01">Path 01</option>
            <option value="path02">Path 02</option>
            <option value="path03">Path 03</option>
        </select>
        <div>
            <input id="reset" type="submit" name="reset" value="reset" class="btn btn-primary"
                    style="margin-top: 30px">
            </input>
        </div>
    </form>
    <br/><br/>
    <div id="msg"></div>
</div>

<?php
require_once("../../common/templates/footer.php");
?>
