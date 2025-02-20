edit
<form action=<?php echo "/users/{$user['id']}" ?> method="post">
    <input hidden name="_method" value="PATCH">
    <input type="text" name="name">
    <input type="text" name="email">
    <button type="submit">edit user</button>
</form>
<form action=<?php echo "/users/{$user['id']}" ?> method="post">
    <input hidden name="_method" value="DELETE">
    <button type="submit">delete</button>
</form>