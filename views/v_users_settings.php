
<?php if(isset($_GET['error'])): ?>
    <?php $pcode= "wrong password"; ?>
<?php else: ?>
    <?php $pcode = ""; ?>
<?php endif; ?>


    <div id = "page-wrapper">
        <h1>Settings</h1>
        <p>If you would like to delete your profile please enter your password.</p>
        <br>
        <form method='POST' action='/users/p_settings_delete'>
            <table>
                <tr>
                    <th>
                        <label for="password">Password</label>
                    </th>
                    <td>
                        <input type='password' name='password' id = "password"><?=$pcode?>
                    </td>
                </tr>
            </table>
            <input type='submit' value='Delete Profile'>
        </form>
    </div>



