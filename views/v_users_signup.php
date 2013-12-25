



    <div div id = "page-wrapper">
       
        <h1>Sign Up</a></h1>
        <div id="signupformlay">
            <form method='POST' action='/users/p_signup' id="signupform">
            <table>
                <tr>
                    <th>
                        <label for="first">First Name</label>
                    </th>
                    <td>
                        <input type='text' name='first_name' id = "first" required>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="last">Last Name</label>
                    </th>
                    <td>
                        <input type='text' name='last_name' id = "last" required>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="email">Email</label>
                    </th>
                    <td>
                        <input type='email' name='email' id = "email" required>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="password">Password</label>
                    </th>
                    <td>
                        <input type='password' name='password' id = "password" required>
                    </td>
                </tr>

            </table>
             <input type='submit' value='Sign up'>
        </div>

        </form>
    </div>
    <script>
        $("#signupform").validate();
    </script>

