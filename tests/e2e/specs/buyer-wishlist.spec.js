import { test, expect } from '@playwright/test';

test.describe('Buyer Wishlist Module', () => {
    test.beforeEach(async ({ page }) => {
        // Asumsi ada endpoint login untuk seeder buyer
        await page.goto('/login');
        await page.fill('input[name="email"]', 'pembeli1@tokokita.com');
        await page.fill('input[name="password"]', 'password');
        await page.click('button[type="submit"]');
        await page.waitForURL('/dashboard');
    });

    test('Harus menampilkan halaman daftar favorit yang kosong atau ada datanya', async ({ page }) => {
        await page.goto('/buyer/wishlist');
        await expect(page.getByText('Daftar Produk Favorit', { exact: true })).toBeVisible();
        await expect(page.locator('table')).toBeVisible();
    });

    // Karena add wishlist biasanya ada di detail produk, ini sekadar validasi flow bisa diakses
    test('Navigasi ke daftar favorit berhasil', async ({ page }) => {
        await page.goto('/buyer/wishlist');
        await expect(page.locator('text=Kelola data Daftar Produk Favorit')).toBeVisible();
    });
});
