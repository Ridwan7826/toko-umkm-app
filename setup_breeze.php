echo "Memulai instalasi Breeze...\n";
exec('composer require laravel/breeze --dev', $out, $code);
if($code !== 0) die("Composer require breeze gagal\n");

echo "Install Breeze Blade...\n";
exec('php artisan breeze:install blade --quiet', $out, $code);
if($code !== 0) die("Breeze install gagal\n");

echo "Install NPM...\n";
exec('npm install', $out, $code);
if($code !== 0) die("NPM install gagal\n");

echo "Build NPM...\n";
exec('npm run build', $out, $code);
if($code !== 0) die("NPM build gagal\n");

echo "Breeze Berhasil Diinstal!\n";
