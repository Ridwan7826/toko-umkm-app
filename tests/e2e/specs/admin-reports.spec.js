import { test, expect } from '@playwright/test';

test.describe('Admin Reports Module', () => {
    test.beforeEach(async ({ page }) => {
        // Asumsi ada endpoint login untuk seeder admin
        await page.goto('/login');
        await page.fill('input[name="email"]', 'admin@tokokita.com');
        await page.fill('input[name="password"]', 'password');
        await page.click('button[type="submit"]');
        await page.waitForURL('/dashboard');
    });

    test('Admin dapat melihat halaman Laporan Keseluruhan Platform', async ({ page }) => {
        await page.goto('/admin/reports');
        await expect(page.getByText('Laporan Keseluruhan Platform', { exact: true })).toBeVisible();
        await expect(page.getByText('Total Pendapatan Platform')).toBeVisible();
        await expect(page.getByText('Total Pesanan Selesai')).toBeVisible();
        await expect(page.locator('table')).toBeVisible();
    });
});
