<div id = "page-wrapper">

    <p>Are you sure you want to do this?</p>
    <p>To continue deleting your profile re-enter your password.</p>
    <br>
    <form method='POST' action='/users/p_settings_delete_delete/'>
        <table>
            <tr>
                <th>
                    <label for="password">Password</label>
                </th>
                <td>
                    <input type='password' name='password' id = "password">

                </td>
            </tr>
        </table>
        <input type='submit' value='Delete'>
    </form>
    <button id="cancel">Cancel</button>

</div>
