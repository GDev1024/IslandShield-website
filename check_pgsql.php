<?php
echo "<h1>PHP PostgreSQL Extension Check</h1>";

echo "<h2>PDO Drivers Available:</h2>";
$drivers = PDO::getAvailableDrivers();
echo "<ul>";
foreach ($drivers as $driver) {
    echo "<li>" . $driver . "</li>";
}
echo "</ul>";

if (in_array('pgsql', $drivers)) {
    echo "<p style='color: green;'>✓ PostgreSQL PDO driver is available!</p>";
} else {
    echo "<p style='color: red;'>✗ PostgreSQL PDO driver is NOT available!</p>";
    echo "<h3>How to fix:</h3>";
    echo "<ol>";
    echo "<li>Open: <code>C:\\xampp\\php\\php.ini</code></li>";
    echo "<li>Find: <code>;extension=pdo_pgsql</code></li>";
    echo "<li>Remove semicolon: <code>extension=pdo_pgsql</code></li>";
    echo "<li>Find: <code>;extension=pgsql</code></li>";
    echo "<li>Remove semicolon: <code>extension=pgsql</code></li>";
    echo "<li>Save file</li>";
    echo "<li>Restart Apache in XAMPP</li>";
    echo "</ol>";
}

echo "<h2>PHP Info:</h2>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Loaded Extensions: " . count(get_loaded_extensions()) . "</p>";

if (extension_loaded('pgsql')) {
    echo "<p style='color: green;'>✓ pgsql extension loaded</p>";
} else {
    echo "<p style='color: red;'>✗ pgsql extension NOT loaded</p>";
}

if (extension_loaded('pdo_pgsql')) {
    echo "<p style='color: green;'>✓ pdo_pgsql extension loaded</p>";
} else {
    echo "<p style='color: red;'>✗ pdo_pgsql extension NOT loaded</p>";
}
?>
