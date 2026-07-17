import { test, expect } from '@playwright/test';
import { getSeederUser } from '../helpers/db.js';
import { LoginPage } from '../pages/LoginPage.js';

test.describe('Seller Order Management Module', () => {
  let loginPage;

  test.beforeEach(async ({ page }) => {
    loginPage = new LoginPage(page);
    await loginPage.goto();
    
    // Login as seller
    const seller = getSeederUser('penjual');
    await loginPage.fillCredentials(seller.email, seller.password);
    await loginPage.submit();
  });

  test('Seller can view order and update status to dikirim', async ({ page }) => {
    // 1. Buka daftar pesanan
    await page.goto('/seller/orders');
    await expect(page.getByText('Daftar Pesanan Masuk')).toBeVisible();

    // Pastikan ada order
    const firstOrderDetail = page.getByRole('link', { name: 'Detail' }).first();
    if (await firstOrderDetail.isVisible()) {
        // Masuk ke detail
        await firstOrderDetail.click();
        
        await expect(page.getByText(/Detail Pesanan #/)).toBeVisible();

        // Update status pesanan
        await page.selectOption('select[name="status"]', 'dikirim');
        await page.fill('input[name="courier_name"]', 'JNE E2E Test');
        await page.fill('input[name="tracking_number"]', 'RESI-TEST-999');

        await page.getByRole('button', { name: 'Perbarui Pesanan' }).click();

        // Verifikasi flash message
        await expect(page.getByText('Status pesanan berhasil diperbarui.')).toBeVisible();
        
        // Verifikasi form tetap menampilkan nilai baru
        await expect(page.locator('input[name="tracking_number"]')).toHaveValue('RESI-TEST-999');
    } else {
        console.log('No orders to test.');
    }
  });
});
