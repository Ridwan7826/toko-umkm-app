import { test, expect } from '@playwright/test';
import { LoginPage } from '../pages/LoginPage.js';
import { DashboardPage } from '../pages/DashboardPage.js';
import { getSeederUser } from '../helpers/db.js';

test.describe('Buyer Review Flow', () => {
    let dashboardPage;

    test.beforeEach(async ({ page }) => {
        // Run seeder specific to this test to ensure there is a "delivered" order
        // Note: The seeder must be run before tests, we assume it's run via terminal in our workflow

        const loginPage = new LoginPage(page);
        dashboardPage = new DashboardPage(page);
        await loginPage.goto();
        const user = getSeederUser('pembeli');
        await loginPage.fillCredentials(user.email, user.password);
        await loginPage.submit();
        await dashboardPage.verifyRole('pembeli');
    });

    test('Can write a review for a delivered order and verify on public catalog', async ({ page }) => {
        // 1. Pergi ke daftar pesanan pembeli
        await page.getByRole('link', { name: 'Pesanan Saya' }).click();
        await expect(page.getByText('Riwayat Pembelian', { exact: true })).toBeVisible();

        // 2. Cari baris pesanan dengan status 'selesai' dan klik detail
        const orderRow = page.locator('tr').filter({ hasText: /selesai/i }).first();
        await orderRow.getByRole('link', { name: 'Detail' }).click();

        // 3. Pastikan berada di halaman detail pesanan yang tepat
        await expect(page.locator('h3', { hasText: /Status Pesanan:\s*selesai/i })).toBeVisible();

        // 4. Klik tombol Beri Ulasan
        await page.getByRole('link', { name: 'Beri Ulasan' }).click();
        
        // 5. Isi form ulasan
        await expect(page.getByText('Beri Ulasan Produk', { exact: true })).toBeVisible();
        await page.locator('select[name="rating"]').selectOption('5');
        const reviewText = 'Produk luar biasa! ' + Date.now();
        await page.locator('textarea[name="comment"]').fill(reviewText);
        
        // 6. Submit
        await page.getByRole('button', { name: 'Kirim Ulasan' }).click();

        // 7. Aplikasi mengarahkan ke halaman katalog produk publik
        await expect(page.getByText('Katalog Produk')).toBeVisible();
        await expect(page.getByText('Ulasan berhasil ditambahkan!')).toBeVisible();

        // 8. Verifikasi ulasan ada di halaman tersebut
        await expect(page.getByRole('heading', { name: 'Ulasan Pembeli' })).toBeVisible();
        await expect(page.getByText(reviewText)).toBeVisible();
    });
});
