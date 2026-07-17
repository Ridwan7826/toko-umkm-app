import { test, expect } from '@playwright/test';

test.describe('Seller Product Management', () => {

    test.beforeEach(async ({ page }) => {
        // Login as Seller
        await page.goto('/login');
        await page.fill('input[name="email"]', 'penjual1@tokokita.com');
        await page.fill('input[name="password"]', 'password');
        await page.click('button[type="submit"]');
        await page.waitForURL('/dashboard');
    });

    test('Harus bisa menambah produk baru beserta varian', async ({ page }) => {
        await page.goto('/seller/products');
        await page.click('text="+ Tambah Data Baru"');

        await page.waitForURL('/seller/products/create');
        
        const timestamp = Date.now();
        const productName = `Produk E2E Test ${timestamp}`;
        
        await page.fill('input[name="name"]', productName);
        await page.fill('textarea[name="description"]', 'Deskripsi produk testing ini sangat panjang dan bagus.');
        
        // Pilih kategori pertama
        const firstCategoryCheckbox = page.locator('input[name="category_ids[]"]').first();
        await firstCategoryCheckbox.check();

        // Isi Varian 1
        await page.fill('input[name="variants[0][name]"]', 'Varian 1');
        await page.fill('input[name="variants[0][price]"]', '15000');
        await page.fill('input[name="variants[0][weight]"]', '500');
        await page.fill('input[name="variants[0][stock]"]', '10');

        // Tambah Varian 2
        await page.click('button#add-variant');
        await page.fill('input[name="variants[1][name]"]', 'Varian 2');
        await page.fill('input[name="variants[1][price]"]', '20000');
        await page.fill('input[name="variants[1][weight]"]', '600');
        await page.fill('input[name="variants[1][stock]"]', '5');

        await page.click('button:has-text("Simpan Produk")');

        await page.waitForURL('/seller/products');
        
        // Verifikasi Flash Message & Produk ada di tabel
        await expect(page.getByText('Produk berhasil ditambahkan.')).toBeVisible();
        await expect(page.getByText(productName)).toBeVisible();
    });

    test('Harus bisa merubah (edit) produk', async ({ page }) => {
        await page.goto('/seller/products');
        
        // Asumsi ada produk, klik tombol Ubah pada produk pertama
        const firstEditBtn = page.locator('a:has-text("Ubah")').first();
        await firstEditBtn.click();
        
        await expect(page).toHaveURL(/seller\/products\/\d+\/edit/);
        
        const updatedName = `Produk E2E Updated ${Date.now()}`;
        await page.fill('input[name="name"]', updatedName);
        
        // Ubah harga varian pertama
        await page.fill('input[name="variants[0][price]"]', '99999');

        await page.click('button:has-text("Simpan Perubahan")');

        await page.waitForURL('/seller/products');
        await expect(page.getByText('Produk berhasil diperbarui.')).toBeVisible();
        await expect(page.getByText(updatedName)).toBeVisible();
    });

    test('Harus bisa menghapus produk', async ({ page }) => {
        await page.goto('/seller/products');
        
        // Tangani alert confirm browser
        page.on('dialog', async dialog => {
            expect(dialog.message()).toContain('Apakah Anda yakin ingin menghapus produk ini?');
            await dialog.accept();
        });

        const firstDeleteBtn = page.locator('button:has-text("Hapus")').first();
        await firstDeleteBtn.click();

        await page.waitForURL('/seller/products');
        await expect(page.getByText('Produk berhasil dihapus.')).toBeVisible();
    });

});
