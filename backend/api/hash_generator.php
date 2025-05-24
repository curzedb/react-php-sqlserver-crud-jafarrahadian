<?php
// Script untuk membuat hash password yang kompatibel dengan environment Anda

$passwordToHash = 'admin123';

$newHash = password_hash($passwordToHash, PASSWORD_BCRYPT);

echo "Gunakan HASH BARU di bawah ini untuk database Anda:<br><br>";
echo "<strong>" . $newHash . "</strong>";
?>