
    <div id = "page-wrapper">
       
        <h1>Log In</h1>
        
         <form method='POST' action='/users/p_login' id="loginform">
            <table>

                        <label for="email">Email  </label>

                        <input type='text' name='email' id = "email" required=>
                <div></div>


                        <label for="password">Password</label>

                        <input type='password' name='password' id = "password" required>

            </table>

            <input type='submit' value='Enter'>
        </form>
    </div>
    <script>
        $("#loginform").validate();
    </script>


