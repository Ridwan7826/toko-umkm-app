<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Laporan'); ?> - TokoKita</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            font-size: 14px;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }
        .header {
            border-bottom: 2px solid #2563eb;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #1e3a8a;
            margin: 0 0 5px 0;
            font-size: 24px;
            text-transform: uppercase;
        }
        .header p {
            margin: 0;
            color: #64748b;
            font-size: 14px;
        }
        .shop-info {
            float: right;
            text-align: right;
            margin-top: -45px;
        }
        .shop-info h3 {
            margin: 0 0 5px 0;
            font-size: 16px;
            color: #0f172a;
        }
        .shop-info p {
            margin: 0;
            font-size: 12px;
            color: #475569;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table th, table td {
            border: 1px solid #e2e8f0;
            padding: 12px;
            text-align: left;
        }
        table th {
            background-color: #f8fafc;
            color: #1e293b;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 12px;
        }
        table tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .summary-box {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .summary-box strong {
            color: #1d4ed8;
        }
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
        }
        .clear {
            clear: both;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1><?php echo $__env->yieldContent('title'); ?></h1>
        <p>Tanggal Cetak: <?php echo e(date('d F Y')); ?></p>
        
        <?php if(isset($shop)): ?>
        <div class="shop-info">
            <h3><?php echo e($shop->name); ?></h3>
            <p><?php echo e($shop->address ?? 'Alamat belum diatur'); ?></p>
        </div>
        <?php endif; ?>
        <div class="clear"></div>
    </div>

    <div class="content">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <div class="footer">
        <p>Dicetak secara otomatis oleh sistem <strong>TokoKita</strong>. Laporan ini valid tanpa tanda tangan basah.</p>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\Toko_Kita\resources\views\pdf\layout.blade.php ENDPATH**/ ?>