$password_salt = random_bytes (64);
$password_hash = hash('sha256', 'password'.$password_salt);
