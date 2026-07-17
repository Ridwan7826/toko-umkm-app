import { test, expect } from '@playwright/test';

test.describe('Seller Reports Module', () => {
    test.beforeEach(async ({ page }) => {
        // Asumsi ada endpoint login untuk seeder seller
        await page.goto('/login');
        await page.fill('input[name="email"]', 'penjual1@tokokita.com');
        await page.fill('input[name="password"]', 'password');
        await page.click('button[type="submit"]');
        await page.waitForURL('/dashboard');
    });

    test('Seller dapat melihat halaman Laporan Penjualan Toko', async ({ page }) => {
        await page.goto('/seller/reports');
        // Pastikan tidak diarahkan kembali ke pembuatan toko jika sudah punya (asumsi akun seller punya toko)
        await expect(page.getByText('Laporan Penjualan Toko', { exact: true })).toBeVisible();
        await expect(page.getByText('Total Pendapatan Anda')).toBeVisible();
        await expect(page.getByText('Total Pesanan Selesai')).toBeVisible();
        await expect(page.locator('table')).toBeVisible();
    });
});
