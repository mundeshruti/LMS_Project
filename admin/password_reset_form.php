<br />
<form method="post" action="">
    <input type="hidden" name="action" value="update" />
    <br /><br />
    <label><strong>Enter New Password:</strong></label><br />
    <input type="password" name="pass1" maxlength="255" required />
    <br /><br />
    <label><strong>Re-Enter New Password:</strong></label><br />
    <input type="password" name="pass2" maxlength="255" required />
    <br /><br />
    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>" />
    <input type="submit" id="reset" value="Reset Password" />
</form>
