<form name='myForm' action='adminprocess.php' method='POST'>
    <table id='left' style='margin-bottom:5px;'>
        <tr>
            <th class='sortable'>Username</th><th class='sortable'>Name</th>
            <th class='sortable'>Email</th><th class='sortable'>Level</th><th>Department</th><th class='sortable'>Registered</th><th>
                <input type="checkbox" id="checkL" onclick="jqCheckAll3(this.id, 'left');"/></th>
        </tr>
        <?php
        while($row = $result->fetch())
        {
        $regdate = $row['regdate'];
        $reg  = date("j M, y, g:i a", $regdate);
        echo "<tr><td><a href='".$config['WEB_ROOT']."admin/index.php?id=6&usertoedit=".$username."'>".$username."</a></td>\n";

        echo "<td>".$fname." ".$lname."</td>\n";
        echo "<td>".$Uemail."</td>\n";
        echo "<td>";
        ?>
        <select name="ulevel" id="ulevel">
            <option value="8">Supervisor</option>
            <option value="6">Regular user</option>
            <option value="5">Reports Only</option>
        </select>

        <?PHP
        echo "</td>\n";
        echo "<td>\n\t";
        ?>
        <select name="departmentid" id="departmentid">
            <option value="1">North East</option>
            <option value="2">South</option>
            <option value="3">Central</option>
        </select>
<?PHP
echo "</td>\n";
echo "<td>".$reg."</td>\n";
echo "</td>\n";
echo "<td>".$reg."</td>\n";
echo "</td><td><input name='user_name[]' type='checkbox' value='".$row['username']."' />";
echo "</td>\n</tr>";
    echo "</td>\n</tr>";
}
?>
</table>
<input type="hidden" name="activateusers" value="1">
<input type="submit" value="Activate Selected Users">
<br>
</form>